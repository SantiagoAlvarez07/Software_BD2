class InterviewJs {


  interview(route) 
  {
    fetch(route)
    .then((resp) => resp.text())
    .then(function(response)
    {
        $('#content').html(response);
    })
    .catch(function(error) {
      console.log(error);
    });  
  }
    //Metodo para insertar horarios
    insertSchedule() 
    {
      swal({
        icon: "warning",
        title: "Confirmar agregar horario",
        text: "¿Está segur@ de agregar el horario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {
          //Enviar el formulario si es que se confirmo el envio
          var object = new FormData(document.querySelector("#insert_schedule"));
  
          fetch("InterviewController/insertSchedule", {
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
    //--------------------------------------------------------------------
    insertInterview() {
      swal({
        icon: "warning",
        title: "Programación de entrevista",
        text: "¿Está seguro de enviar los datos de la entrevista?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {
          // Obtener el valor seleccionado del campo de entrada de radio
          var selectionInterview = document.querySelector('input[name="selectionInterview"]:checked');
          if (selectionInterview) {
            var value = selectionInterview.value;
    
            // Crear objeto FormData y agregar los datos del formulario
            var object = new FormData(document.querySelector("#insert_interview"));
            object.append("selectionInterview", value);
    
            // Enviar solicitud si se confirmó el envío
            fetch("InterviewController/insertInterview", {
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
                  toastr.success("Se apartó un horario de entrevista");
                }
              })
              .catch(function (error) {
                console.log(error);
              });
          }
        }
      });
    }

    //Metodo para eliminar un horario
    generarPDF() 
    {
      swal({
        icon: "warning",
        title: "Confirmar eliminar horario",
        text: "¿Está segur@ de eliminar el horario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {  
          
          fetch("InterviewController/deleteSchedule")
            .then((resp) => resp.text())
            .then(function (data) {
              try {
                object = JSON.parse(data);
  
                toastr.error(object.message);
              } catch (error) {
                document.querySelector("#content").innerHTML = data;
                toastr.success("El horario fue eliminado");
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    }
    
    //--------------------------------------------------------------------
    //Metodo para eliminar un horario
    deleteSchedule(id_sche) 
    {
      swal({
        icon: "warning",
        title: "Confirmar eliminar horario",
        text: "¿Está segur@ de eliminar el horario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {  
          //Crear un formulario
          var object = new FormData();
  
          //Añardir al formulario el codigo del usuario
          object.append("id_sche", id_sche);
          
          fetch("InterviewController/deleteSchedule", {
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
                toastr.success("El horario fue eliminado");
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    }
    //--------------------------------------------------------------------
    //Metodo para actualuzar un horario
    showSchedule(id_sche) {
      //Crear un formulario
      var object = new FormData();
  
      //Añardir al formulario el codigo del horario
      object.append("id_sche", id_sche);
  
      $("#my_modal").modal("show");
  
      document.querySelector("#modal_title").innerHTML = "Actualizar horario";
  
      fetch("InterviewController/showSchedule", 
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
    //Metodo para actualuzar un horario
    showInterviewAcudiente(id_user, id_sche) {
      //Crear un formulario
      var object = new FormData();
  
      //Añardir al formulario el codigo del horario
      object.append("id_user", id_user,"id_sche",id_sche);
  
      $("#my_modal").modal("show");
  
      document.querySelector("#modal_title").innerHTML = "Actualizar horario";
  
      fetch("InterviewController/showInterviewAcudiente", 
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
    updateSchedule(id_sche) {
      swal({
        icon: "warning",
        title: "Confirmar actualizar horario",
        text: "¿Esta segur@ de actualizar al horario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
  
        if (confirm) {
          //Obtener y agregar al formulario el codigo del horario
          var object = new FormData(document.querySelector("#update_schedule"));
          object.append("id_sche", id_sche);
  
          fetch("InterviewController/updateSchedule", {
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
          
          fetch("UserController/paginateProcessPosition", {
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
  }
  //--------------------------------------------------------------------
  var Interview = new InterviewJs(); //Crear un nuevo objeto
  