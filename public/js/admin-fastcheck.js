$('.reviewBtn').click(async function (e) {
    e.preventDefault();
    const dataSend = [];
    $('md-filled-select').each(function () {
        var value = $(this).val();
        parts = value.split("|"); // Phân tách phần tử thành các phần
        dataSend.push({
            oritieuchiid: parts[0],
            idtieuchi: parts[1],
            diem: parts[2],
            version: parts[3],
            idtieuchuan: parts[4],

        });
    });
    const data = await fetch('/api/admin/fastcheck', { method: 'POST', body: JSON.stringify({ dataSend: dataSend, status: $(this).prop('id') === "okbtn" }) });
    const dr = await data.json();
    if (dr.success) {
        return showToast("✔️ Đánh giá thành công");
    }
    return showToast("❌ Đánh giá thất bại, vui lòng tải lại trang và thử lại");
});