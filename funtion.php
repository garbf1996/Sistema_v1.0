<?php

date_default_timezone_set('America/Santo_Domingo');

function fechaC(){
$mes = array ("","Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Dicimbre");

                return date('d')."  /". $mes[date('n')]."/".date("y");
}

?>