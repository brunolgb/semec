<?php
	session_destroy();

	$message = $_GET["m"];
	$div_message = null;
	if(isset($message))
	{
		$spaceReplace_message = str_replace("%", " ",$message);
		switch ($spaceReplace_message) {
			case 'user or password invalid':
				$message_final = "Usuário ou senha inválidos!";
				break;
			case 'cpf registered':
				$message_final = "Já existe registro para esse CPF!";
				break;
			case 'erro':
				$message_final = "Algo deu errado!<br>Tente novamente!";
				break;
		}
		$div_message = "<div class='erro'>{$message_final}</div>";
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="src/assets/icon.png">
	<link rel="stylesheet" href="src/style/estilo.css">
	<link rel="stylesheet" href="src/style/styleLogin.css">
	<title>Secretaria Municipal de Educação de Comodoro</title>
</head>
<body>
	<div class="background"></div>
	<div class="box-login">
	<?php echo $div_message; ?>
		<div class="box-control-login">
			<figure>
				<img src="src/assets/logo_white.svg" alt="Logo SEMEC">
			</figure>
			<form name='login' action="./src/validation.php" method="post">
				<input type="hidden" name="verify_action" value='login' verify_action>
				<section id="login">
					<div class="box_field">
						<label for="cpf">
							<img src="./src/assets/icon-cpf-login.png" alt="">
						</label>
						<input type="text" name='cpf' placeholder='Digite seu CPF' id='cpf' maxlength='14' autofocus>
					</div>
					<div class="box_field">
						<label for="password_acess">
							<img src="./src/assets/icon-password-login.png" alt="" maxlength='50'>
						</label>
						<input type="password" name='password_acess' id='password_acess' placeholder='Digite sua senha'>
					</div>
				</section>
				<section class="registration-section">
					<div class="box_field">
						<label for="name_person">
							<img src="./src/assets/icon-user-login.png" alt="">
						</label>
						<input type="text" name='name_person' id='name_person' placeholder='Digite seu nome completo' maxlength='200'>
					</div>
					<div class="box_field">
						<label for="birth">
							<img src="./src/assets/icon-birth-login.png" alt="" maxlength='50'>
						</label>
						<input type="date" name='birth' id='birth' placeholder='Digite sua data de nascimento' value='1990-01-01'>
					</div>
				</section>
				<button class='submit'>Enviar</button>
			</form>
		</div>
		<a href='cadastrar' class='registration tam10' registration>Cadastrar-se</a>
	</div>
	<script src='./src/scripts/script_login.js'></script>
</body>
</html>