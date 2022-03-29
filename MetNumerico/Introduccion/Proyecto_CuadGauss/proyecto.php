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
				<h1 class="Title-nombre-texto">Cuadratura Gaussiana</h1>
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
						<form action="EulerMejorado.php" method="post">
							<div class="mb-3">
								<label for="formGroupExampleInput" class="form-label">Función f(x)</label>
								<input type="text" class="form-control" name="fx" required placeholder="Ej: x**2+4+y**2" value="<?php if (isset($_POST['fx'])) echo $_POST['fx']; ?>">
							</div>
							<div class="mb-3">
								<label for="formGroupExampleInput2" class="form-label">Limite inferior</label>
								<input type="text" class="form-control" required name="a" placeholder="Ej: 4" value="<?php if (isset($_POST['a'])) echo $_POST['a']; ?>">	
							</div>
							<div class="mb-3">
								<label for="formGroupExampleInput2" class="form-label">Limite superior</label>
								<input type="text" class="form-control" required name="b" placeholder="Ej: 7" value="<?php if (isset($_POST['b'])) echo $_POST['b']; ?>">
							</div>
							<div class="mb-3">
								<label for="formGroupExampleInput2" class="form-label">Grado del polinomio </label>
								<input type="text" name="n" class="form-control"  required placeholder="Ej: 2" value="<?php if (isset($_POST['n'])) echo $_POST['n']; else echo ""; ?>">
							</div>
							<button type="submit" class="btn btn-primary" name="aceptar" href="#resultados">Aceptar<button>
						</form>
					</div>	
					<div class="figura"> 
						<script type="text/javascript" src="https://cdn.geogebra.org/apps/deployggb.js"></script>
						<script type="text/javascript">
								function perspective(p){
									updateHelp(p);
									ggbApplet.setPerspective(p);
								} 
								var parameters = {
										"id":"ggbApplet",
										"appName":"graphing",
										"width":1000,
										"height":400,
										"showToolBar":true,
										"borderColor":null,
										"showMenuBar":true,
										"allowStyleBar":true,
										"showAlgebraInput":true,
										"enableLabelDrags":false,
										"enableShiftDragZoom":true,
										"capturingThreshold":null,
										"showToolBarHelp":false,
										"errorDialogsActive":true,
										"showTutorialLink":true,
										"showLogging":true,
										"useBrowserForJS":false};
								var applet = new GGBApplet(parameters, '5.0', 'applet_container');
							window.onload = function() { applet.inject('applet_container'); }
						</script>
					<div id="applet_container"></div>
					</div>
				</section>
				<section class="subtitulos">
					<h3 class=titulo-section>Resultados y coste computacional</h3>
				</section>
				<section class="resultados-field">
						<?php
							if(isset($_POST['aceptar'])){
								$n = $_POST['n'];
								$a = $_POST['a'];
								$b = $_POST['b'];
								$fx = $_POST['fx'];
								$timeInicial= microtime(true);
								#Obtenemos la raíz.
								$raiz = localizarRaiz($n);
								#Calculamos la integral.
								$resultado = CalIntegral($a, $b, $n, $raiz, $fx);
								$timeFinal = microtime(true);
								$time = $timeFinal-$timeInicial;
								echo "<div class=resultados>"; 
									echo "<table>";
										echo "<caption>Tabla de resultados <b>Método Cuadratura Gaussiana</b>.</caption>";
										echo "<tr><td>Limite inferior</td><td>$a</td></tr>";
										echo "<tr><td>Limite superior</td><td>$b</td></tr>";
										echo "<tr><td>Grado del polinomio</td><td>$n</td></tr>";
										echo "<tr><td>Función</td><td>$fx</td></tr>";
										echo "<tr><td>Tiempo de ejecución</td><td>$time</td></tr>";
										echo "<tr><td><b>Resultado</b></td><td>$resultado</td></tr>";
									echo "</table>";
								echo "</div>";
							}

							#FUNCION PARA CALCULAR LA INTEGRAL MEDIANTE LA CUADRATURA DE GAUSS
							function CalIntegral($a, $b, $n, $raiz, $fx){ 
								$sumatorio = 0;
								for($i = 0; $i < $n; $i++){
									$sumatorio = $sumatorio + (funcion($fx, calculaXi($a, $b, $i, $raiz)) * calculaWi($n, $i, $raiz));
								}
								return ((($b - $a)/2) * $sumatorio);
							}
							
							#FUNCION PARA CALCULAR EL Xi
							function calculaXi($a, $b, $i, $raiz){
								return ((($b - $a)/2) * $raiz[$i]) + (($b + $a)/2);
							}
							
							#FUNCION PARA CALCULAR EL Wi
							function calculaWi($n, $i, $raiz){
								return (2)*(1/((1-($raiz[$i]*$raiz[$i]))*(DerivPolinLegen($n,$raiz[$i])*(DerivPolinLegen($n,$raiz[$i])))));
							}
							
							#FUNCION PARA EVALUAR X EN EL POLINOMIO DE LEGENDRE
							function PolinLengeEval($n, $x){ 
								if($n == 0){
									return 1;
								}else if($n == 1){
									return $x;
								}else{
									return (1/$n)*(((2*$n-1)*$x*(PolinLengeEval($n - 1, $x))) - (($n - 1) *(PolinLengeEval($n - 2, $x)))); 
								}
							}

							#FUNCION PARA CALCULAR LA DERIVADA DEL POLINOMIO DE LEGENDRE
							function DerivPolinLegen($n, $x){
								$delta = 1e-8;
								return (PolinLengeEval($n, $x+$delta) - PolinLengeEval($n, $x))/($delta);
							}
							
							#FUNCION PARA OBTENER LOS VALORES DE X EN EL INTERVALO DE [-1;1]
							function localizarRaiz($n){
								$a = -1;
								$b = 1;
								$c = ($b - $a)/$n;
								for($i = 0; $i <= $n; $i++){
									$k[$i] = $a + $c * $i; 
								}
								for($i = 0; $i < $n; $i++){
									$raiz[$i] = Secante($n, $k[$i], $k[$i+1]);
								}
								return $raiz;
							}

							#FUNCION PARA ENCONTRAR RAICES MEDIANTE EL METODO DE LA SECANTE-BISECCION
							function Secante($n, $x, $y){ 
								$a[0] = $x;
								$b[0] = $y;
								$tol = 1e-9;
								$continuar = true;
								$k = 0;
								while($continuar){
									$c[$k] = $b[$k] - (PolinLengeEval($n, $b[$k])) * (($b[$k] - $a[$k])/(PolinLengeEval($n, $b[$k]) - PolinLengeEval($n, $a[$k])));
									if(abs($b[$k] - $c[$k]) <= $tol || abs(PolinLengeEval($n, $c[$k])) <= $tol){
										$raiz = $c[$k];
										$continuar = false;
									}else if((PolinLengeEval($n, $b[$k]) * PolinLengeEval($n, $c[$k])) <= 0){
										$a[$k+1] = $c[$k];
										$b[$k+1] = $b[$k];
									}else{
										$a[$k+1] = $a[$k];
										$b[$k+1] = $c[$k];
									}
									$k++;
								}
								return $raiz;
							}
							
							#FUNCION PARA OBTENER EL VALOR DE lA FUNCION EVALUADA EN X
							function funcion($fx, $x){
								$r = 0;
								$pat[0]= '/(\d+)[x]/';
								$pat[1]= '/[x]["^"]+(\d+)/';
								$rep[0]='$1*x';
								$rep[1]='pow(x,$1)';
								$fx = preg_replace($pat,$rep,$fx);
								$funcionEval = str_replace("x", "(".$x.")", $fx);
								eval("\$r=".$funcionEval.";");
								return $r;
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