$('#openprofile').click(function (e) {
    $('.popup').fadeIn(250, () => $('.popup').show()); // 400 là thời gian (milliseconds) để hoàn thành hiệu ứng

});

// Tạo hàm để lấy một màu HEX ngẫu nhiên
function getRandomColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Gán màu ngẫu nhiên cho từng phần tử
$('.usermessname').each(function (index, element) {
    let randomColor = getRandomColor();
    $(element).css('color', randomColor);
});

let chatbox = $('.chatbox');
chatbox.scroll(function () {
    let isScrolledToBottom = chatbox[0].scrollHeight - chatbox[0].clientHeight <= chatbox.scrollTop() + 1;

    if (isScrolledToBottom) {
        $('.chatlayout-divider').fadeOut(500);

        console.log('Đang ở dưới cùng');
    } else {
        $('.chatlayout-divider').fadeIn(500);

        console.log('Không ở dưới cùng');
    }
});

// tạo pòng
// const newrom = document.getElementById("fab-new-mess")
// newrom.onclick = async function(event){
//     event.preventDefault();


//     const formData = new FormData();
//     formData.append('user', "hhhh");
//     formData.append('admin', "hhhh");
//     formData.append('name', "hhhh");


//     const res = await fetch('/api/createchatroom', {
//         method: 'POST',
//         body: formData
//     });

//     const data = await res.json();
//     if (data.success) {
//         showToast(`✔️ ${selectedAccounts[0]}'s role updated successfully!`);
//     } else {
//         showToast('❌ Failed to update role!');
//     }
// }

// lấy nhiều user 
// const newrom = document.getElementById("fab-new-mess")
// newrom.onclick = async function (event) {
//     event.preventDefault();


//     const formData = new FormData();
//     formData.append('status', "getf");
//     formData.append('limit', 5);


//     const res = await fetch('/api/getaccount', {
//         method: 'POST',
//         body: formData
//     });

//     const data = await res.json();


//     console.log(data.message);
//     if (data.message && data.message.length > 0) {
//         data.message.forEach(function (user) {
//             var newDiv = document.createElement("div");
//             newDiv.setAttribute("class", "item-chat");
//             newDiv.innerHTML = `
//             <md-elevation></md-elevation>
//             <md-ripple></md-ripple>
//             <div class='from-user'>
//                 <div class='avatar-select avt'>
//                     <img class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
//                 </div>
//             </div>
//             <div class="container">
//                 <div class='name-user'>${user.name}</div>
//                 <div class='content-user'>em oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi day</div>
//             </div>
//           `;

//             // Lấy thẻ cha có class là "chatlist"
//             var chatList = document.querySelector(".chatlist");

//             // Thêm thẻ div mới vào trong thẻ cha
//             chatList.appendChild(newDiv);
//         });
//     }

//     if (data.success) {
//         showToast(`✔️ ${selectedAccounts[0]}'s role updated successfully!`);
//     } else {
//         showToast('❌ Failed to update role!');
//     }
// }

// kết bạn bốn phương
const newrom = document.getElementById("fab-new-mess")
newrom.onclick = async function (event) {
    event.preventDefault();


    const formData = new FormData();
    formData.append('status', "addf");
    formData.append('user_1', "admin");
    formData.append('user_2', "user1");
    formData.append('state', 0);


    const res = await fetch('/api/addfriend', {
        method: 'POST',
        body: formData
    });

    const data = await res.json();

    if (data.success) {
        showToast(`✔️ ${selectedAccounts[0]}'s role updated successfully!`);
    } else {
        showToast('❌ Failed to update role!');
    }
}