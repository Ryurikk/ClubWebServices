<?php 
    require 'database.php';


  if($_GET['correo'] !== null){
    $correo = mysqli_real_escape_string($con, trim($_GET['correo']));
  } else{
    return http_response_code(400);
  }
  
  if($_GET['contrasena'] !== null){
    $contrasena = mysqli_real_escape_string($con, trim($_GET['contrasena']));
  } else{
    return http_response_code(400);
  }

  $sql = "SELECT * FROM usuario WHERE `correo`='$correo'AND `contrasena`='$contrasena' LIMIT 1";
  if($result = mysqli_query($con,$sql))
  {
    $row = mysqli_fetch_assoc($result);
    http_response_code(200);
    $user = [
      'id' => $row['id_usr'],
      'nombres' => $row['nombre'],
      'apellidos' => $row['apellidos'],
      'fec_nac' => "",
      'admin' => $row['admin'],
      'correo' => "",
      'contrasena' => ""
    ];
    echo json_encode($user);
  }
  else
  {
    http_response_code(404);
  }
?>