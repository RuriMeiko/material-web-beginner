let currentPage = 1;
let maxPages = 1;
async function fetctData(obset, range) {
    const formData = new FormData();


    formData.append('obset', obset);
    formData.append('range', range);

    const res = await fetch('/api/admin/getuserdata', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();
    $('.loading').hide();

    if (res.status === 403) {
        showToast('❌ Tải Dữ liệu Thất Bại!');
    } else {
        displayUserData(data);
    }
}
let listCheck = [];


$('#toadminbtn').click(function () {
    if (listCheck.length > 0) {
        setRole(listCheck, true);
        $('.checkboxAdmin').prop('checked', true);
    }
    else showToast('❌ Vui lòng chọn user');
});

$('#deleteadmin').click(function () {
    if (listCheck.length > 0) {
        setRole(listCheck, false);
        $('.checkboxAdmin').prop('checked', false);
    }
    else showToast('❌ Vui lòng chọn user');
});

async function setRole(selectedAccounts, isAdmin) {
    const formData = new FormData();
    formData.append('accounts', JSON.stringify(selectedAccounts));
    formData.append('newRole', isAdmin ? 0 : 1);

    const res = await fetch('/api/admin/changerole', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();
    if (data.success) {
        showToast(`✔️ Quyền của ${selectedAccounts.join(', ')} đã cập nhật thành công!`);
    } else {
        showToast('❌ Lỗi khi cập nhật quyền!');
    }
}
let checkall = false
function displayUserData(data) {
    $('#user_data').empty();
    data.forEach(user => {
        const row = `<tr>
        <td class="mdc-data-table__cell">
        <div class="mdc-data-table__cell-div">
            <md-checkbox class="${user.username !== myusername && 'checkboxitem'}" ${user.username === myusername && 'checked'} ${user.username === myusername && 'disabled'} value="${user.username}" ${checkall && 'checked'} touch-target="wrapper"></md-checkbox>
            </div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.name}</p></div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.username}</p></div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation>${user.birthday}</div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${user.gender === 0 ? 'Male' : 'Female'}</div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.location}</p></div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.role}</div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-checkbox value="${user.username}" class="checkboxAdmin" ${user.role === 0 && 'checked'} ${user.username === myusername && 'disabled'} touch-target="wrapper"></md-checkbox> </div>
        </td>

    </tr>`;
        $('#user_data').append(row);
    });
    $('.checkboxAdmin').click(async function (e) {
        let currentColumn = $(this).closest('td');
        let previousColumn = currentColumn.prev();
        $('#roleDialog').prop('open', true);
        $('#roleDialog').one('close', async function () {
            const okClicked = this.returnValue === 'ok';
            if (okClicked) {
                previousColumn.html(`<div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${e.target.checked ? 0 : 1}</div>`);
                await setRole([e.target.value], e.target.checked);
            } else {
                e.target.checked = false;
                this.returnValue = 'cancel'
            }
        });
    });

    $('.checkboxitem').click(function (e) {
        if (!$(this).prop('checked'))
            listCheck.push(e.target.value);
        else {
            const index = listCheck.indexOf(e.target.value);
            if (index > -1) { // only splice array when item is found
                listCheck.splice(index, 1); // 2nd parameter means remove one item only
            }
        }
        $('.checkall').prop('indeterminate', true);


    });




}
$('.checkall').click(function () {

    if (checkall) {
        $('.checkboxitem').prop('checked', false);
        listCheck = [];
        checkall = false
    }
    else {
        $('.checkboxitem').each(function () {
            if (myusername !== $(this).prop('value'))
                listCheck.push($(this).prop('value'));
        }); $('.checkboxitem').prop('checked', true);
        checkall = true
    }
});



async function goToPage(page) {
    currentPage = page;
    await fetctData(7 * currentPage - 7, 7 * currentPage);

    updateButtonState();
}

function updateButtonState() {
    $('#pageNumbers p').text(currentPage);
    $('#prevBtn').prop('disabled', currentPage === 1);
    $('#nextBtn').prop('disabled', currentPage === maxPages);
}

$('#prevBtn').click(async function () {
    if (currentPage > 1) {
        await goToPage(currentPage - 1);
    }
});

$('#nextBtn').click(async function () {
    if (currentPage < maxPages) {
        await goToPage(currentPage + 1);
    }
});


$(document).ready(async () => {
    const res = await fetch('/api/admin/getcount', {
        method: 'POST',
    });
    const count = await res.json();
    maxPages = Math.ceil(count.message / 7);
    updateButtonState();
    await fetctData(7 * currentPage - 7, 7 * currentPage);


});