<?php 
//Array id y correos de los usuarios
$usuarios = array( 
	$Javier => array(
		$id => "pJfTgJs7Qxi2BKCJEVuagw",
		$correo => "tecnico@unired.edu.co"), 
	$Bibiana => array(
		$id => "6ZI_WVqJQMqJqmNGLBkPRg",
		$correo => "directora@unired.edu.co"),
	$AntonUFPSO => array(
		$id => "pAXE2-YjT8qf_KON9dRaIQ",
		$correo => "anton@ufpso.edu.co"), 
	$CesarUNAB => array (
		$id => "QsAIghT1SIiVfIwQyyVpuQ",
		$correo => "cguerrer@unab.edu.co"),
	$DavidComunicaciones => array(
		$id => "NxQOunQXTgiKY6TPaymXrw",
		$correo => "comunicaciones@unired.edu.co"),
	$CoreUNAB => array(
		$id => "44dhVDLuRRW4yAIr4ZNYog",
		$correo => "core_unab@unired.edu.co"),
	$DoctoradoIngeneriaUNAB => array(
		$id => "6X-2BhFWT4GmpMod3-XQog",
		$correo => "doctoradoingenieria@unab.edu.co "), 
	$ElkinUIS => array(
		$id => "kXmHO0DRR_KWMvSsdCQj4w",
		$correo => "efroa@uis.edu.co"),
	$ErikaUNAB=> array(
		$id => "gCDMncd8TyycPu3_UymNzA",
		$correo => "egonzalp@unab.edu.co"), 
	$EsphseqUFPSO => array(
		$id => "OuohUYilQs6dLg03s3uUJg ",
		$correo => "esphseq@ufpso.edu.co"), 
	$JhernanUNAB=>array(
		$id => "jly3D_euRX6ePJImNpLQhA",
		$correo => "jhernand@unab.edu.co"),
	$MultimedioUNAB => array(
		$id => "FVBX71ORQzWLAvh0qwUviA",
		$correo => "multimedios@unab.edu.co"),
	$Sala1 => array(
		$id => "zQg-osoaTIu_OfrKPUZ2ow",
		$correo => "sala_1@unired.edu.co"),
	$Sala2 => array(
		$id => "4Dj8DHlHTm-wzp6cckTEQg",
		$correo => "sala_2@unired.edu.co"), 
	$Sala3 => array(
		$id => "GLb5INSJQzS4MapqYLJyUg",
		$correo => "sala_3@unired.edu.co")
	$Sala4 => array(
		$id => "4_d7xTiHRF-PZvyjVwIVOA",
		$correo => "sala_4@unired.edu.co"),
	$Sala5 => array(
		$id => "k2fP4weUTky01SHMnlQYHA",
		$correo => "sala_5@unired.edu.co"),
	$Sala7 => array(
		$id => "KYFI9lBjQju-VCkUt75oTg",
		$correo => "sala_7@unired.edu.co"),
	$UNISANGIL => array(
		$id => "bFLhGGrTQ6CGCbPIC3NDsQ",
		$correo => "uniredonline@unisangil.edu.co"),
	$Webinar => array(
		$id => "Mq_Lq8MyQbmVvCMLSABe_Q",
		$correo => "webinar_1@unired.edu.co"),
	$NataliaUSTABUCA => array(
		$id => "R3NnciPYQbak3BsmNZ18zg",
		$correo => "yudy.florez@ustabuca.edu.co")
);
// se capturan los datos del formulario html
date_default_timezone_set('UTC');
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
$horazoom = $fechaEvento . " " .  $iniciohora . ":" . $iniciominutos; // se compila la hora de inicio con los minutos
$horazoom = strtotime($horazoom); // se combierte la variable String a time 
$horazoom = gmdate("Y M d H:i:s T", $horazoom); //se define el formato de la hora exigido por Zoom
$fechaSolicitacion = strtotime($fechaSolicitacion); // se convierte String en tipo date 
$fechaSolicitacion = gmdate("Y M d H:i:s T", $fechaSolicitacion); //se define el formato de fecha exigido por Zoom
// el siguiente if verifica si la fecha de solicitación no sea despues de la fecha del evento
if($horazoom > $fechaSolicitacion){   
echo "la fecha es valida y se puede agendar";
}else {
echo "la fecha no es valida";
}
// ******************************** envio de datos al csv
$csv_line = array($fechaSolicitacion, $nombreEvento, $Solicitante, $emailSolicitante, $servicio, $fechaEvento, $horazoom, $duracion, $organiza, $nombreResponsable, $cargo, $telefono, $celular, $responsableTecnico, $emailTecnico, $difusion); 
$path = 'reunioneszoom.csv';
$fop = fopen($path, 'a');
fputcsv($fop, $csv_line);
rewind($fop);
fclose($fop);
// ***************************** fin de envio de datos
/* envio de datos a Zoom por cURL */
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
print_r(getUsers());
// el if define segun los datos si el evento es reunion o seminario web
if($servicio=="Sala virtual de reuniones(hasta 100 participantes)"){
$ch = curl_init('https://api.zoom.us/v2/users/Mq_Lq8MyQbmVvCMLSABe_Q/meetings'); //se inicia la transacción, lo comprendido entre users/ y /meetings el el id de usuario
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . generateJWT(), "Content-Type: application/json") ); // se adjunta el token y se dise que tipo de dato se envia
$d = array (
    "topic" => "prueba",
    "type" => "2",
    "start_time" => $horazoom,
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
$ch = curl_init('https://api.zoom.us/v2/users/Mq_Lq8MyQbmVvCMLSABe_Q/webinars');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . generateJWT(), "Content-Type: application/json") );
$d = array (
    "topic" => "prueba",
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
?>
