$(document).ready(function () {
  tablaPersonas = $("#tablaPersonas").DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>",
      },
    ],

    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
  });

  $("#btnNuevo").click(function () {
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#2C99A9");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Banner");
    $("#modalCRUD").modal("show");
    id = null;
    opcion = 1; //alta
  });

  var fila; //capturar la fila para editar o borrar el registro

  //botón EDITAR
  $(document).on("click", ".btnEditar", function () {
    fila = $(this).closest("tr");
    id = parseInt(fila.find("td:eq(0)").text());
    img = fila.find("td:eq(1)").text();
    link = fila.find("td:eq(2)").text();
    lang = fila.find("td:eq(3)").text();

    $("#img").val(img);
    $("#link").val(link);
    $("#lang").val(lang);
    opcion = 2; //editar

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");
    $("#modalCRUD").modal("show");
  });

  //botón BORRAR
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //borrar
    var respuesta = confirm(
      "¿Está seguro de eliminar el registro: " + id + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: { opcion: opcion, id: id },
        success: function () {
          tablaPersonas.row(fila.parents("tr")).remove().draw();
          
        },
      });
    }
  });

  $("#formPersonas").submit(function (e) {
    e.preventDefault();
    img = $.trim($("#img").val());
    link = $.trim($("#link").val());
    lang = $.trim($("#lang").val());
    if( lang == ""){
      alert("seleccione idioma");
      
      return false
    }else{

    
    $.ajax({
      url: "bd/crud.php",
      type: "POST",
      dataType: "json",
      data: { img: img, link: link, lang: lang, id: id, opcion: opcion },
      success: function (data) {
        console.log(data);
        id = data[0].id;
        img = data[0].img;
        link = data[0].link;
        lang = data[0].lang;
        if (opcion == 1) {
          tablaPersonas.row.add([id, img, link, lang]).draw();
        } else {
          tablaPersonas.row(fila).data([id, img, link, lang]).draw();
        }
      },
    });
  }
    $("#modalCRUD").modal("hide");
  });
});
