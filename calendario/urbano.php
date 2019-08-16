<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="estilo.css">
	<script src="jv.js"></script>
	<title>Calendário Escolar</title>
</head>
<body>
<?php
// dias dos meses para o ano de 2019
	$jan = 31;
	$fev = 28;
	$mar = 31;
	$abr = 30;
	$mai = 31;
	$jun = 30;
	$jul = 31;
	$ago = 31;
	$set = 30;
	$out = 31;
	$nov = 30;
	$dez = 31;

// ------------
	$con = mysqli_connect('localhost','root','','semec');
	function meses($mesBuscar,$cone)
	{
		echo "<tbody>";
		echo "<tr>";
		$comando = "select * from calendarioEscolar";
		$query = mysqli_query($cone,$comando);
		$k = 1;
		$n = 0;
		$marcaBimestre= 1;
		$marcador = false;
		$bimestreIF = array();
		while ($a = mysqli_fetch_array($query))
		{
			$id = $a['idCalenEscolar'];
			$data = $a['data'];
			$evento = $a['evento'];
			$obs = $a['obs'];
			switch ($evento)
			{
				case 'feriado':	$title = "Feriado - ".$obs;break;
				case 'diaLetivo':	$title = "Dia Letivo";break;
				case 'facultativo':	$title = "Ponto Facultativo";break;
				case 'recessoEscolar':	$title = "Recesso Escolar";break;
				case 'semanaPedagogica':	$title = "Semana Pedagogica";break;
				case 'ferias':	$title = "Ferias";break;
				case 'atribuicao':	$title = "Atribuição";break;
				case 'bimestre':	$title = $obs." - Bimestre";break;
				
				default:
					$title = null;
					break;
			}
			$subMes = substr($data, 5,2);
			$subAno = substr($data, 0,4);
			if ($subMes == $mesBuscar)
			{
				
				$sub = substr($data, 8,2);
				$diaSemana = date("w",mktime(0,0,0,$subMes,$sub,$subAno));

				// verificando os dias letivos e os inicios de bimestres
				if ($evento == "diaLetivo" or $evento == "bimestre")
				{
					$n++;
					
					$letivos = $n;
				
					if ($evento == "bimestre")
					{
						$bimestreIF[$marcaBimestre] = $obs == "inicio" ? " | ".$sub." IB" : " | ".$sub." TB";
						$marcaBimestre++;
					}
					
					
				}

				//Verificando se o dia da semana é domingo ou sábado
				if ($diaSemana == 0 or $diaSemana == 6 and $evento == null)
				{
					$evento = "sabadoDomingo";
					$title = "Sábado ou Domingo";
				}
				else if($diaSemana == 0 or $diaSemana == 6 and $evento != null)
				{

				}

				// Verificando quantos dias da semana devemos rodar para exibir
				if ($marcador == false)
				{
					
					switch ($diaSemana)
					{
						case '0':
						$marcador = true;
							break;
						case '1':
						echo "<td></td>";
						$diasPula = 1;
						$marcador = true;
							break;
						case '2':
						echo "<td></td>";
						echo "<td></td>";
						$diasPula = 2;
						$marcador = true;
							break;
						case '3':
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						$diasPula = 3;
						$marcador = true;
							break;
						case '4':
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						$diasPula = 4;
						$marcador = true;
							break;
						case '5':
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						$diasPula = 5;
						$marcador = true;
							break;
						case '6':
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						$diasPula = 6;
						$marcador = true;
							break;
					}
				}
				echo "<td  onclick='muda($id)' class='".$evento."' title='".$title."'>".$sub." <input type='hidden' value='".$data."' id='".$id."'></td>";				
			
				if ($k == 7-$diasPula)
				{
					echo "</tr><tr>";
				}
				else if ($k == 14-$diasPula)
				{
					echo "</tr><tr>";
				}
				else if ($k == 21-$diasPula)
				{
					echo "</tr><tr>";
				}
				else if ($k == 28-$diasPula)
				{
					echo "</tr><tr>";
				}
				else if ($k == 35-$diasPula)
				{
					echo "</tr><tr>";
				}
				$k++;
			}
		}
		$mostrarBimestre = $bimestreIF[1];
		$mostrarBimestre .= $bimestreIF[2];
		$qtdletivo = $letivos == null ? $qtdletivo = 0: $qtdletivo = $letivos;
		$qtdletivo .=" Dias Letivos";
		echo "</tr>";
		echo "</tbody>";
		echo "</table>";
		echo "<span class='mostrardias'>".$qtdletivo."".$mostrarBimestre."</span>";
	}
	
?>
	<div class="cad" id="cadastrar">
		<h1>Calendário Escolar 2019</h1>
		<h4>Registro <span id="muda">--</span></h4>
		<form method="post" name="calendForm">
		<aside>
			<input type="hidden" name="idEscondido" id="idEscondido" value="">
			<label for="data">Data</label>
			<input type="date" name="data" id="data">
		</aside>
		<aside>
			<label for="evento">Evento</label>
			<select name="evento" id="evento">
				<option disabled="" selected="">Escolha um evento</option>
				<option value="diaLetivo">Dia Letivo</option>
				<option value="feriado">Feriado</option>
				<option value="facultativo">Facultativo</option>
				<option value="recessoEscolar">Recesso Escolar</option>
				<option value="semanaPedagogica">Semana Pedagógica</option>
				<option value="ferias">Férias</option>
				<option value="atribuicao">Atribuição</option>
				<option value="bimestre">Bimestre</option>
			</select>
		</aside>
		<aside>
			<label for="obs">Observação</label>
			<input type="text" name="obs" id="obs" list="acontecimento">
			<datalist id="acontecimento">
				<option value="inicio">Inicio de Bimestre</option>
				<option value="termino">Termino de Bimestre</option>
			</datalist>
		</aside>
		<div class="controleBotao">
			<button type="submit" id="salvar" name="salvar">Salvar</button>
			<button type="reset" id="salvar">Desmarcar</button>
		</div>
		</form>
		<?php
			if (isset($_POST['salvar']) and $_POST['idEscondido'] !=null)
			{
				$idCalendario = $_POST['idEscondido'];
				$diasCalendario = $_POST['dias'];
				$dataCalendario = $_POST['data'];
				$eventoCalendario = $_POST['evento'];
				$obsCalendario = $_POST['obs'];
				echo $diasCalendario."<br>";
				// dividindo a data em vario pedaços
				$diasub = substr($dataCalendario, 8,2);
				$diasub = $diasub + $diasCalendario;
				$messub = substr($dataCalendario, 5,2);
				$anosub = substr($dataCalendario, 0,4);
				echo "$diasub e $messub - $anosub <br>";

				//Comando para inserir os dados
				$salvarCalend = "UPDATE calendarioEscolar SET data='".$dataCalendario."', evento='".$eventoCalendario."', obs='".$obsCalendario."' WHERE idCalenEscolar='".$idCalendario."'";
				mysqli_query($con,$salvarCalend);
				// echo $salvarCalend;

			}
		?>
	<!-- </div> -->
	<a href="calendario-final-urbano.php">Ver resultado final</a>
	<a href="lista.php">Lista de produtos</a>
	<div class="tamanho" id="enviar">
		<header>
				<section class="logos">
					<figure>
						<img src="logo-prefeitura.png" alt="Logo Prefeitura">
					</figure>
				</section>
				<section class="titulos">
					<span>ESTADO DE MATO GROSSO</span>
					<span>PREFEITURA MUNICIPAL DE COMODORO</span>
					<span>SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA</span>
				</section>
				<section class="logos">
					<figure>
						<img src="logo-semec.png" alt="Logo Semec">
					</figure>
				</section>
			</header>
			<h3>Calendário Escolar 2019</h3>
		<section class="controleMes">
			<div class="mes">
				<table>
					<thead>
						<tr>
							<td colspan="7">Janeiro</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					
						<?php
						meses('01',$con);
						?>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Fevereiro</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('02',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Março</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('03',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
<!-- segundo trimestre --------------- -->
		<section  class="controleMes">
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Abril</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('04',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Maio</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('05',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Junho</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('06',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
<!-- terceiro trimestre --------------- -->
		<section  class="controleMes">
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Julho</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('07',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Agosto</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('08',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Setembro</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('09',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
<!-- quarto trimestre --------------- -->
		<section  class="controleMes">
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Outubro</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('10',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Novembro</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('11',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mes">
				<table border="1">
					<thead>
						<tr>
							<td colspan="7">Dezembro</td>
						</tr>
						<tr>
							<td>D</td>
							<td>S</td>
							<td>T</td>
							<td>Q</td>
							<td>Q</td>
							<td>S</td>
							<td>S</td>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php
						meses('12',$con);
						?>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
		<footer>
			<div class="legenda">
				<table>
					<thead>
						<tr>
							<td colspan="2">Legenda</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cor diaLetivo"></td>
							<td>Dia Letivo</td>
						</tr>
						<tr>
							<td class="cor feriado"></td>
							<td>Feriado</td>
						</tr>
						<tr>
							<td class="cor sabadoDomingo"></td>
							<td>Sábado e Domingo</td>
						</tr>
						<tr>
							<td class="cor facultativo"></td>
							<td>Ponto Facultativo</td>
						</tr>
						<tr>
							<td class="cor recessoEscolar"></td>
							<td>Recesso Escolar</td>
						</tr>
						<tr>
							<td class="cor semanaPedagogica"></td>
							<td>Semana Pedagógica</td>
						</tr>
						<tr>
							<td class="cor ferias"></td>
							<td>Férias</td>
						</tr>
						<tr>
							<td class="cor atribuicao"></td>
							<td>Atribuição</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="obs">
				<?php
				function letivo($data1,$data2,$conexao)
				{
					$buscaLetivo = "SELECT * FROM calendarioEscolar WHERE data BETWEEN '".$data1."' AND '".$data2."'";
					$buscandoLetivo = mysqli_query($conexao,$buscaLetivo);
					$conta = 0;
					while ($le = mysqli_fetch_array($buscandoLetivo))
					{
						$dias_letivos = $le['evento'];
						if ($dias_letivos == "diaLetivo" or $dias_letivos=="bimestre")
						{
							$conta++;
						}
					}
					echo $conta;
				}

				$bimestral = array();
				$contadorLetivos = 0;
				$contadorBimestre = 1;
				$MudaBimestre = 1;
				$buscarBimestre = "SELECT * FROM calendarioEscolar";
				$buscandoBimestre = mysqli_query($con,$buscarBimestre);
				while ($b = mysqli_fetch_array($buscandoBimestre))
				{
					$biId = $b['idCalenEscolar'];
					$biData = $b['data'];
					$biEvento = $b['evento'];
					$biObs = $b['obs'];

					if ($biEvento == "diaLetivo" or $biEvento == "bimestre")
					{
						$contadorLetivos++;
						if ($biObs == "inicio")
						{
							$bimestral[$MudaBimestre][1] = $biData;
						}
						else if($biObs == "termino")
						{
							$bimestral[$MudaBimestre][2] = $biData;
							$MudaBimestre++;
						}
						$bimestral[0][0] = $contadorLetivos;
					}
				}
				?>
			<span class="obsTitle">I.B. - Inicío de Bimestre</span>
			<span class="obsTitle">T.B. - Término de Bimestre</span>
			<span>
				1º Bimestre:
				Inicio <strong><?php echo $bimestral[1][1]; ?></strong> | 
				Término <strong><?php echo $bimestral[1][2]; ?></strong> =
				<?php letivo($bimestral[1][1],$bimestral[1][2],$con) ?> Dias Letivos
			</span>
			<span>
				2º Bimestre:
				Inicio <strong><?php echo $bimestral[2][1]; ?></strong> | 
				Término <strong><?php echo $bimestral[2][2]; ?></strong> =
				<?php letivo($bimestral[2][1],$bimestral[2][2],$con) ?> Dias Letivos
			</span>
			<span>
				3º Bimestre:
				Inicio <strong><?php echo $bimestral[3][1]; ?></strong> | 
				Término <strong><?php echo $bimestral[3][2]; ?></strong> =
				<?php letivo($bimestral[3][1],$bimestral[3][2],$con) ?> Dias Letivos
			</span>
			<span>
				4º Bimestre:
				Inicio <strong><?php echo $bimestral[4][1]; ?></strong> | 
				Término <strong><?php echo $bimestral[4][2]; ?></strong> =
				<?php letivo($bimestral[4][1],$bimestral[4][2],$con) ?> Dias Letivos
			</span>
			<span>Total: <?php echo $bimestral[0][0]; ?> Dias Letivos</span>
			</div>
		</footer>
	</div>
	
</body>
</html>