$('.sendBtn md-filled-button').click(async function (e) {
    e.preventDefault();
    const dataSend = [];
    $('md-filled-select').each(function () {
        var value = $(this).val();
        parts = value.split("|"); // Phân tách phần tử thành các phần
        dataSend.push({
            idtieuchuan: parts[0],
            idtieuchi: parts[1],
            diem: parts[2],

        });
    });
    const data = await fetch('/api/fastcheck', { method: 'POST', body: JSON.stringify(dataSend) });
    const dr = await data.json();
    if (dr.success){
        return showToast("✔️ Gửi bảng thành công");
    }
    return showToast("❌ Gửi bảng thất bại, vui lòng tải lại trang và thử lại");



});