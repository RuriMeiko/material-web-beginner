const formInfo = $('.formInfo');
const loading = $('.loading');

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

formInfo.submit(async function (e) {
    e.preventDefault();
    formInfo[0].repassword.error = false;
    formInfo[0].repassword.supportingText = '';
    formInfo[0].password.error = false;
    formInfo[0].password.supportingText = '';
    if (formInfo[0].password.value === formInfo[0].repassword.value) {
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
    } else {
        formInfo[0].repassword.error = true;
        formInfo[0].repassword.supportingText = 'Repassword not match';
        formInfo[0].password.error = true;
        formInfo[0].password.supportingText = 'Repassword not match';
    }
})

$(document).on('keypress', function (e) {
    if (e.which == 13) {
        $('#save-btn').click();
    }
});