$('.sendBtntoAdmin').click(async function (e) {
    e.preventDefault();
    const dataSend = [];
    $('md-filled-select').each(function () {
        let value = $(this).val();
        parts = value.split("|"); // Phân tách phần tử thành các phần
        dataSend.push({
            idtieuchuan: parts[0],
            idtieuchi: parts[1],
            diem: parts[2],

        });
    });
    const data = await fetch('/api/fastcheck', { method: 'POST', body: JSON.stringify(dataSend) });
    const dr = await data.json();
    if (dr.success) {
        return showToast("✔️ Gửi bảng thành công");
    }
    return showToast("❌ Gửi bảng thất bại, vui lòng tải lại trang và thử lại");



});

function getTotal() {
    let totalScore = 0;
    $('md-filled-select').each(function () {
        let value = $(this).val();
        parts = value.split("|"); // Phân tách phần tử thành các phần
        totalScore += parseInt(parts[2]);
    });
    $('.tongdiem').text('Tổng điểm: ' + totalScore)
}



$('md-filled-select').on('change', getTotal)