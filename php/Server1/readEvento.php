<?php 
    require 'database.php';

    $usuarios = [];
    $sql = "SELECT id_evento, nombre, fecha, descripcion, time FROM evento";
    
    if($result = mysqli_query($con,$sql))
    {
      $i = 0;
      while($row = mysqli_fetch_assoc($result))
      {
        $usuarios[$i]['id']    = $row['id_evento'];
        $usuarios[$i]['time'] = $row['time'];
        $usuarios[$i]['fecha'] = $row['fecha'];
        $usuarios[$i]['nombre'] = $row['nombre'];
        $usuarios[$i]['descripcion'] = $row['descripcion'];
        $i++;
      }
    
      echo json_encode($usuarios);
    }
    else
    {
      http_response_code(404);
    }
?>