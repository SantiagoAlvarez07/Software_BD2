<?php

class InterviewView
{
    //Metodo para listar los usuarios
    function paginateFormSchedule($array_schedule, $array_hour, $array_interview)
    {
?>
        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="row">
            <div class="col-xl-7 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body ">

                        <div class="table">
                            <table class="table table-striped ">
                                <thead class="table-dark">
                                    <tr>
                                        <!--<th>Día</th>-->
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Acci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($array_schedule as $schedule) 
                                    { 
                                        $id_sche = $schedule->id_sche;
                                        $date_sche = $schedule->date_sche;
                                        $id_hour_sche = $schedule->id_hour_sche;

                                        //-------------------------------------------
                                        

                                        if($id_hour_sche == '1')
                                        {
                                            $id_hour_sche = '08:00 - 09:00';
                                        }
                                        
                                        if($id_hour_sche == '2')
                                        {
                                            $id_hour_sche = '09:00 - 10:00';
                                        }

                                        if($id_hour_sche == '3')
                                        {
                                            $id_hour_sche = '10:00 - 11:00';
                                        }

                                        if($id_hour_sche== '4')
                                        {
                                            $id_hour_sche = '11:00 - 12:00';
                                        }

                                        if($id_hour_sche == '5')
                                        {
                                            $id_hour_sche = '02:00 - 03:00';
                                        }

                                        if($id_hour_sche == '6')
                                        {
                                            $id_hour_sche = '03:00 - 04:00';
                                        }

                                        if($id_hour_sche == '7')
                                        {
                                            $id_hour_sche = '04:00 - 05:00';
                                        }

                                        if($id_hour_sche == '8')
                                        {
                                            $id_hour_sche = '05:00 - 06:00';
                                        }
                                    ?>  
                                        <tr>
                                            
                                            <td><?php echo $date_sche ?></td>
                                            <td><?php echo $id_hour_sche ?></td>
                                            <td>
                                                <i class="fa-sharp fa-solid fa-pen-to-square" onclick="Interview.showSchedule('<?php echo $id_sche ?>');" style="color: #16a239;cursor:pointer;"></i>
                                                <i class="fa-solid fa-trash" onclick="Interview.deleteSchedule('<?php echo $id_sche ?>');" style="color: #b32323;cursor:pointer;"></i>
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
            </div>

            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">    
                <div class="card">
                    <div class="card-body ">                
                    
                        <div class="form-signin"> 
                            <form id="insert_schedule">
                                    
                                <div class="row">
                                    <!-- Campo - Fecha -->
                                    <div class="form-group col">
                                        <label for="date">Fecha</label>
                                        <input type="date" class="form-control" id="date" name="date">
                                    </div> 
                                </div>
                            
                                <div class="row">
                                    <!-- Campo - Hora -->
                                    <div class="col">
                                        <label for="hour">Hora</label> 
                                        <select class="form-select" id='hour_sche' name='hour_sche' aria-label="Default select example">
                                            <option selected>Seleccionar</option>
                                            <?php
                                             foreach ($array_hour as $day) 
                                             { 
                                                $id_hour =  $day-> id_hour;
                                                $name_hour = $day->name_hour;
                                                ?>
                                                    <option value="<?php echo $id_hour ?>"><?php echo $name_hour ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                </br>
                                <button type="button" class="btn btn-success float-left" onclick="Interview.insertSchedule()">
                                    <i class="fa-sharp fa-solid fa-calendar-days"></i> Agregar horario
                                </button>

                            </form>
                        </div>        
                    </div>        
                </div>        
            </div>        
        </div>
        <div class="card">
                        <div class="card-body ">
                        
                            <div class="table">
                                <table class="table table-striped ">
                                    <thead class="table-dark">
                                        <tr>
                                            <!--<th>Día</th>-->
                                            <th>Nombres Acudiente/Aspirante</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($array_interview as $interview) 
                                        { 
                                            $id_inter = $interview->id_inter;
                                            $date_sche = $interview->date_sche;
                                            $id_hour_sche = $interview->id_hour_sche;
                                            $state_inter = $interview->state_inter;
                                            $observation_inter = $interview->observation_inter;

                                                //-------------------------------------------
                                                foreach($array_interview as $user)
                                        {
                                            $name_user = $user->name_user;
                                            $date_sche = $user->date_sche;
                                            $id_hour_sche = $user->id_hour_sche;
                                        
                                                if($id_hour_sche == '1')
                                                {
                                                    $id_hour_sche = '08:00 - 09:00';
                                                }
                                                
                                                if($id_hour_sche == '2')
                                                {
                                                    $id_hour_sche = '09:00 - 10:00';
                                                }
        
                                                if($id_hour_sche == '3')
                                                {
                                                    $id_hour_sche = '10:00 - 11:00';
                                                }
        
                                                if($id_hour_sche== '4')
                                                {
                                                    $id_hour_sche = '11:00 - 12:00';
                                                }
        
                                                if($id_hour_sche == '5')
                                                {
                                                    $id_hour_sche = '02:00 - 03:00';
                                                }
        
                                                if($id_hour_sche == '6')
                                                {
                                                    $id_hour_sche = '03:00 - 04:00';
                                                }
        
                                                if($id_hour_sche == '7')
                                                {
                                                    $id_hour_sche = '04:00 - 05:00';
                                                }
        
                                                if($id_hour_sche == '8')
                                                {
                                                    $id_hour_sche = '05:00 - 06:00';
                                                }
                                            if ($state_inter == 'P') {
                                                $state_inter = '<span style="color: orange;">PENDIENTE</span>';
                                            } elseif ($state_inter == 'Y') {
                                                $state_inter = '<span style="color: green;">ACEPTADA</span>';
                                            } elseif ($state_inter == 'N') {
                                                $state_inter = '<span style="color: red;">RECHAZADA</span>';
                                            }
                                            
                                            
                                        ?>  
                                            <tr>
                                                <td><?php echo $name_user ?></td>
                                                <td><?php echo $date_sche ?></td>
                                                <td><?php echo $id_hour_sche ?></td>
                                                <td><?php echo $state_inter ?></td>
                                                
                                            </tr>
                                        <?php
                                        
                                    }}
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
    <?php
    }
    //Metodo para listar los usuarios
        function paginateSchedule($array_schedule, $array_hour, $array_user)
{
    ?>
    <!-- TABLA QUE LISTA LOS USUARIOS -->
    <div class="form-signin"> 
        <form id="insert_interview">
            <div class="row">
                <div class="col-xl-7 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body ">
                            <div class="table">
                                <table class="table table-striped ">
                                    <thead class="table-dark">
                                        <tr>
                                            <!--<th>Día</th>-->
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($array_schedule as $schedule) 
                                        { 
                                            $id_sche = $schedule->id_sche;
                                            $date_sche = $schedule->date_sche;
                                            $id_hour_sche = $schedule->id_hour_sche;

                                            foreach ($array_user as $user) 
                                            { 
                                                $id_user = $user->id_user;

                                                //-------------------------------------------

                                                if($id_hour_sche == '1')
                                                {
                                                    $id_hour_sche = '08:00 - 09:00';
                                                }

                                                if($id_hour_sche == '2')
                                                {
                                                    $id_hour_sche = '09:00 - 10:00';
                                                }

                                                if($id_hour_sche == '3')
                                                {
                                                    $id_hour_sche = '10:00 - 11:00';
                                                }

                                                if($id_hour_sche== '4')
                                                {
                                                    $id_hour_sche = '11:00 - 12:00';
                                                }

                                                if($id_hour_sche == '5')
                                                {
                                                    $id_hour_sche = '02:00 - 03:00';
                                                }

                                                if($id_hour_sche == '6')
                                                {
                                                    $id_hour_sche = '03:00 - 04:00';
                                                }

                                                if($id_hour_sche == '7')
                                                {
                                                    $id_hour_sche = '04:00 - 05:00';
                                                }

                                                if($id_hour_sche == '8')
                                                {
                                                    $id_hour_sche = '05:00 - 06:00';
                                                }
                                            ?>  
                                            <tr>
                                                <td><?php echo $date_sche, $id_sche?></td>
                                                <td><?php echo $id_hour_sche ?></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input value='<?php echo $id_sche?>' class="form-check-input" type="radio" name="selectionInterview" id="selectionInterview">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">    
                <div class="card">
                    <div class="card-body ">                
                        <div class="row">
                            <!-- Campo - Hora -->
                            <div class="col">
                                <label for="hour">Subir boletín actual</label> 
                                </br>
                                <input type="file" id='condition_document_stud' name="condition_document_stud"></input>
                            </div>
                        </div>
                    </div>        
                </div>  
                
                </br>
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                <button type="button" class="btn btn-success" onclick="Interview.insertInterview('<?php echo $id_sche?>')" id="submitInterviewButton">
                    <i></i> Enviar
                </button>

                <button type="button" class="btn btn-danger"  onclick="Request.cancelProceso();">
                    <i></i>  Cancelar Proceso
                </button>   
            </div>        
        </div>
    </form>             
</div>  
<?php
}

        
    //Metodo para listar los usuarios
    function paginateIntervieAcudiente($array_interview, $id_user)
    {
?>
        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="form-signin"> 
        <form id="insert_interview">
            <div class="row">
                
                    <div class="card">
                        <div class="card-body ">
                        
                            <div class="table">
                                <table class="table table-striped ">
                                    <thead class="table-dark">
                                        <tr>
                                            <!--<th>Día</th>-->
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($array_interview as $interview) 
                                        { 
                                            $id_inter = $interview->id_inter;
                                            $date_sche = $interview->date_sche;
                                            $id_hour_sche = $interview->id_hour_sche;
                                            $state_inter = $interview->state_inter;
                                            $observation_inter = $interview->observation_inter;

                                                //-------------------------------------------
                                                
                                                if($id_hour_sche == '1')
                                                {
                                                    $id_hour_sche = '08:00 - 09:00';
                                                }
                                                
                                                if($id_hour_sche == '2')
                                                {
                                                    $id_hour_sche = '09:00 - 10:00';
                                                }
        
                                                if($id_hour_sche == '3')
                                                {
                                                    $id_hour_sche = '10:00 - 11:00';
                                                }
        
                                                if($id_hour_sche== '4')
                                                {
                                                    $id_hour_sche = '11:00 - 12:00';
                                                }
        
                                                if($id_hour_sche == '5')
                                                {
                                                    $id_hour_sche = '02:00 - 03:00';
                                                }
        
                                                if($id_hour_sche == '6')
                                                {
                                                    $id_hour_sche = '03:00 - 04:00';
                                                }
        
                                                if($id_hour_sche == '7')
                                                {
                                                    $id_hour_sche = '04:00 - 05:00';
                                                }
        
                                                if($id_hour_sche == '8')
                                                {
                                                    $id_hour_sche = '05:00 - 06:00';
                                                }
                                            if ($state_inter == 'P') {
                                                $state_inter = '<span style="color: orange;">PENDIENTE</span>';
                                            } elseif ($state_inter == 'Y') {
                                                $state_inter = '<span style="color: green;">ACEPTADA</span>';
                                            } elseif ($state_inter == 'N') {
                                                $state_inter = '<span style="color: red;">RECHAZADA</span>';
                                            }
                                            
                                        ?>  
                                            <tr>
                                                <td><?php echo $date_sche ?></td>
                                                <td><?php echo $id_hour_sche ?></td>
                                                <td><?php echo $state_inter ?></td>
                                                <td><?php echo $observation_inter ?></td>
                                            </tr>
                                        <?php
                                        
                                    }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    </br>    
                    <button type="button" class="btn btn-success" onclick="Request.cambiarEstadoInterview('<?php echo $id_user ?>');">
                        <i></i>  Cambiar de horario
                    </button>   
                    <button type="button" class="btn btn-danger" onclick="Request.cancelProceso();">
                        <i></i>  Cancelar Proceso
                    </button> 
                </div>        
            </div>
        </form>             
    </div>  
    <?php
    }
    //--------------------------------------------------------------------
    //Método para mostrar un horario seleccionado
    function showSchedule($schedule, $array_hour)
    {
        $id_sche = $schedule[0]->id_sche;
        $date_sche = $schedule[0]->date_sche;
        $id_hour_sche = $schedule[0]->id_hour_sche;
    ?>
        <div>
            <form id="update_schedule">
                <div class="row">
                    <!-- Campo - Fecha -->
                    <div class="form-group col">
                        <label for="date">Fecha</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo $date_sche?>">
                    </div> 
                </div>
                                
                <div class="row">
                    <!-- Campo - Hora -->
                    <div class="col">
                        <label for="hour">Hora</label> 
                        <select class="form-control" id='hour_sche' name='hour_sche' aria-label="Default select example">
                            <option select>Seleccionar</option>
                            <?php
                            foreach ($array_hour as $hour) 
                            {
                                $id_hour_scheA = $hour->id_hour;
                                $name_hour_scheA = $hour->name_hour;
                                if ($id_hour_scheA == $id_hour_sche) 
                                {
                                ?>
                                    <option selected value="<?php echo $id_hour_scheA ?>"><?php echo $name_hour_scheA ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $id_hour_scheA ?>"><?php echo $name_hour_scheA ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
    
                </br>
                <button type="button" class="btn btn-success float-right mt-4" onclick="Interview.updateSchedule('<?php echo $id_sche;?>')">
                    <i class="fa-sharp fa-solid fa-pen-to-square"></i> Actualizar
                </button>
    
            </form>
        </div>
<?php
    }
}
?>