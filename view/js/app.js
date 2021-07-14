
$(document).ready(main);

var contador = 1;

function main () {

  tableView();
  //dataTable();
}//main

function contexMenu(md){
     $("#menuCapa").css("display", "none");
}
function agregarPaciente(dataselect){
  var data=dataselect.split("-");
    $("#idpaciente").val(data[0]);
    $("#nombre_cliente").val(data[1]);
    fncSweetAlert("success","seleccionado.","");

}
function agregarPacienteGrooming(dataselect){
  var data=dataselect.split("-");
    $("#id_citas").val(data[0]);
    $("#idpaciente").val(data[1]);
    $("#nombre_paciente").val(data[2]);
    $("#nombre_cliente").val(data[3]);
    $("#id_historia").val(data[4]);

    fncSweetAlert("success","seleccionado.","");

}



function buscarDni(){
  fncSweetAlert("loading","Buscando.","");

  var dni=$("#dni_cliente").val();
    var settings = {
      "url": $("#path").val()+"ajax/data-cliente.php?dni="+dni,
      "method": "GET",
      "timeout": 0,
    };
    /*=============================================
    Cuando la petición de AJAX devuelve error
    =============================================*/

    /*=============================================
    Cuando la petición de AJAX devuelve el resultado correcto
    =============================================*/

    $.ajax(settings).done(function (response) {

          var datos = JSON.parse(response);
          $("#nombre_cliente").val(datos['nombres']);
          $("#apellido_cliente").val(datos['apellidoPaterno']+' '+datos['apellidoMaterno']);

           return;


    });


}
function tableView(){
  var tipo=$("#tipo").val();
  if (tipo==="cliente") {
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-server');

    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=cliente",
                 "type": "POST"
             },
            "columns": [

                 { "data": "id_cliente" },
                 { "data": "accion", "orderable": false  },
                 { "data": "nombre_cliente"},
                 { "data": "apellido_cliente"},
                 { "data": "dni_cliente"},
                 { "data": "email_cliente" , "orderable": false  },
                 { "data": "telefono_cliente" , "orderable": false  },
                 { "data": "direccion_cliente" , "orderable": false  }
               ],
               "language": {
                 "lengthMenu": "Mostrar : _MENU_ registros",
                 "buttons": {
                 "copyTitle": "Tabla Copiada",
                 "copySuccess": {
                         _: '%d líneas copiadas',
                         1: '1 línea copiada'
                         }
                       }
                   },
           "bDestroy": true,
           "iDisplayLength": 5,//Paginación
           "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
           }).DataTable();


   }//datatable cliente

  }
  if (tipo==="paciente") {
    /*Datatable Lado Servidor
    =============================================*/
    var targetServer = $('.dt-server');


    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=paciente",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_paciente" },
                 { "data": "accion", "orderable": false  },
                 { "data": "foto_paciente", "orderable": false  },
                 { "data": "nombre_paciente"},
                 { "data": "edad"},
                 { "data": "fecha_nacimiento", "orderable": false  },
                 { "data": "sexo_paciente" , "orderable": false  },
                 { "data": "esterilizado" , "orderable": false  }
               ],
               "language": {
                 "lengthMenu": "Mostrar : _MENU_ registros",
                 "buttons": {
                 "copyTitle": "Tabla Copiada",
                 "copySuccess": {
                         _: '%d líneas copiadas',
                         1: '1 línea copiada'
                         }
                       }
                   },
           "bDestroy": true,
           "iDisplayLength": 5,//Paginación
           "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
           }).DataTable();


   }//datatable cliente

  }
  if (tipo==="grooming") {
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-server3');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=grooming",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_grooming" },
                 { "data": "accion", "orderable": false  },
                 { "data": "cliente", "orderable": false  },
                 { "data": "nombre_paciente"},
                 { "data": "servicio"},
                  { "data": "estado" , "orderable": false  },
                 { "data": "descripcion" },
                 { "data": "fecha"   },

               ],
               "language": {
                 "lengthMenu": "Mostrar : _MENU_ registros",
                 "buttons": {
                 "copyTitle": "Tabla Copiada",
                 "copySuccess": {
                         _: '%d líneas copiadas',
                         1: '1 línea copiada'
                         }
                       }
                   },
           "bDestroy": true,
           "iDisplayLength": 5,//Paginación
           "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
           }).DataTable();


   }//datatable cliente

  }
  if (tipo==="visitas") {
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-server3');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=visitas",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_consulta" },
                 { "data": "accion", "orderable": false  },
                 { "data": "nombre_paciente"},
                 { "data": "motivo_consulta"},
                 { "data": "fecha_consulta"   },

               ],
               "language": {
                 "lengthMenu": "Mostrar : _MENU_ registros",
                 "buttons": {
                 "copyTitle": "Tabla Copiada",
                 "copySuccess": {
                         _: '%d líneas copiadas',
                         1: '1 línea copiada'
                         }
                       }
                   },
           "bDestroy": true,
           "iDisplayLength": 5,//Paginación
           "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
           }).DataTable();


   }//datatable cliente

  }
  if (tipo==="internamiento") {
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-internamiento');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=internamiento",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_internamiento" },
                 { "data": "accion", "orderable": false  },
                 { "data": "nombre_paciente"},
                 { "data": "motivo_internamiento"},
                 { "data": "fecha_internamiento"   },
                 { "data": "fecha_alta"   },

               ],
               "language": {
                 "lengthMenu": "Mostrar : _MENU_ registros",
                 "buttons": {
                 "copyTitle": "Tabla Copiada",
                 "copySuccess": {
                         _: '%d líneas copiadas',
                         1: '1 línea copiada'
                         }
                       }
                   },
           "bDestroy": true,
           "iDisplayLength": 5,//Paginación
           "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
           }).DataTable();


   }//datatable cliente

  }

}
function dataTable(table) {

  var tipo=table;//$("#tipo").val();


  // listoado citas recervados
  if (tipo==="cl-paciente") {
      var targetServer = $('.dt-server');
    if(targetServer.length > 0){

    $(targetServer).dataTable({
               "lengthMenu": [ 5, 10, 25, 75, 100],
               "processing":true,
               "serverSide": true,
               "ajax":{
                   "url": $("#path").val()+"ajax/data.php?tipo=cl-paciente",
                   "type": "POST"
               },
              "columns": [
                   { "data": "id_citas" },
                   { "data": "accion", "orderable": false  },
                   { "data": "cliente", "orderable": false  },
                   { "data": "nombre_paciente"},
                   { "data": "servicio_cita"},
                   { "data": "fecha_cita"}
                 ],
                 "language": {
                   "lengthMenu": "Mostrar : _MENU_ registros",
                   "buttons": {
                   "copyTitle": "Tabla Copiada",
                   "copySuccess": {
                           _: '%d líneas copiadas',
                           1: '1 línea copiada'
                           }
                         }
                     },
             "bDestroy": true,
             "iDisplayLength": 5,//Paginación
             "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
             }).DataTable();

   }//datatable cliente

 }

 //lisatod paciente total
 if (tipo==="cl-paciente2") {
  var targetServer = $('.dt-server2');
   if(targetServer.length > 0){

            var tb=    $(targetServer).dataTable({
                      "lengthMenu": [ 5, 10, 25, 75, 100],
                      "processing":true,
                      "serverSide": true,
                      "ajax":{
                          "url": $("#path").val()+"ajax/data.php?tipo=cl-paciente2",
                          "type": "POST"
                      },
                     "columns": [
                          { "data": "id_paciente" },
                          { "data": "accion", "orderable": false  },
                          { "data": "cliente", "orderable": false  },
                          { "data": "nombre_paciente"}
                        ],
                        "language": {
                          "lengthMenu": "Mostrar : _MENU_ registros",
                          "buttons": {
                          "copyTitle": "Tabla Copiada",
                          "copySuccess": {
                                  _: '%d líneas copiadas',
                                  1: '1 línea copiada'
                                  }
                                }
                            },
                    "bDestroy": true,
                    "iDisplayLength": 5,//Paginación
                    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                    }).DataTable();


        }//datatable cliente
   }//if



}//datable

function validateImageJS(event, input){

    var image = event.target.files[0];

    /*=============================================
    Validamos el formato
    =============================================*/

    if(image["type"] !== "image/jpeg" && image["type"] !== "image/png"){

        fncSweetAlert("error", "The image must be in JPG or PNG format", null)

        return;
    }

    /*=============================================
    Validamos el tamaño
    =============================================*/

    else if(image["size"] > 2000000){

        fncSweetAlert("error", "Image must not weigh more than 2MB", null)

        return;

    }

    /*=============================================
    Mostramos la imagen temporal
    =============================================*/

    else{

        var data = new FileReader();
        data.readAsDataURL(image);

        $(data).on("load", function(event){

            var path = event.target.result;

            $("."+input).attr("src", path);

              document
                .getElementById(input)
                .innerHTML = image.name;

        });


    }

}
function sendSMSNotificacion() {
  var dni=$("#dni_cliente").val();
    var settings = {
      "url": $("#pathprincipal").val()+"altiria/http/testAltiriaSms.php",
      "method": "GET",
      "timeout": 0,
    };
    $.ajax(settings).done(function (response) {

      console.log(response);
           return;


    });
}
//setInterval(sendSMSNotificacion , 3000);
