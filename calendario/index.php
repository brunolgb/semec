<?php
	session_start();
	$pasta = "Calendário";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="shorcut icon" href="../arquivos/logo-semec.png">
	<link rel="stylesheet" href="../arquivos/estilo.css">
	<script src="../arquivos/jv.js"></script>
	<title><?=$pasta ?> - SEMEC</title>
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
				<a href="../">Início</a> / <?=$pasta ?>
			</span>
		</div>
		<?php
			//incluindo o arquivo Tudo
			include_once("../classes/Tudo.php");
			$ferramentas = new Ferramentas();
		?>
		<div class="formularios disFlex">
			<div class="preenche-calendario t20">
				<h3>Preenchendo <?=$pasta; ?></h3>
				<form method="post">
				<div class="controle_campos">
					<div class="campos t100">
						<label for="data_requerimento">Data Selecionada</label>
						<input type="text" name="data_requerimento" id="data_requerimento" class="agora" disabled>
					</div>
				</div>
				<div class="controle_campos">
					<div class="campos t100">
						<label for="nome">Evento</label>
						<input type="text" name="nome" id="nome" maxlength="255">
					</div>
				</div>
				<div class="controle_campos">
					<div class="campos t100">
						<label for="escola">Observação</label>
						<input type="text" name="escola" id="escola" maxlength="255">
					</div>
				</div>
				<div class="campos">
					<input type="submit" name="salvar" id="submit" class="t70" value="Salvar">
				</div>
				</form>
			</div>
			<div class="calendario">
				<div class='controleMes'>
				<?php 
				for ($i=1; $i <= 12; $i++)
				{
					echo "<div class='mes'>"; //abrindo o mes
						$todos_os_meses = $ferramentas->todosMeses();
						//titulos dos meses
						echo "<div class='titulo_mes'>";
						echo $todos_os_meses[$i];
						echo "</div>";

						//titulos das semanas
						echo "<div class='semana titulo_semana'>";
							echo "<div>D</div>";
							echo "<div>S</div>";
							echo "<div>T</div>";
							echo "<div>Q</div>";
							echo "<div>Q</div>";
							echo "<div>S</div>";
							echo "<div>S</div>";
						echo "</div>";
						$tot_mes = cal_days_in_month(CAL_GREGORIAN, $i, 2019);
						echo "<div class='semana'>";

						//buscando o primeiro dia do mes em que dia da semana começa
						$dia_inicio = mktime(0, 0, 0, $i , 1 , date('Y'));
						$dia_inicio = date('w',$dia_inicio);

						for ($valoresnulos=0; $valoresnulos <= $dia_inicio; $valoresnulos++)
						{ 
							echo "<div></div>";
						}
						$semana1 = 7 - $valoresnulos;
						$semana2 = 14 - $valoresnulos;
						$semana3 = 21 - $valoresnulos;
						$semana4 = 28 - $valoresnulos;
						$semana5 = 35 - $valoresnulos;


						//mostrando os dias da semana
						for ($dias=1; $dias <= $tot_mes; $dias++)
						{
							echo "<div>$dias</div>";
							if ($dias == $semana1 or $dias == $semana2 or $dias == $semana3 or $dias == $semana4 or $dias == $semana5)
							{
								echo "</div>";
								echo "<div class='semana'>";
							}
						}
						echo "</div>";

					echo "</div>";//fechando o mes
					if ($i == 3 or $i == 6 or $i == 9)
					{
						echo "</div>"; //fechando o controle do mes
						echo "<div class='controleMes'>";//abrindo novamente o controle do mes
					}
				}
				?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>