<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->nombre) === '' || trim($request->fecha) === '' || trim($request->time) === ''  || trim($request->descripcion) === '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $nombre = mysqli_real_escape_string($con, trim($request->nombre) );
  $fecha = mysqli_real_escape_string($con, trim($request->fecha));
  $time = mysqli_real_escape_string($con, trim($request->time));
  $descripcion = mysqli_real_escape_string($con, trim($request->descripcion));

  // Create.
  $sql = "INSERT INTO `evento`(`nombre`,`fecha`,`time`,`descripcion`) VALUES ('{$nombre}','{$fecha}', '{$time}' , '{$descripcion}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $evento = [
      'nombre' => $nombre,
      'fecha' => $fecha,
      'time' => $time,
      'descripcion' => $descripcion,
      'id' => mysqli_insert_id($con)
    ];
    echo json_encode($evento);
  }
  else
  {
    http_response_code(422);
  }
}

?>