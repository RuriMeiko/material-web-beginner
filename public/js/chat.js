
$(document).ready(function () {
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
    function appendMessage(content) {
        function getCurrentTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();

            // Định dạng giờ và phút thành chuỗi hh:mm
            var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

            return formattedTime;
        }
        const message = `
        <div class="mess-self">
            <div class="mess-chat">
                <div class="content-chat">
                    <p>${content.replace(/\n/g, '<br>')}</p>
                    <span class="time-chat">${getCurrentTime()}</span>

                </div>

                <div class='from-user'>
                    <div class='avatar-select avt avt-title'>
                        <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                    </div>
                </div>

            </div>
        </div>`;
        $('.chatlayout').append(message);
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
            var content = this.value;
            var caret = getCaret(this);
            this.value = content.substring(0, caret) + content.substring(caret, content.length);
            event.stopPropagation();
        }
    });

    function getCaret(el) {
        if (el.selectionStart) {
            return el.selectionStart;
        } else if (document.selection) {
            el.focus();
            var r = document.selection.createRange();
            if (r == null) {
                return 0;
            }
            var re = el.createTextRange(),
                rc = re.duplicate();
            re.moveToBookmark(r.getBookmark());
            rc.setEndPoint('EndToStart', re);
            return rc.text.length;
        }
        return 0;
    }
    $('.sendBtn').click(function () {
        if (textContent.val()) {
            appendMessage(textContent.val());
            textContent.val('');
        }
    });

    $('.item-chat').click(function () {
        var divId = $(this).attr("id");
        // Loại bỏ class "choosed" khỏi tất cả các phần tử .item-chat
        $('.item-chat').removeClass('choosed');

        // Thêm class "choosed" vào phần tử .item-chat được nhấp chuột
        $(this).addClass('choosed');
        console.log(divId);
    });


    $('.chat').on('contextmenu', function (event) {
        console.log('haha');
        event.preventDefault();
        var menu = $('#usage-document');
        menu.css({
            left: event.pageX + 'px',
            top: event.pageY + 'px'
        });
        menu.attr('open', 'true');
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

});