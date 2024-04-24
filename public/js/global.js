function showToast(mess) {
    const divElement = `<div class="toast">
    <md-elevation></md-elevation>
    <div class='content'>
        <p>${mess}</p>
    </div>
    <md-text-button>Ẩn (5s)</md-text-button>
    </div>`;

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = divElement;

    const toast = tempDiv.firstChild;

    const btntoast = toast.querySelector('.toast md-text-button');
    btntoast.addEventListener('click', () => {
        toast.classList.remove('toastActive');
        toast.addEventListener('transitionend', () => {
            document.body.removeChild(toast);
        });
    })

    document.body.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('toastActive');
    }, 300)
    let timerCout = 4;
    setInterval(() => {
        btntoast.innerHTML = `Ẩn (${timerCout}s)`;
        timerCout--;
    }, 1000);

    setTimeout(() => {

        toast.classList.remove('toastActive');
        toast.addEventListener('transitionend', () => {
            document.body.removeChild(toast);
        });

    }, 5000);
}