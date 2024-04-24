<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
    <?php require_once (DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/login.css" />
</head>

<body>
    <div class="box">
        <h1>Form Đánh Giá Nhân Viên</h1>
        <form id="evaluationForm">
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>

            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>
            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br> <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br> <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>
            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>
            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>
            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>
            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>
            <!-- Thêm các select box cho các tiêu chí khác tương tự như trên -->
            <label for="goal">Mục tiêu cá nhân:</label>
            <select onchange="calculateTotalScore()" name="goal" id="goal">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>




            <label for="totalScore"><strong>Tổng Điểm:</strong></label>
            <input type="text" id="totalScore" name="totalScore" readonly><br><br>

            <button type="button" onclick="calculateTotalScore()">Gửi Đánh Giá</button>
        </form>
    </div>
    <script src="/public/js/scoring.js"></script>
</body>

</html>