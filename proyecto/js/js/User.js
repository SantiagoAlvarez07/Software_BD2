class UserJs {
    //Metodo para insertar usuarios
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

    //Metodo para insertar usuarios
    //Metodo para actualizar un usuario
    generarPDF(id_user) {
      swal({
        icon: "warning",
        title: "Confirmar actualizar usuario",
        text: "Esta segur@ de actualizar al usuario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
  
        if (confirm) {
         
          
          //Obtener y agregar al formulario el codigo del usuario
          var object = new FormData(document.querySelector("#update_user"));
          object.append("id_user", id_user);
  
          fetch("UserController/updateUser", {
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
  
    //Metodo para mostrar el formulario para agregar un nuevo usuario
    showFormUser() 
    {
      var object = new FormData();
  
      $("#my_modal").modal("show"); //Saber en donde vamos a mostrar el contenido
      document.querySelector("#modal_title").innerHTML =
        "Agregar un nuevo usuario";
      fetch("UserController/showFormUser", 
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


  
    //Metodo para actualuzar un usuario
    showUser(id_user) {
      //Crear un formulario
      var object = new FormData();
  
      //Añardir al formulario el codigo del usuario
      object.append("id_user", id_user);
  
      $("#my_modal").modal("show");
  
      document.querySelector("#modal_title").innerHTML = "Actualizar usuario";
  
      fetch("UserController/showUser", 
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

    //Metodo para actualizar un usuario
    pUser() 
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

    //Metodo para actualizar un usuario
    aceptarRequest(id_curr) 
    {
      swal({
        icon: "warning",
        title: "ACEPTACIÓN DEL CUPO",
        text: "¿Desea aceptar el cupo y el envío de los horarios de entrevista?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
        if (confirm) {  
          //Crear un formulario
          var object = new FormData();
  
          //Añardir al formulario el codigo del usuario
          object.append("id_curr", id_curr);
          
          fetch("UserController/insertUserAcudiente", {
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

    //Metodo para actualizar un usuario
    updateUser(id_user) {
      swal({
        icon: "warning",
        title: "Confirmar actualizar usuario",
        text: "Esta segur@ de actualizar al usuario?",
        buttons: {
          cancel: true,
          confirm: true,
        },
      }).then((confirm) => {
  
        if (confirm) {
         
          
          //Obtener y agregar al formulario el codigo del usuario
          var object = new FormData(document.querySelector("#update_user"));
          object.append("id_user", id_user);
  
          fetch("UserController/updateUser", {
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
  
  var User = new UserJs(); //Crear un nuevo objeto
  