
<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Sanitize.
  $id_user1    = mysqli_real_escape_string($con, (int)$request->id_usr1);
  $id_user2 = mysqli_real_escape_string($con, (int)trim($request->id_usr2));

  // Update.
  $sql = "UPDATE `amigo` SET `estado`='S' WHERE (`id_user1` ='{$id_user1}' and `id_user2` ='{$id_user2}') or (`id_user1` ='{$id_user2}' and `id_user2` ='{$id_user1}') LIMIT 1";

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