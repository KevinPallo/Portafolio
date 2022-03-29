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
				<h1 class="Title-nombre-texto">Aproximaciones Sucesivas</h1>
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
    </main>
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
							<label for="formGroupExampleInput" class="form-label">Tolerancia</label>
							<input type="text" class="form-control" name="tol" required placeholder="Ej: 0.0000001" value="<?php if (isset($_POST['tol'])) echo $_POST['tol']; ?>">
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
                $tol=$_POST['tol'];
            $matriz=array(
                array(9,3,0),
                array(3,7,2),
                array(0,7,8),
            );                   
            $vector=[24,22,22];
            $matrizG=array(
                array(9,3,1),
                array(1,3,1),
                array(1,3,15),
            );
            $vectorG=[13,5,40];
            
            echo "<h2 class=Thomas> Algoritmo de Thomas </h2>";
            echo "<h2 class=Gauss1> Algoritmo de GaussJacobi </h2>";
            echo "<h3 class=original>";
            imprimir($matriz,$vector,'inicial','true');
            echo "</h3>";
            echo "<h3 class=res>";
            thomas($matriz,$vector);
            echo "</h3>";
            echo "<h3 class=original1>";
            imprimir($matrizG,$vectorG,'inicial','true');
            echo "</h3>";
            echo "<h3 class=gauss>";
            GaussJacobi($matrizG,$vectorG,$tol);
            echo "</h3>";
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
                    echo "Vector $mensaje <br><table>";    
                    for($i=0;$i<count($vector);$i++){
                        echo"<td> ", $vector[$i], " </td>";
                    }
                    echo "</table>";        
            }
            #Metodo de Thomas
            function thomas ($matriz,$vector){              
                for($i=1;$i<count($matriz[0]);$i++){
                    $matriz[$i][$i]=round(($matriz[$i][$i]-(($matriz[$i][$i-1]*$matriz[$i-1][$i])/($matriz[$i-1][$i-1]))),2);
                    $vector[$i]=$vector[$i]-(($matriz[$i][$i-1]*$vector[$i-1])/($matriz[$i-1][$i-1]));
                    $matriz[$i][$i-1]=0;
                }
                $vectorX[2]=round(($vector[2]/$matriz[2][2]),2);
                for($i=1;$i>=0;$i--){
                    $vectorX[$i]=round(((($vector[$i]-$matriz[$i][$i+1]*$vectorX[$i+1])/$matriz[$i][$i])),2);
                }
                imprimir($matriz,$vectorX,'Respuesta','false');
            }

            #Metodo de Gauss Jacobi
            function GaussJacobi($matriz,$vector,$tol){
                $X=[1,1,1];
                $aux=[0,0,0];
                do{
                    for($i=0;$i<3;$i++){
                        $suma=0;
                        for($j=0;$j<3;$j++){
                            if($i!=$j){
                                $suma+=$matriz[$i][$j]*$X[$j];
                            }
                        }
                        $X[$i]=round((($vector[$i]-$suma)/$matriz[$i][$i]),3);
                        #echo $X[$i],"<br>";
                    }
                    $stop='true';
                    for($i=0;$i<3;$i++){
                        if(abs(($X[$i]-$aux[$i]/$X[$i]))<$tol){
                            $stop='false';
                        }
                        $aux[$i]=$X[$i];
                        #echo abs(($X[$i]-$aux[$i]/$aux[$i])),"<br>";
                    }               
                }while($stop=='true');
                imprimir($matriz,$X,'respuesta','false');
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