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
