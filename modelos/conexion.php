<?php

	class conexion
	{
		static public function conectar()
		{
//		    echo "conexion.php";
//            phpinfo();


            $host="192.168.15.22"; 
            $user="relaciones";
            $pswd='R3l4_cc1on3Ss.';
            $bd="RelacionesLaborales";


            $linker=mssql_connect($host, $user, $pswd) or die ("Error al conectarse a ". $host);
            $base=mssql_select_db($bd, $linker) or die ("Error al seleccionar la Base de Datos ". $bd);
            //ini_set('mssql.charset', 'UTF-8');


//print_r($linker);<
            return $base;



        }

		public static function desconectar()
       {
           mssql_close($linker);

       }
	}