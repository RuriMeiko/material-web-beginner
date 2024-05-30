// Dữ liệu số lượng người dùng đạt và không đạt
$(document).ready(
    async function () {


        // const res = await fetch('/api/admin/statistical', {
        //     method: 'GET',
        // });

        // const data = await res.json();
        const data = { success: true };
        const dataChart = {
            labels: [
                'Đạt',
                'Không đạt',
            ],
            datasets: [{
                label: 'Thống kê hội viên',
                data: [122, 9855],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        if (data.success) {
            // dataChart.datasets[0].data = [data.message.good, data.message.notgood];
            let ctx = document.getElementById("statistical").getContext("2d");

            new Chart(ctx, {
                type: 'doughnut',
                data: dataChart,
            });
        } else {
            showToast('❌ Tải Dữ liệu Thất Bại!');
        }

    });

