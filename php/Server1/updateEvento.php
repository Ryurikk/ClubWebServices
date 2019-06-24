<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  if ((int)$request->id < 1 || trim($request->nombre) == '' || trim($request->time) == '' || trim($request->fecha) == '' || trim($request->descripcion) == '') {
    return http_response_code(400);
  }

  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->id);
  $nombre = mysqli_real_escape_string($con, trim($request->nombre));
  $time = mysqli_real_escape_string($con, trim($request->time));
  $fecha = mysqli_real_escape_string($con, trim($request->fecha));
  $descripcion =  mysqli_real_escape_string($con, trim($request->descripcion));

  // Update.
  $sql = "UPDATE `evento` SET `nombre`='$nombre',`fecha`='$fecha',`time`='$time' ,`descripcion`='$descripcion' WHERE `id_evento` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}

?>