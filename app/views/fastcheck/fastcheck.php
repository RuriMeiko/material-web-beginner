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
                                                                                        echo 'của hội viên'
                                                                                    ?></th>
                                    <?php if (str_starts_with($path, '/admin/review/'))
                                        echo ' <th class="mdc-data-table__header-cell">Điểm đánh giá</th>'
                                    ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $tongdiem = 0 ?>

                                <?php foreach ($data['Title'] as $index1 => $tieuchuan) { ?>
                                    <tr>
                                        <td class="mdc-data-table__cell tieu-chuan">
                                            <div class="mdc-data-table__cell-div">
                                                <md-elevation></md-elevation>
                                                <p><?php echo $tieuchuan[key($tieuchuan)][0]['tentieuchuan'] ?>:</p>
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
                                                    $tongdiem += $value;

                                                    ?>
                                                    <?php if (!str_starts_with($path, '/admin/review/')) {
                                                        if (isset($subArray[$index2]['isGood']) && $subArray[$index2]['isGood'] === 1) { ?>
                                                            <p class="diemhs <?php if ($subArray[$index2]['isGood'] === 1) echo 'ok' ?>"> <?php echo $value . " điểm" ?></p>
                                                        <?php } else { ?>
                                                            <md-filled-select required menu-positioning="fixed">
                                                                <?php for ($i = 0; $i <= $tieuchi['diem']; $i++) { ?>
                                                                    <md-select-option value="<?php echo (key($tieuchuan) . "|" . $tieuchi['id'] . "|" . $i . "|" . $tieuchi['version']) ?>" <?php if ($value === $i) echo "selected" ?>>
                                                                        <div slot="headline"><?php echo $i ?></div>
                                                                    </md-select-option>
                                                                <?php } ?>
                                                            </md-filled-select>
                                                        <?php }
                                                    } else { ?>
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
                                                        <?php if (!isset($subArray[$index2])) echo "<script>window.location.href = '/admin/usermanager'</script>" ?>
                                                        <md-elevation></md-elevation>
                                                        <md-filled-select required menu-positioning="fixed">
                                                            <?php for ($i = 0; $i <= $tieuchi['diem']; $i++) { ?>
                                                                <md-select-option value="<?php echo ($tieuchi['id'] . "|" . $subArray[$index2]['id'] . "|" . $i . "|" . $tieuchi['version'] . "|" . key($tieuchuan)) ?>" <?php if ($value === $i) echo "selected" ?>>
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
                                <td class="mdc-data-table__cell diem" <?php
                                                                        if (str_starts_with($path, '/admin/review/'))
                                                                            echo 'colspan="3"';
                                                                        else echo 'colspan="2"'  ?>>
                                    <div class="mdc-data-table__cell-div">
                                        <md-elevation></md-elevation>
                                        <p class="tongdiem
                                        <?php
                                        if (isset($subArray[$index2]['isGood'])) {
                                            if ($subArray[$index2]['isGood'] === 1  && !str_starts_with($path, '/admin/review/')) {
                                                echo " ok";
                                            }
                                        } ?>">
                                            Tổng điểm:
                                            <?php echo $tongdiem;
                                            if (isset($subArray[$index2]['isGood'])) {
                                                if ($subArray[$index2]['isGood'] === 1 && !str_starts_with($path, '/admin/review/')) echo " (Bạn đạt)";
                                                else if (!str_starts_with($path, '/admin/review/')) echo " (Bạn rớt)";
                                            } ?>
                                        </p>
                                    </div>

                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="sendBtn">

                        <?php if (str_starts_with($path, '/admin/review/')) { ?>
                            <md-outlined-button id="notok" class="reviewBtn">
                                Đánh giá không đạt
                                <svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M620-520q25 0 42.5-17.5T680-580q0-25-17.5-42.5T620-640q-25 0-42.5 17.5T560-580q0 25 17.5 42.5T620-520Zm-280 0q25 0 42.5-17.5T400-580q0-25-17.5-42.5T340-640q-25 0-42.5 17.5T280-580q0 25 17.5 42.5T340-520Zm140 100q-68 0-123.5 38.5T276-280h66q22-37 58.5-58.5T480-360q43 0 79.5 21.5T618-280h66q-25-63-80.5-101.5T480-420Zm0 340q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Z" />
                                </svg>
                            </md-outlined-button>
                            <md-filled-button id="okbtn" class="reviewBtn">
                                Đánh giá đạt
                                <svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                    <path d="M620-520q25 0 42.5-17.5T680-580q0-25-17.5-42.5T620-640q-25 0-42.5 17.5T560-580q0 25 17.5 42.5T620-520Zm-280 0q25 0 42.5-17.5T400-580q0-25-17.5-42.5T340-640q-25 0-42.5 17.5T280-580q0 25 17.5 42.5T340-520Zm140 260q68 0 123.5-38.5T684-400h-66q-22 37-58.5 58.5T480-320q-43 0-79.5-21.5T342-400h-66q25 63 80.5 101.5T480-260Zm0 180q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Z" />
                                </svg>
                            </md-filled-button>
                            <?php } else {
                            if (!isset($subArray[$index2]['isGood'])) { ?>
                                <md-filled-button class="sendBtntoAdmin">
                                    Gửi đánh giá
                                    <svg slot="icon" viewBox="0 0 48 48">
                                        <path d="M6 40V8l38 16Zm3-4.65L36.2 24 9 12.5v8.4L21.1 24 9 27Zm0 0V12.5 27Z" />
                                    </svg>
                                </md-filled-button>
                            <?php } else if ($subArray[$index2]['isGood'] === 0) { ?>
                                <md-filled-button class="sendBtntoAdmin">
                                    Gửi lại bảng đánh giá
                                    <svg slot="icon" viewBox="0 0 48 48">
                                        <path d="M6 40V8l38 16Zm3-4.65L36.2 24 9 12.5v8.4L21.1 24 9 27Zm0 0V12.5 27Z" />
                                    </svg>
                                </md-filled-button>
                        <?php  }
                        } ?>

                    </div>
                </form>
            </div>
        </div>
        <?php if (str_starts_with($path, '/admin/review/'))
            echo '<script src="/public/js/admin-fastcheck.js"></script>'
        ?>

        <script src="/public/js/fastcheck.js"></script>
    </div>
</body>

</html>