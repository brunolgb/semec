<?php
class Banco extends PDO
{
	private $con;

	function __construct()
	{
		try {
			$this->con = new PDO ("pgsql:host=localhost;dbname=","","");
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function select($comando,$parametros = array())
	{
		$stmt = $this->con->prepare($comando);
		foreach ($parametros as $key => $value)
		{
			$stmt->bindParam($key,$value);
			$cont++;
		}
		$stmt->execute();

		$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0)
		{
			return $dados;
		}
		else
		{
			return "vazio";
		}
	}
	public function validar($cpf)
	{
		$stmt = $this->con->prepare("SELECT * FROM usuario WHERE cpf=:cpf");
		$stmt->bindParam(":cpf",$cpf);
		$stmt->execute();
		$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0)
		{
			return $dados;
		}
		else
		{
			return "vazio";
		}
	}
}
class Ferramentas
{
	public function data_inverte($data,$formato)
	{
		if ($formato === "br")
		{
			$transformado = date("d/m/Y",strtotime($data));
		}
		else
		{
			$transformado = date("Y-m-d",strtotime($data));
		}
		return $transformado;
	}
	public function todosMeses()
	{
		$meses = array(
			1 => "Janeiro",
			2 => "Fevereiro",
			3 => "Março",
			4 => "Abril",
			5 => "Maio",
			6 => "Junho",
			7 => "Julho",
			8 => "Agosto",
			9 => "Setembro",
			10 => "Outubro",
			11 => "Novembro",
			12 => "Dezembro"
		);
		return $meses;
	}
}
?>