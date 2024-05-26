
let avt = '';
function previewAvatar(event) {
    const input = event.target;
    const preview = $('#avatar-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.prop('src', e.target.result);
            avt = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$(function () {
    const formInfo = $('.formInfo');
    const loading = $('.loading');
    const formPassword = $('.formPassword');

    tippy('#change-password', {
        content: 'Cập nhật mật khẩu',
        placement: 'bottom',
    });
    tippy('#change-info', {
        content: 'Cập nhật thông tin cá nhân',
        placement: 'bottom',
    });


    tippy('#avatar', {
        content: 'Đổi ảnh đại diện',
        placement: 'bottom',
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

    formPassword.submit(async function (e) {
        console.log(e);
        e.preventDefault();
        formPassword[0].currentpassword.error = false;
        formPassword[0].currentpassword.supportingText = '';
        formPassword[0].newpassword.error = false;
        formPassword[0].newpassword.supportingText = '';
        formPassword[0].repassword.error = false;
        formPassword[0].repassword.supportingText = '';
        console.log(!formPassword[0].currentpassword.value);
        if (!formPassword[0].currentpassword.value) {
            formPassword[0].currentpassword.error = true;
            return formPassword[0].currentpassword.supportingText = 'Vui lòng nhập mật khẩu hiện tại';
        }
        if (!formPassword[0].newpassword.value) {
            formPassword[0].newpassword.error = true;
            return formPassword[0].newpassword.supportingText = 'Vui lòng nhập mật khẩu mới';

        }
        if (!formPassword[0].repassword.value) {
            formPassword[0].repassword.error = true;
            return formPassword[0].repassword.supportingText = 'Vui lòng nhập lại mật khẩu mới';

        }
        if (formPassword[0].newpassword.value === formPassword[0].repassword.value) {
            const formData = new FormData(this);
            loading.css("display", "block");
            $('#save-btn').prop('disabled', true);
            const res = await fetch('/api/profile/update', { method: 'POST', body: formData });

            if (res.status === 200) {
                showToast('✔️ Cập nhật thành công, bạn sẽ phải đăng nhập lại!');
                setTimeout(() => {
                    window.location.reload();
                }, 5000);
            } else if (res.status === 403) {
                formPassword[0].currentpassword.error = true;
                formPassword[0].currentpassword.supportingText = 'Mật khẩu hiện tại sai';
                showToast('🔒 Mật khẩu hiện tại sai');
            }
            else if (res.status === 203) {
                formPassword[0].newpassword.error = true;
                formPassword[0].newpassword.supportingText = 'Mật khẩu mới không được giống với mật khẩu hiện tại';
                formPassword[0].repassword.error = true;
                formPassword[0].repassword.supportingText = 'Mật khẩu mới không được giống với mật khẩu hiện tại';
                showToast('🔒 Mật khẩu mới không được giống với mật khẩu hiện tại');
            }
            else if (res.status === 500) {
                showToast('❌ Có lỗi đã xảy ra');
            };

            loading.css("display", "none");
            $('#save-btn').prop('disabled', false);
        } else {
            formPassword[0].repassword.error = true;
            formPassword[0].repassword.supportingText = 'Mật khẩu nhập lại không giống nhau';
            formPassword[0].newpassword.error = true;
            formPassword[0].newpassword.supportingText = 'Mật khẩu nhập lại không giống nhau';
        }


    })

    $(document).on('keypress', function (e) {
        if (e.which == 13) {
            $('#save-btn').click();
        }
    });

    formInfo.submit(async function (e) {
        e.preventDefault();


        const formData = new FormData(this);
        loading.css("display", "block");
        $('#save-btn').prop('disabled', true);
        const res = await fetch('/api/profile/update', { method: 'POST', body: formData });

        if (res.status === 200) {
            showToast('✔️ Cập nhật thành công');
        } else if (res.status === 403) {
            showToast('❌ Có lỗi đã xảy ra');
        };

        loading.css("display", "none");
        $('#save-btn').prop('disabled', false);

    })

    $(document).on('keypress', function (e) {
        if (e.which == 13) {
            $('#save-btn').click();
        }
    });
});