<?php
class InterviewModel
{
    private $Connection;
    
    //Metodo constrcutor
    function __construct($Connection) {
        $this->Connection = $Connection;
    }


    //Metodo para insertar un horario
    function insertSchedule($date_sche,$id_hour_sche)
    {
        $sql = "INSERT INTO SIMAT_MASS.SCHEDULE (id_sche,date_sche,id_hour_sche)
        VALUES (DEFAULT,'$date_sche',$id_hour_sche)";
        $this->Connection->query($sql);
    }
    
    function insertInterview($id_sche,$id_user)
    {
        $sql = "INSERT INTO SIMAT_MASS.INTERVIEW(id_inter,id_user_inter,id_sche_inter,state_inter,observation_inter)
        VALUES (DEFAULT,$id_user,$id_sche,DEFAULT,DEFAULT)";
        $this->Connection->query($sql);
    }
    function updateInterview($id_sche)
    {
        $id_sche = intval($id_sche); // Convertir a entero para evitar SQL Injection

        $sql = "UPDATE SIMAT_MASS.INTERVIEW
                SET id_sche_inter = $id_sche,
                state_inter = 'P'
                WHERE id_sche_inter = $id_sche";
        
        $this->Connection->query($sql);
    }

    function updateInterviewPendiente()
    {
        $sql = "UPDATE SIMAT_MASS.INTERVIEW
                SET state_inter = 'P'
                WHERE state_inter <> 'P'";
        
        $this->Connection->query($sql);
    }

    //--------------------------------------------------------------------
    function updateSchedule($id_sche,$date_sche,$id_hour_sche)
    {
        $sql = "UPDATE SIMAT_MASS.SCHEDULE
        SET date_sche = '$date_sche', 
        id_hour_sche = $id_hour_sche
        WHERE id_sche = '$id_sche'";
        $this->Connection->query($sql);
    }
    function updateScheduleState($id_sche)
    {
        $sql = "UPDATE SIMAT_MASS.SCHEDULE
        SET state_sche = 'Y'
        WHERE id_sche = '$id_sche'";
        $this->Connection->query($sql);
    }
    function updateEstadoInterview($id_inter)
    {
        $sql = "UPDATE SIMAT_MASS.INTERVIEW
        SET state_inter = 'N'
        WHERE id_inter = '$id_inter'";
        $this->Connection->query($sql);
    }
    //--------------------------------------------------------------------
    function deleteSchedule($id_sche)
    {
        $sql = "DELETE FROM SIMAT_MASS.SCHEDULE
        WHERE id_sche = $id_sche";
        $this->Connection->query($sql);
    }

    function deleteInterview($id_inter)
    {
        $sql = "DELETE FROM SIMAT_MASS.INTERVIEW
        WHERE id_inter = $id_inter";
        $this->Connection->query($sql);
    }

    function deleteUser($id_user)
    {
        $sql = "DELETE FROM SIMAT_MASS.USER
        WHERE id_user = $id_user";
        $this->Connection->query($sql);
    }
    //--------------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (HORARIOS)
    function paginateSchedule()
    {
        $sql = "SELECT * FROM SIMAT_MASS.SCHEDULE
        ORDER BY date_sche, id_hour_sche";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    function paginateSchedule2()
    {
        $sql = "SELECT * FROM SIMAT_MASS.SCHEDULE
        WHERE state_sche = 'N'
        ORDER BY date_sche, id_hour_sche";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //--------------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (HORAS)
    function paginateHour()
    {
        $sql = "SELECT * FROM SIMAT_MASS.HOUR";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //--------------------------------------------------------------------
    //Metodo para seleccionar un horario en concreto
    function selectSchedule($id_sche)
    {
        $sql = "SELECT * FROM SIMAT_MASS.SCHEDULE
        WHERE id_sche = $id_sche";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    function validate_v($id_user)
    {
        $sql = "SELECT * FROM SIMAT_MASS.INTERVIEW
        WHERE id_user_inter = $id_user";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
        //--------------------------------------------------------------------
    //Metodo para seleccionar un horario en concreto
    function paginateIntervieAcudiente()
    {
        $sql = "SELECT i.id_inter, s.date_sche, s.id_hour_sche,
        i.state_inter, i.observation_inter
 
         FROM SIMAT_MASS.USER u INNER JOIN SIMAT_MASS.INTERVIEW i
         ON (u.id_user=i.id_user_inter)
         INNER JOIN SIMAT_MASS.SCHEDULE s
         ON (s.id_sche=i.id_sche_inter)
         WHERE id_inter > 0";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    function paginateIntervieAcudiente2()
    {
        $sql = "SELECT i.id_inter, s.date_sche, s.id_hour_sche,
        i.state_inter, i.observation_inter
 
         FROM SIMAT_MASS.USER u INNER JOIN SIMAT_MASS.INTERVIEW i
         ON (u.id_user=i.id_user_inter)
         INNER JOIN SIMAT_MASS.SCHEDULE s
         ON (s.id_sche=i.id_sche_inter)
         WHERE id_inter > 0
         ORDER BY i.id_inter DESC LIMIT 1";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    function paginateInterview()
    {
        $sql = "SELECT * FROM SIMAT_MASS.INTERVIEW
        WHERE id_inter > 0";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    function paginateIntervieTotal()
    {
        $sql = "SELECT i.id_inter, s.date_sche, s.id_hour_sche,
        i.state_inter, i.observation_inter, u.id_user, u.name_user, i.id_user_inter
 
         FROM SIMAT_MASS.USER u INNER JOIN SIMAT_MASS.INTERVIEW i
         ON (u.id_user=i.id_user_inter)
         INNER JOIN SIMAT_MASS.SCHEDULE s
         ON (s.id_sche=i.id_sche_inter)
         WHERE i.id_user_inter = u.id_user
         ORDER BY date_sche, id_hour_sche";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function paginateProcesoTotal()
    {
        $sql = "SELECT i.id_user_inter, u.id_user

        FROM SIMAT_MASS.USER u INNER JOIN SIMAT_MASS.INTERVIEW i
        ON (u.id_user=i.id_user_inter)
        WHERE i.id_user_inter > 0";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function paginateProcesoTotal_ver($id_user)
    {
        $sql = "SELECT i.id_user_inter, u.id_user, i.id_inter, i.state_inter

        FROM SIMAT_MASS.USER u INNER JOIN SIMAT_MASS.INTERVIEW i
        ON (u.id_user=i.id_user_inter)
        WHERE i.id_user_inter = $id_user";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function paginateProcesoTotal_p()
    {
        $sql = "SELECT 
            FROM SIMAT_MASS.INTERVIEW i
            INNER JOIN SIMAT_MASS.USER u ON u.id_user = i.id_user_inter
            INNER JOIN SIMAT_MASS.SCHEDULE s ON s.id_sche = i.id_sche_inter
            WHERE s.state_sche = 'N'
            ";
    
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    
}
?>