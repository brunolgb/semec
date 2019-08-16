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
function acesso()
{
	var acess = document.querySelector(".acesso");
	if (acess.getAttribute("class") == "acesso")
	{
		acess.classList.add("disBlock");
		setTimeout(function(){
			acess.classList.add("opacity");
			acess.classList.add("acesso-mov");
		}, 100);
	}
	else
	{
		acess.classList.remove("acesso-mov");
		acess.classList.remove("opacity");
		setTimeout(function(){
			acess.classList.remove("disBlock");
		}, 400);
	}
	
	
}
function mascara(elemento,masc)
{
	var e = document.querySelector(elemento);
	e.addEventListener("keypress", function (){
		if (event.keyCode != 8)
		{
			mascara_chamada(elemento,masc);
		}
	});
}
function mascara_chamada(elemento,masc)
{
	var e = document.querySelector(elemento);
	var c = e.value.length;
	if (masc == "cpf")
	{
		switch (c) {
			case 3: e.value += "."; break;
			case 7: e.value += "."; break;
			case 11: e.value += "-"; break;
		}
	}
	if (masc == "data")
	{
		switch (c) {
			case 2: e.value += "/"; break;
			case 5: e.value += "/"; break;
		}
	}
}
window.onload = function (){
	//colocando as datas do dia automaticamente nos inputs
	var i = 0;
	while (document.querySelectorAll(".agora")[i])
	{
		var d = new Date();
		var dia = d.getDate();
		var mes = d.getMonth() + 1;
		var ano =  d.getFullYear();
		var elemento = document.querySelectorAll(".agora")[i];
		if (mes < 10)
		{
			mes = "0" + mes;
		}
		elemento.value = dia + "/" + mes + "/" + ano;
		
		i++;
	}


	// mostrando suavemente os campos
	var i = 0;
	while (document.querySelectorAll(".campos")[i])
	{
		var campos = document.querySelectorAll(".campos")[i];
		campos.style.transition = 'opacity 0.4s 0.'+i+'s ';
		campos.style.opacity = 1;
		
		i++;
	}
	var elemento = document.querySelector("#acesso");
	elemento.addEventListener("change", function(){
		if(elemento.value.length > 0 && elemento.value.length < 14)
		{
			elemento.style.color = 'red'; 
			elemento.focus();
		}
		else
		{
			elemento.style.color = '#333'; 
		}
	});

};