<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="../../arquivos/logo-semec.png">
	<link rel="stylesheet" href="../../arquivos/estilo.css">
	<script src="../../arquivos/jv.js"></script>
	<title>ARQUIVO PASSIVO - SEMEC</title>
</head>
<body>
	<header class="header">
		<div class="sombra">
			<figure>
				<img src="../../arquivos/logo-semec.png" alt="SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA" class="logoG">
			</figure>
		</div>
	</header>
	<div class="controle_geral">
		<div class="titulos_paginas">
			<span>
				<a href="../../">Início</a> / <a href="../">Arquivo Passivo</a> / Cadastro de Arquivo Passivo
			</span>
		</div>
		<?php
			//incluindo o arquivo Tudo
			include_once("../../classes/Tudo.php");
			$ferramentas = new Ferramentas();
		?>
		<div class="formularios">
			<form method="post">
			<div class="controle_campos">
				<div class="campos t100">
					<label for="nome">Nome completo do aluno <span class="obrigatorio">*</span></label>
					<input type="text" name="nome" id="nome" maxlength="255">
				</div>
				<div class="campos t30">
					<label for="data_nascimento">Data de Nascimento</label>
					<input type="text" name="data_nascimento" id="data_nascimento" onkeypress="mascara('#data_nascimento','data')" maxlength="10">
				</div>
			</div>
			<div class="controle_campos">
				<div class="campos t100">
					<label for="escola">Escola</label>
					<input type="text" name="escola" id="escola" maxlength="255">
				</div>
				<div class="campos t100">
					<label for="data_requerimento"></label>
					<input type="text" name="data_requerimento" id="data_requerimento" onkeypress="mascara('#data_requerimento','data')" maxlength="10" class="agora">
				</div>
			</div>


			<div class="campos">
				<input type="submit" name="salvar" id="submit" value="Salvar">
			</div>
			</form>
			<div class="resultado">
				<?php
				if (isset($_POST['salvar']))
				{
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>