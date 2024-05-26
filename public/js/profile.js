
$(function () {
    const formInfo = $('.formInfo');
    const loading = $('.loading');

    tippy('#avatar', {
        content: 'Đổi ảnh đại diện',
        placement: 'bottom',
    });



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