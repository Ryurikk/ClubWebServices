<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  if ((int)$request->id < 1 || trim($request->nombres) == '' || trim($request->apellidos) == '' || trim($request->fec_nac) == '' || trim($request->correo) == '' || trim($request->contrasena) == '') {
    return http_response_code(400);
  }

  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->id);
  $nombre = mysqli_real_escape_string($con, trim($request->nombres));
  $apellido = mysqli_real_escape_string($con, trim($request->apellidos));
  $fecha = mysqli_real_escape_string($con, trim($request->fec_nac));
  $correo = mysqli_real_escape_string($con, trim($request->correo));
  $contrasena = mysqli_real_escape_string($con, trim($request->contrasena));


  // Update.
  $sql = "UPDATE `usuario` SET `nombre`='$nombre',`apellidos`='$apellido',`fecha`='$fecha',`correo`='$correo',`contrasena`='$contrasena' WHERE `id_usr` = '{$id}' LIMIT 1";

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