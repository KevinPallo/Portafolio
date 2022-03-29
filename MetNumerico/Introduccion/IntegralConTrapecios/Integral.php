<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Metodos Numericos</title>
		<link rel="stylesheet" href="estilos.css" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
</head>
<body>
<header>
			<div class="menu-bar">
				<a href="" class="bt-menu">Menú</a>	
			</div>
			<div class="Title-nombre">
				<h1 class="Title-nombre-texto">Integral por trapecios</h1>
			</div>
			<nav>
				<ul>
					<li><a  href="#datos">Datos</a></li>
          <li><a  href="#grafica">Gráfica</a></li>
          <li><a  href="#resultados">Resultados</a></li>
          <li><a  href="../../MetodosNumericos.html">Regresar</a></li>
				</ul>
			</nav>
		</header>
	<main> 
		<section class="subtitulos">
			<h3 class=titulo-section>Ingreso de datos y gráfica</h3>		</section>
		<div class="title-form">Ingrese los siguientes datos:</div>
		<section class="formulario">
			<br>
			<form action="integral.php" method="post">
				<div class="mb-3">
					<label for="formGroupExampleInput" class="form-label">Limite Inferior</label>
					<input type="text" class="form-control" name="LimInf" placeholder="Ej: -5">
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput2" class="form-label">Limite Superior</label>
					<input type="text" class="form-control" name="LimSup" placeholder="Ej: 5">
				</div>
				<div class="mb-3">
					<label for="formGroupExampleInput2" class="form-label">Tolerancia</label>
					<input type="text" class="form-control" name="Tol" placeholder="Ej: 0.0000001">
				</div>
				<button type="submit" class="btn btn-primary" name="Aceptar">Aceptar<button>
			</form>
		</section>	
		<section class=resultados>
			<div class="title-resultados">Resultados y coste computacional</div>
		</section>
		<section class="resultados-field">
		<?php
		if(isset($_POST['Aceptar'])){
		$a = $_POST['LimInf'];
		$b = $_POST['LimSup'];
		$t = $_POST['Tol'];
		$Area=0;
		$i=81; 
		$cont=0;
		$suma= 0;
		$t_inicial = microtime(true);
			if ($b > $a) {	
					$n=$a;
					$Area1=$Area;
					$h = ($b-$a)/$i;
					for ($j = 1 ; $j <= ($i-1) ; $j++) { 
						$n=$n+$h;
						$suma = $suma + funcion($n);
						$cont++;
					}
					$Area = ($h/2)*(funcion($a)+funcion($b)) + $h*$suma;
					$suma=0;
					$dif = abs($Area-$Area1);
				$t_final = microtime(true);
				$time=$t_final-$t_inicial;
				echo "<div class=resultados-texto>";
				echo "El número de iteracciones de la suma es: $cont <br>";
				echo "El Area es: $Area con $i trapecios <br>";
				echo "Tiempo de ejecución: $time";
				echo "</div>";
			}
			else{
				echo "Por favor revisar los limites.";
			}
		}
		function funcion($valor1){
			return sin($valor1);
		}
	?>
	</section>
	</main>
	<footer id="footer">
	<?php
          include_once("../../RedesSociales.html");
          ?>
		</footer>
		</body>
		</html>


	
