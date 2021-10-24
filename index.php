<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas de prestamos</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="css/estilos.css" rel="stylesheet"></link>
</head>
<body>
    <!-- <img src="img/icono-acciones.png" alt="error en imagen"> -->

    <div class="container" align="center">
        <div class="col" align="center">

            <div class="row no-gutters">
                <div class="col-12 col-sm-6 col-md-8">
                    <label for="">Cliente: </label>
                    <input type="text" id="txtCliente">
                    <button type="button" class="btn btn-success" onClick="obtenerPrestamos()">
                        Buscar
                    </button>
                </div>

                <div class="col-6 col-md-4">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalPrestamos">
                        Agregar prestamo
                    </button>
                </div>
            </div>

            <br>
            
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Monto del prestamo</th>
                            <th>Plazos</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody id="tbPrestamos">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Prestamos-->
    <div class="modal fade" id="modalPrestamos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar prestamo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCerrarModalPrestamos">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <label for="">Cliente:</label>
                <select name="" id="selCliente" class="form-select" aria-label="Default select example">
                    <option value="0">Seleccione un cliente</option>
                </select>

                <br>

                <label for="">Monto:</label>
                <select name="" id="selMonto" class="form-select" aria-label="Default select example">
                    <option value="0">Seleccione un Monto</option>
                </select>

                <br>

                <label for="">Plazo:</label>
                <select name="" id="selPlazo" class="form-select" aria-label="Default select example">
                    <option value="0">Seleccione un plazo</option>
                </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onClick="agregarPrestamo()">Agregar</button>
            </div>
        </div>
        </div>
    </div>

        <!-- Modal amortizaciones-->
    <div class="modal fade" id="modalAmortizaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tabla de amortizaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnCerrarModalPrestamos">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <strong>
                        <label for="" id="lblCliente">Cliente: </label>
                        <br>
                        <label for="" id="lblPago">No.Pago:</label>
                    </strong>
            

                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>No. pago</th>
                                <th>Fecha</th>
                                <th>Prestamo</th>
                                <th>Interes</th>
                                <th>Abono</th>
                            </tr>
                        </thead>

                        <tbody id="tbAmortizacion">
                            <!-- <tr>
                                <td>123</td>
                            </tr> -->
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button> -->
                    <!-- <button type="button" class="btn btn-success" onClick="agregarPrestamo()">Agregar</button> -->
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="js/funciones.js"></script>
    
    <script>
        funcionesExtras();
    </script>
    
</body>
</html>