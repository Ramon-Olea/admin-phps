$("#formLogin").submit(function (e) {
  e.preventDefault();
  var usuario = $.trim($("#usuario").val());
  var password = $.trim($("#password").val());

  if (usuario.length == "" || password == "") {
    Swal.fire({
      type: "warning",
      title: "Debe ingresar un usuario y/o password",
    });
    return false;
  } else {
    $.ajax({
      url: "bd/login.php",
      type: "POST",
      datatype: "json",
      data: { usuario: usuario, password: password },
      success: function (data) {
        if (data == "null") {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "error",
            title: "Usuario o Contraseña Incorrecto",
            type: "error",
          });
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "success",
            type: "success",

            title: "Conectado",
          }); //window.location.href = "vistas/pag_inicio.php";
          window.location.href = "dashboard/index.php";
        }
      },
    });
  }
});
