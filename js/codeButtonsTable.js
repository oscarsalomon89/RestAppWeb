$(document).ready(function()
{
  $("#btn_enviar").click(function(){
 var url = "php/insertarDatos.php"; // the script where you handle the form input.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formulario").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $("#respuesta").html(data); // show response from the php script.
               $("#tabla").load("../../php/cargaDatos.php?cod=1");
           }
         });
 return false; // avoid to execute the actual submit of the form.
  })

  $("#tabla").load("../../php/cargaDatos.php?cod=1"); 

  /*Modal
          $("#btnAdd").click(function () {
            $.ajax({
                type: "GET",
                url: 'form.html',
                data: null
            })
          .done(function (result) {
              $(".modal-body").html(result);
          });
        }); */
});