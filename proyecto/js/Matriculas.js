class MatriculasJs 
{
    matriculas(route) {
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
}
var Matriculas = new MatriculasJs();