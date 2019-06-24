<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->nombres) === '' || trim($request->apellidos) === '' || trim($request->fec_nac) === '' || trim($request->admin) === '' || trim($request->correo) === '' || trim($request->contrasena) === '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $nombre = mysqli_real_escape_string($con, trim($request->nombres) );
  $apellidos = mysqli_real_escape_string($con, trim($request->apellidos));
  $fecha = mysqli_real_escape_string($con, trim($request->fec_nac));
  $correo = mysqli_real_escape_string($con, trim($request->correo));
  $admin = mysqli_real_escape_string($con, trim($request->admin));
  $contrasena = mysqli_real_escape_string($con, trim($request->contrasena));

  // Create.
  $sql = "INSERT INTO `usuario`(`nombre`,`apellidos`,`fecha`,`admin`, `correo`, `contrasena`) VALUES ('{$nombre}','{$apellidos}','{$fecha}', '{$admin}', '{$correo}', '{$contrasena}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $usuario = [
      'nombres' => $nombre,
      'apellidos' => $apellidos,
      'fec_nac' => $fecha,
      'correo' => $correo,
      'contrasena' => $contrasena,
      'admin' => $admin,
      'id' => (int)mysqli_insert_id($con)
    ];
    echo json_encode($usuario);
  }
  else
  {
    http_response_code(422);
  }
}

?>