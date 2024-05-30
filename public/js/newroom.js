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
$('#f-newroom-btn').click(function (e) {
    e.preventDefault();
    console.table(dataCreateRoom);


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



});

