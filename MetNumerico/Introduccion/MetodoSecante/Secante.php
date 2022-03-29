<!DOCTYPE html>
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
				<h1 class="Title-nombre-texto">Metodo de la secante</h1>
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
					<form action="Secante.php" method="post">
                    <div class="mb-3">
							<label for="formGroupExampleInput" class="form-label">Función f(x)</label>
							<input type="text" class="form-control" name="funcion" required placeholder="Ej: x**2+4+y**2" value="<?php if (isset($_POST['func'])) echo $_POST['func'];?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Limite inferior</label>
							<input type="text" class="form-control" required name="LimA" placeholder="Ej: -4" value="<?php if (isset($_POST['LimA'])) echo $_POST['LimA']; ?>">	
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Limite superior</label>
							<input type="text" class="form-control" required name="LimB" placeholder="Ej: 7" value="<?php if (isset($_POST['LimB'])) echo $_POST['LimB']; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Número de subintervalos</label>
							<input type="text" name="N" class="form-control"  required placeholder="Ej: 4" value="<?php if (isset($_POST['N'])) echo $_POST['N']; else echo ""; ?>">
						</div>
						<div class="mb-3">
							<label for="formGroupExampleInput2" class="form-label">Tolerancia</label>
							<input type="text" name="tol" class="form-control"  required placeholder="Ej: 0.0000001" value="<?php if (isset($_POST['tol'])) echo $_POST['tol']; else echo ""; ?>">
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
                    if (isset($_POST["Aceptar"])){
                        $tol=$_POST['tol'];
                        $func=$_POST['func'];
                        $n=$_POST['N'];
                        $a=$_POST['LimA'];
                        $b=$_POST['LimB'];
                        $i=1;
                        echo "<b>RESULTADOS</b><br>";
                        $h=($b-$a)/$n;
                    do{
                        $x1=$a+($i-1)*$h;
                        $x2=($a+($i*$h));
                        $int = signoFun($x1,$x2,$func);
                        if($int==1){
                            echo "Una posible raíz se encuentra en $x1 y $x2<br>";
                            echo"<tr>";
                                echo "<td>Secante</td>";
                                $tiempo=secante($x1,$x2,$func,$tol,$n);
                                echo "<td>$tiempo</td>";
                            echo"</tr>";
                            echo"<tr>";
                                echo "<td>Biseccion</td>";
                                $tiempo1 = bisectionIter($x1,$x2,$func,$tol);
                                echo "<td>$tiempo1</td>";
                            echo"</tr>";
                            echo"<tr>";
                                echo "<td>Sec-Biseccion</td>";
                                $tiempo2 = secBisection($x1,$x2,$func,$tol);
                                echo "<td>$tiempo2<td>";
                            echo"</tr>"; 
                            echo "<tr><center></center></tr>";
                            if($tiempo<$tiempo1 && $tiempo<$tiempo2){
                                echo "El método más rápido es: <b>Secante</b><br>";
                            }
                            if($tiempo1<$tiempo && $tiempo1<$tiempo2){
                                echo "El método más rápido es: <b>Biseccion</b><br>";
                            }
                            if($tiempo2<$tiempo1 && $tiempo2<$tiempo){
                                echo "El método más rápido es: <b>Sec-Biseccion</b><br>";
                            }  
                            if($tiempo==$tiempo1 && $tiempo==$tiempo2){
                                echo "Los tres métodos tardan el mismo tiempo</b><br>";
                            }
                        }
                        $i++;
                        $x1=0;
                        $x2=0;
                    }while($i<=$n);
                    }

                    #FUNCION DE LA SECANTE
                    function secante($x1,$x2,$fun,$tol,$n){
                        $t_inicial = microtime(true);
                        $aux=1;
                        $i=1;
                        do{
                            $x3=$x2-((funcion($x2,$fun)*($x2-$x1))/(funcion($x2,$fun)-funcion($x1,$fun)));
                            if(abs($x2-$x3)<=$tol && funcion($x3,$fun)<=$tol){
                                echo "<td>x= $x3<br></td>";
                                $aux=0;
                                break;
                            }else{
                                $x2=$x3;
                            }
                            $i++;
                        }while($i<$n); 
                        if($aux!=0){echo "<td>No converge en $n iteracciones</td>";} 
                        echo "<td>$i</td>"; 
                        $t_final = microtime(true);
                        $t_total = $t_final-$t_inicial;
                        return $t_total;
                    }

                    #FUNCION CAMBIO DE SIGNO
                    function signoFun($x1,$x2,$funci){
                        if ((funcion($x1,$funci)*funcion($x2,$funci))<0){
                            $signo = 1;
                        }else{
                            $signo = 0;
                        }
                        return $signo;
                    }

                    #FUNCION PARA EVALUAR LA FUNCION.
                    function funcion($x,$func){
                        $resultado=0;
                        $func=str_replace("x","(".$x.")",$func);
                        eval("\$resultado=".$func.";");
                        if ($resultado==0){
                            $resultado="0";}
                        elseif ($resultado=="" || $resultado=="-1.#IND"){
                            $resultado="NAN";		
                        }
                        return $resultado;   
                    }
                    
            
                    #FUNCION BISECCION ITERATIVA
                    function bisectionIter($r1,$r2,$fun,$tol){
                    $t_inicial = microtime(true);
                    $i=0;
                    do{
                        $dif=abs($r2-$r1);
                        $m=($r1+$r2)/2;
                        if(signoFun($r1,$m,$fun)==1){
                            $r2=$m;
                        }else{
                            $r1=$m;
                        }
                        $i++;
                    }while($tol<$dif);
                    $n=($r1+$r2)/2;
                    echo "<td>x = $n<br></td>";
                    echo "<td>$i</td>";
                    $t_final = microtime(true);
                    $t_total = $t_final-$t_inicial;
                    return $t_total;
                    }

                    #FUNCION SECANTE-BISECTION
                    function secBisection($x1,$x2,$fun,$tol){
                    $t_inicial =microtime(true);
                    $i=0;
                    do{    
                        $salida=1;
                        $x3=$x2-funcion($x2,$fun)*(($x2-$x1)/(funcion($x2,$fun)-funcion($x1,$fun)));
                        if(abs($x2-$x3)<=$tol && abs(funcion($x3,$fun))<$tol){
                            echo "<td>x= $x3<br></td>";
                            $salida = 0;
                        }
                        if(signoFun($x2,$x3,$fun)==1){
                            $x1=$x3;
                        }else{
                            $x2=$x3;
                        }
                        $i=$i+1;
                    }while($salida!=0);
                    echo "<td>$i</td>";
                    $t_final=microtime(true);
                    $t_total = $t_final-$t_inicial;
                    return $t_total;
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