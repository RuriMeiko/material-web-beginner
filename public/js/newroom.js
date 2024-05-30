const dataCreateRoom = { info: { avt: '', name: '' }, user: [] };

dataCreateRoom.info.avt = $('#newroom-review').attr('src');

$('#next-newroom-btn').click(function (e) {
    e.preventDefault();
    if ($('#nameroomchat').val()) {
        dataCreateRoom.info.name = $('#nameroomchat').val();

        $('#newroom-info').hide();
        $('#newroom-member').css('display', 'flex');
    }
    else showToast('❌ Bạn chưa nhập tên phòng chat!');

});
$('#avatar').change(function (e) {
    var file = e.target.files[0];
    console.log(file);
    dataCreateRoom.info.avt = file;
});
$('#f-newroom-btn').click(async function (e) {
    e.preventDefault();
    const fd = new FormData();
    fd.append('room_name', dataCreateRoom.info.name);
    fd.append('members', JSON.stringify(dataCreateRoom.user));
    // fd.append('avt', dataCreateRoom.user);

    const d = await fetch('/api/createroom', {
        method: 'POST',
        body: fd,

    });
    const dr = await d.text();
    if (dr == 'OK') {
        showToast('✅ Tạo phòng thành công');
        $('.popupnewfriend').fadeOut(250, () => $('.popupnewfriend').hide());
        window.location.reload(); // 400 là thời gian (milliseconds) để hoàn thành hiệu ứng
    }
    else
        showToast('❌ Tạo phòng thất bại');



});
$('.item-user').click(function () {
    // $('.nullchatscrene').hide();
    let divId = $(this).attr("id");
    const parts = divId.split("_");
    const result = parts[1];
    divId = result;

    // Thêm class "choosed" vào phần tử .item-chat được nhấp chuột
    if ($(this).hasClass('choosed')) {
        const index = dataCreateRoom.user.indexOf(divId);
        if (index > -1) { // only splice array when item is found
            dataCreateRoom.user.splice(index, 1); // 2nd parameter means remove one item only
        }
        $(this).removeClass('choosed');
    }
    else {
        $(this).addClass('choosed');
        dataCreateRoom.user.push(divId);
    }
    if ($('.item-user.choosed').length > 0) {
        if ($('.item-user.choosed').parent().parent().hasClass('dingu'))

            $('#add-curr-btn').show();
        else
            $('#f-newroom-btn').show();
    } else {
        if ($('.item-user').parent().parent().hasClass('dingu'))

            $('#add-curr-btn').hide();
        else
            $('#f-newroom-btn').hide();
    }
});



$('#find-newroom-btn').click(async function (e) {
    e.preventDefault();
    data = new FormData();

    data.append('search', $('#find-newroom').val());
    $('#find-newroom').val("");
    $('#find-newroom').focus();
    const r = await fetch('/api/searchuser', { method: 'POST', body: data });
    const dr = await r.json();
    for (let i = 0; i < dr.length; i++) {
        const obj = {
            name: dr[i].name,
            username: dr[i].username,
            avt: dr[i].avt
        };
        let checl = false;
        $('.item-user').each(function () {
            const a = $(this).prop('id').split('_');
            if (a[1] === obj.username) {
                // Phần tử có id giống với obj.username
                checl = true;
            }
        });
        if (checl) return;
        $('.member-container').append(
            `<div id=member_${obj.username} class="item-user" onclick="handleUserClick(this)">
                <md-elevation></md-elevation>
                <md-ripple-ripple></md-ripple-ripple>
                <div class='from-user'>
                    <div class='avatar-select avt'>
                        <img class="avatar-preview" class="avatar-preview mb-4" src='${obj.avt}' />
                    </div>
                </div>
                <div class="container">
                    <div class='name-user'>${obj.name}</div>
                </div>
            </div>`
        );





    }

});

function handleUserClick(element) {
    let divId = $(element).attr("id");
    const parts = divId.split("_");
    const result = parts[1];
    divId = result;

    // Thêm class "choosed" vào phần tử .item-chat được nhấp chuột
    if ($(element).hasClass('choosed')) {
        const index = dataCreateRoom.user.indexOf(divId);
        if (index > -1) { // only splice array when item is found
            dataCreateRoom.user.splice(index, 1); // 2nd parameter means remove one item only
        }
        $(element).removeClass('choosed');
    }
    else {

        $(element).addClass('choosed');
        dataCreateRoom.user.push(divId);
    }
    if ($('.item-user.choosed').length > 0) {
        if ($('.item-user.choosed').parent().parent().hasClass('dingu'))

            $('#add-curr-btn').show();
        else
            $('#f-newroom-btn').show();
    } else {
        if ($('.item-user').parent().parent().hasClass('dingu'))

            $('#add-curr-btn').hide();
        else
            $('#f-newroom-btn').hide();
    }
}

$('#add-curr-btn').click(async function (e) {
    e.preventDefault();
    const a = new FormData();
    a.append('members', JSON.stringify(dataCreateRoom.user));
    a.append('room_id', currentBox.room);

    const d = await fetch('/api/addmember', { method: 'POST', body: a });
    const dr = await d.text();
    if (dr == 'OK') {
        showToast('✅ Thêm thành công');
        $('.popupnewfriend').fadeOut(250, () => $('.popupnewfriend').hide()); // 400 là thời gian (milliseconds) để hoàn thành hiệu ứng
    }
    else
        showToast('❌ Thêm thất bại');
});