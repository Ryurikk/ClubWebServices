<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);



  // Sanitize.
  $id_user1 = mysqli_real_escape_string($con, trim($request->id_usr1) );
  $id_user2 = mysqli_real_escape_string($con, trim($request->id_usr2));

  // Create.
  $sql = "INSERT INTO `amigo`(`id_user1`,`id_user2`,`fecha`, `estado`) VALUES ('{$id_user1}','{$id_user2}', CURDATE(), 'N')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $amigo = [
      'id_user1' => $id_user1,
      'id_user2' => $id_user2,
  
    ];
    echo json_encode($amigo);
  }
  else
  {
    http_response_code(422);
  }
}

?>