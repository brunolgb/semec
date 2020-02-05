<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="../../assets/icon.png">
	<link rel="stylesheet" href="../../style/estilo.css">
	<link rel="stylesheet" href="../../style/styleHome.css">
	<title>SEMEC</title>
</head>
<body>
	<?php include_once('../header/index.php'); ?>

	<div class="box-control">
		<div id="botoes">
			<ul>
				<li>
					<a href="../calendario">
						<img src="../../assets/icone-calendario.png">
						Calendários Escolar
					</a>
				</li>
				<li>
					<a href="calendario.php?calendario=campo">
						<img src="../../assets/icone-oficio.png">
						Ofícios
					</a>
				</li>
				<li>
					<a href="../arquivo-passivo">
						<img src="../../assets/icone-passivo.png">
						Arquivo Passivo
					</a>
				</li>
				<li>
					<a href="../transferencia">
						<img src="../../assets/icone-transferencia.png">
						Transferências
					</a>
				</li>
			</ul>
		</div>
	</div>
	<?php include_once('../footer/index.php')?>
</body>
<script src='../../scripts/script.js'></script>
</html>