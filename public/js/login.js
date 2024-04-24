const formLogin = $('.formLogin');
const formReg = $('.formReg');
const passwordInput = $('.passwordInput');
const loading = $('.loading');


$('.tabbox').change((event) => {
    if (event.target.activeTabIndex === 1) {
        formLogin.hide();
        formReg.css("display", "flex");
        $("head title").text("Đăng ký");
    } else {
        formLogin.css("display", "flex");
        formReg.hide();
        $("head title").text("Đăng nhập");
    }
});


$('.eyesToggle').each((index, eye) => {
    $(eye).click((event) => {
        event.preventDefault();
    });

    $(eye).change((event) => {
        if ($('.passwordInput').eq(index).attr('type') === 'password' && event.target.selected) {
            $('.passwordInput').eq(index).attr('type', 'text');
            $(eye).attr('aria-label', 'Ẩn mật khẩu');
        } else {
            $('.passwordInput').eq(index).attr('type', 'password');
            $(eye).attr('aria-label', 'Hiển thị mật khẩu');
        }
    });
});

formLogin.submit(async (e) => {
    e.preventDefault();

    const formDate = new FormData();

    formDate.append('username', formLogin[0].username.value);
    formDate.append('password', formLogin[0].password.value);

    loading.css("display", "block");
    $('#login-btn').prop('disabled', true);

    const res = await fetch('/api/login', { method: 'POST', body: formDate });
    loading.css("display", "none");
    $('#login-btn').prop('disabled', false);
    if (res.status === 403) {
        showToast('Sai thông tin đăng nhập');
    } else {
        window.location.href = '/profile'
    };



});

formReg.submit(async (e) => {
    e.preventDefault();

    if (formReg[0].password.value === formReg[0].repassword.value) {
        const formDate = new FormData();

        formDate.append('username', formReg[0].username.value);
        formDate.append('password', formReg[0].password.value);
        formDate.append('name', formReg[0].name.value);
        formDate.append('birddate', formReg[0].birddate.value);
        formDate.append('gender', formReg[0].gender.value);
        formDate.append('location', formReg[0].location.value);
        loading.css("display", "block");
        $('#reg-btn').prop('disabled', true);
        const res = await fetch('/api/register', { method: 'POST', body: formDate });

        if (res.status === 200) {
            showToast('✔️ Đăng ký thành công');
            $(".tabbox")[0].activeTabIndex = 0;
        } else if (res.status === 403) {
            showToast('❌ Tài khoản đã tồn tại');
        };

        loading.css("display", "none");
        $('#reg-btn').prop('disabled', false);
    } else {
        formInfo[0].repassword.error = true;
        formInfo[0].repassword.supportingText = 'Repassword not match';
        formInfo[0].password.error = true;
        formInfo[0].password.supportingText = 'Repassword not match';

    }
});