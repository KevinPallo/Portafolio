<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Metodos Numericos</title>
		<link rel="stylesheet" href="estilo.css" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	</head>
	<body>
    <header>
			<div class="menu-bar">
				<a href="" class="bt-menu">Menú</a>	
			</div>
			<div class="Title-nombre">
				<h1 class="Title-nombre-texto">Metodo Simpoms</h1>
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
		</SECtion>
			<section class="subtitulos">
					<h3 class=titulo-section>Ingreso de datos y gráfica</h3>
			</section>
				<div class="title-form">Ingrese los siguientes datos:</div>
				<section class="formulario-section">
					<div class="formulario">
					<br>
					<form action="Simpsoms.php" method="post">
					<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Función/label>
							<input type="text" class="form-control" name="funcion" required placeholder="Ej: x**2+4+y**2" value="<?php if (isset($_POST['funcion'])) echo $_POST['funcion']; ?>">
						</div>
					<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Limite inferior</label>
							<input type="text" class="form-control" name="LimInf" required placeholder="-2" value="<?php if (isset($_POST['LimInf'])) echo $_POST['LimInf']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Limite superior</label>
							<input type="text" class="form-control" required name="LimSup" placeholder="Ej: 4" value="<?php if (isset($_POST['LimSup'])) echo $_POST['LimSup']; ?>">	
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Tolerancia</label>
							<input type="text" class="form-control" required name="Tol" placeholder="Ej: 0.0000001" value="<?php if (isset($_POST['Tol'])) echo $_POST['Tol']; ?>">
						</div>
						<button type="submit" class="btn btn-primary" name="aceptar" href="#resultados">Aceptar<button>
					</form>
					</div>	
				</section>
				<section class="subtitulos">
					<h3 class=titulo-section>Resultados y coste computacional</h3>
				</section>
				<section class="resultados-field">
				<?php
				$inf = $_POST['LimInf'];
				$sup = $_POST['LimSup'];
				$tol =  $_POST['Tol'];
				$Area=0;
				$Area1=0;
				$i=81;
				$sum=0;
				$sum1=0;

				echo "<b>Método de Simpons<br>Datos ingresados</b><br>";
				echo "Lim superior = $sup<br> Lim inferior = $inf <br> Tolerancia = $tol<br>";

				$t_inicial = microtime(true);

					$h=($sup-$inf)/$i;

					#Sumatoria para un valor de X impar.
					for ($j=1; $j<= ($i/2); $j++) { 
						$num = ((2*$j-1)*$h)+$inf;
						$sum = $sum + funcionBase($num);
					}

					#Sumatoria para un valor de X par.
					for ($k=1; $k<=(($i/2)-1); $k++) { 
						$num1 = (2*$k*$h)+$inf;
						$sum1 = $sum1 + funcionBase($num1);
					}

					#Calculo de la integral.
					$Area = ($h/3)*(funcionBase($inf) + 4*$sum + 2*$sum1 + funcionBase($sup));

					#------------------------------------------------------------------------------------
					#Declaracion de la variable para calcular la convergencia.
				$t_final = microtime(true);
				$time=$t_final-$t_inicial;
				echo "Función: <b>sin(x)</b><br>";
				echo "El resultado de la integral es: $Area con $i iteracciones" ;
				echo "<br>Tiempo de ejecución: $time";
				function funcionBase($valor1) {
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

