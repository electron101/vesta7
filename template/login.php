<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Вход в систему</title>

	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/signin.css" rel="stylesheet">

    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/skin-blue.css">

	<style>
	body {
	  padding-top: 90px;
	}    

	.skleit {
		margin-top: -16px;
	}

	.skleit_alert {
		margin-bottom: 5px;
		height: 10px;
	}

	p {
		margin-top: -10px;
	}

	h5 {
		padding-bottom: 50px;
	}

	.text-center {
	  text-align: center;
	}

	.sk2 {
	  margin-bottom: 15px;
	}

	.glyph {
		margin-top: 5px;
	}

	</style>

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="jquery/jquery-1.12.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

  </head>

  <body>
	<div class="container">

		<form class="form-signin" role="form" id="LoginForm">
			<h1 class="text-center form-signin-heading">Веста</h1>
			<h5 class="text-center form-signin-heading">СИСТЕМА ЗАЯВОК</h5>

			<div class="alert alert-danger skleit_alert hidden" id="login-alert">
				<p>Неверный логин или пароль</p>
			</div>
			<div class="alert alert-danger skleit_alert hidden" id="danger-alert">
				<p>Что то пошло не так</p>
			</div>
			<div class="alert alert-success skleit_alert hidden" id="success-alert">
				<p>Вход выполнен</p>
			</div>
			<div class="alert alert-danger skleit_alert hidden" id="status_off-alert">
				<p>Пользователь отключён</p>
			</div>

			<div class="form-group sk2 has-feedback">
				<input type="text" name="login" class="form-control" placeholder="Логин" required autofocus>
				<span class="glyphicon glyph form-control-feedback" aria-hidden="true"></span>
			</div>

			<div class="form-group skleit has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Пароль" required>
				<span class="glyphicon glyph form-control-feedback"></span>
			</div>

			<div class="form-group">
				<a href="index.php?act=recover_login">Восстановить пароль</a>
				<br>
				<a href="index.php?act=registry">Зарегистрироваться</a>
			</div>			

			<button id="btn_login" class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

		</form>
	</div>
	<script src="js/login.js"></script>
  </body>
</html>
