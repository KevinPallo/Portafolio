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
				<h1 class="Title-nombre-texto">Minimos cuadrados</h1>
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
					<form action="MinCuadrados.php" method="post">
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Grado del polinomio</label>
							<input type="text" class="form-control" name="grado" required placeholder="Ej: x**2+4+y**2" value="<?php if (isset($_POST['grado'])) echo $_POST['grado']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Valores para la coordenada 'X' </label>
							<input type="text" class="form-control" required name="x" placeholder="Ej: 1,4,0" value="<?php if (isset($_POST['x'])) echo $_POST['x']; ?>">	
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Valores para la coordenada 'Y'</label>
							<input type="text" class="form-control" required name="y" placeholder="Ej: 1,4,0" value="<?php if (isset($_POST['y'])) echo $_POST['y']; ?>">
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
        if(isset($_POST["Aceptar"])){
            $x=$_POST['x']; 
            $y=$_POST['y'];
            $grado=$_POST['grado'];
            $x=tokenizar($x);
            $y=tokenizar($y);
            if(count($x)==count($y)){
                    $polinomio=polinomio($grado); 
                    $gradiente=gradiente($x,$y,implode($polinomio));
                    $gradiente = correccionS($gradiente); 
                    $gradienteAux=$gradiente;
                    #echo $gradienteAux.'<br><br><br>'; FUNCION GRADIENTE OK 
                    $estimativa=estimativa($grado);
                    $funcionAx=funcionxAx($estimativa,$gradiente);
                    $funcionx=funcionX($estimativa,$gradiente);
                    $gradiente=derivadaS($funcionAx,$funcionx);
                    echo '<div class=gradiente><h3>Vector Gradiente</h3>';
                    imprimir($gradiente); echo '<br>';
                    echo '</div>';
                    ############  PASOS PARA OBTENER LA JACOBIANA #######
                    $gradienteAux=explode('2+(',$gradienteAux);
                    $jacobiana=correccionJacobiana($gradienteAux,$y,$x); 
                    $jacobiana=implode($jacobiana);
                    $jacobiana=jacobiana($grado,$jacobiana,$x);
                    for($i=0;$i<count($jacobiana);$i++){
                        for($j=0;$j<count($jacobiana);$j++){
                            $jacovianaAx=funcionxAx($estimativa,$jacobiana[$i]);
                            $jacovianaX=funcionX($estimativa,$jacobiana[$i]);
                            $matriz[$i][$j]=derivadaJ($jacovianaAx[$j],$jacovianaX[$j]);
                          
                            #$matrizT[$j][$i]=derivadaJ($jacovianaAx[$j],$jacovianaX[$j]);
                        }
                    }
                    #imprimirMatriz($matrizT);
                    echo '<div class=matriz><h3>Matriz Jacobiana</h3>';
                    imprimirMatriz($matriz);
                    echo '</div>';
                    $respuestas=metodoThomas($matriz,$gradiente);
                    echo '<br><br>';
                    echo '<div class=respuestas><h3>Vector Respuestas</h3><b>';
                    imprimir($respuestas);
                    echo '<b></div>';
        }else echo "<b>Revisar que el número de valores en X sean los mismos q en Y</b><br>";
        }

        #########################################   INICIO PARA OBTENER EL JACOBIANA ######################################### 

        #FUNCION PARA OBTENER LA SEGUNDA DERIVADA
        function jacobiana($grado,$polinomio,$x){
            for($j=$grado;$j>=0;$j--){
                $jacobianaV=explode(')+(',$polinomio);
                $jacobianaV[0]=str_replace('(-'.$x[0].'','(-'.$x[0].')**'.$j.'+',$jacobianaV[0])  ; 
                for($i=1;$i<count($jacobianaV)-1;$i++){
                    $jacobianaV[$i]=str_replace('2)','(2)',$jacobianaV[$i]);
                    $jacobianaV[$i]= str_replace('(-'.$x[$i].'','(-'.$x[$i].')**'.$j.'+',$jacobianaV[$i]);
                }
                $jacobianaV[count($jacobianaV)-1]=str_replace('2)*(','(2)*(',$jacobianaV[count($jacobianaV)-1]);
                $jacobianaV[count($jacobianaV)-1]=str_replace('(-'.$x[count($x)-1].')','(-'.$x[count($x)-1].')**'.$j.'',$jacobianaV[count($jacobianaV)-1]);
                $jacovianaFinal[$j]=implode($jacobianaV);
            }
            return $jacovianaFinal;
        }

        #FUNCION PARA CORREGIR LOS ERRORES DEL STRING
        function correccionJacobiana($gradienteAux,$y,$x){
            for($i=0;$i<count($gradienteAux);$i++){
                $gradienteAux[$i]=str_replace(''.$y[$i].'-(','(2)*('.$y[$i].'-(',$gradienteAux[$i]);
                $gradienteAux[$i]=str_replace('))**','))*(-'.$x[$i].')+',$gradienteAux[$i]);
                $gradienteAux[$i]=str_replace('((','(',$gradienteAux[$i]);
                $gradienteAux[$i]=str_replace('(-'.$x[$i].')+2','*(-1)',$gradienteAux[$i]);
            }
            $gradienteAux[count($gradienteAux)-1] = str_replace('**(-1)','*(-'.$x[count($x)-1].')',$gradienteAux[count($gradienteAux)-1]);
            return $gradienteAux;
        }

        #FUNCION PARA IMPRIMIR LA MATRIZ
        function imprimirMatriz($matriz){
            echo '<table>';
            for($i=0;$i<count($matriz);$i++){
                echo '<tr>';
                for($j=0;$j<count($matriz);$j++){
                    echo '<td>'.$matriz[$i][$j]."</td>";
                }
                echo '</tr>';
            }
            echo '</table>';  
        }

        #FUNCION PARA RETORNAR LAS SEGUNDA DERIVADAS YA EVALUADAS
        function derivadaJ($funcionAx,$funcionx){
            $Ax=1e-8;
            eval("\$fAx=".$funcionAx.";");
            eval("\$fx=".$funcionx.";");
            $derivada=($fAx-$fx)/$Ax;
            return $derivada;
        }

        #########################################   FIN PARA OBTENER EL JACOBIANA ######################################### 


        #########################################   INICIO PARA OBTENER EL GRADIENTE ######################################### 

        #FUNCION PARA CREAR EL POLINOMIO 
        function polinomio($grado){
            for($i=$grado;$i>=0;$i--){
                $polinomio[$i]='a'.$i.'*x**'.$i.'+';
            }
            #$polinomio[0]=str_replace("0+","0", $polinomio[0]);
            return $polinomio;
        }

        #FUNCION PARA CALCULAR LA FUNCION S
        function gradiente($x,$y,$polinomio){
            $k=0;
            for($i=0;$i<=count($x)-1;$i++){
                $funcS[$k]='('.$y[$i].'-(';
                $k++;
                for($j=0;$j<=count($x);$j++){
                    $funcS[$k]=str_replace('x',"(".$x[$i].")",$polinomio);
                } 
                $k++;
                $funcS[$k]='))**2+';
                $k++;
            }
            return $funcS;
        }

        #FUNCION PARA OBTENER a0,a1,...,an
        function funcionxAx($estimativa,$gradiente){
            $Ax=1e-8;
            for($j=0;$j<count($estimativa);$j++){
                $aux=$gradiente;
                $vectorAux=$estimativa;
                for($i=0;$i<count($estimativa);$i++){
                    if($j==$i){
                        $vectorAux[$i]=$vectorAux[$i]+$Ax;
                    }
                    $aux=str_replace('a'.$i.'',"".$vectorAux[$i]."",$aux);
                }
                $stringAux[$j]=$aux;
            }
            return $stringAux;
        }

        #FUNCION PARA REEMPLAZAR a0, a1, a3, ..., an
        function funcionX($estimativa,$gradiente){
            $Ax=1e-8;
            for($j=0;$j<count($estimativa);$j++){
                $aux=$gradiente;
                $vectorAux=$estimativa;
                for($i=0;$i<count($estimativa);$i++){
                    $aux=str_replace('a'.$i.'',"".$vectorAux[$i]."",$aux);
                }
                $stringAux[$j]=$aux;
            }
            return $stringAux;
        }

        #FUNCION DE LA DERIVADA
        function derivadaS($funcionAx,$funcionx){
            $Ax=10;
            for($i=0;$i<count($funcionx);$i++){
                eval("\$fAx=".$funcionAx[$i].";");
                eval("\$fx=".$funcionx[$i].";");
                $derivada[$i]=($fAx-$fx)/$Ax;
            }
            return $derivada;
        }

        ######################################### FIN PARA OBTENER EL GRADIENTE ######################################### 

        #FUNCION PARA LLENAR EL VECTOR DE LA ESTIMATIVA
        function estimativa($grado){
            for($i=0;$i<=$grado;$i++){
                $estimativa[$i]=1;
            }
            return $estimativa;
        }

        #FUNCION PARA CORREGIR LOS ERRORES DE S
        function correccionS($gradiente){
            $gradiente[count($gradiente)-1]=str_replace('))**2+',"))**2",$gradiente[count($gradiente)-1]);
            $gradiente=implode($gradiente);
            $gradiente=str_replace('+)',")",$gradiente);
            return $gradiente;
        }

        #FUNCION PARA TOKENIZAR LOS VALORES DE X Y Y DE LA TABLA
        function tokenizar($string){
            return explode(",",$string);
        }

        #FUNCION PARA IMPRIMIR STRINGS
        function imprimir($string){
            echo '<table><tr>';
            for($i=0;$i<count($string);$i++){
                echo '<td>'.$string[$i], "</td>";
            }
            echo '</tr></table>';
        }

        #METODO DE TOMAS
        function metodoThomas($matriz, $vector){
            $resultados=array();
            $dim_vector=count($vector);

            for ($i=1; $i <count($matriz) ; $i++) { 
                $matriz[$i][$i]-=(($matriz[$i][$i-1]*$matriz[$i-1][$i])/$matriz[$i-1][$i-1]);
                $vector[$i]-=(($matriz[$i][$i-1]*$vector[$i-1])/$matriz[$i-1][$i-1]);
                $matriz[$i][$i-1]=0;
            }

            $resultado[$dim_vector-1]=$vector[$dim_vector-1]/$matriz[$dim_vector-1][$dim_vector-1];

            for($j=count($vector)-2; $j>=0 ;$j--){
                $resultado[$j]=($vector[$j]-($matriz[$j][$j+1]*$resultado[$j+1]))/$matriz[$j][$j];
            }
        return $resultado;
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