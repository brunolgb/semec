<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="arquivos/logo-semec.png">
	<link rel="stylesheet" href="arquivos/estilo.css">
	<script src="arquivos/jv.js"></script>
	<title>VALIDAÇÃO - SEMEC</title>
</head>
<body style="overflow: hidden;">
	<div class="transparencia"></div>
	<div class="validar">
		<div class="acesso">
			<figure>
				<img src="arquivos/logo-semec.png" alt="SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA" class="logoG">
			</figure>
			<h3 class="titulo_branco">DIGITE SEU CPF</h3>
			<form method="post">
				<input type="text" id="acesso" class="t100" onkeydown="mascara('#acesso','cpf')" placeholder="CPF 000.000.000-00" maxlength="14">
				<button type="submit" name="salvar" class="btn_laranja">Entrar</button>
			</form>
			<?php
			if (isset($_POST["salvar"]))
			{
				include_once("classes/Tudo.php");
				$banco = new Banco();
				$retorno = $banco->validar();
				if ($retorno === "vazio")
				{
					echo "<h3>Não foi possível fazer validação com esse CPF</h3>";
				}
				else
				{
					header("REFRESH: 0; url=".$_GET["pagina"]."/");
				}
			}
			?>
		</div>
	</div>
</body>
</html>