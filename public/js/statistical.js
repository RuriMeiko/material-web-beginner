// Dữ liệu số lượng người dùng đạt và không đạt
$(document).ready(
    async function () {
        const res = await fetch('/api/admin/statistical', {
            method: 'GET',
        });
        const data = await res.json();
        const dataChart = {
            labels: [
                'tài khoản hợp lệ',
                'tài khoản bị hạn chế',
            ],
            datasets: [{
                label: 'Thống kê tài khoản',
                data: [1, 1],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };

        const dataRoomChart = {
            labels: [
                'phòng chat hợp lệ',
                'phòng chat bị hạn chế',
            ],
            datasets: [{
                label: 'Thống kê phong chat',
                data: [1, 1],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };
        if (data.success) {
            dataChart.datasets[0].data = [ data.message.unban, data.message.ban];


            dataRoomChart.datasets[0].data = [data.message.roomuban, data.message.roomban];
            
            let ctx = document.getElementById("statistical").getContext("2d");
            let rctx = document.getElementById("roomstatistical").getContext("2d");

            new Chart(rctx, {
                type: 'doughnut',
                data: dataRoomChart,
            });
            new Chart(ctx, {
                type: 'doughnut',
                data: dataChart,
            });
        } else {
            showToast('❌ Tải Dữ liệu Thất Bại!');
        }

    });

