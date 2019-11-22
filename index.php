<?php
	session_start();
	session_destroy();
	
	// verificando o erro
	include_once("src/class/ErrorsForms.php");
    $message = new ErrorsForms();
    $responseMsg = $message->getMsg($_GET["m"]);
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
	<?php echo $responseMsg; ?>
		<div class="box-control-login">
			<figure>
				<img src="src/assets/logo_white.svg" alt="Logo SEMEC">
			</figure>
			<form name='login' action="./src/validation.php" method="post">
				<input type="hidden" name="verify_action" value='login' verify_action>
				<section id="login">
					<div class="box_field">
						<label for="cpf" class='tam30'>CPF</label>
						<input type="text" name='cpf' placeholder='000.000.000-00' id='cpf' maxlength='14' autofocus required title='CPF'>
					</div>
					<div class="box_field">
						<label for="password_acess" class='tam30'>Senha</label>
						<input type="password" name='password_acess' id='password_acess' placeholder='Digite sua senha' required title='Senha'>
					</div>
				</section>
				<section class="registration-section">
					<div class="box_field">
						<label for="name_person" class='tam30'>Nome</label>
						<input type="text" name='name_person' id='name_person' placeholder='Digite seu nome completo' maxlength='200' title='Nome'>
					</div>
					<div class="box_field">
						<label for="birth" class='tam40'>Nascimento</label>
						<input type="date" name='birth' id='birth' placeholder='Digite sua data de nascimento' value='1990-01-01' title='Nascimento'>
					</div>
				</section>
				<button class='submit'>Entrar</button>
			</form>
		</div>
		<a href='cadastrar' class='registration' registration>Cadastrar-se</a>
		<a href='./src/pages/about/' class='registration' registration>Sobre SEMEC</a>
	</div>
	<script src='./src/scripts/script_login.js'></script>
</body>
</html>