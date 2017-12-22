$(document).ready(function(){

   $("#form-clientes").submit(function(e){
        
        /*activar loading*/

        var sbmt = $("#form-clientes button[type='submit']");
        var grpRif = $("#form-clientes #rif");

        grpRif.removeClass("has-error");

        /*sbmt
        .removeClass("btn-danger btn-success")
        .addClass("disabled")
        .html("Enviando <img src='loading.gif'/>");*/
        sbmt.html("Enviando <img src='img/loading.gif'/>");

        /*consulta AJAX */
        $.ajax({

            url: "validar_rif.php",
            /*data: "rif="+$("#form-clientes #rif input[name='rif']").val(),*/
            data: $(this).serializeArray(),
            dataType: "json",
            method: "POST",

        }).done(function(data){
            
            sbmt.attr("disabled","disabled");

            $("#confirmWindow").addClass("in confirmOn");

            var msj = $("#confirmWindow #confirmMsj");

            if (data.status == 1) {            
                msj.text("Felicidades, el mensaje ha sido enviado con exito.");            
            }else if (data.status == -1){
                msj.text("El código ingresado no coincide con la imagen.");
            }else{
                msj.text("El RIF ingresado no se encuentra registrado en el SENIAT.");
            }

            $("#confirmWindow .confirmBtn").focus().on("click keypress", function(){

                $("#confirmWindow").removeClass("in confirmOn");                
                location = "index.php";                              
            });

            sbmt.html("Enviar");                        
        }).fail(function(data){
            sbmt.attr("disabled","disabled");

            $("#confirmWindow").addClass("in confirmOn");

            var msj = $("#confirmWindow #confirmMsj");
            msj.text("Falla en conexión.");

             $("#confirmWindow .confirmBtn").focus().on("click keypress", function(){

                $("#confirmWindow").removeClass("in confirmOn");                
                location = "index.php";                              
            });
        });
         e.preventDefault();
    }); 

});