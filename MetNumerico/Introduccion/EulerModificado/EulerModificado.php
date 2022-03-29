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
				<h1 class="Title-nombre-texto">Euler mejorado</h1>
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
			<SECtion class="introduccion">
			<div class='div_parrafo'>
						Metodo de Euler consiste en encontrar una función solución de la función ingresada en el campo 'Ingrese la función', en el campo 
						'Ingrese el valor de n' se especifica el número de iteracciones que deseamos que el computador realice, es decir, mientras mas grande
						sea el valor de n el resultado será mas exacto ya que el número de iteracciones aumentan; el campo 'punto a evaluar' se refiere al 
						punto de la función f(x,y) en la cual se desea hallar la función solución. Además, necesitamos un par ordenado para evaluar la función 
						en ese punto y empezar a encontrar la función solución.
			</div>
			</SECtion>
			<section class="subtitulos">
					<h3 class=titulo-section>Ingreso de datos y gráfica</h3>
			</section>
				<div class="title-form">Ingrese los siguientes datos:</div>
				<section class="formulario-section">
					<div class="formulario">
					<br>
					<form action="EulerMejorado.php" method="post">
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Función f(x,y)</label>
							<input type="text" class="form-control" name="funcion" required placeholder="Ej: x**2+4+y**2" value="<?php if (isset($_POST['funcion'])) echo $_POST['funcion']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Ingrese el valor de n</label>
							<input type="text" class="form-control" required name="n" placeholder="Ej: 4" value="<?php if (isset($_POST['n'])) echo $_POST['n']; ?>">	
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Punto a evaluar </label>
							<input type="text" class="form-control" required name="valorEval" placeholder="Ej: 7" value="<?php if (isset($_POST['valorEval'])) echo $_POST['valorEval']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Valores (x,y) iniciales</label>
							<input type="text" name="valoresIniciales" class="form-control"  required placeholder="Ej: (1,2)" value="<?php if (isset($_POST['valoresIniciales'])) echo $_POST['valoresIniciales']; else echo ""; ?>">
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
						if(isset($_POST['aceptar'])){
							$funcion=$_POST['funcion'];
							$n=$_POST['n'];
							$numEval=$_POST['valorEval'];
							$string=explode(",",$_POST['valoresIniciales']);
							$x=$string[0];
							$y=$string[1];
							$h=($numEval-$x)/$n;
							EulerM($x,$y,$h,$n,$funcion);
						}

						function EulerM($x,$y,$h,$n,$funcion){
							for($i=0;$i<=$n;$i++){
								echo $i."<br>";
								$vectorY[$i]=$y;  
								$y=$y+$h*(funcionEval($x+($h/2),$y+($h/2)*funcionEval($x,$y,$funcion),$funcion));
								$vectorX[$i]=$x;              
								$x=$x+$h;
							}
							tabla($vectorX,$vectorY,$n);
						}
						

						function funcionEval($x,$y,$funcion){
							$funcion=str_replace("x","(".$x.")",$funcion);
							$funcion=str_replace("y","(".$y.")",$funcion);
							eval("\$r=".$funcion.";");
							#eval("\$resultado=".$func.";");
							return $r;
						}
					
						function tabla($x,$y,$n){   
							echo "<div class=resultados><table>";
							echo "<tr><td> <b>n</b> </td><td> <b>x</b> </td><td> <b>y</b> </td></tr>";
							for($i=0;$i<=$n;$i++){
								echo "<tr><td>".$i."</td><td>".$x[$i]."</td><td>".$y[$i]."</td></tr>";
							}
							echo "</table></div>";
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
