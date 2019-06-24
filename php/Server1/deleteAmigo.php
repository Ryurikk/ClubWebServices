<?php

    require 'database.php';

    // Extract, validate and sanitize the id.
    $id_user1 = ($_GET['id_usr1'] !== null && (int)$_GET['id_usr1'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id_usr1']) : false;
    $id_user2 = ($_GET['id_usr2'] !== null && (int)$_GET['id_usr2'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id_usr2']) : false;

    // Delete.
    $sql = "DELETE FROM `amigo` WHERE (`id_user1` ='{$id_user1}' and `id_user2` ='{$id_user2}') or (`id_user1` ='{$id_user2}' and `id_user2` ='{$id_user1}') LIMIT 1";

    if(mysqli_query($con, $sql))
    {
        http_response_code(204);
    }
    else
    {
        return http_response_code(422);
    }
?>