const form = document.querySelector('#formLogin');
form.addEventListener('submit', function(event) {
  event.preventDefault(); // prevenir el envío del formulario

  const doc = document.querySelector('#docUser').value;
  const password = document.querySelector('#password').value;
  const rol = document.querySelector('#role').value;

  if (doc.length < 8) {
    Swal.fire({
      icon: 'warning',
      text: 'El DOCUMENTO debe tener al menos 8 caracteres.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK'
    });
  } else if (password.length < 8) {
    Swal.fire({
      icon: 'warning',
      text: 'La CONTRASEÑA debe tener al menos 8 caracteres.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK'
    });
  } else if (doc === '1004897868' && password === 'santi123' && rol === '1') {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: '¡CORRECTO!',
      showConfirmButton: false,
      timer: 2000
    }).then(() => {
      form.submit();
    });
  } else {
    // Los datos son válidos, enviar el formulario
    form.submit();
    /*Swal.fire({
      icon: 'error',
      title: 'DATOS INCORRECTOS',
      text: 'Diligencie de nuevo...',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK'
    });*/
  }
});

