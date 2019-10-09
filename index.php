<?php session_destroy(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="src/assets/icon.png">
	<link rel="stylesheet" href="src/style/estilo.css">
	<link rel="stylesheet" href="src/style/styleLogin.css">
	<script src="jv.js"></script>
	<title>Secretaria Municipal de Educação de Comodoro</title>
</head>
<body>
	<div class="background"></div>
	<div class="box-login">
		<div class="box-control-login">
			<figure>
				<img src="src/assets/logo_white.svg" alt="Logo SEMEC">
			</figure>
			<form action="./src/validation.php" method="post">
				<div class="box_field">
					<label for="cpf">
						<img src="./src/assets/icon-user-login.png" alt="CPF">
					</label>
					<input type="text" name='cpf' placeholder='Digite seu CPF, ex: 000.000.000-00' maxlength='14' autofocus>
				</div>
				<div class="box_field">
					<label for="password">
						<img src="./src/assets/icon-password-login.png" alt="Senha" maxlength='50'>
					</label>
					<input type="password" name='password_acess' placeholder='Digite sua senha'>
				</div>
				<button class='submit'>Enviar</button>
			</form>
		</div>
	</div>
</body>
</html>