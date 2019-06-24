<?php 
    require 'database.php';


  if($_GET['id'] !== null){
    $id = mysqli_real_escape_string($con, trim($_GET['id']));
  } else{
    return http_response_code(400);
  }
  

  $sql = "SELECT * FROM usuario WHERE id_usr='$id' LIMIT 1";
  if($result = mysqli_query($con,$sql))
  {
    $row = mysqli_fetch_assoc($result);
    http_response_code(200);
    $user = [
      'id' => $row['id_usr'],
      'nombres' => $row['nombre'],
      'apellidos' => $row['apellidos'],
      'fec_nac' => $row['fecha'],
      'admin' => $row['admin'],
      'correo' => $row['correo'],
      'contrasena' => $row['contrasena']
    ];
    echo json_encode($user);
  }
  else
  {
    http_response_code(404);
  }
?>