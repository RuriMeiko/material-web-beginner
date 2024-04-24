<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Đăng nhập</title>
	<?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
	<link rel="stylesheet" href="/public/css/login.css" />
</head>

<body>
	<div class="box">
		<md-elevation></md-elevation>

		<md-tabs class="tabbox">
			<md-secondary-tab>Đăng nhập</md-secondary-tab>
			<md-secondary-tab>Đăng ký</md-secondary-tab>
		</md-tabs>

		<form class="formLogin">

			<md-outlined-text-field prefix-text="👤" aria-label="Username Login" required name="username" label="Tên đăng nhập" autocomplete="username" placeholder="Nhập tên đăng nhập của bạn"></md-outlined-text-field>
			<md-outlined-text-field class="passwordInput" prefix-text="🔒" aria-label="Password Login" required type="password" name="password" autocomplete="current-password" label="Mật khẩu" placeholder="Nhập mật khẩu của bạn">
				<md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
					<md-icon>visibility</md-icon>
					<md-icon slot="selected">visibility_off</md-icon>
				</md-icon-button></md-outlined-text-field>
			<md-divider inset></md-divider>

			<md-filled-button>Đăng nhập</md-filled-button>
			<md-linear-progress class="loading" indeterminate></md-linear-progress>

		</form>

		<form class="formReg">
			<md-outlined-text-field prefix-text="👤" aria-label="Username" required name="username" label="Tên đăng nhập" autocomplete="username" placeholder="Nhập tên đăng nhập của bạn">
			</md-outlined-text-field>
			<div class="two-container">
				<md-outlined-text-field prefix-text="🔒" aria-label="Password" required class="passwordInput" type="password" name="password" autocomplete="new-password" label="Mật khẩu" placeholder="Nhập mật khẩu của bạn">
					<md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
						<md-icon>visibility</md-icon>
						<md-icon slot="selected">visibility_off</md-icon>
					</md-icon-button></md-outlined-text-field>
				<md-outlined-text-field prefix-text="🔐" aria-label="Re-Password" required type="password" name="repassword" autocomplete="off" label="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu của bạn">
				</md-outlined-text-field>
			</div>
			<md-divider inset></md-divider>
			<md-outlined-text-field prefix-text="😎" aria-label="name" required label="Họ và tên" name="name" autocomplete="name" placeholder="Nhập tên của bạn">
			</md-outlined-text-field>
			<div class="two-container">
				<md-outlined-text-field type="date" prefix-text="🗓️" aria-label="birddate" required label="Ngày sinh" autocomplete="bday" placeholder="Nhập tên đăng nhập của bạn" name="birddate">
				</md-outlined-text-field>
				<md-outlined-select required label="Giới tính" aria-label="Giới tính" name="gender">
					<md-select-option selected value="Không tiết lộ">
						<div slot="headline">🤫Khác</div>
					</md-select-option>
					<md-select-option value="Nam">
						<div slot="headline">👨Nam</div>
					</md-select-option>
					<md-select-option value="Nữ">
						<div slot="headline">👩Nữ</div>	
					</md-select-option>
				</md-outlined-select>
			</div>
			<md-outlined-text-field prefix-text="🏠" aria-label="quê quán" required label="Quê quán" name="location" autocomplete="street-address" placeholder="Nhập tên địa chỉ của bạn">
			</md-outlined-text-field>
			<md-divider inset></md-divider>

			<label>
				<md-checkbox required aria-label="Agree to terms and conditions"></md-checkbox>
				Đồng ý <a href="/term">các điều khoản</a> của chúng tôi?
			</label>
			<md-filled-button>Đăng ký</md-filled-button>
			<md-linear-progress class="loading" indeterminate></md-linear-progress>
		</form>

	</div>

	<script src="/public/js/login.js"></script>
</body>

</html>