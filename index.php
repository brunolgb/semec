<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="arquivos/logo-semec.png">
	<link rel="stylesheet" href="arquivos/estilo.css">
	<script src="jv.js"></script>
	<title>SEMEC</title>
</head>
<body>
	<header class="header">
		<div class="sombra">
			<figure>
				<img src="arquivos/logo-semec.png" alt="SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA" class="logoG">
			</figure>
		</div>
	</header>
	
	<div id="botoes">
		<ul>
			<li>
				<a href="validacao.php?pagina=calendario">
					<img src="arquivos/icone-calendario.png">
					Calendários Escolar
				</a>
			</li>
			<li>
				<a href="calendario.php?calendario=campo">
					<img src="arquivos/icone-oficio.png">
					Ofícios
				</a>
			</li>
			<li>
				<a href="validacao.php?pagina=arquivo-passivo">
					<img src="arquivos/icone-passivo.png">
					Arquivo Passivo
				</a>
			</li>
			<li>
				<a href="validacao.php?pagina=transferencias">
					<img src="arquivos/icone-transferencia.png">
					Transferências
				</a>
			</li>
		</ul>
	</div>
</body>
</html>