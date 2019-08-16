<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="../arquivos/logo-semec.png">
	<link rel="stylesheet" href="../arquivos/estilo.css">
	<script src="../arquivos/jv.js"></script>
	<title>TRANSFERÊNCIAS - SEMEC</title>
</head>
<body>
	<header class="header">
		<div class="sombra">
			<figure>
				<img src="../arquivos/logo-semec.png" alt="SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA" class="logoG">
			</figure>
		</div>
	</header>
	<div class="controle_geral">
		<div class="titulos_paginas">
			<span>
				<a href="../">Início</a> / Transferências
			</span>
			<a href="cadastro/" class="cadastro">Adicionar</a>
		</div>
		<?php
			//incluindo o arquivo Tudo
			include_once("../classes/Tudo.php");
			$ferramentas = new Ferramentas();
		?>
		<div class="formularios">
			<form method="post">
			<div class="filtro">
				<input type="text" name="busca" id="busca" placeholder="Buscar pelo nome do aluno" maxlength="255">
				<input type="text" name="nascimento" id="nascimento" placeholder="Buscar pelo Nascimento" onkeydown="mascara('#nascimento','data')" maxlength="10">
				<input type="submit" name="salvar" id="submit" value="Buscar">
			</div>
			</form>
			<div class="resultado">
				<?php
				if (isset($_POST['salvar']))
				{
					$crit1 = $_POST["busca"];
					$crit2 = $ferramentas->data_inverte($_POST["nascimento"]);
				}
				else
				{
					$crit1 = null;
					$crit2 = null;
				}
				$banco = new Banco();
				$retorno = $banco->select("SELECT * FROM calendarioEscolar");
				if($retorno === "vazio")
				{
					echo "Vazio";
				}
				else if($retorno === "erro")
				{
					echo "Aconteceu algum erro na pesquisa!";
				}
				else
				{
					foreach ($retorno as $linha)
					{
						echo "<div class='linha'>";
						foreach ($linha as $key => $value)
						{
							echo "<div class='column'>";
							echo $key;
							echo "</div>";
						}
						echo "</div>";
						break;
					}
					foreach ($retorno as $linha)
					{
						echo "<div class='linha'>";
						foreach ($linha as $key => $value)
						{
							if ($key === "data")
							{
								$value = $ferramentas->data_inverte($value,"br");
							}
							echo "<div class='column'>";
							echo $value;
							echo "</div>";
						}
						echo "</div>";
					}
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>