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
        setRole(listCheck, true, false);
    }
    else showToast('❌ Vui lòng chọn user');
});

$('#deleteadmin').click(function () {
    if (listCheck.length > 0) {
        setRole(listCheck, false, false);
    }
    else showToast('❌ Vui lòng chọn user');
});


$('#block').click(function () {
    if (listCheck.length > 0) {
        setBlock(listCheck, true, false);
    }
    else showToast('❌ Vui lòng chọn user');
});

$('#unblock').click(function () {
    if (listCheck.length > 0) {
        setBlock(listCheck, false, false);
    }
    else showToast('❌ Vui lòng chọn user');
});

async function setRole(selectedAccounts, isAdmin, one = true) {
    $('#roleDialog').prop('open', true);
    $('#roleDialog div').eq(0).text(`Xác nhận cập nhật quyền`);

    $('#roleDialog').one('close', async function () {
        const okClicked = this.returnValue === 'ok';
        if (okClicked) {
            $('.checkboxAdmin').each(function () {
                if (selectedAccounts.includes($(this).val()))
                    $(this).prop('checked', isAdmin);
            });
            $('.xembtn').each(function () {
                if (selectedAccounts.includes($(this).prop('id')))
                    $(this).prop('disabled', isAdmin);
            });
            $('.checkboxBan').each(async function () {
                if (selectedAccounts.includes($(this).val())) {
                    $(this).prop('disabled', isAdmin);
                    if (isAdmin)
                        $(this).prop('checked', false);
                    const formData = new FormData();
                    formData.append('accounts', JSON.stringify([$(this).val()]));
                    formData.append('block', 0);

                    await fetch('/api/admin/block', {
                        method: 'POST',
                        body: formData
                    });
                }
            });
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
        } else {
            if (one)
                $('.checkboxAdmin').each(function () {
                    if (selectedAccounts.includes($(this).val()))
                        $(this).prop('checked', !isAdmin);
                });
        }
        this.returnValue = 'cancel';

    });
}
async function setBlock(selectedAccounts, isBlock, one = true) {
    const selectedAccountsShadow = selectedAccounts.slice();
    $('#roleDialog').prop('open', true);
    $('#roleDialog div').eq(0).text(`Xác nhận ${isBlock ? "chặn" : "bỏ chặn"} người dùng!`);

    $('#roleDialog').one('close', async function () {
        const okClicked = this.returnValue === 'ok';
        if (okClicked) {
            $('.checkboxAdmin').each(async function () {
                if ($(this).prop('checked')) {
                    const index = selectedAccountsShadow.indexOf($(this).val());
                    if (index > -1) { // only splice array when item is found
                        selectedAccountsShadow.splice(index, 1); // 2nd parameter means remove one item only
                    }
                }

            });
            $('.checkboxBan').each(function () {
                if (selectedAccountsShadow.includes($(this).val()))
                    $(this).prop('checked', isBlock);

            });

            const formData = new FormData();
            formData.append('accounts', JSON.stringify(selectedAccountsShadow));
            formData.append('block', isBlock ? 1 : 0);

            const res = await fetch('/api/admin/block', {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (data.success) {
                showToast(`✔️ Trạng thái của ${selectedAccountsShadow.join(', ')} đã cập nhật thành công!`);
            } else {
                showToast('❌ Lỗi khi cập nhật trạng thái!');
            }

        } else {
            if (one)
                $('.checkboxBan').each(function () {
                    if (selectedAccountsShadow.includes($(this).val()))
                        $(this).prop('checked', !isBlock);
                });
        }
        this.returnValue = 'cancel';

    });
}


let checkall = false
function displayUserData(data) {
    $('#user_data').empty();
    data.forEach(user => {
        const row = `<tr>
        <td class="mdc-data-table__cell">
        <div class="mdc-data-table__cell-div">
            <md-checkbox class="${user.username !== myusername && 'checkboxitem'}" ${user.username === myusername && 'disabled'} value="${user.username}" ${checkall && 'checked'} touch-target="wrapper"></md-checkbox>
            </div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.name}</p></div>
        </td>
        <td class="mdc-data-table__cell">
        <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><md-text-button class="xembtn" ${user.role === 0 && "disabled"} ${user.hasReview === 0 && "disabled"} id="${user.username}">Xem</md-text-button>
        </div>
    </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.username}</p></div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation>${user.birthday}</div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${user.gender === 1 ? 'Nam' : 'Nữ'}</div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation><p>${user.location}</p></div>
        </td>
        <td class="mdc-data-table__cell">
        <div class="mdc-data-table__cell-div"> <md-checkbox value="${user.username}" ${user.role === 0 && "disabled"} class="${user.username !== myusername && 'checkboxBan'}" ${user.ban !== 0 && 'checked'} ${user.username === myusername && 'disabled'} touch-target="wrapper"></md-checkbox> </div>
        </td>
        <td class="mdc-data-table__cell">
            <div class="mdc-data-table__cell-div"> <md-checkbox value="${user.username}" class="${user.username !== myusername && 'checkboxAdmin'}" ${user.role === 0 && 'checked'} ${user.username === myusername && 'disabled'} touch-target="wrapper"></md-checkbox> </div>
        </td>

    </tr>`;
        $('#user_data').append(row);
    });
    $('.checkboxAdmin').click(async function (e) {
        await setRole([e.target.value], !e.target.checked);
    });
    $('.checkboxBan').click(async function (e) {
        await setBlock([e.target.value], !e.target.checked);
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
    $('.xembtn').click(function () {
        window.location.href = "/admin/review/" + $(this).prop('id');
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