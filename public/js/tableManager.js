$(document).ready(async function () {
    $('.enterscore').on('change', function () {
        if ($(this).val() < 1) $(this).val(1);
        const sellect = $('#evaluationTree').jstree(true).get_selected(true);
        sellect[0].data.score = $(this).val();
        calculateScores();

    });
    $('.enterChitietcontent').on('change', function () {
        const sellect = $('#evaluationTree').jstree(true).get_selected(true);
        const dataNode = $('#evaluationTree').jstree(true).get_node(sellect[0]);
        let str = dataNode.text.split(":");
        if (str.length > 1) {


            let regex = /^(.*?)\s*\((.*?)\)$/;

            let matches = str[1].match(regex);
            let standard = matches[1].trim();
            let score = matches[2].trim();
            $('.scoreTC h1').text('Chi tiết ' + `${str[0]}${str[0] && ':'} ${$(this).val()} (${score})`)

            dataNode.text = `${str[0]}${str[0] && ':'} ${$(this).val()} (${score})`;
            $('#evaluationTree').jstree(true).redraw_node(dataNode);
        } else {
            let regex = /^(.*?)\s*\((.*?)\)$/;

            let matches = dataNode.text.match(regex);
            let standard = matches[1].trim();
            let score = matches[2].trim();
            $('.scoreTC h1').text('Chi tiết ' + `${standard}${standard && ':'} ${$(this).val()} (${score})`)

            dataNode.text = `${standard}${standard && ':'} ${$(this).val()} (${score})`;
            $('#evaluationTree').jstree(true).redraw_node(dataNode);
        }


    });

    $('.entercritecontent').on('change', function () {
        const sellect = $('#evaluationTree').jstree(true).get_selected(true);

        sellect[0].data.content = $(this).val();

    });
    $('#addtieuchi').click(() => { addNode("Nội dung tiêu chí") });
    $('#deltieuchi').click(deleteNode);
    // Dữ liệu cây
    async function getDataTree() {
        let r = await fetch('/api/admin/listmanager', { method: "GET" });
        rd = await r.json();
        const newData = [];
        rd.message.forEach(function (item) {
            const key = Object.keys(item)[0];
            const value = item[key];
            if (value !== null) {
                let totalScore = 0;
                const children = value.map(function (tieuchi, index) {
                    totalScore += parseInt(tieuchi.diem);
                    return {
                        text: `Tiêu chí ${key}.${index}`,
                        data: {
                            score: tieuchi.diem,
                            content: tieuchi.content,
                            index: tieuchi.indexId

                        },
                        icon: '/public/images/tieuchi.svg'
                    };
                });

                newData.push({
                    text: value[0]['tentieuchuan'],
                    icon: '/public/images/tieuchuan.svg',
                    parent: "#",
                    data: { id: parseInt(key), version: value[0]['version'] },
                    children: children
                });
            } else {
                newData.push({
                    text: value[0]['tentieuchuan'],
                    icon: '/public/images/tieuchuan.svg',
                    parent: "#",
                    data: { id: parseInt(key), version: value[0]['version'] },
                    children: []
                });
            }
        });
        return newData;
    }
    function deleteNode() {
        let selectedNodes = $('#evaluationTree').jstree(true).get_selected();
        if (selectedNodes.length === 0) {
            showToast('❌ Vui lòng chọn tiêu chí cần xoá');
            return;
        }
        let parentNode = $('#evaluationTree').jstree(true).get_node($('#evaluationTree').jstree(true).get_node(selectedNodes[0]).parent);
        if (parentNode.children.length > 1) {
            selectedNodes.forEach((item) => {
                if ($('#evaluationTree').jstree(true).get_node(item).parent !== '#') {
                    let nodeId = item;
                    let node = $('#evaluationTree').jstree(true).get_node(nodeId);
                    $('#evaluationTree').jstree(true).delete_node(node);
                    let lastChild = $('#evaluationTree').jstree(true).get_node(parentNode.children[parentNode.children.length - 1]);
                    $('#evaluationTree').jstree(true).select_node(lastChild.id);
                    parentNode.children.forEach((item, index) => {
                        const nodechild = $('#evaluationTree').jstree(true).get_node(item);
                        nodechild.text = nodechild.text.replace(/\d+$/, index + 1);
                        nodechild.data.index = index + 1;
                        $('#evaluationTree').jstree(true).redraw_node(nodechild);
                    });
                } else showToast('❌ Không thể xoá tiêu chuẩn');

            });
        } else showToast('❌ Tiêu chuẩn phải có ít nhất một tiêu chí!');

    }
    function addNode(newNodeText) {
        let parentNode = $('#evaluationTree').jstree(true).get_node($('#evaluationTree').jstree(true).get_selected());
        if (parentNode.parent === '#') {
            let match = parentNode.text.match(/\d+/);
            let number = match ? parseInt(match[0]) : null;
            let lastChild = $('#evaluationTree').jstree(true).get_node(parentNode.children[parentNode.children.length - 1]);
            let number2 = 0;
            if (lastChild) {
                let match2 = lastChild.text.match(/\.(\d+)/);
                number2 = match2 ? parseInt(match2[1]) : null;
            }
            let newNode = {
                text: `Tiêu chí ${number}.${number2 + 1}`,
                data: { score: 1, content: newNodeText, index: number2 + 1 },
                icon: '/public/images/tieuchi.svg'
            };
            $('#evaluationTree').jstree(true).create_node(parentNode, newNode, 'last', function (newNode) {
                $('#evaluationTree').jstree(true).open_node(parentNode);
                calculateScores([newNode]);
            });

        } else {
            showToast('❌ Vui lòng chọn tiêu chuẩn cần thêm');
        }
    }
    async function init() {
        $('#evaluationTree').jstree({
            "core": {
                "animation": 0,
                multiple: false,

                "check_callback": true,
                "themes": { "stripes": true },
                'data': await getDataTree()
            },

        }).on('ready.jstree', function () {
            let dsasadasdsa = tongdiem();
            $('.btnlistandtotal h3').text('Tổng điểm: ' + dsasadasdsa);
            if (dsasadasdsa !== 100)
                $('.btnlistandtotal h3').css('color', 'red');
            $('.toadminbtn').click(async () => {
                const totalScore = tongdiem();
                if (totalScore === 100) {
                    let jsonData = $('#evaluationTree').jstree(true).get_json('#', { flat: false });

                    getFlatJson(jsonData);
                    let re = await fetch('/api/admin/listmanager', { method: "POST", body: JSON.stringify({ data: jsonData, totalScore: tongdiem() }) });
                    let ax = await re.json();
                    if (ax.success)
                        return showToast('✔️ Đã lưu bảng');
                    else return showToast('❌ Có lỗi xảy ra khi lưu bảng');
                } else {
                    showToast('❌ Tổng điểm phải bằng 100!');
                }

            })


        });
    }
    // Khởi tạo cây jsTree
    init();

    function tongdiem() {
        let rootNode = $('#evaluationTree').jstree(true).get_node("#");
        let totalScore = calculateTotalScore(rootNode);
        return totalScore;
    }
    // Lắng nghe sự kiện thay đổi cây
    $('#evaluationTree').on('changed.jstree', function (e, data) {
        if (data.node.parent !== '#') {
            $('.score').css('display', 'flex');
            $('.scoreTC').hide();

            $('.score h1').text('Chi tiết ' + data.node.text)
            $('.enterscore').val(data.node.data.score);
            $('.entercritecontent').val(data.node.data.content);
        } else {
            $('.score').hide();
            $('.enterChitietcontent').val("")

            $('.scoreTC').css('display', 'flex');
            $('.scoreTC h1').text('Chi tiết ' + data.node.text)
            const coreStr = data.node.text.split(":");
            let str = coreStr[1];

            let regex = /^(.*?)\s*\((.*?)\)$/;

            let matches = str.match(regex);
            let standard = matches[1].trim();
            $('.enterChitietcontent').val(standard)

        }
        calculateScores();

    });

    function getFlatJson(data) {
        data.forEach(function (node) {
            // Xử lý lại các thuộc tính không cần thiết
            delete node.li_attr;
            delete node.a_attr;
            delete node.icon;
            delete node.state;

            // Xử lý lại các nút con
            if (node.children.length > 0) {

                getFlatJson(node.children);
            } else {
                delete node.children;
            }
        });
    }
    function calculateTotalScore(node) {
        let totalScore = 0;

        if (node.children.length > 0) {
            node.children.forEach(function (childId) {
                let childNode = $('#evaluationTree').jstree(true).get_node(childId);
                if (childNode.parent === '#') {

                    totalScore += calculateTotalScore(childNode);
                } else {
                    let childScore = parseInt(childNode.data.score);
                    totalScore += parseInt(childScore);
                }
            });
        }

        return totalScore;
    }

    // Tính toán điểm tiêu chuẩn và tổng điểm
    function calculateScores(listNode = $('#evaluationTree').jstree(true).get_selected(true)) {
        const totalScore = tongdiem();
        $('.btnlistandtotal h3').text('Tổng điểm: ' + totalScore);
        if (totalScore !== 100) {
            $('.btnlistandtotal h3').css('color', 'red')
        } else {
            $('.btnlistandtotal h3').css('color', 'black')

        }

        let standardScores = {};
        // Duyệt qua các nút đã chọn trong cây
        listNode.forEach(function (node) {
            let parentNode = $('#evaluationTree').jstree(true).get_node(node.parent);
            parentNode.children.forEach((child) => {
                let dataChild = $('#evaluationTree').jstree(true).get_node(child);
                if (standardScores[parentNode.id])
                    standardScores[parentNode.id] += parseInt(dataChild.data?.score);
                else standardScores[parentNode.id] = parseInt(dataChild.data?.score);

            })

            // Cập nhật điểm tiêu chuẩn và tổng điểm trên giao diện
            for (let standardId in standardScores) {
                if (standardScores.hasOwnProperty(standardId)) {
                    let node = $('#evaluationTree').jstree(true).get_node(standardId);
                    let nodeName = node.text;
                    let updatedName = nodeName?.replace(/\(\d+ điểm\)$/, "") + "(" + standardScores[standardId] + " điểm)";
                    standardScores = {};
                    node.text = updatedName;
                    $('#evaluationTree').jstree(true).redraw_node(node);
                }
            }
        });
    }
});