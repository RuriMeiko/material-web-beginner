function showToast(mess) {
    const divElement = `<div class="toast">
    <md-elevation></md-elevation>
    <div class='content'>
        <p>${mess}</p>
    </div>
    <md-text-button>Ẩn (5s)</md-text-button>
    </div>`;

    const tempDiv = $('<div></div>').html(divElement);
    const toast = tempDiv.find('.toast');
    const btntoast = toast.find('md-text-button');

    $('body').append(toast);

    btntoast.on('click', () => {
        toast.removeClass('toastActive');
        toast.slideUp(400, () => { toast.remove() });

    });


    setTimeout(() => {
        toast.addClass('toastActive');
    }, 100);

    let timerCout = 4;
    setInterval(() => {
        btntoast.text(`Ẩn (${timerCout}s)`);
        timerCout--;
    }, 1000);

    setTimeout(() => {
        toast.removeClass('toastActive');
        toast.slideUp(400, () => { toast.remove() });
    }, 5000);
}
