<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="vierport" content="width=device-width, initial-scale=1.0">
	<title>bruno</title>
</head>
<body>
	<style>
		*{box-sizing: border-box;}
		div{
			display: block;
			width: 300px;
			height: 300px;
			position: relative;
			padding: 0px;
			box-shadow: 0px 0px 5px #ddd;
		}
		@media(max-width: 1000px)
		{
		div{
			width: 100%;
			height: 60%;
		}	
		}
		span{
			display: block;
			width: 100%;
			height: 0px;
			top: 0px;
			overflow-y: hidden;
			background: rgba(0,0,0,0.4);
			position: absolute;
			top: 0px;
			text-align: center;
			font-size: 20px;
			font-family: arial;
			color:#fff;
			transition: height 0.5s ease-in-out;
		}
		em{
			position: absolute;
			word-wrap: nowrap;
			top: 50%;
			left: 40%;
			transform: translate(0%,100%);
			transition: 0.4s ease-in-out;
		}
		img{
			display: block;
			margin: 0px;
			margin: auto;
			width: 100%;
			height: 100%;
			transition: 0.5s ease-in-out;
		}
		div:hover span{
			height: 100%;
		}
		div:hover img{
			filter: blur(5px);
			transform: scale(1.1);
		}
	</style>
	<div>
		<img src="arquivos/logo-semec.png" alt="">
		<span>
			<em>texto</em>
		</span>
	</div>
</body>
</html>