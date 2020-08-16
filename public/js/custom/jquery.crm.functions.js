function send_submit(arreglo){

    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", arreglo.method);
    form.setAttribute("action", arreglo.url);
    // alert(arreglo.url);
    for(var key in arreglo.params) {
        //console.log(key);
        if(arreglo.params.hasOwnProperty(key)) {
            //console.log(arreglo.params[key]);
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", arreglo.params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}


function ajax_on_div(arreglo){

    // $("#"+arreglo.div).preloader();

    // return false;
    // setVisible('.page', true);
    startLoading();

    $.ajax({
        type:"POST",
        data:arreglo.data,
        url:arreglo.url,
        success:function(data){
            $("#loading").hide();
            $("#"+arreglo.div).html(data);
            // setVisible('#loading', false);
            // $("#"+arreglo.div).preloader("remove");
        },
        statusCode: {
            200: function() {
             stopLoading();
         },
         404: function() {
            alert( "page not found" );
                // $("#"+arreglo.div).preloader("remove");

            },
            500: function() {
                alert( "Error en la pagina" );
                // $("#"+arreglo.div).preloader("remove");               
            }
        }
    });
}


function ajax_on_div_status(arreglo){

    // $("#"+arreglo.div).preloader();

    // return false;
    // setVisible('.page', true);
    startLoading();

    $.ajax({
        type:"POST",
        data:arreglo.data,
        url:arreglo.url,
        success:function(data){
            $("#loading").hide();
            $("#"+arreglo.div).html(data);
            // setVisible('#loading', false);
            // $("#"+arreglo.div).preloader("remove");
        },
        complete : function() {

            if(localStorage.getItem("misObservaciones")!=""){

                $("#inputObservacionesGenerales").val(localStorage.getItem("misObservaciones"));

                localStorage.removeItem("misObservaciones");

                localStorage.clear();
            }

//            alert('Petición realizada');
        },
        statusCode: {
            200: function() {
             stopLoading();
         },
         404: function() {
            alert( "page not found" );
                // $("#"+arreglo.div).preloader("remove");

            },
            500: function() {
                alert( "Error en la pagina" );
                // $("#"+arreglo.div).preloader("remove");               
            }
        }
    });
}




function ajax_on_popup(arreglo){
    $("#modalIni").modal("show");
    $("#modalIni-title").html(arreglo.title);            
    startLoading();
    $.ajax({
        type:"POST",
        data:arreglo.data,
        url:arreglo.url,
        success:function(data){
            $("#modalIni-body").html(data);
            stopLoading();
        },
        statusCode: {
            200: function() {
             stopLoading();
         },
         404: function() {
            alert( "page not found" );
            stopLoading();
        },
        500: function() {
            alert( "Error en la pagina" );
            stopLoading();
        },
        203: function() {
            alert( "page not found" );
            stopLoading();
        },
    }
});
}

function ajax_on_minipopup(arreglo){
    $("#modal-mini-form").modal("show");
    $("#modal-mini-title").html(arreglo.title);            
    startLoading();
    $.ajax({
        type:"POST",
        data:arreglo.data,
        url:arreglo.url,
        success:function(data){
            $("#modal-mini-body").html(data);
        },
        statusCode: {
            200: function() {
             stopLoading();
         },
         404: function() {
            alert( "page not found" );
        },
        500: function() {
            alert( "Error en la pagina" );
        }
    }
});
}

function ajax_on_select(arreglo){   

    var $dropdown = $("#"+arreglo.select); 
    // $.preloader.start({
    //     modal: true,
    //     src : 'sprites1.png'
    // });
    $.ajax({
        type:"POST",
        data:arreglo.data,
        url:arreglo.url,
        async: false,
        success:function(result){
            try{ 

                arrayJ = JSON.parse(result);            
                $dropdown.find('option').remove().end();
                $dropdown.append("<option value=''>No Definido</option>");
                $.each(arrayJ,function(index, value){
                    $dropdown.append($("<option />").val(value.Id).text(value.text));
                    // console.log('My array has at position ' + index + ', this value: ' + );
                });
                // $.preloader.stop();
                
                // console.log("here");                
            }catch(ex){
                $dropdown.find('option').remove().end();
                $dropdown.append("<option value=''>No Definido</option>");
                // $.preloader.stop();
            }
        },
        statusCode: {
            404: function() {
                alert( "page not found" );
                 // $.preloader.stop();
             },
             500: function() {
                alert( "Error en la pagina" );
                 // $.preloader.stop();
             }
         }
     });
}

function form_to_json(objeto){


    var myform = $("#"+objeto);
    var disabled = myform.find(':input:disabled').removeAttr('disabled');
    var formdata = $("#"+objeto).serializeArray();    
    var data = {};
    $(formdata ).each(function(index, obj){
        data[obj.name] = obj.value;
    });

    disabled.attr('disabled','disabled');
    return data;
}

function ajax_send(arreglo,callback){
    var response  ={};
    startLoading();
    rp={};
    //$("#loading").show();
    
    $.ajax({
        type:"POST",
        data:arreglo.data,
        url:arreglo.url,
        success:function(data){
            try{

                resp = JSON.parse(data); 

                if( typeof callback !== 'undefined' )            
                    callback(data);

            }catch(ex){               
                rp.msg="Ha ocurrido un error, comuniquese con el departamento de sistemas";
                rp.title="Aviso";
                rp.event ="error";
                toastNotificacion(rp);
            }
        },
        statusCode: {
            200: function() {
             stopLoading();
         },
         404: function() {
            response.Code=404;
            response.Msg="Fail";
            callback(response);
        },
        500: function() {
            response.Code=500;
            response.Msg="Server Error";
            callback(response);
        }
    }
});
}

function ajax_send_file(arreglo,callback){
    var response  ={};
    
    // console.log(arreglo);
        // document.getElementById(arreglo.input).addEventListener('change', false);
        var formData = new FormData(document.getElementById(arreglo.form));
        //$("#loading").show();
        
        // arreglo.form.preventDefault();
        
        $.ajax({
            type:"POST",
            dataType: "html",
            data:formData,
            url:arreglo.url,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data){

             if( typeof callback !== 'undefined' )
                callback(data);
        },
        statusCode: {
            404: function() {
                response.Code=404;
                response.Msg="Fail";
                callback(response);
            },
            500: function() {
                response.Code=500;
                response.Msg="Server Error";
                callback(response);
            }
        }
    });
    }


    function tabladinamica(objeto){             
        $('#'+objeto).dataTable({                       

            "language": {
                "decimal":        "",
                "emptyTable":     "No Hay registros Disponibles",
                "info":           "Mostrando _START_ to _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 to 0 de 0 Registros",
                "infoFiltered":   "(Fildrado de _MAX_ total registros)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ ",
                "loadingRecords": "Cargando..",
                "processing":     "Procesando",
                "search":         "Buscar:",
                "zeroRecords":    "No Hay registros encontrados",
                "paginate": {
                    "first":      "Inicio",
                    "last":       "Final",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },          
            },
            "aaSorting": [],    
        } );
    }

    function toastNotificacion(objeto){
       var msg = objeto.msg;
       var event =objeto.event;
       var title = objeto.title;
       toastr.options = {
        closeButton: true,        
        progressBar: true,
        preventDuplicates: true,
        positionClass: 'toast-top-right',
        onclick: null
    };
    if (event=="success"){
        toastr.success(msg, title);
    }
    if (event=="error"){
        toastr.error(msg, title);
    }
    if (event=="info"){
        toastr.info(msg, title);
    }
    if (event=="warning"){
        toastr.info(msg, title);
    }
}

function roundThis(mount){
  let myRound= !isNaN(mount)? Math.round((mount*100)/100):0.00;

  return myRound.toFixed(2);
}

function startLoading(){
    $("#myloading").css({
     "display": "block",
     "position": "absolute",
     "top": "0",
     "left": "0",
     "z-index": "999999999",
     "width": "100vw",
     "height":$("#wrapper").height(),
     "background-color": "rgba(192, 192, 192, 0.5)",
     "background-image": "url(\"public/assets/js/custom/loader_main.gif\")",
     "background-repeat": "no-repeat",
     "background-position": "center",
 })
    $("#myloading").show();
}

function stopLoading(){
    $("#myloading").css({});
    $("#myloading").hide();
}