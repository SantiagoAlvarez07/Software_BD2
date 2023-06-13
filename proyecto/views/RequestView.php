<?php
class RequestView
{
    //Metodo para listar los usuarios
    function paginateRequest($array_RequestTotal, $array_RequestCancel, $array_RequestAcept)
    {
    ?>
        <!-- Listado de opciones de la parte superiror -->
        
        <div class="card">
            <div class="card-header row">
                <h1 class="text-warning">PENDIENTES</h1>   
            </div>
        </div>
        

        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="card">
            
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead class="table-dark">
                            <tr>
                                <th>ITEM</th>
                                <th>Nombres Acudiente/Aspirante</th>
                                <th>Documentos</th>
                                <th>Teléfono</th>
                                <th>Grado</th>
                                <th>Condición</th>
                                <th>Agregar/Observación</th>
                                <th>Aceptar/Enviar horarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($array_RequestTotal as $Request) 
                            { 
                                $id_req = $Request->id_req ;
                                $id_curr = $Request->id_curr ;
                                $nameC_curr = $Request->name_curr . " " . $Request->last_name_curr;
                                $document_curr = $Request->document_curr;
                                $phone_curr = $Request->phone_curr;
                                $observation_req = $Request->observation_req;

                                $nameC_stud= $Request->name_stud . " " . $Request->last_name_stud;
                                $document_stud = $Request->document_stud;
                                $id_grade_stud = $Request->id_grade_stud;
                                $condition_stud = $Request->condition_stud;

                                if($id_grade_stud == '1')
                                {
                                    $id_grade_stud = 'PÁRVULOS';
                                }

                                if($id_grade_stud == '2')
                                {
                                    $id_grade_stud = 'PREJARDIN';
                                }

                                if($id_grade_stud == '3')
                                {
                                    $id_grade_stud = 'JARDIN';
                                }
                                
                                if($id_grade_stud == '4')
                                {
                                    $id_grade_stud = 'TRANSICIÓN';
                                }

                                if($id_grade_stud == '5')
                                {
                                    $id_grade_stud = 'PRIMERO';
                                }

                                if($id_grade_stud == '6')
                                {
                                    $id_grade_stud = 'SEGUNDO';
                                }

                                if($id_grade_stud == '7')
                                {
                                    $id_grade_stud = 'TERCERO';
                                }

                                if($id_grade_stud == '8')
                                {
                                    $id_grade_stud = 'CUARTO';
                                }

                                if($id_grade_stud == '9')
                                {
                                    $id_grade_stud = 'QUINTO';
                                }

                                if($id_grade_stud == '10')
                                {
                                    $id_grade_stud = 'SEXTO';
                                }

                                if($id_grade_stud == '11')
                                {
                                    $id_grade_stud = 'SÉPTIMO';
                                }

                                if($id_grade_stud == '12')
                                {
                                    $id_grade_stud = 'OCTAVO';
                                }

                                if($id_grade_stud == '13')
                                {
                                    $id_grade_stud = 'NOVENO';
                                }

                                if($id_grade_stud == '14')
                                {
                                    $id_grade_stud = 'DÉCIMO';
                                }

                                if($id_grade_stud == '15')
                                {
                                    $id_grade_stud = 'UNDÉCIMO';
                                }
                                //-------------------------------------------

                                if($condition_stud == 'Y')
                                {
                                    $condition_stud = 'Si';
                                }else 
                                {
                                    $condition_stud = 'No';
                                }
                            ?>  
                                <tr>
                                    <td><?php echo $id_req ?></td>
                                    <td><?php echo $nameC_curr;
                                            echo "<br>";
                                            echo $nameC_stud ?></td>

                                    <td><?php echo $document_curr;
                                            echo "<br>";
                                            echo $document_stud ?></td>

                                    <td><?php echo $phone_curr ?></td>
                                    <td><?php echo $id_grade_stud ?></td>
                                    <td><?php echo $condition_stud?>
                                        <i class="fa-solid fa-file-pdf" onclick="conditionPDF();" style="color: #16a239;cursor:pointer;"></i>
                                    </td>
                                    <script>
                                        function conditionPDF() 
                                        {
                                        swal({
                                            icon: "warning",
                                            title: "Descargar PDF",
                                            text: "¿Desea descargar el documento PDF?",
                                            buttons: {
                                            cancel: true,
                                            confirm: true,
                                            },
                                        }).then((confirm) => {
                                            if (confirm) {  

                                            fetch("UserController/generatePDF", {
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
                                    </script>
                                    
                                    <td><?php echo $observation_req ?>
                                    <i class="fa-sharp fa-solid fa-pen-to-square" onclick="User.showModificarRequest('<?php echo $id_req ?>');" style="color: #16a239;cursor:pointer;"></i></td>
                                    <td>
                                        <i class="fa-sharp fa-solid fa-pen-to-square" onclick="User.aceptarRequest('<?php echo $id_curr ?>');" style="color: #16a239;cursor:pointer;"></i>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header row">
                <h1 class="text-danger">CANCELADAS</h1>        
            </div>
        </div>

        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="card">
            
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead class="table-dark">
                            <tr>
                                <!--<th>ITEM</th>-->
                                <th>Nombres Acudiente/Aspirante</th>
                                <th>Documentos</th>
                                <th>Teléfono</th>
                                <th>Grado</th>
                                <th>Condición</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($array_RequestCancel as $Request) 
                            { 
                                //$id_req = $Request->id_req ;
                                $nameC_curr = $Request->name_curr . " " . $Request->last_name_curr;
                                $document_curr = $Request->document_curr;
                                $phone_curr = $Request->phone_curr;

                                $nameC_stud= $Request->name_stud . " " . $Request->last_name_stud;
                                $document_stud = $Request->document_stud;
                                $id_grade_stud = $Request->id_grade_stud;
                                $condition_stud = $Request->condition_stud;
                                $register_date = $Request->register_date;

                                if($id_grade_stud == '1')
                                {
                                    $id_grade_stud = 'PÁRVULOS';
                                }

                                if($id_grade_stud == '2')
                                {
                                    $id_grade_stud = 'PREJARDIN';
                                }

                                if($id_grade_stud == '3')
                                {
                                    $id_grade_stud = 'JARDIN';
                                }
                                
                                if($id_grade_stud == '4')
                                {
                                    $id_grade_stud = 'TRANSICIÓN';
                                }

                                if($id_grade_stud == '5')
                                {
                                    $id_grade_stud = 'PRIMERO';
                                }

                                if($id_grade_stud == '6')
                                {
                                    $id_grade_stud = 'SEGUNDO';
                                }

                                if($id_grade_stud == '7')
                                {
                                    $id_grade_stud = 'TERCERO';
                                }

                                if($id_grade_stud == '8')
                                {
                                    $id_grade_stud = 'CUARTO';
                                }

                                if($id_grade_stud == '9')
                                {
                                    $id_grade_stud = 'QUINTO';
                                }

                                if($id_grade_stud == '10')
                                {
                                    $id_grade_stud = 'SEXTO';
                                }

                                if($id_grade_stud == '11')
                                {
                                    $id_grade_stud = 'SÉPTIMO';
                                }

                                if($id_grade_stud == '12')
                                {
                                    $id_grade_stud = 'OCTAVO';
                                }

                                if($id_grade_stud == '13')
                                {
                                    $id_grade_stud = 'NOVENO';
                                }

                                if($id_grade_stud == '14')
                                {
                                    $id_grade_stud = 'DÉCIMO';
                                }

                                if($id_grade_stud == '15')
                                {
                                    $id_grade_stud = 'UNDÉCIMO';
                                }
                                //-------------------------------------------

                                if($condition_stud == 'Y')
                                {
                                    $condition_stud = 'Si';
                                }else 
                                {
                                    $condition_stud = 'No';
                                }
                            ?>  
                                <tr>
                                    <!--<td><?php echo $id_req ?></td>-->
                                    <td><?php echo $nameC_curr;
                                            echo "<br>";
                                            echo $nameC_stud ?></td>

                                    <td><?php echo $document_curr;
                                            echo "<br>";
                                            echo $document_stud ?></td>

                                    <td><?php echo $phone_curr ?></td>
                                    <td><?php echo $id_grade_stud ?></td>
                                    <td><?php echo $condition_stud?></td>
                                    <td><?php echo $register_date?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header row">
                <h1 class="text-success">ACEPTADAS</h1>        
            </div>
        </div>

        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="card">
            
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead class="table-dark">
                            <tr>
                                <!--<th>ITEM</th>-->
                                <th>Nombres Acudiente/Aspirante</th>
                                <th>Documentos</th>
                                <th>Teléfono</th>
                                <th>Grado</th>
                                <th>Condición</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($array_RequestAcept as $Request) 
                            { 
                                //$id_req = $Request->id_req ;
                                $nameC_curr = $Request->name_curr . " " . $Request->last_name_curr;
                                $document_curr = $Request->document_curr;
                                $phone_curr = $Request->phone_curr;

                                $nameC_stud= $Request->name_stud . " " . $Request->last_name_stud;
                                $document_stud = $Request->document_stud;
                                $id_grade_stud = $Request->id_grade_stud;
                                $condition_stud = $Request->condition_stud;

                                if($id_grade_stud == '1')
                                {
                                    $id_grade_stud = 'PÁRVULOS';
                                }

                                if($id_grade_stud == '2')
                                {
                                    $id_grade_stud = 'PREJARDIN';
                                }

                                if($id_grade_stud == '3')
                                {
                                    $id_grade_stud = 'JARDIN';
                                }
                                
                                if($id_grade_stud == '4')
                                {
                                    $id_grade_stud = 'TRANSICIÓN';
                                }

                                if($id_grade_stud == '5')
                                {
                                    $id_grade_stud = 'PRIMERO';
                                }

                                if($id_grade_stud == '6')
                                {
                                    $id_grade_stud = 'SEGUNDO';
                                }

                                if($id_grade_stud == '7')
                                {
                                    $id_grade_stud = 'TERCERO';
                                }

                                if($id_grade_stud == '8')
                                {
                                    $id_grade_stud = 'CUARTO';
                                }

                                if($id_grade_stud == '9')
                                {
                                    $id_grade_stud = 'QUINTO';
                                }

                                if($id_grade_stud == '10')
                                {
                                    $id_grade_stud = 'SEXTO';
                                }

                                if($id_grade_stud == '11')
                                {
                                    $id_grade_stud = 'SÉPTIMO';
                                }

                                if($id_grade_stud == '12')
                                {
                                    $id_grade_stud = 'OCTAVO';
                                }

                                if($id_grade_stud == '13')
                                {
                                    $id_grade_stud = 'NOVENO';
                                }

                                if($id_grade_stud == '14')
                                {
                                    $id_grade_stud = 'DÉCIMO';
                                }

                                if($id_grade_stud == '15')
                                {
                                    $id_grade_stud = 'UNDÉCIMO';
                                }
                                //-------------------------------------------

                                if($condition_stud == 'Y')
                                {
                                    $condition_stud = 'Si';
                                }else 
                                {
                                    $condition_stud = 'No';
                                }
                                
                            ?>  
                                <tr>
                                    <!--<td><?php echo $id_req ?></td>-->
                                    <td><?php echo $nameC_curr;
                                            echo "<br>";
                                            echo $nameC_stud ?></td>

                                    <td><?php echo $document_curr;
                                            echo "<br>";
                                            echo $document_stud ?></td>

                                    <td><?php echo $phone_curr ?></td>
                                    <td><?php echo $id_grade_stud ?></td>
                                    <td><?php echo $condition_stud?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    }


//Metodo para listar los usuarios
function paginateRequestCurrent($array_RequestCurrent)
{
    // Obtener el tiempo restante almacenado en localStorage, si existe
    $remaining_time = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : null;

    // Verificar si el tiempo restante no está almacenado o ya ha finalizado
    if ($remaining_time === null || $remaining_time <= 0) {
        // Calcular la fecha de finalización sumando 5 horas al tiempo actual
        $end_date = strtotime('+12 hours');

        $remaining_time = $end_date - time();

        // Almacenar el tiempo restante en localStorage
        $_SESSION['remaining_time'] = $remaining_time;
    }

    // Verificar si la cuenta regresiva ha finalizado
    if ($remaining_time <= 0) {
        
        echo "La cuenta regresiva ha finalizado.";
        return;
    }

    // Calcular los valores de días, horas, minutos y segundos restantes
    $days = floor($remaining_time / (60 * 60 * 24));
    $hours = floor(($remaining_time % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($remaining_time % (60 * 60)) / 60);
    $seconds = $remaining_time % 60;

    
?>

    <!-- TABLA QUE LISTA LOS USUARIOS -->
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombres Acudiente/Aspirante</th>
                            <th>Documentos</th>
                            <th>Teléfono</th>
                            <th>Grado</th>
                            <th>Condición</th>
                            <th>Estado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($array_RequestCurrent as $Request) 
                        { 
                            $id_req = $Request->id_req;
                            $nameC_curr = $Request->name_curr . " " . $Request->last_name_curr;
                            $document_curr = $Request->document_curr;
                            $phone_curr = $Request->phone_curr;

                            $nameC_stud= $Request->name_stud . " " . $Request->last_name_stud;
                            $document_stud = $Request->document_stud;
                            $id_grade_stud = $Request->id_grade_stud;
                            $condition_stud = $Request->condition_stud;
                            $state_req = $Request->state_req;
                            $observation_req = $Request->observation_req;

                            if($id_grade_stud == '1')
                                {
                                    $id_grade_stud = 'PÁRVULOS';
                                }

                                if($id_grade_stud == '2')
                                {
                                    $id_grade_stud = 'PREJARDIN';
                                }

                                if($id_grade_stud == '3')
                                {
                                    $id_grade_stud = 'JARDIN';
                                }
                                
                                if($id_grade_stud == '4')
                                {
                                    $id_grade_stud = 'TRANSICIÓN';
                                }

                                if($id_grade_stud == '5')
                                {
                                    $id_grade_stud = 'PRIMERO';
                                }

                                if($id_grade_stud == '6')
                                {
                                    $id_grade_stud = 'SEGUNDO';
                                }

                                if($id_grade_stud == '7')
                                {
                                    $id_grade_stud = 'TERCERO';
                                }

                                if($id_grade_stud == '8')
                                {
                                    $id_grade_stud = 'CUARTO';
                                }

                                if($id_grade_stud == '9')
                                {
                                    $id_grade_stud = 'QUINTO';
                                }

                                if($id_grade_stud == '10')
                                {
                                    $id_grade_stud = 'SEXTO';
                                }

                                if($id_grade_stud == '11')
                                {
                                    $id_grade_stud = 'SÉPTIMO';
                                }

                                if($id_grade_stud == '12')
                                {
                                    $id_grade_stud = 'OCTAVO';
                                }

                                if($id_grade_stud == '13')
                                {
                                    $id_grade_stud = 'NOVENO';
                                }

                                if($id_grade_stud == '14')
                                {
                                    $id_grade_stud = 'DÉCIMO';
                                }

                                if($id_grade_stud == '15')
                                {
                                    $id_grade_stud = 'UNDÉCIMO';
                                }
                                //-------------------------------------------
                                if($condition_stud == 'Y')
                                {
                                    $condition_stud = 'Si';
                                }else 
                                {
                                    $condition_stud = 'No';
                                }
                                //-------------------------------------------
                                if ($state_req == 'Y') {
                                    $state_req = '<span style="color: green;">ADMITIDO</span>';
                                } else {
                                    if ($state_req == 'N') {
                                        $state_req = '<span style="color: red;">RECHAZADA</span>';
                                    } else {
                                        $state_req = '<span style="color: orange;">PENDIENTE</span>';
                                    }
                                }
                                
                        ?>  
                            <tr>
                                <td><?php echo $nameC_curr;
                                        echo "<br>";
                                        echo $nameC_stud ?></td>

                                <td><?php echo $document_curr;
                                        echo "<br>";
                                        echo $document_stud ?></td>

                                <td><?php echo $phone_curr ?></td>
                                <td><?php echo $id_grade_stud ?></td>
                                <td><?php echo $condition_stud?></td>
                                <td ><?php echo $state_req?></td>
                                <td><?php echo $observation_req?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <div class="card">
                    <div class="card-body ">
                        
                    </div>
                    <div id="countdown">Tiempo restante: <span id="countdown-timer"><?php echo "$days días, $hours horas, $minutes minutos, $seconds segundos"; ?></span></div>
                </div>
                
                <button type="button" class="btn btn-lg btn-danger" onclick="Request.cancelRequest('<?php echo $id_req ?>');">
                    <i class="fa-solid fa-users-gear"></i>  
                    <p class="text-light">Cancelar Solicitud</p>
                </button>     
            </div>
        </div>
    </div>
    <script>
        // Función para actualizar el contador
        function updateCountdown() {
            // Obtener el elemento HTML del contador
            var countdownTimer = document.getElementById('countdown-timer');

            // Obtener el tiempo restante del contador
            var remainingTime = countdownTimer.textContent;

            // Convertir el tiempo restante en segundos
            var timeArray = remainingTime.split(' ');
            var days = parseInt(timeArray[0]);
            var hours = parseInt(timeArray[2]);
            var minutes = parseInt(timeArray[4]);
            var seconds = parseInt(timeArray[6]);
            var totalSeconds = days * 24 * 60 * 60 + hours * 60 * 60 + minutes * 60 + seconds;

            // Verificar si la cuenta regresiva ha finalizado
            if (totalSeconds <= 0) {
                countdownTimer.textContent = "La cuenta regresiva ha finalizado.";
                return;
            }

            // Actualizar el contador restando un segundo
            totalSeconds -= 1;

            // Calcular los nuevos valores de días, horas, minutos y segundos
            days = Math.floor(totalSeconds / (24 * 60 * 60));
            hours = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
            minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
            seconds = totalSeconds % 60;

            // Actualizar el contenido del contador
            countdownTimer.textContent = days + " días, " + hours + " horas, " + minutes + " minutos, " + seconds + " segundos";

            // Almacenar el tiempo restante en localStorage
            localStorage.setItem('remaining_time', totalSeconds);

             // Actualizar el contador cada segundo
             setTimeout(updateCountdown, 1000);
        }

        // Iniciar la actualización del contador al cargar la página
        updateCountdown();
    </script>

     
<?php
}
//Metodo para listar los usuarios
function paginateRequestCurrent_mod($array_RequestCurrent)
{
    // Obtener el tiempo restante almacenado en localStorage, si existe
    $remaining_time = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : null;

    // Verificar si el tiempo restante no está almacenado o ya ha finalizado
    if ($remaining_time === null || $remaining_time <= 0) {
        // Calcular la fecha de finalización sumando 5 horas al tiempo actual
        $end_date = strtotime('+12 hours');

        $remaining_time = $end_date - time();

        // Almacenar el tiempo restante en localStorage
        $_SESSION['remaining_time'] = $remaining_time;
    }

    // Verificar si la cuenta regresiva ha finalizado
    if ($remaining_time <= 0) {
        
        echo "La cuenta regresiva ha finalizado.";
        return;
    }

    // Calcular los valores de días, horas, minutos y segundos restantes
    $days = floor($remaining_time / (60 * 60 * 24));
    $hours = floor(($remaining_time % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($remaining_time % (60 * 60)) / 60);
    $seconds = $remaining_time % 60;

    
?>

    <!-- TABLA QUE LISTA LOS USUARIOS -->
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombres Acudiente/Aspirante</th>
                            <th>Documentos</th>
                            <th>Teléfono</th>
                            <th>Grado</th>
                            <th>Condición</th>
                            <th>Estado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($array_RequestCurrent as $Request) 
                        { 
                            $id_req = $Request->id_req;
                            $nameC_curr = $Request->name_curr . " " . $Request->last_name_curr;
                            $document_curr = $Request->document_curr;
                            $phone_curr = $Request->phone_curr;

                            $nameC_stud= $Request->name_stud . " " . $Request->last_name_stud;
                            $document_stud = $Request->document_stud;
                            $id_grade_stud = $Request->id_grade_stud;
                            $condition_stud = $Request->condition_stud;
                            $state_req = $Request->state_req;
                            $observation_req = $Request->observation_req;

                            if($id_grade_stud == '1')
                                {
                                    $id_grade_stud = 'PÁRVULOS';
                                }

                                if($id_grade_stud == '2')
                                {
                                    $id_grade_stud = 'PREJARDIN';
                                }

                                if($id_grade_stud == '3')
                                {
                                    $id_grade_stud = 'JARDIN';
                                }
                                
                                if($id_grade_stud == '4')
                                {
                                    $id_grade_stud = 'TRANSICIÓN';
                                }

                                if($id_grade_stud == '5')
                                {
                                    $id_grade_stud = 'PRIMERO';
                                }

                                if($id_grade_stud == '6')
                                {
                                    $id_grade_stud = 'SEGUNDO';
                                }

                                if($id_grade_stud == '7')
                                {
                                    $id_grade_stud = 'TERCERO';
                                }

                                if($id_grade_stud == '8')
                                {
                                    $id_grade_stud = 'CUARTO';
                                }

                                if($id_grade_stud == '9')
                                {
                                    $id_grade_stud = 'QUINTO';
                                }

                                if($id_grade_stud == '10')
                                {
                                    $id_grade_stud = 'SEXTO';
                                }

                                if($id_grade_stud == '11')
                                {
                                    $id_grade_stud = 'SÉPTIMO';
                                }

                                if($id_grade_stud == '12')
                                {
                                    $id_grade_stud = 'OCTAVO';
                                }

                                if($id_grade_stud == '13')
                                {
                                    $id_grade_stud = 'NOVENO';
                                }

                                if($id_grade_stud == '14')
                                {
                                    $id_grade_stud = 'DÉCIMO';
                                }

                                if($id_grade_stud == '15')
                                {
                                    $id_grade_stud = 'UNDÉCIMO';
                                }
                                //-------------------------------------------
                                if($condition_stud == 'Y')
                                {
                                    $condition_stud = 'Si';
                                }else 
                                {
                                    $condition_stud = 'No';
                                }
                                //-------------------------------------------
                                if ($state_req == 'Y') {
                                    $state_req = '<span style="color: green;">ADMITIDO</span>';
                                } else {
                                    if ($state_req == 'N') {
                                        $state_req = '<span style="color: red;">RECHAZADA</span>';
                                    } else {
                                        $state_req = '<span style="color: orange;">PENDIENTE</span>';
                                    }
                                }
                                
                        ?>  
                            <tr>
                                <td><?php echo $nameC_curr;
                                        echo "<br>";
                                        echo $nameC_stud ?></td>

                                <td><?php echo $document_curr;
                                        echo "<br>";
                                        echo $document_stud ?></td>

                                <td><?php echo $phone_curr ?></td>
                                <td><?php echo $id_grade_stud ?></td>
                                <td><?php echo $condition_stud?></td>
                                <td ><?php echo $state_req?></td>
                                <td><?php echo $observation_req?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <div class="card">
                    <div class="card-body ">
                    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">    
                        <div class="card">
                            <div class="card-body ">                
                                        <div class="row">
                                            <!-- Campo - Hora -->
                                            <div class="col">
                                                <label for="hour">Subir archivo modificado</label> 
                                                </br>
                                                <input type="file" id='condition_document_stud' name="condition_document_stud"></input>
                                            </div>
                                        </div>
                            </div>        
                        </div>  
                    </div>
                    <button type="button" class="btn btn-lg btn-success" onclick="">
                        <i class="fa-solid fa-users-gear"></i>  
                        <p class="text-light">Enviar</p>
                    </button> 
                    <button type="button" class="btn btn-lg btn-danger" onclick="Request.cancelRequest('<?php echo $id_req ?>');">
                        <i class="fa-solid fa-users-gear"></i>  
                        <p class="text-light">Cancelar Solicitud</p>
                    </button> 
                    <div id="countdown">Tiempo restante: <span id="countdown-timer"><?php echo "$days días, $hours horas, $minutes minutos, $seconds segundos"; ?></span></div>
                </div>
                
                    
            </div>
        </div>
    </div>
    <script>
        // Función para actualizar el contador
        function updateCountdown() {
            // Obtener el elemento HTML del contador
            var countdownTimer = document.getElementById('countdown-timer');

            // Obtener el tiempo restante del contador
            var remainingTime = countdownTimer.textContent;

            // Convertir el tiempo restante en segundos
            var timeArray = remainingTime.split(' ');
            var days = parseInt(timeArray[0]);
            var hours = parseInt(timeArray[2]);
            var minutes = parseInt(timeArray[4]);
            var seconds = parseInt(timeArray[6]);
            var totalSeconds = days * 24 * 60 * 60 + hours * 60 * 60 + minutes * 60 + seconds;

            // Verificar si la cuenta regresiva ha finalizado
            if (totalSeconds <= 0) {
                countdownTimer.textContent = "La cuenta regresiva ha finalizado.";
                return;
            }

            // Actualizar el contador restando un segundo
            totalSeconds -= 1;

            // Calcular los nuevos valores de días, horas, minutos y segundos
            days = Math.floor(totalSeconds / (24 * 60 * 60));
            hours = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
            minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
            seconds = totalSeconds % 60;

            // Actualizar el contenido del contador
            countdownTimer.textContent = days + " días, " + hours + " horas, " + minutes + " minutos, " + seconds + " segundos";

            // Almacenar el tiempo restante en localStorage
            localStorage.setItem('remaining_time', totalSeconds);

             // Actualizar el contador cada segundo
             setTimeout(updateCountdown, 1000);
        }

        // Iniciar la actualización del contador al cargar la página
        updateCountdown();
    </script>

     
<?php
}
//Metodo para listar los usuarios
function paginateRequestCurrent_acep($array_RequestCurrent)
{
    // Obtener el tiempo restante almacenado en localStorage, si existe
    $remaining_time = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : null;

    // Verificar si el tiempo restante no está almacenado o ya ha finalizado
    if ($remaining_time === null || $remaining_time <= 0) {
        // Calcular la fecha de finalización sumando 5 horas al tiempo actual
        $end_date = strtotime('+12 hours');

        $remaining_time = $end_date - time();

        // Almacenar el tiempo restante en localStorage
        $_SESSION['remaining_time'] = $remaining_time;
    }

    // Verificar si la cuenta regresiva ha finalizado
    if ($remaining_time <= 0) {
        
        echo "La cuenta regresiva ha finalizado.";
        return;
    }

    // Calcular los valores de días, horas, minutos y segundos restantes
    $days = floor($remaining_time / (60 * 60 * 24));
    $hours = floor(($remaining_time % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($remaining_time % (60 * 60)) / 60);
    $seconds = $remaining_time % 60;

    
?>

    <!-- TABLA QUE LISTA LOS USUARIOS -->
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombres Acudiente/Aspirante</th>
                            <th>Documentos</th>
                            <th>Teléfono</th>
                            <th>Grado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($array_RequestCurrent as $Request) 
                        { 
                            $id_req = $Request->id_req;
                            $nameC_curr = $Request->name_curr . " " . $Request->last_name_curr;
                            $document_curr = $Request->document_curr;
                            $phone_curr = $Request->phone_curr;

                            $nameC_stud= $Request->name_stud . " " . $Request->last_name_stud;
                            $document_stud = $Request->document_stud;
                            $id_grade_stud = $Request->id_grade_stud;
                            $condition_stud = $Request->condition_stud;
                            $state_req = $Request->state_req;
                            $observation_req = $Request->observation_req;

                            if($id_grade_stud == '1')
                                {
                                    $id_grade_stud = 'PÁRVULOS';
                                }

                                if($id_grade_stud == '2')
                                {
                                    $id_grade_stud = 'PREJARDIN';
                                }

                                if($id_grade_stud == '3')
                                {
                                    $id_grade_stud = 'JARDIN';
                                }
                                
                                if($id_grade_stud == '4')
                                {
                                    $id_grade_stud = 'TRANSICIÓN';
                                }

                                if($id_grade_stud == '5')
                                {
                                    $id_grade_stud = 'PRIMERO';
                                }

                                if($id_grade_stud == '6')
                                {
                                    $id_grade_stud = 'SEGUNDO';
                                }

                                if($id_grade_stud == '7')
                                {
                                    $id_grade_stud = 'TERCERO';
                                }

                                if($id_grade_stud == '8')
                                {
                                    $id_grade_stud = 'CUARTO';
                                }

                                if($id_grade_stud == '9')
                                {
                                    $id_grade_stud = 'QUINTO';
                                }

                                if($id_grade_stud == '10')
                                {
                                    $id_grade_stud = 'SEXTO';
                                }

                                if($id_grade_stud == '11')
                                {
                                    $id_grade_stud = 'SÉPTIMO';
                                }

                                if($id_grade_stud == '12')
                                {
                                    $id_grade_stud = 'OCTAVO';
                                }

                                if($id_grade_stud == '13')
                                {
                                    $id_grade_stud = 'NOVENO';
                                }

                                if($id_grade_stud == '14')
                                {
                                    $id_grade_stud = 'DÉCIMO';
                                }

                                if($id_grade_stud == '15')
                                {
                                    $id_grade_stud = 'UNDÉCIMO';
                                }
                                //-------------------------------------------
                                if($condition_stud == 'Y')
                                {
                                    $condition_stud = 'Si';
                                }else 
                                {
                                    $condition_stud = 'No';
                                }
                                //-------------------------------------------
                                if ($state_req == 'Y') {
                                    $state_req = '<span style="color: green;">ADMITIDO</span>';
                                } else {
                                    if ($state_req == 'N') {
                                        $state_req = '<span style="color: red;">RECHAZADA</span>';
                                    } else {
                                        $state_req = '<span style="color: orange;">PENDIENTE</span>';
                                    }
                                }
                                
                        ?>  
                            <tr>
                                <td><?php echo $nameC_curr;
                                        echo "<br>";
                                        echo $nameC_stud ?></td>

                                <td><?php echo $document_curr;
                                        echo "<br>";
                                        echo $document_stud ?></td>

                                <td><?php echo $phone_curr ?></td>
                                <td><?php echo $id_grade_stud ?></td>
                                <td ><?php echo $state_req?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    <button type="button" class="btn btn-lg btn-primary"  onclick="Menu.closeSession()">
                        <i class="fa-solid fa-users-gear"></i>  
                        <p class="text-light">Continuar Proceso</p>
                    </button> 

                    <button type="button" class="btn btn-lg btn-success"  onclick="Menu.menu('RequestController/paginateRequestSpace')">
                        <i class="fa-solid fa-users-gear"></i>  
                        <p class="text-light">Nueva solicitud</p>
                    </button> 
            </div>
        </div>
    </div> 
<?php
}
    //Metodo para listar los usuarios
function paginateRequestSpace()
{
?>
    <div class="wpb_single_image wpb_content_element vc_align_center  wpb_animate_when_almost_visible wpb_bounceInLeft bounceInLeft">
        <h5 class="featurette-heading">Solicite un cupo escolar para ESTUDIANTES NUEVOS en cinco(5) sencillos pasos: <span class="text-muted"></span></h5>
    </div>

    <!-- TABLA PARA INFORMACIÓN CUPO -->
    <div class="card">
        <div class="card-body ">
            <div class="row featurette">
                <div class="col-md-5">
                    <br></br>
                    <br></br>
                    <br></br>
                    <h4 class="text-info">REQUISITOS DEL TRÁMITE</h4>
                    <a class="bd-placeholder-img" href=""></a><center><img src="img/icon_requisitos.png" height="100px" width="80x"></center></a>
                </div> 
                
                <div class="col-md-7">
                    <div class="row featurette">
                    <a class="bd-placeholder-img" href=""></a><center><img src="img/icon_requisitos_info.png" height="400x" width="650"></center></a>
                    </div>  
                </div>
                 
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body ">
            <div class="row featurette">
                <div class="col-md-5">
                    <button type="button" href="" class="btn btn-lg btn-primary" onclick="Request.showFormRequest()">
                        <i class="fa-solid fa-users-gear"></i>  
                        <p class="text-light">Solicitar Cupo</p>
                    </button> 
                </div> 
                
                <div class="col-md-7">
                    <button type="button" href="" class="btn btn-lg btn-success" onclick="Menu.closeSession()">
                        <i class="fa-solid fa-users-gear"></i>  
                        <p class="text-light">Continuar Proceso</p>
                    </button>    
                </div>
                 
            </div>
        </div>
    </div>   
<?php
}

    function showFormRequest($arrayDocumentType, $arrayGrade)
    {
?>
                        <div>
                            <h3>Datos acudiente</h3><br>
                            <div class="form-request"> 
                            <form class="form" id='insert_request'>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                          <!-- Nombres del usuario -->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="name_curr" name="name_curr" placeholder="Nombre(s)">
                                                <input type="text" class="form-control" id="last_name_curr" name="last_name_curr" placeholder="Apellido(s)">
                                            </div>
                                        </div>

                                        <!-- Campos para el documento -->
                                        <div class="col">
                                          <select class="form-select fieldlabels" id="documentType_curr" name="documentType_curr" aria-label="Default select example">
                                              <option selected>Tipo de documento</option>
                                              
                                              <?php
                                              foreach ($arrayDocumentType as $DocumentType) 
                                              {
                                                  $id_doct = $DocumentType->id_doct;
                                                  $name_doct = $DocumentType->name_doct;
                                                  if($id_doct > 1)
                                                  {
                                                  ?>
                                                      <option value="<?php echo $id_doct ?>"><?php echo $name_doct ?></option>
                                                  <?php
                                                  }
                                              }
                                              ?>
                                          </select>
                                          <input type="text" class="form-control" id="document_curr" name="document_curr" placeholder="Documento">
                                        </div>

                                        <div class="col">
                                          <div class="mb-3">
                                              <input type="text" class="form-control" id="phone_curr" name="phone_curr" placeholder="Telefono">
                                              <input type="email" class="form-control" id="email_curr" name="email_curr" placeholder="Email">
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                
                                <h3>Datos aspirante</h3><br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                          <input type="text" class="form-control" id="name_stud" name="name_stud" placeholder="Nombre(s)">
                                          <input type="text" class="form-control" id="last_name_stud" name="last_name_stud" placeholder="Apellido(s)">
                                        </div>
                                        <div class="col">
                                          <select class="form-select fieldlabels" id="documentType_stud" name="documentType_stud" aria-label="Default select example">
                                            <option selected>Tipo de documento</option>
                                            
                                            <?php
                                            foreach ($arrayDocumentType as $DocumentType) 
                                            {
                                                $id_doct = $DocumentType->id_doct;
                                                $name_doct = $DocumentType->name_doct;
                                                ?>
                                                    <option value="<?php echo $id_doct ?>"><?php echo $name_doct ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                            <input type="text" class="form-control" id="document_stud" name="document_stud" placeholder="Documento">
                                        </div>
                                        <div class="col">
                                            <center>
                                                
                                                
                                              <select class="form-select fieldlabels" id='grade_stud' name="grade_stud" aria-label="Default select example">
                                                <option selected>Grado a cursar</option>
                                                <?php
                                                foreach ($arrayGrade as $grade) 
                                                {
                                                    $id_grade = $grade->id_grade;
                                                    $name_grade = $grade->name_grade;
                                                    ?>
                                                    <option value="<?php echo $id_grade ?>"><?php echo $name_grade ?></option>
                                                    <?php
                                                }
                                                ?>
                                              </select>
                                            </center>
                                        </div>
                                        <div class="col">
                                            <center>
                                              <h5>Condición</h5>
                                                <div class="continer">
                                                    <div class="row">
                                                        <div class="col">
                                                          
                                                        <select class="form-select fieldlabels" id='condition_stud' name="condition_stud" aria-label="Default select example">
                                                            <option selected>Seleccionar</option>
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                            <input type="file" id="condition_document_stud" name="condition_document_stud"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    
                                </div>
                                <button type="button" class="btn btn-lg btn-primary" onclick="Request.insertRequest()">
                                    <i class="fas fa-save mr-2"></i> Enviar
                                </button>
                                
                            </form>
                            </div>
                        </div>

</html>

<?php 
    }
    //--------------------------------------------------------------------
    //Método para mostrar un horario seleccionado
    function showModificarRequest($array_request)
    {
        $id_req = $array_request[0]->id_req;
        $observation_req = $array_request[0]->observation_req;
    ?>
        <div>
            <form id="update_request_mod">
                <div class="row">
                    <!-- Campo - Fecha -->
                    <div class="form-group col">
                        <label for="observation">Observación</label>
                        <input type="text" class="form-control" id="observation_req" name="observation_req" value="<?php echo $observation_req?>">
                    </div> 
                </div>
                    
    
                </br>
                <button type="button" class="btn btn-success float-right mt-4" onclick="Request.updateRequest_Acu('<?php echo $id_req?>')">
                    <i class="fa-sharp fa-solid fa-pen-to-square"></i> Actualizar
                </button>
    
            </form>
        </div>
<?php
    }

}
?>