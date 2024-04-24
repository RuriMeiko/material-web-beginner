
const formLogin = $('.formLogin');
const formReg = $('.formReg');
const eyes = $('.eyesToggle');
const passwordInput = $('.passwordInput');
const loading = $('.loading');


$('.tabbox').change((event) => {
    if (event.target.activeTabIndex === 1) {
        formLogin.hide();
        formReg.css("display","flex");
        $("head title").text("Đăng ký");
    } else {
        formLogin.css("display","flex");
        formReg.hide();
        $("head title").text("Đăng nhập");
    }
});


$('.eyesToggle').each((index, eye) => {
    $(eye).click((event) => {
        event.preventDefault();
    });

    $(eye).change((event) => {
        if ($('.passwordInput').attr('type') === 'password' && event.target.selected) {
            $('.passwordInput').attr('type', 'text');
            $(eye).attr('aria-label', 'Ẩn mật khẩu');
        } else {
            $('.passwordInput').attr('type', 'password');
            $(eye).attr('aria-label', 'Hiển thị mật khẩu');
        }
    });
});

formLogin.submit(async (e) => {
    e.preventDefault();

    const formDate = new FormData();

    formDate.append('username', formLogin[0].username.value);
    formDate.append('password', formLogin[0].password.value);

    loading.css("display","block");

    const res = await fetch('/api/login', { method: 'POST', body: formDate });
    if (res.status === 403) {
        showToast('Sai thông tin đăng nhập');
    };

    loading.css("display","none");
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
        loading.css("display","block");
    
        const res = await fetch('/api/register', { method: 'POST', body: formDate });
    
        if (res.status === 200) {
            showToast('✔️ Đăng ký thành công'); 
            $(".tabbox")[0].activeTabIndex = 0;
        }else if (res.status === 403) {
            showToast('❌ Tài khoản đã tồn tại');
        };
    
        loading.css("display","none");
    } else {
        formReg[0].repassword.error = true;
        formReg[0].repassword.supportingText = 'Repassword not match';

    }
});