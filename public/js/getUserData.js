const let_fetch_btn = document.getElementById("let_fetch");
let_fetch_btn.onclick = async (event) => {
    const formData = new FormData();
    formData.append('obset', 0);
    formData.append('range', 100);
    const res = await fetch('/api/getuserdata', {
        method: 'POST',
        body: formData
    });
    const data = await res.json();

    if (res.status === 403) {
        showToast('Tài khoản đã tồn tại');
    } else {
        displayUserData(data);
    }
};

function displayUserData(data) {
    const userTable = document.getElementById('user_data');
    userTable.innerHTML = '';
    data.forEach(user => {
        const row = `<tr>
            <td>${user.name}</td>
            <td>${user.username}</td>
            <td>${user.birddate}</td>
            <td>${user.gender === 0 ? 'Male' : 'Female'}</td>
            <td>${user.location}</td>
        </tr>`;
        userTable.innerHTML += row;
    });
}

function showToast(message) {
    alert(message);
}

