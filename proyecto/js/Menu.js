class MenuJs {

    closeSession() 
    { 
        fetch('AccessController/closeSession')
        .then((resp) => resp.json())
        .then(function(data) { 
           toastr.success(data.message);

            setTimeout(function() {
               location.href="index.php";
            }, 2500);
        })
        .catch(function(error) {
          console.log(error);
        });
    }

    menu(route) {
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

    deleteSchedule(id_user) 
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
          object.append("id_user", id_user);
          
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
    
}

var Menu=new MenuJs();