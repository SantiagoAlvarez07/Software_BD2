class RequestJs {
    //Metodo para insertar usuarios
    insertRequest() 
    {
      swal({
        icon: "warning",
        title: "Confirmar Solicitud",
        text: "¿Esta segur@ de enviar los datos",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {
          //Enviar solicitud si es que se confirmo el envio
          var object = new FormData(document.querySelector("#insert_request"));
  
          fetch("RequestController/insertRequest", {
            method: "POST",
            body: object,
          })
            .then((resp) => resp.text())
            .then(function (data) {
              try {
                object = JSON.parse(data);
  
                toastr.error(object.message);
              } catch (error) {
                document.querySelector("#content").innerHTML = data;
                toastr.success("La solicitud fue enviada");
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    }

    insertUser() 
    {
      swal({
        icon: "warning",
        title: "Confirmar agregar usuario",
        text: "Esta segur@ de agregar al usuario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {
          //Enviar el formulario si es que se confirmo el envio
  
          var object = new FormData(document.querySelector("#insert_user"));
  
          fetch("UserController/insertUser", {
            method: "POST",
            body: object,
          })
            .then((resp) => resp.text())
            .then(function (data) {
              try {
                object = JSON.parse(data);
  
                toastr.error(object.message);
              } catch (error) {
                document.querySelector("#content").innerHTML = data;
                toastr.success("El registro fue guardado");
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    }

    cancelRequest(id_req) 
    {
      swal({
        icon: "warning",
        title: "Confirmar Cancelación",
        text: "¿Esta segur@ de cancelar solicitud?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }) 
      .then((confirm) => {
        if (confirm) {
          //Crear un formulario
          var object = new FormData();
  
          //Añardir al formulario el codigo del usuario
          object.append("id_req", id_req);

          fetch("RequestController/cancelRequest", {
          method: "POST",
          body: object,
        })
          .then((resp) => resp.text())
          .then(function (data) {
            try {
              object = JSON.parse(data);

              toastr.error(object.message);
            } catch (error) {
              document.querySelector("#content").innerHTML = data;
              toastr.success("El cupo fue cancelado");
            }
          })
          .catch(function (error) {
            console.log(error);
          });
        }
      });
    }
    cambiarEstadoSchedule(id_user) 
    {
      swal({
        icon: "warning",
        title: "Continuar Proceso",
        text: "Está a punto de continuar con el proceso",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {  
          //Crear un formulario
          var object = new FormData();
  
          //Añardir al formulario el codigo del usuario
          object.append("id_user", id_user);
          
          fetch("InterviewController/cambiarEstadoSchedule", {
            method: "POST",
            body: object,
          })
            .then((resp) => resp.text())
            .then(function (data) {
              try {
                object = JSON.parse(data);
  
                toastr.error(object.message);
              } catch (error) {
                document.querySelector("#content").innerHTML = data;
                toastr.success("Ha continuado el proceso");
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    }
    
    cambiarEstadoInterview(id_user) 
    {
      swal({
        icon: "warning",
        title: "CAMBIAR HORARIO",
        text: "¿Esta segur@ de cambiar el horario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }) 
      .then((confirm) => {
        if (confirm) {
          //Crear un formulario
          var object = new FormData();
  
          //Añardir al formulario el codigo del usuario
          object.append("id_user", id_user);

          fetch("InterviewController/cambiarEstadoInterview", {
          method: "POST",
          body: object,
        })
          .then((resp) => resp.text())
          .then(function (data) {
            try {
              object = JSON.parse(data);

              toastr.error(object.message);
            } catch (error) {
              document.querySelector("#content").innerHTML = data;
              toastr.success("El horario fue cancelado");
            }
          })
          .catch(function (error) {
            console.log(error);
          });
        }
      });
    }


    cancelProceso() 
    {
      swal({
        icon: "warning",
        title: "Confirmar Cancelación",
        text: "¿Esta segur@ de cancelar el proceso?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }) 
      .then((confirm) => {
        if (confirm) {
          //Crear un formulario
          var object = new FormData();
  
          //Añardir al formulario el codigo del usuario
          object.append("id_inter", id_inter);

          fetch("AccessController/closeSession", {
          method: "POST",
          body: object,
        })
          .then((resp) => resp.text())
          .then(function (data) {
            try {
              object = JSON.parse(data);

              toastr.error(object.message);
            } catch (error) {
              document.querySelector("#content").innerHTML = data;
              toastr.success("El proceso fue cancelado");
            }
          })
          .catch(function (error) {
            console.log(error);
          });
        }
      });
    }

    
  
    //Metodo para mostrar el formulario para agregar un nuevo usuario
    showFormRequest() 
    {
      var object = new FormData();
      
      $("#my_modal").modal("show"); //Saber en donde vamos a mostrar el contenido
      document.querySelector("#modal_title").innerHTML =
        "Solicitar cupo";
      fetch("RequestController/showFormRequest", 
      {
        method: "POST",
        body: object, 
      })
        
        .then((resp) => resp.text())
        .then(function (data) {
          document.querySelector("#modal_content").innerHTML = data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }

    //--------------------------------------------------------------------
    //Metodo para actualizar un horario
    updateRequest_Acu(id_req) {
      swal({
        icon: "warning",
        title: "CONFIRMAR ACTUAIZAR INFORMACIÓN",
        text: "¿Esta segur@ de actualizar la observación?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
  
        if (confirm) {
          //Obtener y agregar al formulario el codigo del horario
          var object = new FormData(document.querySelector("#update_request_mod"));
          object.append("id_req", id_req);
  
          fetch("RequestController/updateRequest_Acu", {
            method: "POST",
            body: object,
          })
            .then((resp) => resp.text())
            .then(function (data) {
              try {
                object = JSON.parse(data);
  
                toastr.error(object.message);
              } catch (error) {
                document.querySelector("#content").innerHTML = data;
                toastr.success("El registro fue guardado");
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    }
    
  }
  
  var Request = new RequestJs(); //Crear un nuevo objeto
  