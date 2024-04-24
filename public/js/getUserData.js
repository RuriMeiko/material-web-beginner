$(document).ready(async function() {
    const formData = new FormData();
    formData.append('obset', 0);
    formData.append('range', 100);
    
    const res = await fetch('/api/getuserdata', {
        method: 'POST',
        body: formData
    });
    
    const data = await res.json();
    
    if (res.status === 403) {
        showToast('Tải Dữ liệu Thất Bại !');
    } else {
        displayUserData(data);
    }
});
async function setRole() {
    const selectedAccounts = [];
    const role = document.getElementById('admin_checkbox').checked ? 1 : 0; // Check if admin checkbox is checked

    // Get selected accounts
    $('input[type="checkbox"]:checked').each(function () {
        selectedAccounts.push($(this).closest('tr').find('td:nth-child(2)').text());
    });

    const formData = new FormData();
    formData.append('accounts', JSON.stringify(selectedAccounts));
    formData.append('newRole', role);

    const res = await fetch('/api/changerole', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();

    if (res.status === 200) {
        showToast('Role updated successfully!');
    } else {
        showToast('Failed to update role!');
    }
}

function displayUserData(data) {
    $('#user_data').empty();
    data.forEach(user => {
        const row = `<tr>
            <td>${user.name}</td>
            <td>${user.username}</td>
            <td>${user.birddate}</td>
            <td>${user.gender === 0 ? 'Male' : 'Female'}</td>
            <td>${user.location}</td>
            <td>${user.role}</td>
            <td><input type="checkbox"></td>
        </tr>`;
        $('#user_data').append(row);
    });
}
function showToast(message) {
    alert(message);
}