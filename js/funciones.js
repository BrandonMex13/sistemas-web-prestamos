var interes = 0.11; // 11%

function obtenerClientes(){
    // console.log("Inicio");
    $.ajax({
        async: true,
        type: "GET",
        url: "php/obtenerClientes.php",
        dataType: "json",
        success: function(data){
            
            if(data.length == 0){
                document.getElementById('selCliente').innerHTML = '<option value='+ 0 +'>' + 'Seleccione un cliente' + '</option>';
                return;
            }
            document.getElementById('selCliente').innerHTML = '';
            document.getElementById('selCliente').innerHTML = '<option value='+ 0 +'>' + 'Seleccione un cliente' + '</option>';

            for(a = 0; a < data.length; a++){
                document.getElementById('selCliente').innerHTML += '<option value='+ data[a]['id_cliente'] +'>' + data[a]['nombre_completo'] + '</option>';
            }
            
        },
        error: function(){
            console.log("algo fallo");
        }
    });
}

function obtenerMontos(){
    $.ajax({
        async: true,
        type: "GET",
        url: "php/obtenerMontos.php",
        dataType: "json",
        success: function(data){
            
            if(data.length == 0){
                document.getElementById('selMonto').innerHTML = '<option value='+ 0 +'>' + 'Seleccione un monto' + '</option>';
                return;
            }
            document.getElementById('selMonto').innerHTML = '';
            document.getElementById('selMonto').innerHTML = '<option value='+ 0 +'>' + 'Seleccione un monto' + '</option>';

            for(a = 0; a < data.length; a++){
                document.getElementById('selMonto').innerHTML += '<option value='+ data[a]['id_monto'] +'>' + '$'+data[a]['monto'] + '</option>';
            }
            
        },
        error: function(){
            console.log("algo fallo");
        }
    });
}

function obtenerPlazos(){
    $.ajax({
        async: true,
        type: "GET",
        url: "php/obtenerPlazos.php",
        dataType: "json",
        success: function(data){

            if(data.length == 0){
                document.getElementById('selPlazo').innerHTML = '<option value='+ 0 +'>' + 'Seleccione un plazo' + '</option>';
                return;
            }
            document.getElementById('selPlazo').innerHTML = '';
            document.getElementById('selPlazo').innerHTML = '<option value='+ 0 +'>' + 'Seleccione un plazo' + '</option>';

            for(a = 0; a < data.length; a++){
                document.getElementById('selPlazo').innerHTML += '<option value='+ data[a]['id_plazo'] +'>' + data[a]['plazo'] + ' quincenas' + '</option>';
            }
            
        },
        error: function(){
            console.log("algo fallo");
        }
    });
}

function obtenerPrestamos(){

    var datos = {
        'txtCliente' : document.getElementById('txtCliente').value
    };

    $.ajax({
        async: true,
        type: "GET",
        url: "php/obtenerPrestamos.php",
        data: datos,
        dataType: "json",
        success: function(data){

            if(data.length == 0){
                return;
            }

            var valor = '<tr>';
            // console.log('data :>> ', data);

            for(a = 0; a < data.length; a++){
                valor += '<tr>'+
                '<td>' + data[a]['nombre_completo'] + '</td>' + 
                '<td>' + '$'+data[a]['monto'] + '</td>' + 
                '<td>' + data[a]['plazos'] + '</td>' +
                '<td>'+
                '<a href="#">'+
                '<img id="imgAcciones" src="img/icono-acciones.png" alt="error en imagen" data-toggle="modal" data-target="#modalAmortizaciones" onClick="obtenerAmortizacion('+data[a]["id_prestamo"]+')">' + 
                '' + 
                '</a></td>' + 
                '</tr>';
            }
            $("#tbPrestamos").html(valor);
            
        },
        error: function(){
            console.log("algo fallo");
        }
    });
}

function agregarPrestamo(){
    swal({
        title: '¿Esta seguro/a que desea agregar un prestamo?',
        text: ' ',
        icon: 'warning',
        buttons: true,
    })
    .then((aggPrestamo) => {
        if (aggPrestamo) {
            accionAgregarPrestamo();
        } 
    });
}

function accionAgregarPrestamo(){

    if($('#selCliente').val() == 0){
        swal({
            title: "Favor de escoger un cliente...",
            text: ' ',
            icon: 'warning',
            buttons: false,
            timer: 1500
        });
        return;
    }
    else if($('#selMonto').val() == 0){
        swal({
            title: "Favor de escoger un monto...",
            text: ' ',
            icon: 'warning',
            buttons: false,
            timer: 1500
        });
        return;
    }
    else if($('#selPlazo').val() == 0){
        swal({
            title: "Favor de escoger un plazo...",
            text: ' ',
            icon: 'warning',
            buttons: false,
            timer: 1500
        });
        return;
    }
    else if($('#selPlazo').val() == 0 && $('#selMonto').val() == 0 && $('#selCliente').val() == 0){
        swal({
            title: "Falta algun dato importante...",
            text: ' ',
            icon: 'warning',
            buttons: false,
            timer: 1500
        });
        return;
    }

    var datos = {
        'id_cliente': $('#selCliente').val(),
        'id_monto': $('#selMonto').val(),
        'id_plazo': $('#selPlazo').val()
    };

    $.ajax({
        async: true,
        type: "GET",
        url: "php/agregarPrestamo.php",
        data: datos,
        dataType: "json",
        success: function(data){
            // console.log('data :>> ', data);

            if(data > 0){
                swal({
                    title: 'Prestamo agregado correctamente',
                    text: ' ',
                    icon: 'success',
                    buttons: false,
                    timer: 1500
                });
                $('#btnCerrarModalPrestamos').click();
                obtenerPrestamos();
            }
        },
        error: function(){
            console.log("Occurio un error en accionAgregarPrestamo()");
        }
    });
}

function obtenerAmortizacion(id_prestamo){

    var datos = {
        'id_prestamo' : id_prestamo
    };

    $.ajax({
        async: true,
        type: "GET",
        url: "php/obtenerAmortizacion.php",
        data: datos,
        dataType: "json",
        success: function(data){

            var fecha = new Date(data[0]['fecha_registro']);
            var dias = 15; // Número de días a agregar
            fecha.setDate(fecha.getDate() + dias);


            if(data.length == 0){
                return;
            }

            var valor = '<tr>';

            // console.log('data[] :>> ', data[0]['plazos']);
            for(a = 0; a < data[0]['plazos']; a++){
                valor += '<tr>'+
                '<td>' + (a+1) + '</td>' + 
                '<td>' + fecha.toLocaleString('es-MX', { timeZone: 'America/Chihuahua' }).substr(0,10) + '</td>' + 
                '<td>' + '$'+(data[0]['monto']/data[0]['plazos']).toFixed(2) + '</td>' +
                '<td>' + '$'+((data[0]['monto']/data[0]['plazos'])*interes).toFixed(2) + '</td>' + 
                '<td>' + '$'+(((data[0]['monto']/data[0]['plazos'])+((data[0]['monto']/data[0]['plazos'])*interes))).toFixed(2) + '</td>' + 
                '</tr>';
                fecha.setDate(fecha.getDate() + dias);
            }
            
            valor += '<tr>'+
            '<td>'  + '</td>' + 
            '<td>' + "Totales:" + '</td>' + 
            '<td>' + '$'+data[0]['monto'] + '</td>' +
            '<td>' + '$'+(data[0]['monto'])*interes + '</td>' + 
            '<td>' + '$'+(Number(data[0]['monto']) + Number((data[0]['monto'])*interes))+ '</td>' + 
            '</tr>';

            $('#lblCliente').html('Cliente: ' + data[0]['nombre_completo']);
            $('#lblPago').html('No.Pago: '+ data[0]['plazos']);

            $("#tbAmortizacion").html(valor);
        },
        error: function(){
            console.log("Error en obtenerAmortizacion()");
        }
    });
}

function funcionesExtras(){
    obtenerClientes();
    obtenerMontos();
    obtenerPlazos();
    obtenerPrestamos();

    $("#txtCliente").on('keyup', function (e) {
        var keycode = e.keyCode || e.which;
        if (keycode == 13) {
            // alert("Enter!");
            obtenerPrestamos();
        }
    });
}