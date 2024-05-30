let currentPage = 1;
let maxPages = 1;
async function fetctData(obset, range) {
    const formData = new FormData();


    formData.append('obset', obset);
    formData.append('range', range);

    const res = await fetch('/api/admin/getallchatroom', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();
    $('.loading').hide();

    if (res.status === 403) {
        showToast('❌ Tải Dữ liệu Thất Bại!');
    } else {
        console.table(data)
        displayUserData(data);
    }
}

async function setState(selectedAccounts, isBan) {
    const formData = new FormData();
    formData.append('rooms', JSON.stringify(selectedAccounts));
    formData.append('newState', isBan ? 1 : 0);

    const res = await fetch('/api/admin/roomchangestate', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();
    if (data.success) {
        showToast(`✔️ ${selectedAccounts[0]}'s State updated successfully!`);
    } else {
        showToast('❌ Failed to update State!');
    }
}

function displayUserData(data) {
    $('#user_data').empty();
    data.forEach(room => {
        const row = `<tr>
               
                        <td class="mdc-data-table__cell">
                            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${room.name}</div>
                        </td>
                        <td class="mdc-data-table__cell">
                            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${room.member_count}</div>
                        </td>
                        <td class="mdc-data-table__cell">
                            <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${room.state === 0 ? "Hoạt Động" : "Cấm Truy Cập "}</div>
                        </td> 
                        <td class="mdc-data-table__cell">
                            <div class="mdc-data-table__cell-div">  <md-checkbox value="${room.id}" class="checkboxState" ${room.state === 1 && 'checked'} touch-target="wrapper"></md-checkbox> </div>
                        </td>
                    </tr>`;
        $('#user_data').append(row);
    });
    $('.checkboxState').click(async function (e) {
        let currentColumn = $(this).closest('td');
        let previousColumn = currentColumn.prev();
        $('#roleDialog').prop('open', true);

        $('#roleDialog').one('close', async function () {
            const okClicked = this.returnValue === 'ok';
            if (okClicked) {
                previousColumn.html(`<div class="mdc-data-table__cell-div"> <md-elevation></md-elevation> ${e.target.checked ? 0 : 1}</div>`);
                await setState([e.target.value], e.target.checked);
            } else
                e.target.checked = !e.target.checked;
            this.returnValue = 'cancel'
        });
    });
}

async function goToPage(page) {
    currentPage = page;
    console.log(currentPage)
    await fetctData(5 * (currentPage - 1), 5);
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
    const res = await fetch('/api/admin/getchatroomcount', {
        method: 'POST',
    });
    const count = await res.json();
    maxPages = Math.ceil(count.message / 5);
    updateButtonState();
    await fetctData(5 * currentPage - 5, 5 * currentPage);

});