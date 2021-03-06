<?php
	session_start();
	session_destroy();
	
	// verificando o erro
	include_once("src" . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "ErrorsForms.php");
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
						<input type="text" name='cpf' placeholder='000.000.000-00' id='cpf' maxlength='14' autofocus required title='CPF' cpf>
					</div>
					<div class="box_field">
						<label for="password_acess" class='tam30'>Senha</label>
						<input type="password" name='password_acess' id='password_acess' fieldPassword placeholder='Digite sua senha' required title='Senha'>
						<figure id='password-btn-visible' password>
							<img src="src/assets/password-hidden.png" alt="Senha escondida">
						</figure>
					</div>
				</section>
				<button class='submit'>Entrar</button>
			</form>
		</div>
		<a href='./src/pages/about/?page=login' class='registration' registration>Sobre SEMEC</a>
	</div>
	<script src='./src/scripts/script_login.js'></script>
	<script src='./src/scripts/mask.js'></script>
</body>
</html>