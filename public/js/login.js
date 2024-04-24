const tabs = document.querySelector('.tabbox');
const formLogin = document.querySelector('.formLogin');
const formReg = document.querySelector('.formReg');
const eyes = document.querySelectorAll('.eyesToggle');
const passwordInput = document.querySelectorAll('.passwordInput');
const loading = document.querySelector('.loading');

tabs.addEventListener('change', (event) => {
    if (event.target.activeTabIndex === 1) {
        formLogin.style.display = 'none';
        formReg.style.display = 'flex';
        document.title = 'Đăng ký';
    } else {
        formLogin.style.display = 'flex';
        formReg.style.display = 'none';
        document.title = 'Đăng nhập';


    }
});

eyes.forEach((eye, index) => {
    eye.addEventListener('click', (event) => {
        event.preventDefault();
    });
    eye.addEventListener('change', (event) => {

        if (passwordInput[index].type === 'password' && event.target.selected) {
            passwordInput[index].type = 'text';
            eye.setAttribute('aria-label', 'Ẩn mật khẩu');
        } else {
            passwordInput[index].type = 'password';
            eye.setAttribute('aria-label', 'Hiển thị mật khẩu');
        }
    });
});

formLogin.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formDate = new FormData();
    formDate.append('username', formLogin.username.value);
    formDate.append('password', formLogin.password.value);
    loading.style.display = 'block';
    const res = await fetch('/api/login', { method: 'POST', body: formDate });
    if (res.status === 403) {
        showToast('Sai thông tin đăng nhập');
    };
    loading.style.display = 'none';


});

formReg.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formDate = new FormData();
    formDate.append('username', formReg.username.value);
    formDate.append('password', formReg.password.value);
    formDate.append('name', formReg.name.value);
    formDate.append('birddate', formReg.birddate.value);
    formDate.append('gender', formReg.gender.value);
    formDate.append('location', formReg.location.value);
    loading.style.display = 'block';
    const res = await fetch('/api/register', { method: 'POST', body: formDate });
    if (res.status === 403) {
        showToast('Tài khoản đã tồn tại');
    };
    loading.style.display = 'none';


});