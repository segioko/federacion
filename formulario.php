
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
	integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	crossorigin="anonymous">


</head>
<body>
	<header>
		<div class="container-fluid">
			<div class="pull-left col-lg-1">
				<img
					src="https://drive.google.com/uc?export=view&id=1thTe--q9yn7KAee7WNx_rNA1mUQDYDR-"
					class="pill-left" style="height: 100px; width: 100px;" />
			</div>
		</div>
	</header>
<!-- este es todo el codigo php para recoger datos, archivarlos en csv y agendar en Zoom -->
<div style="display: none"> 
<?php
// se capturan los datos del formulario html
date_default_timezone_set('America/bogota');
setlocale(LC_ALL,'es_ES');
$fechaSolicitacion = date('Y-m-d H:i:s');
$nombreEvento = $_POST["nombreEvento"];
$Solicitante = $_POST["Solicitante"];
$emailSolicitante = $_POST["emailSolicitante"];
$servicio = $_POST["servicio"];
$fechaEvento =$_POST["fechaEvento"];
$horaFin = $_POST["horaFin"];
$horaInicio = $_POST["horaInicio"];
$organiza = $_POST["organiza"];
$nombreResponsable = $_POST["nombreResponsable"];
$cargo = $_POST["cargo"];
$telefono = $_POST["telefono"];
$celular = $_POST["celular"];
$responsableTecnico = $_POST["responsableTecnico"];
$emailTecnico = $_POST["emailTecnico"];
$difusion = $_POST["difusion"];
// se configuran los parametros de hora y tiempo de duración de reunion o seminario web
$iniciohora = (int) substr($horaInicio, 0, 2);
$finhora = (int) substr($horaFin, 0, 2);
$iniciominutos = (int) substr($horaInicio, 3, 4);
$finminutos = (int) substr($horaFin, 3, 4);
$minutos = $finminutos - $iniciominutos;
if ($minutos < 0){
$minutos = $minutos*(-1); // encaso de que la diferencia de minutos fueran negativos que pueden pasar, se convierte en negativos, la diferencia de horas nunca seran negativa
}
$duracion = ($finhora - $iniciohora)*60 + $minutos;
$iniciohora = $iniciohora + 5; // segun GTM nosotros tenemos 5 horas de retraso, zoom exigue hora GTM por lo cual con esta operación se estandariza a la hora internacional.
if($iniciominutos=="0"){$iniciominutos="00";}
$horazoom = $fechaEvento . "T" .  $iniciohora . ":" . $iniciominutos . ":00Z"; // se compila la hora de inicio con los minutos 
$horaZOOM = $fechaEvento . "T" .  $iniciohora . ":" . $iniciominutos . ":00Z"; 
$horazoom = strtotime($horazoom); // se combierte la variable String a time
$horazoom = gmdate("Y-m-d H:i:s", $horazoom); //se define el formato de la hora exigido por Zoom
$fechaSolicitacion = strtotime($fechaSolicitacion); // se convierte String en tipo date 
$fechaSolicitacion = gmdate("Y m d T H:i:s Z", $fechaSolicitacion); //se define el formato de fecha exigido por Zoom
// el siguiente if verifica si la fecha de solicitación no sea despues de la fecha del evento
if($horazoom > $fechaSolicitacion){  
echo "la fecha es valida y se puede agendar";
}else {
echo "la fecha no es valida";
}
echo '<br \>';
// ******************************** envio de datos al csv
$csv_line = array($fechaSolicitacion, $nombreEvento, $Solicitante, $emailSolicitante, $servicio, $fechaEvento, $horazoom, $duracion, $organiza, $nombreResponsable, $cargo, $telefono, $celular, $responsableTecnico, $emailTecnico, $difusion); 
$path = 'reunioneszoom.csv';
$fop = fopen($path, 'a');
fputcsv($fop, $csv_line);
rewind($fop);
fclose($fop);
// ***************************** fin de envio de datos
/* envio de datos a Zoom por cURL */
$usuarios = array( 
		'pJfTgJs7Qxi2BKCJEVuagw' => 'tecnico@unired.edu.co',
		'6ZI_WVqJQMqJqmNGLBkPRg' => 'directora@unired.edu.co',
		'pAXE2-YjT8qf_KON9dRaIQ' => 'anton@ufpso.edu.co', 
		'QsAIghT1SIiVfIwQyyVpuQ' => 'cguerrer@unab.edu.co',
		'NxQOunQXTgiKY6TPaymXrw' => 'comunicaciones@unired.edu.co',
	        '44dhVDLuRRW4yAIr4ZNYog' => 'core_unab@unired.edu.co',
	        '6X-2BhFWT4GmpMod3-XQog' => 'doctoradoingenieria@unab.edu.co', 
	        'kXmHO0DRR_KWMvSsdCQj4w' => 'efroa@uis.edu.co',
	        'gCDMncd8TyycPu3_UymNzA' => 'egonzalp@unab.edu.co', 
	        'OuohUYilQs6dLg03s3uUJg' => 'esphseq@ufpso.edu.co', 
	        'jly3D_euRX6ePJImNpLQhA' => 'jhernand@unab.edu.co',
	        'FVBX71ORQzWLAvh0qwUviA' => 'multimedios@unab.edu.co',
	        'zQg-osoaTIu_OfrKPUZ2ow' => 'sala_1@unired.edu.co',
	        '4Dj8DHlHTm-wzp6cckTEQg' => 'sala_2@unired.edu.co', 
	        'GLb5INSJQzS4MapqYLJyUg' => 'sala_3@unired.edu.co',
	        '4_d7xTiHRF-PZvyjVwIVOA' => 'sala_4@unired.edu.co',
	        'k2fP4weUTky01SHMnlQYHA' => 'sala_5@unired.edu.co',
	        'KYFI9lBjQju-VCkUt75oTg' => 'sala_7@unired.edu.co',
	        'bFLhGGrTQ6CGCbPIC3NDsQ' => 'uniredonline@unisangil.edu.co',
	        'Mq_Lq8MyQbmVvCMLSABe_Q' => 'webinar_1@unired.edu.co',
	        'R3NnciPYQbak3BsmNZ18zg' => 'yudy.florez@ustabuca.edu.co');
$id= '';
foreach($usuarios as $supuesto=>$evaluado){
		 if($evaluado==$emailSolicitante){
            	 $id=$supuesto; 
					         }
				         }
if($id==''){
$id='zQg-osoaTIu_OfrKPUZ2ow';
}
$ch = curl_init(); //creacion de nuevo recurso cURL
curl_setopt($ch, CURLOPT_URL, "https://api.zoom.us/v2/");//establece conexiòn
curl_setopt($ch, CURLOPT_HEADER, 0);
//using composer para uso de JWT 
require __DIR__ . '/php-jwt-master/vendor/autoload.php';
// JWT PHP Libreria https://github.com/firebase/php-jwt
use \Firebase\JWT\JWT;
//funcion generadora de JWT
function generateJWT () {
    //credenciales exclusivas para el usuario maestro de zoom, son unicas para cada usuario, para obtener estos datos, es necesario ser usuario pro o superior.
    $key = '36kJDb_ORpubBdYOA6A6TQ'; 
    $secret = 'WxURRwqc2XFTnqv0ufKUgEAE4oQO4WGRL8ob';
    $token = array(
        "iss" => $key,
        // se define el tiempo de vida del token
        "exp" => time() + 60
    );
    return JWT::encode($token, $secret);
}
    //esta funcion se usa para obtener los usuarios adjuntos de la clave principal
function getUsers () {
    $ch = curl_init('https://api.zoom.us/v2/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . generateJWT()
    ));
    $response = curl_exec($ch);
    $response = json_decode($response);
    return $response;
}
//print_r(getUsers());
// el if define segun los datos si el evento es reunion o seminario web
if($servicio=="sala virtual de reuniones (hasta 100 participantes)"){
$ch = curl_init('https://api.zoom.us/v2/users/' . $id . '/meetings'); //se inicia la transacción, lo comprendido entre users/ y /meetings el el id de usuario
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . generateJWT(), "Content-Type: application/json") ); // se adjunta el token y se dise que tipo de dato se envia
$d = array (
    "topic" => $nombreEvento,
    "type" => "2",
    "start_time" => $horaZOOM,
    "timezone" => "America/Bogota",
    "duration" => "" . $duracion,
    "settings" => array("auto_recording" => "local")
      ); //defino el vector de datos a enviar
curl_setopt($ch, CURLOPT_POST, 1);// estas lineas limpian el campo para el envio de datos
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
curl_setopt($ch, CURLOPT_RETURNTRANFIELDS, true); //esta linea dice que quiero reibir datos en retorno
$d = json_encode($d);// codifica el vector en formato JSON
curl_setopt($ch, CURLOPT_POSTFIELDS, $d);
curl_exec($ch);// captura la url y la envia al navegador
curl_close($ch);//cierra el recurso cURL
} else{ 
if($id=='zQg-osoaTIu_OfrKPUZ2ow'){
$id='bFLhGGrTQ6CGCbPIC3NDsQ';
				 }
$ch = curl_init('https://api.zoom.us/v2/users/' . $id . '/webinars');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . generateJWT(), "Content-Type: application/json") );
$d = array (
    "topic" => $nombreEvento,
    "type" => "5",
    "start_time" => $horazoom,
    "timezone" => "America/Bogota",
    "duration" => "" . $duracion,
    "settings" => array("auto_recording" => "local")
      );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
curl_setopt($ch, CURLOPT_RETURNTRANFIELDS, true);
$d = json_encode($d);
curl_setopt($ch, CURLOPT_POSTFIELDS, $d);
curl_exec($ch);
curl_close($ch);
}
$k;
$v=1;
if($servicio=="sala virtual de reuniones (hasta 100 participantes)"){
  $ch = curl_init('https://api.zoom.us/v2/users/' . $id . '/meetings');
}else{
$ch = curl_init('https://api.zoom.us/v2/users/' . $id . '/webinars');
     }
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . generateJWT()) );
$j=curl_exec($ch);
curl_close($ch);
$j=json_decode($j, true);
foreach($j as $supuesto){
	 		foreach($supuesto as $reunion){
				foreach($reunion as $key=>$value){
     if("topic"==$key){
		if($value==$nombreEvento){
                                   $v=0;
 					 }
                      }
     if("join_url"==$key){
                if($v==0){
                    $v=$value;
 					 } 
                         }
				                                 }
					                           }
			         }
echo "value " . $v . "   key   " . $k;	 


?>
</div>


<main role="main" class="container">
      <div class="jumbotron">
        <h1>Programación de <?php echo $servicio?></h1>
        <p class="lead"><?php echo $Solicitante;?> está apunto de completar la programación de <?php echo $nombreEvento;?>, organizado por la <?php echo $organiza;?>, el dia <?php echo date("d F Y", strtotime($fechaEvento));?>, a las <?php echo date("g:i  a", strtotime($horaInicio));?> y termina a las <?php echo date("g:i  a", strtotime($horaFin));?></p>
<p class=lead">Se enviará la información detallada de la reserva al correo<?php echo $emailSolicitante;?> y se programara automáticamente en su calendar.<?php echo $difusio;?></p>

<p class="lead">si el correo registrado no es de gmail por favor copie el siguiente enlace de la sala Zoom para su reunión <?php  echo $v ?></p>
        <a class="btn btn-lg btn-primary" action="agendaCaledar.php" role="button" onclick="Zoom()">Caledar</a>
      </div>
    </main>

<?php 
mail($emailSolicitante, $nombreEvento, $v);
?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>
	<script
		src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
		integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
		crossorigin="anonymous"></script>

</body>
</html>
