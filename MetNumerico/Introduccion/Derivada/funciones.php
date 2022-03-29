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
	<body>
		<header>
			<div class="menu-bar">
				<a href="" class="bt-menu">Menú</a>	
			</div>
			<div class="Title-nombre">
				<h1 class="Title-nombre-texto">Derivada</h1>
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
				<h3 class=titulo-section>Ingreso de datos y gráfica</h3>
	</section>
	<div class="title-form">Ingrese los siguientes datos:</div> 
			<section class="formulario-section">
				<div class="formulario">
				<br>
				<form action="funciones.php" method="post">
					<div class="mb-3">
						<label for="formGroupExampleInput" class="form-label">Función</label>
						<input type="text" class="form-control" name="funcion" required placeholder="Ej: x**2+4" value="<?php if (isset($_POST['funcion'])) echo $_POST['funcion']; ?>">
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Valor de DeltaX</label>
						<input type="text" class="form-control" required name="Ax" placeholder="Ej: 0.0000001" value="<?php if (isset($_POST['Ax'])) echo $_POST['Ax']; ?>">	
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Punto X</label>
						<input type="text" class="form-control" required name="num" placeholder="Ej: 7" value="<?php if (isset($_POST['num'])) echo $_POST['num']; ?>">
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Error del resultado</label>
						<input type="text" name="error" class="form-control"  required placeholder="Ej: 0.0000000001" value="<?php if (isset($_POST['error'])) echo $_POST['error']; else echo ""; ?>">
					</div>
					<button type="submit" class="btn btn-primary" name="Aceptar" href="#resultados">Aceptar<button>
				</form>
				</div>	
			</section>
			<section class="subtitulos">
				<h3 class=titulo-section>Resultados y coste computacional</h3>
			</section>
			<section class="resultados-field">
				<?php
				if(isset($_POST['Aceptar'])){
				echo "<div class=resultado>";
					$Ax=$_POST['Ax'];
					$n=100;
					$stop=$_POST['error'];
					$num = $_POST['num']; 
					$funcion = $_POST['funcion'];
					#Iterracciones para buscar la convergencia.
						echo "<div class=respuesta>";
						echo "La función ingresada es: $funcion<br>";
						echo "El valor de la variable <b>X</b> es: $num <br>";
						do{
						$Ax=$Ax/$n;
						echo "valor de Ax $Ax<br>";
						$suma=$num+$Ax;
						$resta=funcionBase($suma)-funcionBase($num);
						$division=($resta/$Ax);
						$dif=abs($division-funcionDer($num));
						$base = funcionBase($num);
						}while($dif>$stop);
							echo "Valor de la convergencia es: $dif<br>";
							$der= 2*$num;
							echo "La derivada es: $der <br>";
						echo "</div>";
					echo "</div>";
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