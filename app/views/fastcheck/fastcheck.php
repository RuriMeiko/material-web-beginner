<?php
require_once(DIR . '/app/controllers/profile.php');
require_once(DIR . '/app/controllers/fastcheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng đánh giá</title>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/fastcheck.css" />
    <link rel="stylesheet" href="/public/css/header.css" />
    <?php $path = $_SERVER['REQUEST_URI']; ?>
    <?php if (str_starts_with($path, '/admin/review/')) echo
    '<link rel="stylesheet" href="/public/css/admin-fastcheck.css" />'
    ?>
</head>

<body>
    <div class="body-container">
        <?php require_once DIR . "/app/views/component/header.php" ?>
        <div class="body-container">
            <div class="box">
                <md-elevation></md-elevation>

                <form class="formTable">
                    <div class="table-box">
                        <table class="mdc-data-ta ble">
                            <thead>
                                <tr>
                                    <th class="mdc-data-table__header-cell">
                                        Nội dung
                                    </th>
                                    <th class="mdc-data-table__header-cell">Điểm <?php if (str_starts_with($path, '/admin/review/'))
                                                                                        echo 'của học sinh'
                                                                                    ?></th>
                                    <?php if (str_starts_with($path, '/admin/review/'))
                                        echo ' <th class="mdc-data-table__header-cell">Điểm đánh giá</th>'
                                    ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['Title'] as $index1 => $tieuchuan) { ?>
                                    <tr>
                                        <td class="mdc-data-table__cell tieu-chuan">
                                            <div class="mdc-data-table__cell-div">
                                                <md-elevation></md-elevation>
                                                <p>Tiêu chuẩn <?php echo (key($tieuchuan)) ?>:</p>
                                            </div>
                                        </td>

                                        <td class="mdc-data-table__cell diem" <?php
                                                                                if (str_starts_with($path, '/admin/review/'))
                                                                                    echo 'colspan="2"' ?>>
                                            <div class="mdc-data-table__cell-div">
                                                <md-elevation></md-elevation>
                                                <p><?php
                                                    $string = $tieuchuan[key($tieuchuan)][0]['tentieuchuan'];
                                                    $pattern = '/\d+ điểm/'; // Regex pattern để tìm kiếm chuỗi con có dạng số điểm
                                                    if (preg_match($pattern, $string, $matches)) {
                                                        $score = $matches[0]; // Lấy chuỗi con từ mảng matches
                                                        echo $score; // In ra chuỗi con
                                                    }
                                                    ?></p>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php foreach ($tieuchuan[key($tieuchuan)] as $index2 => $tieuchi) { ?>
                                        <tr>
                                            <td class="mdc-data-table__cell tieu-chi">
                                                <div class="mdc-data-table__cell-div"> <md-elevation></md-elevation>
                                                    <md-icon>subdirectory_arrow_right</md-icon>
                                                    <p>Tiêu chí <?php echo key($tieuchuan) . "." . $index2 + 1 ?>: <?php echo ($tieuchi['content']) ?></p>
                                                </div>
                                            </td>
                                            <td class="mdc-data-table__cell">
                                                <div class="mdc-data-table__cell-div">
                                                    <md-elevation></md-elevation>
                                                    <?php
                                                    $subArray = $data['DataReturn'][$index1][key($tieuchuan)];
                                                    $value = isset($subArray[$index2]['diem']) ? $subArray[$index2]['diem'] : 0;
                                                    ?>
                                                    <?php if (!str_starts_with($path, '/admin/review/')) { ?>
                                                        <md-filled-select required menu-positioning="fixed">
                                                            <?php for ($i = 0; $i <= $tieuchi['diem']; $i++) { ?>

                                                                <md-select-option value="<?php echo (key($tieuchuan) . "|" . $tieuchi['id'] . "|" . $i) ?>" <?php if ($value === $i) echo "selected" ?>>
                                                                    <div slot="headline"><?php echo $i ?></div>
                                                                </md-select-option>
                                                            <?php } ?>
                                                        </md-filled-select>
                                                    <?php } else { ?>
                                                        <p class="diemhs"> <?php echo $value . " điểm" ?></p>
                                                    <?php } ?>

                                                </div>
                                            </td>
                                            <?php if (str_starts_with($path, '/admin/review/')) { ?>
                                                <td class="mdc-data-table__cell">
                                                    <div class="mdc-data-table__cell-div">
                                                        <?php
                                                        $subArray = $data['DataReturn'][$index1][key($tieuchuan)];
                                                        $value = isset($subArray[$index2]['diem']) ? $subArray[$index2]['diem'] : 0;
                                                        ?>
                                                        <md-elevation></md-elevation>
                                                        <md-filled-select required menu-positioning="fixed">
                                                            <?php for ($i = 0; $i <= $tieuchi['diem']; $i++) { ?>
                                                                <md-select-option value="<?php echo (key($tieuchuan) . "|" . $tieuchi['id'] . "|" . $i) ?>" <?php if ($value === $i) echo "selected" ?>>
                                                                    <div slot="headline"><?php echo $i ?></div>
                                                                </md-select-option>
                                                            <?php } ?>


                                                        </md-filled-select>
                                                    </div>
                                                </td>

                                            <?php } ?>
                                        </tr>

                                    <?php } ?>


                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="sendBtn">


                        <md-filled-button>
                            Gửi đánh giá
                            <svg slot="icon" viewBox="0 0 48 48">
                                <path d="M6 40V8l38 16Zm3-4.65L36.2 24 9 12.5v8.4L21.1 24 9 27Zm0 0V12.5 27Z" />
                            </svg>
                        </md-filled-button>
                    </div>
                </form>
            </div>
        </div>

        <script src="/public/js/fastcheck.js"></script>
    </div>
</body>

</html>