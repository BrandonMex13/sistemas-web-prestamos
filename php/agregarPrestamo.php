<?php
    header("Acces-Control-Allow-origin: *");
    header("Content-Type: application/json");

    include_once './bd.php';
    $con = new bd();

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == "GET"){

        $id_cliente = $_GET['id_cliente'];
        $id_monto = $_GET['id_monto'];
        $id_plazo = $_GET['id_plazo'];

        $sql = "INSERT INTO registro_prestamos (
                    `id_cliente`,
                    `id_monto`,
                    `id_plazos`
                ) 
                VALUES
                    (".$id_cliente.", ".$id_monto.", ".$id_plazo.")
                ";
        
        $rs = $con->exec($sql);

        $con->desconectar();
        echo json_encode($rs);
    }
?>