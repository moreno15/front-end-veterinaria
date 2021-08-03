
$(document).ready(main);

var contador = 1;

function main () {

  tableView();
  //dataTable();
  $('.select2').select2()


 $('#md-evaluacion').on('show.bs.modal', function (event) {
     $('#valid').val("1");
 })
 $('#md-incidencia').on('show.bs.modal', function (event) {
      $('#valid').val("");
 })
 $('#md-tratamiento').on('show.bs.modal', function (event) {
      $('#valid').val("");
 })
  $('#md-reg-cliente').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal

      var id_cliente=button.data('id_cliente')
      var nombre_cliente=button.data('nombre_cliente')
      var apellido_cliente=button.data('apellido_cliente')
      var dni_cliente=button.data('dni_cliente')
      var email_cliente=button.data('email_cliente')
      var telefono_cliente=button.data('telefono_cliente')
      var direccion_cliente=button.data('direccion_cliente')

      var modal = $(this)

      modal.find('.modal-body #id_cliente').val(id_cliente)
      modal.find('.modal-body #nombre_cliente').val(nombre_cliente)
      modal.find('.modal-body #apellido_cliente').val(apellido_cliente)
      modal.find('.modal-body #dni_cliente').val(dni_cliente)
      modal.find('.modal-body #email_cliente').val(email_cliente)
      modal.find('.modal-body #telefono_cliente').val(telefono_cliente)
      modal.find('.modal-body #direccion_cliente').val(direccion_cliente)
  })

    $("#addpaciente").click(function () {
     $('#id_cliente').val('');
     $('#nombre_cliente').val('');
     $('#id_paciente').val('');
     $('#nombre_paciente').val('');
     $('#fecha_nacimiento').val('');
     $('#color_paciente').val('');
     $('#raza').val(" ");
     $('#especie').val(" ");
     $('#sexo_paciente').val(" ");
     $('#esterilizado').val(" ");
     $('#modal-paciente').modal('show');


   });
    $('#modal-paciente').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Botón que activó el modal

        var id_cliente=button.data('id_cliente')
        var cliente=button.data('cliente')
        var id_paciente=button.data('id_paciente')
        var nombre_paciente=button.data('nombre_paciente')
        var sexo_paciente=button.data('sexo_paciente')
        var color_paciente=button.data('color')
        var especie=button.data('especie')
        var raza=button.data('raza')
        var fecha_nacimiento=button.data('fecha_nacimiento')
        var esterilizado=button.data('esterilizado')

        var modal = $(this)
        if (id_cliente>0) {
          $("#btnbuscarcliente").css("display","none");
          modal.find('.modal-body #id_cliente').val(id_cliente);
          modal.find('.modal-body #nombre_cliente').val(cliente);
          modal.find('.modal-body #id_paciente').val(id_paciente);
          modal.find('.modal-body #nombre_paciente').val(nombre_paciente);
          modal.find('.modal-body #fecha_nacimiento').val(fecha_nacimiento);
          modal.find('.modal-body #color_paciente').val(color_paciente);
          modal.find('.modal-body #raza').val(raza);
          modal.find('.modal-body #especie').val(especie);
          modal.find('.modal-body #sexo_paciente').val(sexo_paciente);
          modal.find('.modal-body #esterilizado').val(esterilizado);

           $('#id_cliente').val(id_cliente).trigger('change.select2');

             $('#id_cliente').attr('readonly', true);


        }else{
          $('#id_cliente').attr('readonly', false);
          $("#btnbuscarcliente").css("display","block");
        }

    })




}//main

function editarGrooming(event){
  var button = $(event.target);
  var idpaciente=button.data("idpaciente");
  var nombre_paciente=button.data("nombre_paciente");
  var id_grooming=button.data("id_grooming");
  var descripcion=button.data("descripcion");

  $('#idpaciente').val(idpaciente);
  $('#nombre_paciente').val(nombre_paciente);
  $('#descripcion').val(descripcion);
  $('#id_grooming').val(id_grooming);

  $("#btnbuscarPc").css("display","none");

}

function eliminarTratamiento(id) {
  var id_internacion=$("#id_internacion").val();
   $.ajax({
          		 "url": $("#path").val()+"ajax/delete.php?tipo=tratamiento&id="+id+"&tabla=tratamiento&namdeId=id_tratamiento",
          	    type: "POST",
          	    contentType: false,
          	    processData: false,
          	    success: function(datos) {
                  fncSweetAlert("success",datos,$("#path").val()+"internacion/datelle-internacion/"+id_internacion)
          	    }
      });
}

function eliminarEavaluacion(id) {
  var id_internacion=$("#id_internacion").val();
   $.ajax({
          		 "url": $("#path").val()+"ajax/delete.php?tipo=tratamiento&id="+id+"&tabla=control&namdeId=id_control",
          	    type: "POST",
          	    contentType: false,
          	    processData: false,
          	    success: function(datos) {
                  fncSweetAlert("success", datos,$("#path").val()+"internacion/datelle-internacion/"+id_internacion)
          	    }
      });
}

function eliminarIncidencia(id) {
  var id_internacion=$("#id_internacion").val();
   $.ajax({
          		 "url": $("#path").val()+"ajax/delete.php?tipo=tratamiento&id="+id+"&tabla=internamiento_incidencia&namdeId=id_internamiento_incidencia",
          	    type: "POST",
          	    contentType: false,
          	    processData: false,
          	    success: function(datos) {
                  fncSweetAlert("success",datos,$("#path").val()+"internacion/datelle-internacion/"+id_internacion)
          	    }
      });
}

function removeCita(id) {

   $.ajax({
          		 "url": $("#path").val()+"ajax/delete.php?tipo=citas&id="+id+"&tabla=citas&namdeId=id_citas",
          	    type: "POST",
          	    contentType: false,
          	    processData: false,
          	    success: function(datos) {
                  fncSweetAlert("success",datos,$("#path").val()+"citas/lista-citas/")
          	    }
      });
}

function eliminarVacuna(id) {
    var id_historia=$("#id_historia").val();
   $.ajax({
          		 "url": $("#path").val()+"ajax/delete.php?tipo=vacuna&id="+id+"&tabla=vacuna&namdeId=id_vacuna",
          	    type: "POST",
          	    contentType: false,
          	    processData: false,
          	    success: function(datos) {
                  fncSweetAlert("success",datos,$("#path").val()+"paciente/historia-clinica/"+id_historia)
          	    }
      });
}

function eliminarVista(id) {
  // $id="'".$value->id_consulta."-" .$dataevaluacion[0]->id_evaluacion."'";
  //var data= id.split("-");


  $.ajax({
             "url": $("#path").val()+"ajax/delete.php?tipo=evaluacion_fisica&id="+id+"&tabla=evaluacion_fisica&namdeId=id_consulta",
              type: "POST",
              contentType: false,
              processData: false,
              success: function(datos) {
                $.ajax({
                           "url": $("#path").val()+"ajax/delete.php?tipo=consulta&id="+id+"&tabla=consulta&namdeId=id_consulta",
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function(datos) {
                               fncSweetAlert("success",datos,$("#path").val()+"visitas/listado-visita")
                            }
                   });


              }
     });
}

function eliminarGrooming(id) {
  // $id="'".$value->id_consulta."-" .$dataevaluacion[0]->id_evaluacion."'";
  var data= id.split("-");


  $.ajax({
             "url": $("#path").val()+"ajax/delete.php?tipo=detalle_grooming&id="+id+"&tabla=detalle_grooming&namdeId=id_grooming",
              type: "POST",
              contentType: false,
              processData: false,
              success: function(datos) {
                $.ajax({
                           "url": $("#path").val()+"ajax/delete.php?tipo=grooming&id="+id+"&tabla=grooming&namdeId=id_grooming",
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: function(datos) {
                               fncSweetAlert("success",datos,$("#path").val()+"grooming/")
                            }
                   });


              }
     });
}

function eliminarInternamiento(id) {
 fncSweetAlert("confirm","esta seguro de borrar la internacion","").then(
   function(value){
     if (value==true) {
       $.ajax({
                  "url": $("#path").val()+"ajax/delete.php?tipo=tratamiento&id="+id+"&tabla=tratamiento&namdeId=id_internamiento",
                   type: "POST",
                   contentType: false,
                   processData: false,
                   success: function(datos) {
                     $.ajax({
                                "url": $("#path").val()+"ajax/delete.php?tipo=control&id="+id+"&tabla=control&namdeId=id_internamiento",
                                 type: "POST",
                                 contentType: false,
                                 processData: false,
                                 success: function(datos) {
                                   $.ajax({
                                              "url": $("#path").val()+"ajax/delete.php?tipo=internamiento_incidencia&id="+id+"&tabla=internamiento_incidencia&namdeId=id_internamiento_inter_incid",
                                               type: "POST",
                                               contentType: false,
                                               processData: false,
                                               success: function(datos) {
                                                 $.ajax({
                                                            "url": $("#path").val()+"ajax/delete.php?tipo=internamiento&id="+id+"&tabla=internamiento&namdeId=id_internamiento",
                                                             type: "POST",
                                                             contentType: false,
                                                             processData: false,
                                                             success: function(datos) {
                                                                fncSweetAlert("success",datos,$("#path").val()+"internamiento")
                                                             }
                                                    });
                                               }
                                      });
                                 }
                        });


                   }
          });
     } //true
   }

 );

}

function eliminarPaciente(id) {
 fncSweetAlert("confirm","esta seguro de borrar los datos del paciente","").then(
   function(value){
     if (value==true) {
       $.ajax({
                  "url": $("#path").val()+"ajax/delete.php?tipo=paciente&id="+id+"&tabla=paciente&namdeId=id_paciente",
                   type: "POST",
                   contentType: false,
                   processData: false,
                   success: function(datos) {
                       fncSweetAlert("success",datos,$("#path").val()+"paciente/")
                   }
          });
     } //true
   }

 );

}

function eliminarCliente(id) {
 fncSweetAlert("confirm","esta seguro de borrar los datos del cliente","").then(
   function(value){
     if (value==true) {
       $.ajax({
                  "url": $("#path").val()+"ajax/delete.php?tipo=cliente&id="+id+"&tabla=cliente&namdeId=id_cliente",
                   type: "POST",
                   contentType: false,
                   processData: false,
                   success: function(datos) {
                       fncSweetAlert("success",datos,$("#path").val()+"cliente/")
                   }
          });
     } //true
   }

 );

}


//grommming
function viewBuacsrPc(){
  $("#form-grooming")[0].reset();
  $("#btnbuscarPc").css("display","block");
}
function contexMenu(md){
     $("#menuCapa").css("display", "none");
}

/*
function agregarPaciente(dataselect){
  var data=dataselect.split("-");
    $("#idpaciente").val(data[0]);
    $("#nombre_cliente").val(data[1]);
    fncSweetAlert("success","seleccionado.","");

}*/


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
  var tipo2=$("#tipo2").val();
  var tipo3=$("#tipo3").val();
  var tipo4=$("#tipo4").val();
  var tipo5=$("#tipo5").val();
  var tipo6=$("#tipo6").val();
  var tipo7=$("#tipo7").val();
  var tipo8=$("#tipoCita").val();

  // listoado citas recervados administracion
  if (tipo8==="cl-paciente") {
      var targetServer = $('.dt-citas');
    if(targetServer.length > 0){

    $(targetServer).dataTable({
               "lengthMenu": [100,200,500],
               "processing":true,
               "serverSide": true,
               "dom": '<Bl<f>rtip>',//Definimos los elementos del control de tabla
               "buttons": [
                  'excelHtml5',
                ],
               "ajax":{
                   "url": $("#path").val()+"ajax/data.php?tipo=cl-citas",
                   "type": "POST"
               },
              "columns": [
                   { "data": "id_citas" },
                   { "data": "accion", "orderable": false  },
                   { "data": "cliente", "orderable": false  },
                   { "data": "correo"},
                   { "data": "telefono_cliente"},
                   { "data": "nombre_paciente"},
                   { "data": "servicio_cita"},
                   { "data": "fecha_cita"},
                   { "data": "sms"}
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

  if (tipo==="cliente") {
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-server');

    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "dom": '<Bl<f>rtip>',//Definimos los elementos del control de tabla
             "buttons": [
                'excelHtml5',
              ],
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
                 "search": 'Buscar Nombre,apellido y dni cliente',
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
             "dom": '<Bl<f>rtip>',//Definimos los elementos del control de tabla
             "buttons": [
                'excelHtml5',
              ],
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
                 { "data": "esterilizado" , "orderable": false  },
                 { "data": "color_paciente" , "orderable": false  },
                 { "data": "raza_paciente" , "orderable": false  } ,



               ],
               "language": {
                 "search": 'Buscar Nombre paciente',
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
             "dom": '<Bl<f>rtip>',//Definimos los elementos del control de tabla
             "buttons": [
                'excelHtml5',
              ],
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=grooming",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_grooming" },
                 { "data": "accion", "orderable": false  },
                  { "data": "fecha"   },
                 { "data": "cliente", "orderable": false  },
                 { "data": "nombre_paciente"},
                 { "data": "servicio"},
                  { "data": "estado" , "orderable": false  },
                 { "data": "descripcion" },


               ],
               "language": {
                 "search":"Buscar por cliente",
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
             "dom": '<Bl<f>rtip>',//Definimos los elementos del control de tabla
             "buttons": [
                'excelHtml5',
              ],
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=visitas",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_consulta" },
                 { "data": "accion", "orderable": false  },
                 { "data": "cliente"},
                 { "data": "nombre_paciente"},
                 { "data": "motivo_consulta"},
                 { "data": "fecha_consulta"   },

               ],
               "language": {
                 "search":"Buscar por cliente",
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
  //mostramos en modulo internamiento
  if (tipo==="internamiento") {
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-internamiento');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "dom": '<Bl<f>rtip>',//Definimos los elementos del control de tabla
             "buttons": [
                'excelHtml5',
              ],
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=internamiento",
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_internamiento" },
                 { "data": "accion", "orderable": false  },
                  { "data": "cliente"},
                 { "data": "nombre_paciente"},
                 { "data": "motivo_internamiento"},
                 { "data": "fecha_internamiento"   },
                 { "data": "fecha_alta"   },

               ],
               "language": {
                 "search":"Buscar por Cliente",
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
  if (tipo2==="tratamiento") {
    /*Datatable Lado Servidor
    =============================================*/
    var id_internacion=$("#id_internacion").val();
    var targetServer = $('.dt-tratamiento');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=tratamiento&id="+id_internacion,
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_tratamiento" },
                 { "data": "accion", "orderable": false  },
                 { "data": "farmaco"},
                 { "data": "dosis"},
                 { "data": "via"   },
                 { "data": "fecha_tratamiento"   },

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
  if (tipo3==="evaluacion") {
    /*Datatable Lado Servidor
    =============================================*/
      var id_internacion=$("#id_internacion").val();
    var targetServer = $('.dt-evaluacion');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=evaluacion&id="+id_internacion,
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_control" },
                 { "data": "accion", "orderable": false  },
                 { "data": "temperatura"},
                 { "data": "frecuencia_card"},
                 { "data": "frecuencia_resp"   },
                 { "data": "fecha_tratamiento"   },

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
  if (tipo4==="incidencia") {
    /*Datatable Lado Servidor
    =============================================*/
    var id_internacion=$("#id_internacion").val();
    var targetServer = $('.dt-incidencia');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=incidencia&id="+id_internacion,
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_internamiento_incidencia" },
                 { "data": "accion", "orderable": false  },
                 { "data": "incidencia"},
                 { "data": "nota"},
                 { "data": "fecha_evaluacion"}

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
  //mostramos en la historia
  if (tipo5==="internamientoPaciente") {
    var historia=$("#id_historia").val();
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-internamientoPaciente');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=internamientoPaciente&id="+historia,
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_internamiento"  },
                 { "data": "accion", "orderable": false},
                 { "data": "motivo_internamiento" , "orderable": false},
                 { "data": "fecha_internamiento", "orderable": false   },
                 { "data": "fecha_alta"  , "orderable": false },

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
  if (tipo6==="vacunacion") {
    var historia=$("#id_historia").val();
    /*Datatable Lado Servidor
    =============================================*/

    var targetServer = $('.dt-vacunacionPaciente');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=vacunacion&id="+historia,
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_vacuna"  },
                 { "data": "accion", "orderable": false},
                 { "data": "parvovirus" , "orderable": false},
                 { "data": "coronavirus", "orderable": false   },
                 { "data": "distemper"  , "orderable": false },
                 { "data": "hepatitis"  },
                 { "data": "parainflueza", "orderable": false},
                 { "data": "l_canicola" , "orderable": false},
                 { "data": "l_icterohaemorrag", "orderable": false   },
                 { "data": "l_grippotyphosa"  , "orderable": false },
                 { "data": "l_pomona"  },
                 { "data": "rabia", "orderable": false},
                 { "data": "rinotraqueitis" , "orderable": false},
                 { "data": "panleucopenia", "orderable": false   },
                 { "data": "calcivirus"  , "orderable": false },
                 { "data": "fecha_programada"  , "orderable": false },
                 { "data": "fecha_aplicada"  , "orderable": false }

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
  if (tipo7==="visitasHitorial") {
    /*Datatable Lado Servidor
    =============================================*/
    var historia=$("#id_historia").val();
    var targetServer = $('.dt-vistasHits');
    if(targetServer.length > 0){


   $(targetServer).dataTable({
             "lengthMenu": [ 5, 10, 25, 75, 100],
             "processing":true,
             "serverSide": true,
             "ajax":{
                 "url": $("#path").val()+"ajax/data.php?tipo=visitasHitorial&id="+historia,
                 "type": "POST"
             },
            "columns": [
                 { "data": "id_consulta" },
                 { "data": "accion", "orderable": false  },
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
}
function dataTable(table) {

  var tipo=table;//$("#tipo").val();


  // listoado citas recervados
  if (tipo==="cl-paciente") {
      var targetServer = $('.dt-server');
    if(targetServer.length > 0){

    $(targetServer).dataTable({
               "lengthMenu": [ 5, 10, 25, 75, 100,300],
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

           $(targetServer).dataTable({
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
                            "search":"Buscar por nombre paciente",
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
function enviarmensaje(id) {
  fncSweetAlert("confirm","esta seguro de enviar mensaje al correo","").then(
    function(value){
      if (value==true) {

        $('#refresch').modal('show');
        $.ajax({
               		 "url": $("#path").val()+"controller/enviarmensaje.php?id="+id,
               	    type: "POST",
               	    contentType: false,
               	    processData: false,
               	    success: function(rpt) {
                        $('#refresch').modal('hide');
                       fncSweetAlert("success",rpt,$("#path").val()+"citas/lista-citas/");

               	    }
           });
      } //true
    }

  );


}


function sendSMSNotificacion(data) {

    var settings = {
      "url": $("#pathprincipal").val()+"altiria/http/testAltiriaSms.php?data="+data,
      "method": "GET",
      "timeout": 0,
    };
    $.ajax(settings).done(function (response) {

          fncSweetAlert("success",response,$("#path").val()+"citas");
           return;


    });
}
//setInterval(sendSMSNotificacion , 3000);
