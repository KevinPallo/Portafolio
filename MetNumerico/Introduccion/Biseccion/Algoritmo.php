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
				<h1 class="Title-nombre-texto">Bisección</h1>
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
       		<section id="datos" class="subtitulos">
			        <h4 class="titulo-section">Ingreso de datos y gráfica</h4>
		    </section>	
			<div class="title-form">Ingrese los siguientes datos:</div>
			<section class="formulario-section">
				<div class="formulario">
				<form action="Algoritmo.php" method="post">
					<div class="mb-3">
						<label for="formGroupExampleInput" class="form-label">Limite Inferior</label>
						<input type="text" class="form-control" name="LimA" required placeholder="Ej: -5" value="<?php if (isset($_POST['LimA'])) echo $_POST['LimA']; ?>">
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Limite Superior</label>
						<input type="text" class="form-control" required name="LimB" placeholder="Ej: 5" value="<?php if (isset($_POST['LimB'])) echo $_POST['LimB']; ?>">	
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Subintervalos</label>
						<input type="text" class="form-control" required name="N" placeholder="Ej: 7" value="<?php if (isset($_POST['N'])) echo $_POST['N']; ?>">
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Función</label>
						<input type="text" name="funcion" class="form-control"  required placeholder="Ej: x**2+4" value="<?php if (isset($_POST['funcion'])) echo $_POST['funcion']; else echo ""; ?>">
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Tolerancia</label>
						<input type="text" name="Tol" class="form-control"  required placeholder="Ej: 0.000001" value="<?php if (isset($_POST['Tol'])) echo $_POST['Tol']; else echo ""; ?>">
					</div> 
					<h6 class="checkbox-title">Seleccione el metodo que desea utilizar:</h6>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" name="recursivo" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
							Recursivo
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" name="iterativo" id="flexCheckChecked" checked>
						<label class="form-check-label" for="flexCheckChecked">
							Iterativo
						</label>
					</div>
					<button type="submit" class="btn btn-primary" name="Aceptar" href="#resultados">Aceptar<button>
				</form>
				</div>
			</section>	
			<section id="datos" class="subtitulos">
			        <h4 class="titulo-section">Ingreso de datos y gráfica</h4>
		    </section>	
			<section id="resultados" class="resultados-field">
			<div class="resultados-texto">
					<?php
					if(isset($_POST['Aceptar'])){
						$n=1;
						$a=$_POST['LimA'];
						$b=$_POST['LimB'];
						$n=$_POST['N'];
						$fun=$_POST['funcion'];
						$tol=$_POST['Tol'];
						$h = ($b-$a)/$n;
						/*echo "<b>DATOS INGRESADOS POR EL USUARIO:<br></b>";
						echo "Limite inferior = $a <br>";
						echo "Limite superior = $b <br>";
						echo "Numero de subintervalos = $n <br>";
						echo "Función: $fun<br>";
						echo "Tolerancia: $tol <br>";*/
						echo "<br><b>RESULTADOS:</b><br>";

						$i=1;

						do{
							$x1=$a+($i-1)*$h;
							$x2=($a+($i*$h));
							$int = signoFun($x1,$x2,$fun);
							if($int==1){
								
								if (isset($_POST['iterativo']) && isset($_POST['recursivo'])){
									echo "Una posible raíz se encuentra entre: x1=$x1 y x2=$x2<br>";
									$pm1=bisectionIter($x1,$x2,$fun,$tol);
									echo "Iterativo: La raíz exacta es: $pm1<br>";
									$pm=bisection($x1,$x2,$fun,$tol);
									echo "Recursividad: La raíz exacta es: $pm<br>";
								}
								#FUNCION ITERATIVA
								elseif (isset($_POST['iterativo'])) {
									echo "Una posible raíz se encuentra entre: x1=$x1 y x2=$x2<br>";
									$pm1=bisectionIter($x1,$x2,$fun,$tol);
									echo "Iterativo: La raíz exacta es: $pm1<br>";		
								}
								#FUNCION RECURSIVA
								elseif(isset($_POST['recursivo'])){
									echo "Una posible raíz se encuentra entre: x1=$x1 y x2=$x2<br>";
									$pm=bisection($x1,$x2,$fun,$tol);
									echo "Recursividad: La raíz exacta es: $pm<br>";
								
								}
								else{
									echo "No ha sido seleccionado ningún método.<br>";
									break;
								}
							}
							$i++;
							$x1=0;
							$x2=0;
						}while($i<=$n);
					}

					#FUNCION PARA EVALUAR LOS PUNTOS DE LA FUNCIÓN.
						function evaluar($x,$func){
							$resultado=0;
							$func=str_replace("x","(".$x.")",$func);
							eval("\$resultado=".$func.";");
							if ($resultado==0)
								$resultado="0";
								elseif ($resultado=="" || $resultado=="-1.#IND"){
							$resultado="NAN";		
						}
						return $resultado;   
						}

					#FUNCION PARA DETERMINAR LOS 'X' CUANDO LA FUNCION CAMBIA DE SIGNO
						function signoFun($X1,$X2,$funci){
							if ((evaluar($X1,$funci)*evaluar($X2,$funci))<0){
								$signo = 1;
							}else{
								$signo = 0;
							}
							return $signo;
						}

					#FUNCION RECURSIVA PARA ENCONTRAR LA RAIZ EXACTA.
						function bisection($r1,$r2,$fun,$tol){
							$dif=abs($r1-$r2);
							if($dif<$tol){
								$n=($r1+$r2)/2;
								return $n;
							}else{
								$m=($r1+$r2)/2;
								if(signoFun($r1,$m,$fun)==1){
									$r2=$m;
								}else
									$r1=$m;
								}
								return bisection($r1,$r2,$fun,$tol); 
							}

					#FUNCION ITERATIVA PARA ENCONTRAR LA RAIZ EXACTA:
						function bisectionIter($r1,$r2,$fun,$tol){
							do{
								$dif=abs($r2-$r1);
								$m=($r1+$r2)/2;
								if(signoFun($r1,$m,$fun)==1){
									$r2=$m;
								}else{
									$r1=$m;
								}
							}while($tol>$dif);
							$n=($r1+$r2)/2;
							return $n;
						}
					?>
					</div>
			</section>
			<footer id="footer">
			<?php
          include_once("/MetNumerico/RedesSociales.html");
		  ?>
		</footer>
		</body>
		</html>