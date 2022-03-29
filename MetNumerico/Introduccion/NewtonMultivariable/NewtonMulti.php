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
				<h1 class="Title-nombre-texto">Newton Multivariable</h1>
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
							<label for="formGroupExampleInput2" class="form-label">Limite inferior</label>
							<input type="text" class="form-control" required name="inf" placeholder="Ej: 7" value="<?php if (isset($_POST['inf'])) echo $_POST['inf']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Limite superior</label>
							<input type="text" name="sup" class="form-control"  required placeholder="Ej: (1,2)" value="<?php if (isset($_POST['sup'])) echo $_POST['sup']; else echo ""; ?>">
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
              $inf=$_POST['inf'];
              $sup=$_POST['sup'];
              for($i=0;$i<3;$i++){ 
                  $vector[$i]=rand($inf,$sup);
                  for($j=0;$j<3;$j++){
                      $matriz[$i][$j]=rand($inf,$sup);
                  }
              }
          echo "<div class='basica'>";
          imprimir($matriz,$vector,'Original');
          echo "</div>";
          $vectorSol=calcular($matriz,$vector);
          echo "<div class='SolFinal'>";
          echo "<br><b>La solución del sistema de ecuaciones es: </b><br>";
          for($k=0;$k<count($vectorSol);$k++){
              echo " x$k= ",$vectorSol[$k],"<br>";
          }
          echo "</div>";
          }

          #FUNCION PARA IMPRIMIR EL VECTOR Y LA MATRIZ
          function imprimir($matriz,$vector,$mensaje){
              echo "<table>";
              echo "<b>Matriz $mensaje</b><br>";
              for($i=0;$i<3;$i++){
                  echo "<tr>";
                  for($j=0;$j<3;$j++){
                      echo "<td>",$matriz[$i][$j],"</td>";
                  }
                  echo "</tr>";
              }
              echo "</table><br>";
              echo "<b>Vector $mensaje</b><br>";
              for($i=0;$i<3;$i++){
              echo "<table class=tabla1>";
              echo "<td>", $vector[$i],"</td>";
              echo "</table>";}
          }

          #FUNCION ELIMINACION GAUSSEANA
          function calcular($matriz,$vector){
              $r=0;
              for($k=0;$k<count($matriz[1]);$k++){
                  for($i=$k+1;$i<count($matriz[1]);$i++){
                  $m=round((($matriz[$i][$k])/$matriz[$k][$k]),2);
                  $vectorL[$r]=$m;
                  $r++;
                  $vector[$i]=round(($vector[$i]-($m)*($vector[$k])),2);
                      for($j=$k+1;$j<count($matriz[1]);$j++){
                          $matriz[$i][$j]=round((($matriz[$i][$j])-($m)*($matriz[$k][$j])),2);
                      }
                  $matriz[$i][$k]=0;    
                  }
              }
          factorizacion($matriz,$vectorL);
          echo "<div class='convertida'>";
          imprimir($matriz,$vector,'Convertida');
          echo "</div>";
          return soluciones($matriz,$vector);
          }

          #FUNCION ENCONTRAR L & U
          function factorizacion($matrizU,$vector){
              $vectorA=[0,0,0];
              $r=0;
              echo "<div class='matrizU'>";
              imprimir($matrizU,$vectorA,'Matriz U');
              echo "</div>";
              for($i=0;$i<count($matrizU[1]);$i++){
                  for($j=0;$j<count($matrizU[1]);$j++){
                      if($matrizU[$i][$j]==0){
                          $matrizU[$i][$j]=$vector[$r];
                          $r++;
                      }
                      if($i==$j){
                          $matrizU[$i][$j]=1;
                      }
                  }
              }
              for($i=0;$i<count($matrizU[1]);$i++){
                  for($j=$i;$j<count($matrizU[1]);$j++){
                      if($j>$i){
                          $matrizU[$i][$j]=0;
                      }
                  }
              }
              echo "<div class='matrizL'>";
              imprimir($matrizU,$vectorA,'Matriz L');
              echo "</div>";
          }

          #Resolver Ax=b
          function soluciones($matriz,$vector){
              for($i=(count($vector)-1);$i>=0;$i--){
                  $suma=0;
                  for($j=$i+1;$j<count($vector);$j++){
                      $suma=$suma+($matriz[$i][$j]*$vector[$j]);
                  }
              $vector[$i]=round(((1/$matriz[$i][$i])*($vector[$i]-$suma)),2);
              }
              echo "<div class='solucion'>";
              imprimir($matriz,$vector,'Solución');
              echo "</div>";
          return $vector;
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