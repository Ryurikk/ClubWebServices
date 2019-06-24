<?php

    require 'database.php';

    // Extract, validate and sanitize the id.
    $id_user = ($_GET['id_user'] !== null && (int)$_GET['id_user'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id_user']) : false;
    $id_ev = ($_GET['id_ev'] !== null && (int)$_GET['id_ev'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id_ev']) : false;

    if(!$id_user && !$id_ev)
    {
        return http_response_code(400);
    }

    // Delete.
    $sql = "DELETE FROM `asistencia_ev` WHERE `id_user` ='{$id_user}' AND `id_ev` ='{$id_ev}' LIMIT 1";

    if(mysqli_query($con, $sql))
    {
        http_response_code(204);
    }
    else
    {
        return http_response_code(422);
    }
?>