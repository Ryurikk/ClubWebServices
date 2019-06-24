<?php 
    require 'database.php';

    // Extract, validate and sanitize the id.
    $id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']) : false;

    $evento = null;
    $sql = "SELECT * FROM evento WHERE id_evento = '$id'";
    
    if($result = mysqli_query($con,$sql))
    {
        $row = mysqli_fetch_assoc($result);
        $evento['id']      = (int)$row['id_evento'];
        $evento['nombre']      = $row['nombre'];
        $evento['fecha']       = $row['fecha'];
        $evento['time']      = $row['time'];
        $evento['descripcion']   = $row['descripcion'];        
        echo json_encode($evento);
    }
    else
    {
        http_response_code(404);
    }
?>