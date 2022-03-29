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
				<h1 class="Title-nombre-texto">Interopolación Lineal</h1>
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
				<form action="Algoritmo.php" method="post">
          
					<div class="mb-3">
						<label for="formGroupExampleInput" class="form-label">Valores para la coordenada 'X' </label>
						<input type="text" class="form-control" name="valX" required placeholder="Ej: 1,4,0" value="<?php if (isset($_POST['valX'])) echo $_POST['valX']; ?>">
					</div>
					<div class="mb-3">
						<label for="formGroupExampleInput2" class="form-label">Valores para la coordenada 'Y'</label>
						<input type="text" class="form-control" required name="valY" placeholder="Ej: 1,4,0" value="<?php if (isset($_POST['valY'])) echo $_POST['valY']; ?>">	
					</div>
					<h6 class="checkbox-title">Seleccione el metodo que desea utilizar:</h6>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" name="lineal" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
            Interpolacion lineal
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" name="cuadratica" id="flexCheckChecked" checked>
						<label class="form-check-label" for="flexCheckChecked">
            Interpolacion cuadratica
						</label>
					</div>
          <div class="form-check">
						<input class="form-check-input" type="checkbox" value="" name="lagrangeana" id="flexCheckChecked" checked>
						<label class="form-check-label" for="flexCheckChecked">
            Interpolacion lagrangeana
						</label>
					</div>
          <br>
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
                  $valoresX=$_POST['valX'];
                  $valoresY=$_POST['valY'];
                  $valoresX=tokenizar($valoresX);
                  $valoresY=tokenizar($valoresY);
                  if (isset($_POST['lagrangeana'])){
                      $funcionE=IntLagrangeana($valoresX,$valoresY);
                      $vector='no';
                  }else{
                  if (isset($_POST['lineal'])){
                      $funcionE=IntLineal($valoresX,$valoresY);
                      $vector='yes';
                  }else{
                  if (isset($_POST['cuadratica']) && count($valoresX)==3){
                      $funcionE=IntCuadratica($valoresX,$valoresY);
                      $vector='no';
                  }else {echo 'Esta selecciones solo sirve para 3 puntos. Por favor ingrese solo 3 puntos.<br>';}
                  }
                  }
                  
              }

              #FUNCION PARA SEPARAR LOS VALORES INGRESADOS
              function tokenizar($string){
                  return explode(",",$string);
              }

              #FUNCION PARA IMPRIMIR VECTORES
              function imprimir($string){
                  for($i=0;$i<count($string);$i++){
                      echo $string[$i]."<br>";
                  }
                  echo '<br>';
              }
              
              #FUNCION PARA OBTENER LA FUNCION LINEAL
              function IntLineal($x,$y){
                  for($i=0;$i<count($x)-1;$i++){
                      $sigma[$i]='((x-'.$x[$i].')/('.$x[$i+1].'-'.$x[$i].'))*('.$y[$i+1].'-'.$y[$i].')+'.$y[$i];
                  }
                  return $sigma;
              }

              #FUNCION PARA OBTENER LA FUNCION DE LA INTERPOLACION CUADRATICA
              function IntCuadratica($x,$y){
                  $polinomio='a2*(x^2)+a1*(x^1)+a0*(x^0)';
                  for($i=0;$i<3;$i++){
                      $k=0;
                      for($j=2;$j>=0;$j--){
                          $matriz[$i][$j]=$x[$i]**$k;
                          $k++;
                      }
                  }
                  $salida=elimacionGaussiana($matriz,$y);
                  $aux=$salida[2];
                  $salida[2]=$salida[0];
                  $salida[0]=$aux;
                  for($i=0;$i<3;$i++){
                      $polinomio=str_replace('a'.$i.'',''.$salida[$i].'',$polinomio);
                  }
                  echo $polinomio;
                  return $polinomio;
              }

              #FUNCION PARA OBTENER LA FUNCION DE LA INTERPOLACION LAGRANGEANA
              function IntLagrangeana($x,$y){
                  for($i=0;$i<4;$i++){
                      $PI[$i]='(x-'.$x[$i].')*';
                  }
                  $PI[3]=str_replace(')*',')',$PI[3]);
                  $funcionPI=implode($PI);
                  for($i=0;$i<4;$i++){
                      $funcionAux=str_replace('(x-'.$x[$i].')','1',$funcionPI);
                      $piFinal[$i]=$funcionAux;
                      $PI[$i]=str_replace('x',''.$x[$i].'',$funcionAux);
                      eval("\$r=".$PI[$i].";");
                      $salida[$i]=$r;
                      $b[$i]=$y[$i]/$salida[$i];
                  }
                  for($i=0;$i<4;$i++){
                      $funcionFinal[$i]='('.$b[$i].')*('.$piFinal[$i].')+';
                  }
                  $funcionFinal[3]=str_replace(')+',')',$funcionFinal[3]);
                  return implode($funcionFinal);
              }




              echo  "<div class = grafica>
              <section id='Spines Cubicos' class='margen'>
              <div id='ggb-element' style='margin: 0 auto'></div>
                  <script>
                      var ggbApp = new GGBApplet({
                          'appName': 'graphing',
                          'showZoomButtons':true,
                          'height': 500,
                          'showToolBar': true,
                          'showAlgebraInput': true,
                          'showMenuBar': true,
                          'appletOnLoad': function(api) {";
                              for($i=0;$i< count($valoresX);$i++){
                                  $a=$valoresX[$i];
                                  $b=$valoresY[$i];
                                  echo "api.evalCommand('($a,$b)');";
                              }
                              for($i=0;$i< count($valoresX)-1;$i++){
                                  $a=$valoresX[$i];
                                  $b=$valoresX[$i+1];
                                  if($vector == 'yes')
                                      $c=$funcionE[$i];
                                  if($vector == 'no')
                                      $c=$funcionE;     
                                  echo "api.evalCommand('Function($c,$a,$b)');";
                              }
                              echo "}}, true);
                              window.addEventListener('load', function() {
                                  ggbApp.inject('ggb-element');
                              });
                      </script>
                  </section>
                  </div>";

                  function imprimirMatriz($matriz){
                      for($i=0;$i<count($matriz);$i++){
                          for($j=0;$j<count($matriz);$j++){
                              echo $matriz[$i][$j]. ' ';
                          }
                          echo '<br>';
                      }
                  }

                  #METODO DE TOMAS
                  function elimacionGaussiana($r,$s){
                      $n=count($s);
                      for($k=0;$k<$n-1;$k++){
                          for($i=$k+1;$i<$n;$i++){
                              if($r[$k][$k] != 0){
                              $m=round($r[$i][$k]/$r[$k][$k],3);
                              for($j=$k+1;$j<$n;$j++){
                                $r[$i][$j]=round($r[$i][$j]-$m*$r[$k][$j],3);
                              }
                              $r[$i][$k]=0;
                              $s[$i]=round($s[$i]-$m*($s[$k]),3);
                              }else
                                  return -1;
                          }
                      }
                      for($i=$n-1;$i>=0;$i--){
                          $suma=0;
                          for($j=$i+1;$j<$n;$j++){
                              $suma+=$t[$j]*$r[$i][$j];
                          }
                          $t[$i]=round(($s[$i]-$suma)/$r[$i][$i],3);
                      } 
                      return $t;
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