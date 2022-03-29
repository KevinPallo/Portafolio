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
    <script src="https://www.geogebra.org/apps/deployggb.js"></script>
</head>
<body>
        <header>
			<div class="menu-bar">
				<a href="" class="bt-menu">Menú</a>	
			</div>
			<div class="Title-nombre">
				<h1 class="Title-nombre-texto">Splines Cubicos</h1>
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
					<form action="splinesCubicos.php" method="post">
						<div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Valores para la coordenada 'x')</label>
							<input type="text" class="form-control" name="x" required placeholder="Ej: 1,5,4,8" value="<?php if (isset($_POST['x'])) echo $_POST['x']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Valores para la coordenada 'y'</label>
							<input type="text" class="form-control" required name="y" placeholder="Ej: 1,3,9,10" value="<?php if (isset($_POST['y'])) echo $_POST['y']; ?>">	
						</div>
						<button type="submit" class="btn btn-primary" name="aceptar" href="#resultados">Aceptar<button>
					</form>
					</div>	
                    <?php 
                        echo  "<div class = figura>
                            <section id='Spines Cubicos' class='margen'>
                            <div id='ggb-element' style='margin: 0 auto'></div>
                            <script>
                            var ggbApp = new GGBApplet({
                                'appName': 'graphing',
                                'showZoomButtons':false,
                                'height': 500,
                                'showToolBar': false,
                                'showToolBarHelp':false,
                                'showAlgebraInput': false,
                                'showMenuBar': false,
                                'appletOnLoad': function(api) {";
                                    for($i=0;$i< $dimX;$i++){
                                        $a=$x[$i];
                                        $b=$y[$i];
                                        echo "api.evalCommand('($a,$b)');";
                                    }
                                    for($i=0;$i< $dimX-1;$i++){
                                        $a=$x[$i];
                                        $b=$x[$i+1];
                                        $c=$p[$i];
                                        echo "api.evalCommand('Function($c,$a,$b)');";
                                    }
                                    echo "}}, true);
                                    window.addEventListener('load', function() {
                                        ggbApp.inject('ggb-element');
                                    });
                            </script>
                            </section>
                        </div>";
                ?>
				</section>
				<section class="subtitulos">
					<h3 class=titulo-section>Resultados y coste computacional</h3>
				</section>
				<section class="resultados-field">

                <?php
                        $archivo = fopen("datos.txt.","r") or die ("Error");
                        $i=0;
                        while(!feof($archivo)){
                            $linea=fgets($archivo); 
                            $tok = strtok($linea, ",");
                                $x[$i]=(int)$tok;
                                $tok = strtok(",");
                                $y[$i]=(int)$tok;
                                $saltodelinea=nl2br($linea);
                                $i++; 
                        }
                        fclose($archivo);  

                    $h=array(); 
                    $sigma=array();
                    $lambda=array();
                    $niu=array();
                    $d=array();
                    $dimX=count($x);
                    $dimY=count($y);
                    echo '<div class=tabla><table><tr><td>X</td><td>Y</td></tr>';
                    
                        imprimir($x,$y);
                    echo '</table></div>';

                #PASO 1
                    for ($i=1;$i<$dimX;$i++){
                        $h[$i]=$x[$i]-$x[$i-1];
                        #echo 'h='.$h[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX;$i++){
                        $sigma[$i]=($y[$i]-$y[$i-1])/$h[$i];
                        #echo 'sigma='.$sigma[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX-1;$i++){
                        $lambda[$i]=$h[$i+1]/($h[$i]+$h[$i+1]);
                        #echo 'lambda='.$lambda[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX-1;$i++){
                        $niu[$i]=$h[$i]/($h[$i]+$h[$i+1]);
                        #echo 'niu='.$niu[$i].'<br>'; 
                    }

                    for ($i=1;$i<$dimX-1;$i++){
                        $d[$i]=6*(($sigma[$i+1]-$sigma[$i])/($h[$i]+$h[$i+1]));
                        #echo 'd='.$d[$i].'<br>'; 
                    }

                #PASO 2
                    for ($i=0;$i<$dimX-2;$i++){
                        for($j=0;$j<$dimX-2;$j++){
                            if ($i==$j)
                                $matriz[$i][$j]=2;
                            elseif($i-$j==-1)
                                $matriz[$i][$j]=$lambda[$j];
                            elseif ($i-$j==1)
                                $matriz[$i][$j]=$niu[$i+1];
                            else
                                $matriz[$i][$j]=0;
                        }
                    }
                    for($i=0;$i<count($d);$i++){
                        $aux1[$i]=$d[$i+1];
                    }
                    $aux=metodoThomas($matriz,$aux1);

                    for ($i=0;$i<$dimX;$i++){
                        if($i==0)
                            $M[$i]=0;
                        elseif($i==$dimX-1)
                            $M[$i]=0;
                        else{
                            $M[$i]=$aux[$i-1];
                        }
                        #echo 'M='.$M[$i].'<br>'; 
                    }

                #PASO 3
                    for ($i=1;$i<$dimX;$i++){
                        $r[$i]=$M[$i-1]/(6*$h[$i]);
                        #echo 'r='.$r[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX;$i++){
                        $s[$i]=$M[$i]/(6*$h[$i]);
                        #echo 's='.$s[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX;$i++){
                        $t[$i]=($y[$i-1]-$M[$i-1]*(pow($h[$i],2)/6))/$h[$i];
                        #echo 't='.$t[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX;$i++){
                        $u[$i]=($y[$i]-$M[$i]*(pow($h[$i],2)/6))/$h[$i];
                        #echo 'u='.$u[$i].'<br>'; 
                    }

                #PASO 4 
                    for ($i=1;$i<$dimX;$i++){
                        $v[$i]=$s[$i]-$r[$i];
                        #echo 'v='.$v[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX;$i++){
                        $w[$i]=3*($r[$i]*$x[$i]-$s[$i]*$x[$i-1]);
                        #echo 'w='.$w[$i].'<br>'; 
                    }   
                    for ($i=1;$i<$dimX;$i++){
                        $f[$i]=3*($s[$i]*pow($x[$i-1],2)-$r[$i]*pow($x[$i],2))+$u[$i]-$t[$i];
                        #echo 'F='.$f[$i].'<br>'; 
                    }
                    for ($i=1;$i<$dimX;$i++){
                        $g[$i]=$x[$i]*($r[$i]*pow($x[$i],2)+$t[$i])-$x[$i-1]*($s[$i]*pow($x[$i-1],2)+$u[$i]);
                        #echo 'g='.$g[$i].'<br>'; 
                    }
                    for ($i=0; $i <$dimX-1; $i++) { 
                        $p[$i]=$v[$i+1]."x^3+".$w[$i+1]."x^2+".$f[$i+1]."x+".$g[$i+1];
                        #echo 'p='.$p[$i].'<br>'; 
                    }

                    
                    #Resolucion del sistemas de ecuaciones con el metodo de thomas
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

                    #imprimir vectores
                    function imprimir($x,$y){
                        for($i=0;$i<count($x);$i++){
                            echo "<tr>";
                            echo "<td>".$x[$i]."</td><td>".$y[$i]."</td>";
                            echo "</tr>";
                        }
                        echo "<br>";
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