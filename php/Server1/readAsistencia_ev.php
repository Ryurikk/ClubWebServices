<?php 
    require 'database.php';

    $id = ($_GET['id_user'] !== null && (int)$_GET['id_user'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id_user']) : false;
    $asistencia_ev = [];
    $sql = "SELECT ev.id_evento, ev.nombre, ev.fecha, ev.time FROM asistencia_ev aev, evento ev WHERE aev.id_user='$id' and aev.id_ev=ev.id_evento";
    
    if($result = mysqli_query($con,$sql))
    {
      $i = 0;
      while($row = mysqli_fetch_assoc($result))
      {
        $asistencia_ev[$i]['nombre']    = $row['nombre'];
        $asistencia_ev[$i]['fecha'] = $row['fecha'];
        $asistencia_ev[$i]['time'] = $row['time'];
        $asistencia_ev[$i]['id'] = $row['id_evento'];
        $i++;
      }
    
      echo json_encode($asistencia_ev);
    }
    else
    {
      http_response_code(404);
    }
?>