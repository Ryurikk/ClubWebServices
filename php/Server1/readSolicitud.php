<?php 
    require 'database.php';
    $id_user1 = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']) : false;
    
    $amigo = [];
    $sql = "SELECT us.* FROM amigo am, usuario us where am.id_user1='$id_user1' and am.id_user2=us.id_usr and am.estado='N'";
    
    if($result = mysqli_query($con,$sql))
    {
      $i = 0;
      while($row = mysqli_fetch_assoc($result))
      {
        $amigo[$i]['id']    = $row['id_usr'];
        $amigo[$i]['nombre'] = $row['nombre'];
        $amigo[$i]['apellidos'] = $row['apellidos'];
        $amigo[$i]['correo'] = $row['correo'];
        $amigo[$i]['admin'] = $row['admin'];
        $amigo[$i]['fec_nac'] = $row['fecha'];
        $i++;
      }
    
      echo json_encode($amigo);
    }
    else
    {
      http_response_code(404);
    }
?>