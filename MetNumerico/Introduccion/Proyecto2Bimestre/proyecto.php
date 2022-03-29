<html>
    <meta charset="UTF-8">
    <title>Proyecto Final Métodos Numéricos</title>
    <style>
        body{
            background-image: url(fondo1.jpg);
        }        
    </style>
    
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <script src="https://mauriciopoppe.github.io/function-plot/js/function-plot.js"></script>
    
  	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<link rel="stylesheet" href="morris.css">
	<script src="morris.min.js" charset="utf-8"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	
    
    <head>
    <title>Proyecto Final Métodos Numéricos</title>
    <hr> 
    <p> 
	<img src="epnlogo.png" align="left" widht="260px" height="110px">
	<img src="fislogo.png" align="right" widht="260px" height="110px">
	<h1><div align="center"><br><strong>Escuela Polit&eacutecnica Nacional</strong><br>
	<div align="center"><br><strong>Ingeniería de Sistemas y Computación</strong><br>
	<div align="center"><br><strong>Proyecto Final</strong><br></h1>
	<div align="center"><br><strong>Métodos Numéricos</strong><br>
	</p>
    <hr>
    </head>
    <?php
    //Valores que seran tabulados en la Tabla 1 
        $x[0] = 1400;
        $x[1] = 1600;
        $x[2] = 1800;
        $x[3] = 2000;
        $x[4] = 2200;
        $x[5] = 2400;
        $x[6] = 2600;
        $x[7] = 2800;
        $x[8] = 3000;
        $x[9] = 3200;
        $x[10] = 3400;
        $x[11] = 3600;
        $x[12] = 3800;
        $x[13] = 4000;
        $x[14] = 4200;
        $x[15] = 4400;
        $x[16] = 4600;
        $x[17] = 4800;
        $x[18] = 5000;
        $x[19] = 5200;
        $x[20] = 5400;
        $x[21] = 5600;
        $x[22] = 5800;

        $y_medido[0] = 12.5;
        $y_medido[1] = 34.375;
        $y_medido[2] = 76.5625;
        $y_medido[3] = 125.;
        $y_medido[4] = 192.1875;
        $y_medido[5] = 287.5;
        $y_medido[6] = 390.625;
        $y_medido[7] = 509.375;
        $y_medido[8] = 635.9375;
        $y_medido[9] = 757.8125;
        $y_medido[10] = 885.9375;
        $y_medido[11] = 976.5625;
        $y_medido[12] = 1040.625;
        $y_medido[13] = 1081.25;
        $y_medido[14] = 1106.25;
        $y_medido[15] = 1070.3125;
        $y_medido[16] = 996.875;
        $y_medido[17] = 909.375;
        $y_medido[18] = 789.0625;
        $y_medido[19] = 609.375;
        $y_medido[20] = 476.5625;
        $y_medido[21] = 343.75;
        $y_medido[22] = 234.375;

        $y_max = 1120.3125;
        $x_0 = 4137.5;


    ?>
    <body>
    
        <table width = "600" border = "1" align = "center">
            <?php
                mostrarTablaDatosMedidos();
            ?>
        </table>
        
        <br>
        <table border = "1">
            <form method="post" action=" ">
                <tr>
                    <th colspan="3"><b>Ingrese los parametros iniciales </b></th>
                </tr>
                <tr>
                    <td align="center">Alpha</td>
                    <td align="center">Delta</td>
                    <td align="center">C</td>
                </tr>
                <tr>
                    <td aling ="center">
                        <input type="text" name = "alpha" value = "<?php if(isset($_POST['alpha'])){echo $_POST['alpha'];}?>" step="0.1"/>
                    </td>
                    <td aling ="center">
                        <input type="text" name = "delta" value = "<?php if(isset($_POST['delta'])){echo $_POST['delta'];}?>" step="0.1"/>
                    </td>
                    <td aling ="center">
                        <input type="text" name = "c" value = "<?php if(isset($_POST['c'])){echo $_POST['c'];}?>" step="0.1"/>
                    </td>
                </tr>
                <tr>
                    <th colspan = "3"> 
                        <input type = "submit" name = "calcular" value = "Calcular" class = "button">
                    </th>
                </tr>
            </form> 
        </table>
        <br>
        <table>        
            <td>
                <table border = "1">
                        <?php imprimirValorMaximo() ?>
                </table>
            </td>
            <td width = "30">
            </td>
            <td>
                <?php
                    if(isset($_POST['calcular'])){
                        imprimirEstimativaInicial($_POST['alpha'], $_POST['delta'], $_POST['c']);
                    }
                ?>
            </td>
        </table>
        <?php
            global $alpha, $delta, $c, $s, $f; #Para evaluar y encontrar el vector Fi = Y(xi) - yi(normalizado)
            global $alpha_lm, $delta_lm, $c_lm, $f_lm, $s_lm; #
            global $alpha_sn, $delta_sn, $c_sn, $f_sn, $s_sn; #
            if(isset($_POST['calcular'])){
                $alpha[0] = $alpha_lm[0] = $alpha_sn[0] = $_POST['alpha'];
                $delta[0] = $delta_lm[0] = $delta_sn[0] = $_POST['delta'];
                $c[0] = $c_lm[0] = $c_sn[0] = $_POST['c'];

                $f[0] = $f_lm[0] = $f_sn[0] = vectorFK($alpha[0], $delta[0], $c[0]);
                $s[0] = $s_lm[0] = $s_sn[0] = calcularSk($f[0]);
                $funcionFinal = calcularFuncionAproximadaLevenberg();
                calcularFuncionAproximadaLM();
            }
        ?>
        <br>
   
        <br>
    		<div class="container">
				<div class="row">
					<div class="col-md-6">
    					<legend><b>Gráfica de los valores obtenidos Tabla 1.</b></legend>
    					<hr>
    					<div id="grafica"></div>
    					<script src="grafica.js" charset="utf-8"></script>
    					
    				</div>
					<div class="col-md-6">
						<legend><b>Grafica de la Función Encontrada</b></legend>
						<div id="Grafo"></div>
						<script id="jsbin-source-css" type="text/css">
							div = {
								float: left;
							}
							#Grafo {
								padding: 20px;
								width: 250px;
								height: 250px;
							}
						</script>
						<script id="jsbin-source-javascript" type="text/javascript">
							var parameters = {
								target: '#Grafo',
								data: [{
									fn: '<?php if(isset($_POST['calcular'])){
										echo $funcionFinal;
									} ?>',
									color: 'blue'
								}],
								grid: true,
								yAxis: {
									domain: [0, 1.25]
								},
								xAxis: {
									domain: [0, 8000]
								}
							};
							functionPlot(parameters);
						</script>
					</div>
				</div>
			</div>
		
        <br>
		<?php
            if(isset($_POST['calcular'])){
                imprimirCuadroComparativo();
                imprimirValoresIteraciones();
                imprimirTablaIteración();
            }
        ?>
    </body>
</html>
<?php
     //Funcion para el calculo del vector Fi = Y(xi) - yi(normalizado)
    function vectorFK($alpha, $delta, $c){
        global $x;
        for($i = 0; $i < sizeof($x); $i++){
            $f[$i] = calcularFiK($alpha, $delta, $c, $x[$i], $i);
        }
        return $f;
    }

    //Formula para el calculo del vector Fi
    function calcularFiK($alpha, $delta, $c, $x,$i){
        return funcionY($alpha, $delta, $c, $x) - calcularYMedNormalizado($i);
    }

    //Funcion para el calculo de Y
    function funcionY($alpha, $delta, $c, $x){
        global $x_0;
        return (1/(1 + $alpha * pow(($x - $x_0), 2)))+($c / (1 + $alpha * pow(($x - $x_0 - $delta), 2)));
    }

    //Funcion para el calculo de Y medio normalizado
        function calcularYMedNormalizado($i){
        global $y_max, $y_medido;
        return $y_medido[$i]/$y_max;
    }
    
    //Funcion para el calculo de Sk
    function calcularSk($f){
        $s = 0;
        for($i = 0; $i < sizeof($f); $i++){
            $s = $s + pow($f[$i], 2);
        }
        return $s;
    }

    #Calculo de la función Levenberg
    function calcularFuncionAproximadaLevenberg(){
        global $x_0, $alpha, $delta, $c, $s, $f ,$k;
        $bandera = false;
        $k = 0;
        $lambda = 1;
        $fn = '(1 / (1 + ($alpha) * pow((x - $x_0), 2)))+($c / (1 + ($alpha )* pow((x - $x_0 - $delta), 2)))';
        while(!$bandera){
            $deltaZ = eliminacionGaussiana(matrizLevenberg($alpha[$k], $delta[$k], $c[$k], $lambda), 
                vectorJxF($alpha[$k], $delta[$k], $c[$k]));    
            $alpha[$k + 1] = $alpha[$k] + $deltaZ[0];
            $delta[$k + 1] = $delta[$k] + $deltaZ[1];
            $c[$k + 1] = $c[$k] + $deltaZ[2];
            $f[$k + 1] = vectorFK($alpha[$k + 1], $delta[$k + 1], $c[$k + 1]);
            $s[$k + 1] = calcularSk($f[$k + 1]);
            if(evaluarFuncional($s, $k)){
                $lambda = $lambda/2;
            }else{
                $lambda = 2 * $lambda;
            }
            $bandera = evaluarTolerancia($alpha, $delta, $c, $k);
            $k++;
        }

        $val = $x_0 - $delta[$k];
        $str1 = str_replace('$alpha', $alpha[$k], $fn);
        $str2 = str_replace('$x_0 - $delta', $val, $str1);
        $str3 = str_replace('$c', $c[$k], $str2);
        $funcionFinal = str_replace('$x_0', $x_0, $str3);

    //Imprime la formula de la Curva de Pulso     
        echo '<br><table width = "500" border = "1" align = "center">';
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="1">'."<b>"."Curva de Pulso"."</b>"."</td>";
        echo '</tr>';
        echo "<tr>";
        echo '<td colspan = "1" align = "center"><br><img src="Formula.png"><br></td>';
        echo "</tr>";
        echo "</table>";
        echo '<br><table width = "1200" border = "1" align = "center">';
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="1">'."<b>"."Funcion Calculada con: $k iteraciones"."</b>"."</td>";
        echo '</tr>';
        echo "<tr>";
        echo '<td align = "center" colspan="1">'."<b>"."y(x)  = $funcionFinal "."</b>"."</td>";
        echo "</tr>";
        echo "</table>";
        
        return $funcionFinal;
    }

    //Funcion para el calculo de la matriz Levenberg
    function matrizLevenberg($alpha, $delta, $c, $lambda){
        $jacobiana = jacobianaK($alpha, $delta, $c);
        $jacobTrans = matrizTranspuesta($jacobiana);
        $mulJacob = multiplicarMatrices($jacobiana, $jacobTrans);
        return sumaMatrices($mulJacob, matrizLambdaIdentidad($lambda, 3));
    }

    //Funcion para el calculo de la eliminacion gaussiana
    function eliminacionGaussiana($a, $b){
        for($k = 0; $k < (sizeof($a) - 1); $k++){
            for($i = $k + 1; $i < sizeof($a); $i++){
                $m[$i][$k] = ($a[$i][$k])/($a[$k][$k]);
                for($j = $k + 1; $j < sizeof($a); $j++){
                    $a[$i][$j] = $a[$i][$j] - (($m[$i][$k])*($a[$k][$j]));
                }
                $b[$i] = $b[$i] - ($m[$i][$k])*($b[$k]);
                $a[$i][$k] = 0;
            }
        }
        for($i = sizeof($a) - 1; $i >= 0; $i--){
            $aux = 0;
            for($j = $i + 1; $j <= sizeof($a) - 1; $j++){
                $aux = $aux + $a[$i][$j] * $x[$j];
            }
            $x[$i] = ($b[$i] - $aux) / ($a[$i][$i]);
        }
		return $x;
    }

    #Funcion para calcular la funcion Aproximada de LevenbergMarquadt
    function calcularFuncionAproximadaLM(){
        global $alpha_lm, $delta_lm, $c_lm, $s_lm, $f_lm ,$k_lm;
        $bandera = false;
        $k_lm = 0;
        $lambda = 1;
        while(!$bandera){
            $deltaZ = eliminacionGaussiana(matrizLevenbergMarquadt($alpha_lm[$k_lm], 
                    $delta_lm[$k_lm], $c_lm[$k_lm], $lambda), vectorJxF($alpha_lm[$k_lm],
                    $delta_lm[$k_lm], $c_lm[$k_lm]));    
            $alpha_lm[$k_lm + 1] = $alpha_lm[$k_lm] + $deltaZ[0];
            $delta_lm[$k_lm + 1] = $delta_lm[$k_lm] + $deltaZ[1];
            $c_lm[$k_lm + 1] = $c_lm[$k_lm] + $deltaZ[2];
            $f_lm[$k_lm + 1] = vectorFK($alpha_lm[$k_lm + 1], $delta_lm[$k_lm + 1], $c_lm[$k_lm + 1]);
            $s_lm[$k_lm + 1] = calcularSk($f_lm[$k_lm + 1]);
            if(evaluarFuncional($s_lm, $k_lm)){
                $lambda = $lambda/2;
            }else{
                $lambda = 2 * $lambda;
            }
            $bandera = evaluarTolerancia($alpha_lm, $delta_lm, $c_lm, $k_lm);
            $k_lm++;
        }
    }

    function calcularFuncionAproximada(){
        global $alpha_sn, $delta_sn, $c_sn, $s_sn, $f_sn ,$k_sn;
        $bandera = false;
        $k_sn = 0;
        
        while(!$bandera){
            $deltaZ = eliminacionGaussiana(matrizAlgoritmo($alpha_sn[$k_sn], 
                    $delta_sn[$k_sn], $c_sn[$k_sn]), vectorJxF($alpha_sn[$k_sn],
                    $delta_sn[$k_sn], $c_sn[$k_sn]));    
            $alpha_sn[$k_sn + 1] = $alpha_sn[$k_sn] + $deltaZ[0];
            $delta_sn[$k_sn + 1] = $delta_sn[$k_sn] + $deltaZ[1];
            $c_sn[$k_sn + 1] = $c_sn[$k_sn] + $deltaZ[2];
            $f_sn[$k_sn + 1] = vectorFK($alpha_sn[$k_sn + 1], $delta_sn[$k_sn + 1], $c_sn[$k_sn + 1]);
            $s_sn[$k_sn + 1] = calcularSk($f_sn[$k_sn + 1]);
            $bandera = evaluarTolerancia($alpha_sn, $delta_sn, $c_sn, $k_sn);
            $k_sn++;
        }
    }



    
//Comparar la tolerancia con cada una de los parametros ingresados por teclado
    function evaluarTolerancia($alpha, $delta, $c, $k){
        $tol = 10e-6;
        if(abs($alpha[$k + 1] - $alpha[$k]) > $tol){
            return false;
        }
        if(abs($delta[$k + 1] - $delta[$k]) > $tol){
            return false;
        }
        if(abs($c[$k + 1] - $c[$k]) > $tol){
            return false;
        }
        return true;
    }

    function evaluarFuncional($s, $k){
        if($s[$k + 1] <= ($s[$k]/2)){
            return true;
        }else{
            return false;
        }
    }

    
//Funcion para el calculo del error (diferencia%)
function calcularError($y, $yn){
    return abs($yn - $y)/$yn;
}


//Funcion para el calculo de la matriz algoritmo
function matrizAlgoritmo($alpha, $delta, $c){
    $jacobiana = jacobianaK($alpha, $delta, $c);
    $jacobTrans = matrizTranspuesta($jacobiana);
    return multiplicarMatrices($jacobiana, $jacobTrans);
}


//Funcion para el calculo de la matriz Levenberg-Marquadt
function matrizLevenbergMarquadt($alpha, $delta, $c, $lambda){
    $jacobiana = jacobianaK($alpha, $delta, $c);
    $jacobTrans = matrizTranspuesta($jacobiana);
    $mulJacob = multiplicarMatrices($jacobiana, $jacobTrans);
    return sumaMatrices($mulJacob, matrizLambdaDiagonal($lambda, $mulJacob));
}

//Funcion para el calculo del vector JxF
function vectorJxF($alpha, $delta, $c){
$jacobiana = jacobianaK($alpha, $delta, $c);
$f = vectorFK($alpha, $delta, $c);
for($i = 0; $i < sizeof($f); $i++){
    $aux[$i][0] = $f[$i];
}
$vector = multiplicarMatrices($jacobiana, $aux);
for($j = 0; $j < sizeof($vector); $j++){
    $ans[$j] = (-1) * $vector[$j][0];
}
return $ans;
}


//Funcion para el calculo de la Jacobiana
function jacobianaK($alpha, $delta, $c){
    global $x;
    for($i = 0; $i < sizeof($x); $i++){
        $jacobiana[0][$i] = derivadaParcial($alpha, $delta, $c, $x[$i], 0);
        $jacobiana[1][$i] = derivadaParcial($alpha, $delta, $c, $x[$i], 1);
        $jacobiana[2][$i] = derivadaParcial($alpha, $delta, $c, $x[$i], 2);
    }
    return $jacobiana;
}

//Funcion para el calculo de la matriz transpuesta
function matrizTranspuesta($matriz){
    for($i = 0; $i < sizeof($matriz); $i++){
        for($j = 0; $j < sizeof($matriz[$i]); $j++){
            $trans[$j][$i] = $matriz[$i][$j];
        }
    }
    return $trans;
}

//Funcion para el calculo de la multiplicacion de matrices
function multiplicarMatrices($m1, $m2){
for($i = 0; $i < sizeof($m1); $i++){
    for($j = 0; $j < sizeof($m2[$i]); $j++){
        $result[$i][$j] = 0;
        for($k = 0; $k < sizeof($m1[$i]); $k++){
            $result[$i][$j] += $m1[$i][$k] * $m2[$k][$j]; 
        }
    }
}
return $result;
}

//Funcion para el calculo de la matriz lambda identidad
function matrizLambdaIdentidad($lambda, $tamaño){
for($i = 0; $i < $tamaño; $i++){
    for($j = 0; $j < $tamaño; $j++){
        if($i == $j){
            $ans[$i][$j] = $lambda;
        }else{
            $ans[$i][$j] = 0;
        }
    }
}
return $ans;
}

//Funcion para el calculo de la suma de matrices
function sumaMatrices($m1, $m2){
for($i = 0; $i < sizeof($m1); $i++){
    for($j = 0; $j < sizeof($m1[$i]); $j++){
        $ans[$i][$j] = $m1[$i][$j] + $m2[$i][$j];
    }
}
return $ans;
}

//Funcion para el calculo de las derivadas parciales
function derivadaParcial($alpha, $delta, $c, $x, $variable){
    $d_variable = 0.1;
    $tol = 10e-7;
    $bandera = true;
    switch ($variable) {
        case 0:
            $result_ant = (funcionY($alpha + $d_variable, $delta, $c, $x) - funcionY($alpha, $delta, $c, $x))/($d_variable);
            $d_variable = $d_variable/2;
            while($bandera){
                $result_act = (funcionY($alpha + $d_variable, $delta, $c, $x) - funcionY($alpha, $delta, $c, $x))/($d_variable);
                $absoluto = abs($result_act - $result_ant);
                if($absoluto < $tol){
                    $bandera = false;
                }else{
                    $d_variable = $d_variable/2;
                    $result_ant = $result_act;
                }
            }
            break;
        case 1:
            $result_ant = (funcionY($alpha, $delta  + $d_variable, $c, $x) - funcionY($alpha, $delta, $c, $x))/($d_variable);
            $d_variable = $d_variable/2;
            while($bandera){
                $result_act = (funcionY($alpha, $delta  + $d_variable, $c, $x) - funcionY($alpha, $delta, $c, $x))/($d_variable);
                $absoluto = abs($result_act - $result_ant);
                if($absoluto < $tol){
                    $bandera = false;
                }else{
                    $d_variable = $d_variable/2;
                    $result_ant = $result_act;
                }
            }
            break;
        case 2:
            $result_ant = (funcionY($alpha, $delta, $c  + $d_variable, $x) - funcionY($alpha, $delta, $c, $x))/($d_variable);
            $d_variable = $d_variable/2;
            while($bandera){
                $result_act = (funcionY($alpha, $delta, $c  + $d_variable, $x) - funcionY($alpha, $delta, $c, $x))/($d_variable);
                $absoluto = abs($result_act - $result_ant);
                if($absoluto < $tol){
                    $bandera = false;
                }else{
                    $d_variable = $d_variable/2;
                    $result_ant = $result_act;
                }
            }
            break;
        default:
            echo "Variable no especificada!!"."<br>";
            break;
    }
    return $result_act;
}


//Funcion para el calculo de la matriz lambda diagonal
function matrizLambdaDiagonal($lambda, $matriz){
    for($i = 0; $i < sizeof($matriz); $i++){
        for($j = 0; $j < sizeof($matriz[$i]); $j++){
            if($i == $j){
                $ans[$i][$j] = $lambda * $matriz[$i][$j];
            }else{
                $ans[$i][$j] = 0;
            }
        }
    }
    return $ans;
}




//Tabla donde se refleja las iteraciones totales 
    function imprimirValoresIteraciones(){
        global $alpha, $delta, $s, $k, $c;
        echo '<table width = "800" border = "1" align = "center">';
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="5">'."<b>"."Valores Obtenidos en las iteraciones con el Método Levenberg"."</b>"."</td>";
        echo '</tr>';
        echo "<tr>";
        echo '<td align = "center">'."<b>"."i"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Alpha"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Delta"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."C"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Diferencia"."</b>"."</td>";
        echo "</tr>";
        for($i = 0; $i <= $k; $i++){
            echo '<tr>';
            echo '<td align = "center">'.$i."</td>";
            echo '<td align = "center">'.$alpha[$i]."</td>";
            echo '<td align = "center">'.$delta[$i]."</td>";
            echo '<td align = "center">'.$c[$i]."</td>";
            echo '<td align = "center">'.$s[$i]."</td>";
            echo '</tr>';
        }
        echo "</table>";
    }
//Tabla donde se evalua las comparaciones entre los metodos de Levenberg & Levenberg-Marquardt
    function imprimirCuadroComparativo(){
        global $alpha, $delta, $s, $k, $c;
        global $alpha_lm, $delta_lm, $s_lm, $k_lm, $c_lm;
        echo '<table width = "550" border = "1" align = "center">';
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="3">'."<b>"."Cuadro comparativo entre los diferentes métodos propuestos"."</b>"."</td>";
        echo '</tr>';
        echo "<tr>";
        echo "<th></th>";
        echo '<td align = "center">'."<b>"."Método Levenberg"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Método Levenberg-Marquardt"."</b>"."</td>";
        echo "</tr>";
        echo "<tr>";
        echo '<td align = "center">'."<b>"."i"."</b>"."</td>";
        echo '<td align = "center">'.$k.'</td>';
        echo '<td align = "center">'.$k_lm.'</td>';
        echo "</tr>";
        echo "<tr>";
        echo '<td align = "center">'."<b>"."Alpha"."</b>"."</td>";
        echo '<td align = "center">'.$alpha[$k].'</td>';
        echo '<td align = "center">'.$alpha_lm[$k_lm].'</td>';
        echo "</tr>";
        echo "<tr>";
        echo '<td align = "center">'."<b>"."Delta"."</b>"."</td>";
        echo '<td align = "center">'.$delta[$k].'</td>';
        echo '<td align = "center">'.$delta_lm[$k_lm].'</td>';
        echo "</tr>";
        echo "<tr>";
        echo '<td align = "center">'."<b>"."C"."</b>"."</td>";
        echo '<td align = "center">'.$c[$k].'</td>';
        echo '<td align = "center">'.$c_lm[$k_lm].'</td>';
        echo "</tr>";
        echo "<tr>";
        echo '<td align = "center">'."<b>"."Diferencia"."</b>"."</td>";
        echo '<td align = "center">'.$s[$k].'</td>';
        echo '<td align = "center">'.$s_lm[$k_lm].'</td>';
        echo "</tr>";
        echo "</table>";
    }
//Tabla de la comparacion resultados experimentales y computacioneles de cada iteracion 
    function imprimirTablaIteración(){
        global $k, $x, $alpha, $delta, $c;
        for($j = 0; $j <= $k; $j++){
            echo '<table width = "800" border = "1" align = "center">';
            echo "<br>";
            echo '<tr>';
            echo '<td align = "center" colspan="5">'."<b>"."Tabla 2: Comparación resultados experimentales y computacionales"."<br>"."(Iteración  $j)"."</b>"."</td>";
            echo '</tr>';
            //echo "<caption><br>Tabla 2: Comparación resultados experimentales y computacionales (k = ".$j.")</caption>";
            echo "<tr>";
            echo '<td align = "center">'."<b>"."i"."</b>"."</td>";
            echo '<td align = "center">'."<b>"."Xi  <br> (Canal)"."</b>"."</td>";
            echo '<td align = "center">'."<b>"."Y̅i  <br> (Conteo Normalizado)"."</b>"."</td>";
            echo '<td align = "center">'."<b>"."Y(Xi) <br> (Curva)"."</b>"."</td>";;
            echo '<td align = "center">'."<b>"."Diferencia  <br> (%)"."</b>"."</td>";
            echo "</tr>";
            for($i = 0; $i < sizeof($x); $i++){
                $y = funcionY($alpha[$j], $delta[$j], $c[$j], $x[$i]);
                $yn = calcularYMedNormalizado($i);
                echo '<tr>';
                echo '<td align = "center">'.$i."</td>";
                echo '<td align = "center">'.$x[$i]."</td>";
                echo '<td align = "center">'.$yn."</td>";
                echo '<td align = "center">'.$y."</td>";
                echo '<td align = "center">'.calcularError($y, $yn)."</td>";
                echo '</tr>';
            }
            echo "</table>";
        }
    }

    //Tabla donde se refleja los datos tabulados de la grafica inicial
    function mostrarTablaDatosMedidos(){
        global $x, $y_medido;
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="4">'."<b>"."Tabla 1: Conteo obtenido a partir de un difractómetro de rayos X"."</b>"."</td>";
        echo '</tr>';
        echo '<tr>';
        echo '<td align = "center">'."<b>"."i"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Xi <br> (Canal)"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Yi <br> (Conteo)"."</b>"."</td>";
        echo '<td align = "center">'."<b>"."Y̅i <br>"."(Conteo normalizado)"."</b>"."</td>";
        echo '</tr>';
        for($i = 0; $i < sizeof($x); $i++){
            echo '<tr>';
            echo '<td align = "center">'.($i + 1)."</td>";
            echo '<td align = "center">'.$x[$i]."</td>";
            echo '<td align = "center">'.$y_medido[$i]."</td>";
            echo '<td align = "center">'.calcularYMedNormalizado($i)."</td>";
            echo '</tr>';
           
        }
    }

    //Funcion para imprimir la Tabla Valores Maximos Observados.
    function imprimirValorMaximo(){
        global $x_0, $y_max;
        echo '<table width = "300" border = "1" align = "center">';
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="2">'."<b>"."Valores Máximos Observados"."</b>"."</td>";
        echo '</tr>';
        echo "<tr>";
        echo '<td colspan = "1" align = "center">'.'X_0 = <b>'.$x_0.'</b></td>';
        echo '<td colspan = "1" align = "center">'.'Y_Max = <b>'.$y_max.'</b></td>';
        echo "</tr>";
        echo "</table>";
    }

    //Imprime la tabla Estimativas ingresadas por el Usuario.
    function imprimirEstimativaInicial($alpha, $delta, $c){
        echo '<table width = "450" border = "1" align = "center">';
        echo "<br>";
        echo '<tr>';
        echo '<td align = "center" colspan="5">'."<b>"."Estimativas Ingresadas por el Usuario"."</b>"."</td>";
        echo '</tr>';
        echo "<tr>";
        echo '<td colspan = "2" align = "center">'.'Alpha = <b>'.$alpha.'</b></td>';
        echo '<td colspan = "2" align = "center">'.'Delta = <b>'.$delta.'</b></td>';
        echo '<td colspan = "2" align = "center">'.'C = <b>'. $c.'</b></td>';
        echo "</tr>";
        echo "</table>";
    }
?>

</body>
	<footer>
		<div class="footright">
		<hr>
		<h3>Developed By:</h3>
			Leonardo Mejía<br>
			Marlon Pachacama<br>
			Kevin Pallo<br>
			Bladimir Pillajo<br><br>
		<hr>
		</div>
		<div class="footleft">
			<img src="epn.png" widht="260px" height="110px"><br>
			<p><b>2020</b></p>
		</div>
	</footer>
</html>
