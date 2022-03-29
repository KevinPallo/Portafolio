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
        <main>
        <section class=intro>
          <p> </p>
        </section>
        <section id="datos" class="subtitulos">
			        <h4 class="titulo-section">Ingreso de datos y gráfica</h4>
		    </section>		   
        <div class="title-form">Ingrese los siguientes datos:</div>
        <section class="formulario-section"> 
              <div class="formulario">
              <br>
              <form action="AproxSucesivas.php" method="post">
                  <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Limite Inferior</label>
                    <input type="text" name="inf" class="form-control" placeholder="Ej: -5" require value="<?php if(isset($_POST['inf'])){echo $_POST['inf'];}else echo "";?>"><br>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Limite Superior</label>
                    <input type="text" name="sup" class="form-control" placeholder="Ej:5" require value="<?php if(isset($_POST['sup'])){echo $_POST['sup'];}else echo "";?>"><br>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Subintervalos</label>
                    <input type="text" name="n" class="form-control" placeholder="Ej: 5" require value="<?php if(isset($_POST['n'])){echo $_POST['n'];}else echo "";?>"><br>

                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Tolerancia</label>
                    <input type="text" name="tol" class="form-control" placeholder="Ej: 0.000001" require value="<?php if(isset($_POST['tol'])){echo $_POST['tol'];}else echo "";?>"><br>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Función</label>
                    <input type="text" name="fun" class="form-control" placeholder="x**2+3*x+4" require value="<?php if(isset($_POST['fun'])){echo $_POST['fun'];}else echo "";?>"><br>
                  </div>
                  <button type="submit" class="btn btn-primary" name="Aceptar">Aceptar<button>
              </form>
              </div>
            </section>	
        <section id="resultados" class=subtitulos>
			    <h4 class="titulo-section">Resultados y coste computacional</h4>
		    </section>
        <section class="resultados-field">
                <?php
                if(isset($_POST['Aceptar'])){   
                    $a = $_POST['inf'];
                    $b = $_POST['sup'];
                    $n=$_POST['n'];
                    $tol = $_POST['tol'];
                    $fun = $_POST['fun'];
                    $h=($b-$a)/$n;
                    $i=0;
                    do{
                        $x1=$a+($i-1)*$h;
                        $x2=($a+($i*$h));
                        if(signoFun($x1,$x2,$fun)==1){
                            echo "Existe una pósible raíz entre [$x1,$x2]<br>";
                            aproxSuc(($x1+$x2)/2,$tol,$fun);
                            falsaPosicion($x1,$x2,$fun,$tol);
                            echo"<br><br>";
                    }
                    $i++;
                    }while($i<=$n);
                }

                #FUNCIÓN CAMBIO DE SIGNO.
                function signoFun($X1,$X2,$fun){
                    if ((funcion($X1,$fun)*funcion($X2,$fun))<0){
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

                #FUNCION PARA EVALUAR LA DERIVADA.
                function derivada($x,$fun){
                    $Ax=0.000001;
                    return (funcion($x+$Ax,$fun)-funcion($x,$fun))/$Ax;
                }

                #FUNCIÓN DE LA APROXIMACIÓN SUCESIVA
                function aproxSuc($x,$tol,$fun){         
                    do{
                        if(-1<derivada($x,$fun) && derivada($x,$fun)<0){
                            $x1=funcion($x,$fun);
                            $x=$x1;
                        }if(0<derivada($x,$fun) && derivada($x,$fun)<1){
                            $x1=funcion($x,$fun);
                            $x=$x1;
                        }if(derivada($x,$fun)>1){
                            echo "<b>Metodo A. Sucesivas:</b> Error, el método no converge";
                        break;
                        }if(derivada($x,$fun)<-1){
                            echo "<b>Metodo A. Sucesivas:</b> Error, el método no converge";
                            break;
                        }
                        $i++;
                    }while(abs(funcion($x,$fun))>$tol);
                        $raiz=abs($x);
                        echo " y la apróximacion mas cercana es $raiz<br>";
                }

                #FUNCION SECANTE-BISECTION
                function falsaPosicion($x1,$x2,$fun,$tol){
                $i=0;
                do{    
                    $salida=1;
                    $x3=($x1*funcion($x2,$fun)-$x2*funcion($x1,$fun))/(funcion($x2,$fun)-funcion($x1,$fun));
                    if(abs($x2-$x3)<=$tol && abs(funcion($x3,$fun))<$tol){
                        echo "<b>Método falsa posición:</b> la raíz es: $x3, ";
                        $salida = 0;
                    }
                    if(signoFun($x2,$x3,$fun)==1){
                        $x1=$x3;
                    }else{
                        $x2=$x3;
                    }
                        $i=$i+1;
                    }while($salida!=0);
                    echo "con $i iteracciones<br>";
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