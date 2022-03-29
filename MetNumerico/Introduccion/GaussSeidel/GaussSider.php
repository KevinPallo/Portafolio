<html>
<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Metodos Numericos</title>
		<link rel="stylesheet" href="etilos.css" type="text/css">
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
				<h1 class="Title-nombre-texto">Gauss Seidel</h1>
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
					<form action="GaussSider.php" method="post">
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Tolerancia</label>
							<input type="text" class="form-control" name="tol" required placeholder="Ej: 0.000001" value="<?php if (isset($_POST['tol'])) echo $_POST['tol']; ?>">
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
				if(isset($_POST['Aceptar'])){
					$tol=$_POST['tol'];
					$matriz=array(
						array(9,3,0),
						array(3,7,2),
						array(0,7,8),
					);                   
					$vector=[24,22,22];
					echo "<h3 class=original>";
					imprimir($matriz,$vector,'inicial','true');
					echo "</h3>";
					echo "<h3 class=res>";
					GaussSeidel($matriz,$vector,$tol);
					echo "</h3>";    
				}
					function GaussSeidel($matriz,$vector,$tol){
						$aux=array();
						$x=array();
						$w=1.3;
						for ($i=0; $i < count($vector); $i++) {
							$aux[$i]=1; 
							$x[$i]=1;
						}
						do{
						$stop=false;
							for ($i=0; $i <count($vector) ; $i++) {
								$sum=0;
								$sum1=0;
								#Sumatiria1
								for ($j=0; $j <=($i-1); $j++) { 
									$sum+=$matriz[$i][$j]*$aux[$j];
								}
								#Sumatoria2
								for ($h=$i+1; $h <count($vector); $h++) { 
									$sum1+=$matriz[$i][$h]*$aux[$h];
								} 
							$aux[$i]=(($vector[$i]-$sum-$sum1)/$matriz[$i][$i]);
							$aux[$i]=round(($w*$aux[$i]+(1-$w)*$x[$i]),4);
							}
							for ($i=0; $i < count($vector); $i++) { 
								if(abs(($aux[$i]-$x[$i])/$x[$i])>$tol){
									$stop=true;
								}
							}
								$x=$aux;
						}while($stop);
						imprimir($matriz,$x,'Respuesta','false');
					}


					#Función para imprimir la matriz y el vector
				function imprimir($matriz,$vector,$mensaje,$boolean){
					if($boolean=='true'){ 
						echo "Matriz $mensaje.<br> <table>";
						for($i=0;$i<count($matriz[0]);$i++){
							echo "<tr>";
							for($j=0;$j<count($matriz[$i]);$j++){
								echo "<td>",$matriz[$i][$j],"</td>";
							}
							echo "</tr>";
						}
						echo "</table>";
					}
						echo "<br><br><br><br><br><br>Vector $mensaje <br><table>";    
						for($i=0;$i<count($vector);$i++){
							echo"<td> ", $vector[$i], " </td>";
						}
						echo "</table>";        
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