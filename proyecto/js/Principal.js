class PrincipalJs {

    menu(route) {
        fetch(route)
        .then((resp) => resp.text())
        .then(function(response)
        {
            $('#matriculas').html(response);
        })
        .catch(function(error) {
          console.log(error);
        });  
    }
}

var Principal = new PrincipalJs();