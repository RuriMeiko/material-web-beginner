$(function () {
    tippy('#logoutbtn', {
        content: 'Đăng xuất',
    });
    tippy('#adminbtn', {
        content: 'Trang admin',
    });
    tippy('#openprofile', {
        content: 'Trang profile',
    });
  
});


function showToast(mess) {
    const divElement = `<div class="toast">
    <md-elevation></md-elevation>
    <div class='content'>
        <p>${mess}</p>
    </div>
    <md-text-button>Ẩn (5s)</md-text-button>
</div>`;
    const totalToastHeight = $('.toast').map(function () {
        return $(this).height() + 5;
    }).get().reduce(function (a, b) {
        return a + b;
    }, 0);
    const tempDiv = $('<div></div>').html(divElement);
    const toast = tempDiv.find('.toast');
    const btntoast = toast.find('md-text-button');

    $('body').append(toast);

    btntoast.on('click', () => {
        toast.removeClass('toastActive');
        const toastIndex = $('.toast').index(toast);
        const removedToastHeight = toast.height() + 5;
        toast.slideUp(400, () => {
            toast.remove();
            $('.toast').each(function (index) {
                if (index >= toastIndex) {
                    const currentTop = parseFloat($(this).css('top'));
                    $(this).css('top', `${currentTop - removedToastHeight}px`);
                }
            });
        });

    });


    setTimeout(() => {
        toast.addClass('toastActive');
        toast.css('top', `${totalToastHeight}px`); // Thiết lập thuộc tính 'top' dựa trên số lượng .toast đã có
    }, 100);

    let timerCout = 4;
    setInterval(() => {
        btntoast.text(`Ẩn (${timerCout}s)`);
        timerCout--;
    }, 1000);

    setTimeout(() => {
        toast.removeClass('toastActive');
        const toastIndex = $('.toast').index(toast);
        const removedToastHeight = toast.height() + 5;
        toast.slideUp(400, () => {
            toast.remove();
            $('.toast').each(function (index) {
                if (index >= toastIndex) {
                    const currentTop = parseFloat($(this).css('top'));
                    $(this).css('top', `${currentTop - removedToastHeight}px`);
                }
            });
        });

    }, 5000);
}