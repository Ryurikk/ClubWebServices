<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->id_usr) === '' || trim($request->id_ev) === '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $id_user = mysqli_real_escape_string($con, trim($request->id_usr) );
  $id_ev = mysqli_real_escape_string($con, trim($request->id_ev));

  // Create.
  $sql = "INSERT INTO `asistencia_ev`(`id_user`,`id_ev`) VALUES ('{$id_user}','{$id_ev}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    
    $asistencia_ev = [
      'id_usr' => $id_user,
      'id_ev' => $id_ev,
    ];
    echo json_encode($asistencia_ev);
  }
  else
  {
    http_response_code(422);
  }
}

?>