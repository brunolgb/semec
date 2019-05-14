function muda($id)
{
	var id = document.getElementById($id);
	var inputData = document.getElementById('data');
	var inputEscondido = document.getElementById('idEscondido');

	//colocando os valores dentro das inputs
	inputData.value = id.value;
	inputEscondido.value = $id;
	const topo = idEscondido.offsetTop;
	window.scroll({
		top: topo,
		behavior: "smooth"
	});
	document.getElementById('muda').innerHTML = $id;
}