<?php
    header("Acces-Control-Allow-origin: *");
    header("Content-Type: application/json");

    include_once './bd.php';
    $con = new bd();

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){

        $sql = "SELECT 
                    cp.`id_plazos` AS id_plazo,
                    cp.`plazos` AS plazo 
                FROM
                    ctl_plazos AS cp 
                WHERE 1 = 1 
                    AND cp.`estatus` = 1 ";
        
        $rs = $con->findAll($sql);

        $con->desconectar();
        echo json_encode($rs);
    }
?>