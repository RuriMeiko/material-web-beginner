
$(document).ready(function () {
    let identification = null;
    const socket = new WebSocket('ws://localhost:8000/chat');
    socket.onopen = function () {
        console.log('Kết nối WebSocket đã được thiết lập.');
    };
    let currentBox = { room: '', id: '' };
    socket.onmessage = function (event) {
        let data = JSON.parse(event.data); // Nhận mã id định danh từ server
        if (data.identification) {
            identification = data.id;
            let sessionCookie = document.cookie
                .split(';')
                .map(cookie => cookie.trim())
                .find(cookie => cookie.startsWith('session='));

            let sessionValue = sessionCookie ? sessionCookie.split('=')[1] : null;
            socket.send(JSON.stringify({ identification: decodeURIComponent(sessionValue) }));
        } else {
            listChat[data.room].push({
                chatId: data.room,
                content: data.content,
                fromMe: data.self === false ? 1 : 0,
                id: data.id,
                name: null,
                timestamp: data.timestamp,
            })
            $(`#chatroom_${data.room} .container .content-user`).html(`${data.self ? "<strong>Bạn: </strong>" : ""}${data.content}`);

            if (currentBox.room === data.room) {
                appendMessage(data.content, !data.self, data.timestamp, 'mess_' + data.id);

            }


        }
    };

    socket.onclose = function () {
        console.log('Kết nối WebSocket đã đóng.');
    };
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

    let chatbox = $('.chatbox');

    chatbox.scrollTop(chatbox.prop('scrollHeight'));
    function appendMessage(content, you = false, time = null, id = '') {
        function getCurrentTime() {
            let currentTime = new Date();
            if (time) {
                currentTime = new Date(time);
            }

            let hours = currentTime.getHours();
            let minutes = currentTime.getMinutes();

            // Định dạng giờ và phút thành chuỗi hh:mm
            let formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

            return formattedTime;
        }


        if (content !== null) {
            const formatContent = content.replace(/\n/g, '<br>');
            const message = `
            <div class="${you ? 'mess-other' : 'mess-self'}">
                <div class="mess-chat">
                    <div class="content-chat">
                        <md-elevation></md-elevation>

                        
                        <p>${formatContent}</p>
                        <span class="time-chat">${getCurrentTime()}</span>

                    </div>

                    <div class='from-user' id="${id}">
                        <div class='avatar-select avt avt-title'>
                            <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                        </div>
                    </div>

                </div>
            </div>`;
            $('.chatlayout').append(message);
            $('.mess-other, .mess-self').on('contextmenu', messClick);
        }

        chatbox.scrollTop(chatbox.prop('scrollHeight'));
    }
    // Gán màu ngẫu nhiên cho từng phần tử
    $('.usermessname').each(function (index, element) {
        let randomColor = getRandomColor();
        $(element).css('color', randomColor);
    });


    chatbox.scroll(function () {
        let isScrolledToBottom = chatbox[0].scrollHeight - chatbox[0].clientHeight <= chatbox.scrollTop() + 1;

        if (isScrolledToBottom) {
            $('.chatlayout-divider').fadeOut(500);

        } else {
            $('.chatlayout-divider').fadeIn(500);

        }
    });

    const textContent = $('#input-mess')

    $('textarea').keydown(function (event) {
        if (event.keyCode == 13 && !event.shiftKey) {
            event.preventDefault();
            $('.sendBtn').click();
            textContent.focus();


        }
        else if (event.keyCode == 13 && event.shiftKey) {
            let content = this.value;
            let caret = getCaret(this);
            this.value = content.substring(0, caret) + content.substring(caret, content.length);
            event.stopPropagation();
        }
    });

    function getCaret(el) {
        if (el.selectionStart) {
            return el.selectionStart;
        } else if (document.selection) {
            el.focus();
            let r = document.selection.createRange();
            if (r == null) {
                return 0;
            }
            let re = el.createTextRange(),
                rc = re.duplicate();
            re.moveToBookmark(r.getBookmark());
            rc.setEndPoint('EndToStart', re);
            return rc.text.length;
        }
        return 0;
    }

    $('.sendBtn').click(function () {
        if (textContent.val()) {

            let currentTime = new Date();

            socket.send(JSON.stringify({ room: currentBox.room, receiver: currentBox.id, timestamp: currentTime, content: textContent.val() }));
            // appendMessage(textContent.val());

            textContent.val('');
        }
    });

    $('.item-chat').click(function () {
        // $('.nullchatscrene').hide();
        let divId = $(this).attr("id");
        const parts = divId.split("_");
        const result = parts[1];
        divId = result;
        // Loại bỏ class "choosed" khỏi tất cả các phần tử .item-chat
        $('.item-chat').removeClass('choosed');

        // Thêm class "choosed" vào phần tử .item-chat được nhấp chuột
        $(this).addClass('choosed');
        $('.chatlayout').empty();
        currentBox.room = divId;
        console.log(listMember[divId], listMember);
        if (!listMember[divId]) return;
        currentBox.id = listMember[divId].map(item => item.memberId);
        listChat[divId].forEach((element, index) => {
            appendMessage(element.content, element.fromMe == 0, element.timestamp, 'mess_' + element.id)
        });
        $('.nullchatscrene').hide();
        $('.chatscrene').css('display', 'flex');

        // change chat channel info
        $('.name-user-title').text($(this).find('.name-user').text())

        chatbox.scrollTop(chatbox.prop('scrollHeight'));

    });

    const menuSurface = document.getElementById('usage-document');

    function messClick(event) {
        $(this).attr('id', "usage-document-anchor");
        $('#usage-document').children('md-menu-item').attr('target', $(this).children('.mess-chat').children('.from-user').attr('id'));
        $('.mess-other, .mess-self').removeClass('mess-chossed');
        event.preventDefault();
        if ($(this).hasClass('mess-other'))
            $(this).addClass('mess-chossed');
        else $(this).addClass('mess-chossed')
        menuSurface.xOffset = event.offsetX;
        menuSurface.open = true;
    }

    $('.mess-other, .mess-self').on('contextmenu', messClick);

    menuSurface.addEventListener('closing', function (event) {
        $('.mess-other, .mess-self').attr('id', "");
        $('.mess-other, .mess-self').removeClass('mess-chossed');
    });

    $('.re-mess').on('click', async function () {
        let idclickedItem = $(this).attr('target');
        origin_idclickedItem = idclickedItem.split('_')[1];
        const formData = new FormData();
        formData.append('status', "delM");
        formData.append('id', origin_idclickedItem);
        const res = await fetch('/api/delmess', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        console.log(data);
        if (data.status === 'OK') {
            $(`#${idclickedItem}`).parent().parent().remove();
            // socket.send('')
        } else {
            showToast('❌ Có lỗi khi thu hồi tin nhắn!');
        }
    });

    const new_mess = $("#fab-new-mess");
    $('.back_to_mess_icon').click(function () {
        $(this).hide();
        $('#openprofile').show();
        $('.listfriend').hide()
        $('.chatlist').css('display', 'flex');
    });


    new_mess.click(async function () {
        
    });
   
});



