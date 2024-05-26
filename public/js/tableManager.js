$(document).ready(function () {
    $('.enterscore').on('change', function () {
        if ($(this).val() < 1) $(this).val(1);
    });
    // Dữ liệu cây
    var data = [
        {
            text: "Tiêu chuẩn 1 (0 điểm)",
            icon: '/public/images/tieuchuan.svg',
            parent: "#",
            children: [
                { text: "Tiêu chí 1.1", data: { score: 2 }, icon: '/public/images/tieuchi.svg' },
                { text: "Tiêu chí 1.2", data: { score: 3 }, icon: '/public/images/tieuchi.svg' }
            ]
        },
        {
            text: "Tiêu chuẩn 2 (0 điểm)",
            icon: '/public/images/tieuchuan.svg',
            parent: "#",

            children: [
                { text: "Tiêu chí 2.1", data: { score: 4 }, icon: '/public/images/tieuchi.svg' },
                { text: "Tiêu chí 2.2", data: { score: 5 }, icon: '/public/images/tieuchi.svg' }
            ]
        }
        // Thêm tiêu chuẩn và tiêu chí khác tại đây
    ];

    // Khởi tạo cây jsTree
    $('#evaluationTree').jstree({
        "core": {
            "animation": 0,
            "check_callback": true,
            "themes": { "stripes": true },
            'data': data
        },
        "types": {
            "#": {
                "max_children": 1,
                "max_depth": 4,
                "valid_children": ["root"]
            },
            "root": {
                "icon": "/static/3.3.16/assets/images/tree_icon.png",
                "valid_children": ["default"]
            },
            "default": {
                "valid_children": ["default", "file"]
            },
            "file": {
                "icon": "glyphicon glyphicon-file",
                "valid_children": []
            }
        },
        "plugins": [
            "contextmenu", "dnd", "search",
            "state", "types", "wholerow"
        ]
    });

    // Lắng nghe sự kiện thay đổi cây
    $('#evaluationTree').on('changed.jstree', function (e, data) {
        calculateScores();
    });

    // Lắng nghe sự kiện thay đổi điểm tiêu chí
    // $('#evaluationTree').on('input', '.criteria-score', function () {
    //     var score = parseInt($(this).val(), 10);
    //     $(this).closest('li').data('score', score);
    //     calculateScores();
    // });

    // Tính toán điểm tiêu chuẩn và tổng điểm
    function calculateScores() {
        var standardScores = {};
        var totalScore = 0;

        // Duyệt qua các nút đã chọn trong cây
        $('#evaluationTree').jstree(true).get_selected(true).forEach(function (node) {
            var parentNode = $('#evaluationTree').jstree(true).get_node(node.parent);
            var standardId = parentNode.id;
            var score = node.data?.score || 0;

            // Cập nhật điểm tiêu chuẩn và tổng điểm
            if (!standardScores[standardId]) {
                standardScores[standardId] = score;
            } else {
                standardScores[standardId] += score;
            }
            totalScore += score;
        });
        console.log(totalScore);
        // Cập nhật điểm tiêu chuẩn và tổng điểm trên giao diện
        for (var standardId in standardScores) {
            if (standardScores.hasOwnProperty(standardId)) {
                var node = $('#evaluationTree').jstree(true).get_node(standardId);
                var nodeName = node.text;
                console.log(standardScores[standardId]);
                var updatedName = nodeName?.replace(/\(\d+ điểm\)$/, "") + " (" + totalScore + " điểm)";

                node.text = updatedName;
                $('#evaluationTree').jstree(true).redraw_node(node);
            }
        }
    }
});