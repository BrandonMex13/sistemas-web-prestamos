<?php
    header("Acces-Control-Allow-origin: *");
    header("Content-Type: application/json");

    include_once './bd.php';
    $con = new bd();

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){

        $nombre_cliente = $_GET['txtCliente'];

        $sql = "SELECT 
                    rp.`id_prestamo`,
                    CONCAT_WS(
                    ' ',
                    cc.`primer_nombre`,
                    cc.`segundo_nombre`,
                    cc.`apellido_paterno`,
                    cc.`apellido_materno`
                    ) AS nombre_completo,
                    cm.`monto`,
                    cp.`plazos`
                FROM
                    registro_prestamos AS rp 
                    INNER JOIN ctl_clientes AS cc 
                    ON cc.`id_cliente` = rp.`id_cliente` 
                    INNER JOIN ctl_montos AS cm 
                    ON cm.`id_monto` = rp.`id_monto` 
                    INNER JOIN ctl_plazos AS cp 
                    ON cp.`id_plazos` = rp.`id_plazos` 
                WHERE 1 = 1 
                    AND rp.`estatus` = 1 
                    ";

        if($nombre_cliente != ''){
            $sql = $sql.'  AND  CONCAT_WS(
                " ",
                cc.`primer_nombre`,
                cc.`segundo_nombre`,
                cc.`apellido_paterno`,
                cc.`apellido_materno`
              ) LIKE "%'.$nombre_cliente.'%"';
        }

        $sql = $sql.' ORDER BY rp.`fecha_registro`'; 
        
        $rs = $con->findAll($sql);

        $con->desconectar();
        echo json_encode($rs);
    }
?>