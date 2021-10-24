<?php
    header("Acces-Control-Allow-origin: *");
    header("Content-Type: application/json");

    include_once './bd.php';
    $con = new bd();

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){

        $sql = "SELECT 
                    cc.`id_cliente` AS id_cliente,
                    CONCAT_WS(
                    ' ',
                    cc.`primer_nombre`,
                    cc.`segundo_nombre`,
                    cc.`apellido_paterno`,
                    cc.`apellido_materno`
                    ) AS nombre_completo 
                FROM
                    ctl_clientes AS cc 
                WHERE 1 = 1 
                    AND cc.`estatus` = 1 
                    ORDER BY cc.`primer_nombre`";
        
        $rs = $con->findAll($sql);

        $con->desconectar();
        echo json_encode($rs);
    }
?>