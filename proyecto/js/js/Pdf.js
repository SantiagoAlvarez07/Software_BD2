class PdfJs {

    pdf(route) 
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
}

    //--------------------------------------------------------------------
    var PdfJs = new PdfJs(); //Crear un nuevo objeto
    