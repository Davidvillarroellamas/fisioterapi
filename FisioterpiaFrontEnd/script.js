document.addEventListener("DOMContentLoaded", function () {
  $("#guardarMasaje").on("click", function () {
    let datos = {
      nombre: $("#nombre").val(),
      descripcion: $("#descripcion").val(),
      duracion: $("#duracion").val(),
      precio: $("#precio").val(),
    };
    if ($("#id-masaje").val() === "") {
      crearMasaje(datos);
    } else {
      datos.id = $("#id-masaje").val();
      editarMasaje(datos);
    }
  });

  $("#agregarMasaje").on("click", function () {
    $("#id-masaje").val("");
  });
  $(".btn-warning").on("click", function () {
    let idMasaje = $(this).data("id");
    $("#id-masaje").val(idMasaje);
  });

  $(".btnEliminar").on("click", function () {
    let idMasaje = $(this).data("id");
    $("#id-masaje").val(idMasaje);
  });

  $("#btnEliminarMasaje").click(function () {
    let id = $("#id-masaje").val();
    eliminar(id);
  });
});
//al abrir el modalverifica si hay un id valido si lo hay lo rellena para un actualizar
$("#masaje").on("shown.bs.modal", function () {


  if ($("#id-masaje").val() !== "") {
    $.ajax({
      type: "GET",
      url: "http://localhost/Fisioterapia/ApiRestFisioterpiaDavid/api-rest/get_id_masaje.php",
      dataType: "JSON",
      data: { id: $("#id-masaje").val() },
      success: function (respuesta) {
        $("#nombre").val(respuesta[0].nombre);
        $("#descripcion").val(respuesta[0].descripcion);
        $("#duracion").val(respuesta[0].duracion);
        $("#precio").val(respuesta[0].precio);
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }else{
    $("#nombre").val("");
        $("#descripcion").val("");
        $("#duracion").val("");
        $("#precio").val("");
  }
  
});

function crearMasaje(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "POST",
    url: "http://localhost/Fisioterapia/ApiRestFisioterpiaDavid/api-rest/create_masaje.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#masaje").modal("hide");

      $("#nombre").val(""),
        $("#descripcion").val(""),
        $("#duracion").val(""),
        $("#precio").val(""),
        Swal.fire({
          title: "Exito",
          text: respuesta.message,
          icon: "success",
          timer: 5000,
        }).then(() => {
          location.reload();
        });
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }
  

function editarMasaje(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "PUT",
    url: "http://localhost/Fisioterapia/ApiRestFisioterpiaDavid/api-rest/update_masaje.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#masaje").modal("hide");

      $("#nombre").val(""),
        $("#descripcion").val(""),
        $("#duracion").val(""),
        $("#precio").val(""),
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}

function eliminar(id) {
  console.log(id);
  $.ajax({
    type: "DELETE",
    url: "http://localhost/Fisioterapia/ApiRestFisioterpiaDavid/api-rest/delete_masaje.php?id=" + id,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
    $('#modalEliminar').modal('hide');
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
    error: function (error) {
      // Manejar errores
      console.error("Error en la solicitud AJAX:", error);
      Swal.fire({
        title: "Error",
        text: "error:" + error,
        icon: "error",
      });
    },
  });
}
