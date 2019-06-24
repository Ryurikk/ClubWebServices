<?php 
    require 'database.php';

    $usuarios = [];
    $sql = "SELECT id_usr, nombre, apellidos, contrasena, correo, fecha FROM usuario";
    
    if($result = mysqli_query($con,$sql))
    {
      $i = 0;
      while($row = mysqli_fetch_assoc($result))
      {
        $usuarios[$i]['id']    = $row['id_usr'];
        $usuarios[$i]['nombre'] = $row['nombre'];
        $usuarios[$i]['apellidos'] = $row['apellidos'];
        $usuarios[$i]['contrasena'] = $row['contrasena'];
        $usuarios[$i]['correo'] = $row['correo'];
        $usuarios[$i]['fec_nac'] = $row['fecha'];
        $i++;
      }
    
      echo json_encode($usuarios);
    }
    else
    {
      http_response_code(404);
    }
?>