<?php
    header("Acces-Control-Allow-origin: *");
    header("Content-Type: application/json");

    include_once './bd.php';
    $con = new bd();

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){

        $sql = "SELECT 
                    cm.`id_monto` AS id_monto,
                    cm.`monto` AS monto 
                FROM
                    ctl_montos AS cm 
                WHERE 1 = 1 
                    AND cm.`estatus` = 1";
        
        $rs = $con->findAll($sql);

        $con->desconectar();
        echo json_encode($rs);
    }
?>