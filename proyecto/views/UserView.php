<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class UserView
{
    //Metodo para mostrar el formulario para insertar un nuevo usuario 
    function showFormUser($arrayTypeDocument, $arrayRol)
    {
?>
        <div>
            <form id="insert_user">
                <!-- Nombres del usuario -->
                <div class="row">
                    <div class="form-group col">
                        <label for="nombre">Nombre(s)</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="form-group col">
                        <label for="apellido">Apellido(s)</label>
                        <input type="text" class="form-control" id="apellido" name="apellido">
                    </div>
                </div>

                <!-- Campos para el documento -->
                <div class="row">
                    <div class="col">
                        <label for="tipo_documento">Tipo de documento</label>
                        <select class="form-control" id="tipo_documento" name="tipo_documento" aria-label="Default select example">
                            <option selected>Seleccionar</option>
                            <?php
                            foreach ($arrayTypeDocument as $typeDocument) 
                            {
                                $id_doct = $typeDocument->id_doct;
                                $name_doct = $typeDocument->name_doct;
                                if($id_doct > 1)
                                {
                                ?>
                                    <option value="<?php echo $id_doct ?>"><?php echo $name_doct ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col">
                        <label for="documento">Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento">
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                

                <!-- Campos para pedir una contraseña -->
                <div class="row">
                    <div class="form-group col">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col">
                        <label for="confirmPassword">Confirmar contraseña</label>
                        </i><input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                </div>

                <!-- Ultimos campos del usuario -->
                <div class="row">
                    <div class="col">
                        <label for="">Estado</label>
                        <select class="form-control" id="estado" name="estado" aria-label="Default select example">
                            <option value="">Seleccionar</option>
                            <option value="Y">ACTIVO</option>
                            <option value="N">INACTIVO</option>
                        </select>

                    </div>
                    <div class="col">
                        <label for="">Rol</label>
                        <select class="form-control col" id="rol" name="rol" aria-label="Default select example">
                            <option selected>Seleccionar</option>
                            <?php
                            
                            foreach ($arrayRol as $rol) 
                            {
                                $id_role = $rol->id_role;
                                $name_role = $rol->name_role;
                                if($id_role <= 2)
                                {
                                    $id_role = $rol->id_role;
                                    $name_role = $rol->name_role;
                                
                                ?>
                                    <option value="<?php echo $id_role?>"><?php echo $name_role?></option>
                                <?php
                                 }
                            }
                            ?>

                        </select>
                    </div>
                </div>


                <button type="button" class="btn btn-primary float-right mt-4" onclick="generate()">
                    <i class="fas fa-save mr-2"></i> Guardar
                </button>

            </form>
        </div>
        
        <script>
            function    insertUser() 
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
        </script>

    <?php
    }
// Metodo para listar los usuarios
function paginateUsers($array_user)
{
?>
    <!-- Listado de opciones de la parte superior -->
    <div class="card">
        <div class="card-header row">
            <div class="col-4">
                <button type="button" class="btn btn-success float-left" onclick="User.showFormUser()">
                    <i class="fa-solid fa-user-plus mr-2"></i> Agregar usuario
                </button>
            </div>
        </div>
    </div>

    <!-- TABLA QUE LISTA LOS USUARIOS -->
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Usuario</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($array_user as $user) : ?>
                            <tr>
                            <?php
                                if ($user->id_role_user == '1') {
                                    $id_role_user = 'Administrador';
                                } elseif ($user->id_role_user == '2') {
                                    $id_role_user ='Secretaria';
                                } elseif ($user->id_role_user == '3') {
                                    $id_role_user = 'Acudiente';
                                } else {
                                echo 'Otro';
                                }
                            ?>
                                <td><?php echo $user->id_user; ?></td>
                                <td><?php echo $user->document_user; ?></td>
                                <td><?php echo $user->name_user . " " . $user->last_name_user; ?></td>
                                <td><?php echo ($user->state_user == 'Y') ? 'Activo' : 'Inactivo'; ?></td>
                                <td><?php echo $id_role_user?></td>
                                <td>
                                    <i class="fa-sharp fa-solid fa-pen-to-square" onclick="User.showUser('<?php echo $user->id_user; ?>');" style="color: #16a239;cursor:pointer;"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-danger mt-4" onclick="generatePDF()">
                    <i class="fa-sharp fa-solid fa-pen-to-square"></i> Generar PDF
                </button>
      
                <button type="button" class="btn btn-success mt-4" onclick="generateExcel()">
                    <i class="fa-sharp fa-solid fa-pen-to-square"></i> Generar Excel
                </button>    
                
            </div>
        </div>
    </div>
    <script>
        function generatePDF() {
            swal({
            icon: "warning",
            title: "Confirmar reporte PDF",
            text: "¿Está seguro/a de generar el PDF?",
            buttons: {
                cancel: true,
                confirm: true,
            },
            }).then((confirm) => {
            if (confirm) {
                // Realizar una solicitud para verificar si el archivo PDF existe
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'UserController/generatePDF');
                xhr.send();

                xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                    showErrorNotification('El archivo PDF ya existe.');
                    } else {
                    // Realizar una solicitud para generar y guardar el archivo PDF en el servidor
                    var generateXhr = new XMLHttpRequest();
                    generateXhr.open('POST', 'UserController/generatePDF');
                    generateXhr.setRequestHeader('Content-Type', 'application/json');

                    generateXhr.send();

                    generateXhr.onload = function () {
                        if (generateXhr.status === 200) {
                            showSuccessNotification('Archivo PDF generado y guardado con éxito.');
                        } else {
                        showErrorNotification('Error al generar y guardar el archivo PDF.');
                        }
                    };
                    }
                } else {
                    showErrorNotification('Error al verificar la existencia del archivo PDF.');
                }
                };
            }
            });
        }
        function generate() {
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

        function generateExcel() {
        swal({
            icon: "warning",
            title: "Confirmar reporte EXCEL",
            text: "¿Está seguro/a de generar el EXCEL?",
            buttons: {
            cancel: true,
            confirm: true,
            },
        }).then((confirm) => {
            if (confirm) {
            // Realizar una solicitud para verificar si el archivo Excel existe
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'UserController/generateExcel');
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.send();

            xhr.onload = function () {
                if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.exists) {
                    showErrorNotification(response.message);
                } else {
                    // Realizar una solicitud para generar y guardar el archivo Excel en el servidor
                    var generateXhr = new XMLHttpRequest();
                    generateXhr.open('POST', 'UserController/generateExcel');
                    generateXhr.setRequestHeader('Content-Type', 'application/json');

                    generateXhr.send();

                    generateXhr.onload = function () {
                    if (generateXhr.status === 200) {
                        showSuccessNotification('Archivo Excel generado y guardado con éxito.');
                    } else {
                        showErrorNotification('Error al generar y guardar el archivo Excel.');
                    }
                    };
                }
                } else {
                showErrorNotification('Error al verificar la existencia del archivo Excel.');
                }
            };
            }
        });
        }


  function showSuccessNotification(message) {
    toastr.success(message);
  }

  function showErrorNotification(message) {
    toastr.error(message);
  }
</script>

<?php
}


    //Metodo para listar los usuarios
    function paginateHistorialAccesos($array_historialAccesos)
    {
    ?>
        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="card">
            
            <div class="card-body ">

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Usuario</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Fecha de Acceso</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach ($array_historialAccesos as $user) 
                            { 
                                $id_user = $user->id_user;
                                $document_user = $user->document_user;
                                $name_user = $user->name_user . " " . $user->last_name_user;
                                $stade_user = $user->state_user;

                                if($stade_user == 'Y')
                                {
                                    $stade_user = 'Activo';
                                }else{
                                    $stade_user = 'Inactivo';
                                }

                                $id_role_user = $user->id_role_user;
                                if($id_role_user == '1')
                                {
                                    $id_role_user = 'Administrador';
                                }else 
                                {
                                    $id_role_user = 'Secretaria';
                                
                                }
                            ?>  
                                <tr>
                                    <td><?php echo $id_user ?></td>
                                    <td><?php echo $document_user ?></td>
                                    <td><?php echo $name_user ?></td>
                                    <td><?php echo $stade_user ?></td>
                                    <td><?php echo $id_role_user ?></td>
                                    <td>
                                        <i class="fa-sharp fa-solid fa-pen-to-square" onclick="User.showUser('<?php echo $id_user ?>');" style="color: #16a239;cursor:pointer;"></i>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    // Fecha de finalización en formato de tiempo Unix
                    $end_date = strtotime('2023-04-27 06:59:59');

                    // Calcula el tiempo restante en segundos
                    $remaining_time = $end_date - time();

                    // Convierte el tiempo restante a días, horas, minutos y segundos
                    $days = floor($remaining_time / (60 * 60 * 24));
                    $hours = floor(($remaining_time % (60 * 60 * 24)) / (60 * 60));
                    $minutes = floor(($remaining_time % (60 * 60)) / 60);
                    $seconds = $remaining_time % 60;

                    // Muestra el tiempo restante
                    echo "Tiempo restante: $days días, $hours horas, $minutes minutos, $seconds segundos";
                    ?>
                </div>
            </div>
        </div>

    <?php
    }
    
    //Metodo para listar los usuarios
function showManual()
{
?>
    <div class="card">
        <div class="card-body">
            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 16px;">La vista de menú</h2>
            <p style="font-size: 16px;">La vista de menú es la página principal del software y muestra un menú de opciones para que los usuarios administren diversas funcionalidades. Esta vista sigue una estructura HTML con estilos CSS y utiliza JavaScript para la interactividad. A continuación, se proporciona una explicación de los elementos clave de esta vista:</p>

            <h3 style="font-size: 20px; font-weight: bold; margin-top: 24px;">Barra de navegación</h3>
            <p style="font-size: 16px;">La vista se compone de una barra de navegación en la parte superior, que contiene botones para expandir/cerrar el menú y alternar la pantalla completa, así como un botón para mostrar el manual de usuario.</p>
            <p style="font-size: 16px;">En la esquina superior derecha de la barra de navegación, se muestra la imagen y el nombre del usuario que ha iniciado sesión. Al hacer clic en el nombre, se despliega un menú con una opción para cerrar la sesión.</p>

            <h3 style="font-size: 20px; font-weight: bold; margin-top: 24px;">Menú principal</h3>
            <p style="font-size: 16px;">El menú principal se encuentra en el panel izquierdo de la vista y contiene varias opciones, representadas por íconos y nombres. Estas opciones permiten administrar usuarios, ver el historial de accesos, gestionar solicitudes, programar horarios de entrevistas, admitir, validar documentos y matricular.</p>

            <h3 style="font-size: 20px; font-weight: bold; margin-top: 24px;">Tarjetas de información</h3>
            <p style="font-size: 16px;">En la parte central de la vista, se muestran dos tarjetas que brindan información relevante. La primera tarjeta muestra el número de usuarios registrados y la segunda tarjeta muestra el número de solicitudes recibidas.</p>

            <h3 style="font-size: 20px; font-weight: bold; margin-top: 24px;">Área de contenido principal</h3>
            <p style="font-size: 16px;">Al hacer clic en las diferentes opciones del menú, se cargará el contenido correspondiente en el área de contenido principal de la vista.</p>
        </div>
    </div>
<?php

}


    function showUser($user,$array_type_document, $array_rol)
    {
        $id_user = $user[0]->id_user;
        $name_user = $user[0]->name_user;
        $last_name_user = $user[0]->last_name_user;
        $id_doct_user = $user[0]->id_doct_user;
        $document_user = $user[0]->document_user;
        $email_user = $user[0]->email_user;
        $password_user = $user[0]->password_user;
        $state_user = $user[0]->state_user;
        $id_role_user = $user[0]->id_role_user;

    ?>
        <div>
            <form id="update_user">
                <!-- Nombres del usuario -->
                <div class="row">
                    <div class="form-group col">
                        <label for="nombre">Nombre(s)</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $name_user?>">
                    </div>
                    <div class="form-group col">
                        <label for="apellido">Apellido(s)</label>
                        <input type="text" class="form-control" id="apellido" name="apellido"  value="<?php echo $last_name_user?>">
                    </div>
                </div>

                <!-- Campos para el documento -->
                <div class="row">
                    <div class="col">
                        <label for="tipo_documento">Tipo de documento</label>
                        <select class="form-control" id="tipo_documento" name="tipo_documento" aria-label="Default select example"  >
                            <option selected>Seleccionar</option>
                            <?php
                            foreach ($array_type_document as $typeDocument) 
                            {
                                $id_doctA = $typeDocument->id_doct;
                                $name_doctA = $typeDocument->name_doct;
                                if ($id_doctA == $id_doct) 
                                {
                                ?>
                                    <option selected value="<?php echo $id_doctA?>"><?php echo $name_doctA?></option>
                                <?php
                                } else {
                                ?>
                                <option value="<?php echo $id_doctA?>"><?php echo $name_doctA?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col">
                        <label for="documento">Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento"  value="<?php echo $document_user?>">
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"  value="<?php echo $email_user?>">
                </div>
                

                <!-- Campos para pedir una contraseña -->
                <div class="row">
                    <div class="form-group col">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password"  value="<?php echo $password_user?>">
                    </div>
                    <div class="form-group col">
                        <label for="confirmPassword">Confirmar contraseña</label>
                        </i><input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                </div>

                <!-- Ultimos campos del usuario -->
                <div class="row">
                    <div class="col">
                        <label for="">Estado</label>
                        <select class="form-control" id="estado" name="estado" aria-label="Default select example">
                            <option value="">Seleccionar</option>
                            <option value="Y">ACTIVO</option>
                            <option value="N">INACTIVO</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">Rol</label>
                        <select class="form-control col" id="rol" name="rol" aria-label="Default select example"  value="<?php echo $id_rol?>">
                            <option selected>Seleccionar</option>
                            <?php
                            foreach ($array_rol as $rol) 
                            {
                                $id_roleA = $rol->id_role;
                                $name_roleA = $rol->name_role;
                                if ($id_roleA == $id_role) 
                                {
                                ?>
                                    <option selected value="<?php echo $id_roleA ?>"><?php echo $name_roleA ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $id_roleA ?>"><?php echo $name_roleA ?></option>
                                <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                        <button type="button" class="btn btn-success float-right mt-4" onclick="User.updateUser('<?php echo $id_user;?>')">
                            <i class="fa-sharp fa-solid fa-pen-to-square"></i> Actualizar
                        </button>
                        

            </form>
        </div>
<?php
    }
}
?>