<?php
	require_once "conexion.php";
	class ModeloUsuarios{

        static public function  mdlPerfiles($tabla)
        {
            conexion::conectar();
            $query="SELECT * FROM ".$tabla;

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }

		static public function mdlEditarUsuario($tabla,$datos)
        {
//            echo "mdl<pre>";
//            print_r($datos);
//            echo "</pre>";
            conexion::conectar();
             $query="UPDATE ".$tabla." SET id_perfil=".$datos['perfil'].",num_empleado='".$datos['num_Empleado']."',usuario='".$datos['usuario']."',correo='".$datos['correo']."',nombre_usuario='".$datos['nombreEmpleado']."' WHERE id=".$datos['idUsuario']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }

		}


		static public function mdlMostrarUsuarios($tabla)
        {
            conexion::conectar();
            $query="SELECT t1.id as idu, t1.id_perfil, t1.num_empleado, t1.usuario, t1.correo, t1.nombre_usuario, t1.activo, t1.active, t2.id as idp, t2.perfil FROM Usuarios as t1, Perfiles as t2 where t1.id_perfil=t2.id";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }


        static public function mdlMostrarUsuariosResponsables()
        {
            conexion::conectar();
             $query="SELECT t1.id as idu, t1.id_perfil, t1.num_empleado, t1.usuario, t1.correo, t1.nombre_usuario, t1.activo, t1.active, t2.id as idp, t2.perfil 
                    FROM Usuarios as t1, Perfiles as t2 
                    where t1.id_perfil=t2.id and t1.id_perfil=3";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }

        /////////para mostrar en sindicatos
        static public function mdlMostrarUsuariosSencillo($tabla)
        {
            conexion::conectar();
            //  $query="SELECT * FROM ".$tabla."order by id asc";
             $query="select * from Usuarios order by id asc";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }
        /////////para mostrar en sindicatos
        static public function mdlMostrarEmpleados($tabla)
        {
            conexion::conectar();
            $query="SELECT id, num_empleado, nombre, cod_division FROM ".$tabla;

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }


		static public function mdlIngresarUsuario($tabla,$datos){


			$email=$datos['correo'];
			conexion::conectar();

			 $query = "insert into ".$tabla." (id_perfil,num_empleado,usuario,nombre_usuario,correo,contrasena,activo,active,fecha_alta)values(".$datos['perfil'].",'".$datos['num_Empleado']."','".$datos['usuario']."','".$datos['nombre']."','".$email."','".$datos['contrasena']."','".$datos['activo']."','".$datos['active']."','".$datos['fecha_alta']."')";
//            mssql_query($query);

            if(mssql_query($query))
            {

                //regrear id de guardado de la minuta

                $query2     ="SELECT MAX(id) AS id FROM Usuarios";
                $sql = mssql_query($query2);
                while($rs = mssql_fetch_object($sql))
                {
                    $id[] = $rs;
                }
                return $id;
            }
            else{
                return "error";
            }


		}

		static public function  mdlUsuarioDivision($idUsuario,$cod_division)
        {
            conexion::conectar();

             $query = "insert into UsuariosDivision (id_usuario,cod_division)values(".$idUsuario.",'".$cod_division."')";
//            mssql_query($query);

            if(mssql_query($query)){
                return "ok";
            }else{
                return "error";
            }
        }


        static public function mdlIngresarUsuarioEmpleado($tabla,$datos){

//echo "mdl";
//print_r($datos);
            $email=$datos['correo'];
            conexion::conectar();

            $query = "insert into ".$tabla." (id_perfil,num_empleado,usuario,correo,contrasena,activo,active,fecha_alta)values(".$datos['perfil'].",'".$datos['num_Empleado']."','".$datos['usuario']."','".$email."','','".$datos['activo']."','".$datos['active']."','".$datos['fecha_alta']."')";
//            mssql_query($query);

            if(mssql_query($query)){
                return "ok";
            }else{
                return "error";
            }


        }



        static public function mdlBajaUsuario($tabla,$datos)
        {
            conexion::conectar();
             $query="UPDATE ".$tabla." SET activo='B' WHERE id=".$datos['idUsuario']."";

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }
		}
        static public function mdlEliminarUsuario($tabla,$datos)
        {
            conexion::conectar();
//            $query="UPDATE ".$tabla." SET activo='B' WHERE id=".$datos['idUsuario']."";

            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }
        }
        static public function mdlResetPass($tabla,$datos)
        {
            conexion::conectar();
            $default=$datos['nameUsuario'].''.date('m_d');
//            echo $default;
//            echo "<br>";
            $passcifrado = md5($default);
//            echo $passcifrado;

             $query="UPDATE ".$tabla." SET contrasena='".$passcifrado."',resetear_pass=1 WHERE id=".$datos['idUsuario']."";

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }
        }
        static public function mdlResetPassUser($tabla,$datos)
        {
            conexion::conectar();
//            $default=date('d/m').'_'.$datos['nameUsuario'].'_'.date('Y');
//            echo $default;
//            echo "<br>";
            $passcifrado = md5($datos['pass']);
//            echo $passcifrado;

            $query="UPDATE ".$tabla." SET contrasena='".$passcifrado."',resetear_pass=0 WHERE id=".$datos['idUsuario']."";

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

            if(mssql_query($query))
            {
                return "ok";
//                session_destroy();
            }else{
                return "error";
            }
        }



		static public function mdlActive($usuario)
        {
//            print_r("mdl user".$usuario);

            conexion::conectar();
          $query="SELECT * FROM Usuarios where usuario='".$usuario."'";
//           echo $query="SELECT U.id as idUs,U.usuario,U.id_perfil,U.correo,U.num_empleado,E.nombre
//                    FROM Usuarios as U,Empleados as E
//                    where U.num_empleado=E.num_empleado and usuario='".$usuario."'";

            $stmt = mssql_query($query);
            $result = mssql_fetch_array($stmt);
            return $result;

            mssql_free_result($stmt);
//            mssql_close();

        }


        static public function mdlAutentica($usuario,$pass)
        {
            // Active Directory server
//            echo "mdlAutentica";
             $ldap_host = "gporotoplas.net";

            // Active Directory DN
            $ldap_dn = "OU=Cuentas Servicios, DC=gporotoplas, DC=net";

            // Domain, for purposes of constructing $user
            $ldap_usr_dom = '@gporotoplas.net';

            // connect to active directory
            $ldap = ldap_connect($ldap_host)
            or die("Could not conenct to $ldap_host");

            // verify user and password
            if($bind = ldap_bind($ldap, $usuario.$ldap_usr_dom, $pass))
                $valido = 1;
            else
                $valido = 0;

            return $valido;
        }


        static public function mdlRegistra_acceso($id_usuario)
        {
            //$result = array();

            conexion::conectar();

            $ip = $_SERVER['REMOTE_ADDR'];

            if(!empty($_SERVER['HTTP_CLIENT_IP']))
                $ip = $_SERVER['HTTP_CLIENT_IP'];

            if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];


             $query = "insert into Accesos (id_usuario,ip,fecha)values(".$id_usuario.",'".$ip."',getdate())";
            mssql_query($query);
            // echo $qry;
        }


        static public function mdlLogin($usuario, $contrasena)
        {
            conexion::conectar();
            $result = array();

            $qry = "validar 'VALIDAR','$usuario','$contrasena'";
            //echo 'entro - '.$qry;
            $sql = mssql_query($qry);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
        }


        static public function mdlbuscarEmpleadoByNumEmpleado($tabla,$datos)
        {
//            print_r("mdl user".$usuario);
//echo "mdl";
//print_r($datos);
            conexion::conectar();
               $query="SELECT correo,nombre,id FROM ".$tabla." where num_empleado='".$datos['numEmpleadoActive']."'";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
//            mssql_close();

        }

        static public function mdlDatosEmpleadoByNumemp($datos)
        {
//            print_r("mdl user".$usuario);
//echo "mdl";
//print_r($datos);
            conexion::conectar();
             $query="SELECT correo,nombre,id FROM Empleados where num_empleado='".$datos."'";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
//            mssql_close();

        }
        static public function mdlbuscarEmpleadoByNumEmpleadoPais()
        {
//            print_r("mdl user".$usuario);
//echo "mdl";
//print_r($datos);
            conexion::conectar();
            // $query="SELECT correo,nombre,id FROM ".$tabla." where pais='mexico' OR where pais='mexico'";

            $query="SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
            FROM Empleados E, Divisiones D
            where E.cod_division=D.cod_division and D.pais='mexico' 
            union 
            SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
            FROM Empleados E, Divisiones D
            where E.cod_division=D.cod_division and D.pais='argentina' ";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
//            mssql_close();

        }
        static public function mdlbuscarEmpleadoByNumEmpleadoPaisbyId($id)
        {
            conexion::conectar();
            $query="SELECT * FROM Empleados where id=".$id."";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlbuscarEmpleadoByNumEmpleadoDEMANDAS($datos)
        {
//            print_r("mdl user".$usuario);
//echo "mdl";
//print_r($datos);
            conexion::conectar();
             $query="SELECT D.division,D.pais,D.cod_division,E.nombre,E.fecha_ingreso,E.posicion FROM Empleados as E, Divisiones as D 
                    where E.cod_division=D.cod_division and E.num_empleado='".$datos['numEmpleadoActive']."'";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;
//            mssql_close();

        }
        static public function mdlbuscarEmpleadoByNumEmpleadoConsecuencias($datos)
        {
            conexion::conectar();
             $query="SELECT D.cod_division, D.division,D.pais,E.nombre, E.posicion, E.area_personal, E.sociedad FROM Empleados as E, Divisiones as D 
                    where E.cod_division=D.cod_division and E.num_empleado='".$datos['numEmpleadoActive']."'";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlBuscarEmpleadoxPais($pais)//para gestion de consecuencias
        {
//            echo $pais;
            conexion::conectar();
            if($pais!='CentroAmerica'){
            $query="SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
             FROM Empleados E, Divisiones D
             where E.cod_division=D.cod_division and D.pais='".$pais."' order by E.num_empleado asc";
            } else
                {
//                   $query="SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais
//                FROM Empleados E, Divisiones D
//                where E.cod_division=D.cod_division and D.pais in('Honduras','Nicaragua','Costa rica','El salvador','Guatemala');";

                 $query="SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='honduras'  order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='nicaragua'  order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='costa rica' order by E.num_empleado asc  union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='el salvador'  order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='guatemala'  order by E.num_empleado asc ";

            }
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlBuscarEmpleadoxDivisiones($divisiones, $pais)//para gestion de consecuencias
        {
            // print_r($divisiones);
            // print_r($pais);
            conexion::conectar();
            if($pais!='centroAmerica'){
            echo $query="SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
             FROM Empleados E, Divisiones D
             where E.cod_division=D.cod_division and D.cod_division in(".$divisiones.") and D.pais='".$pais."' order by E.num_empleado asc";
            } else {

                $query="SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='honduras' order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='nicaragua' order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='costa rica' order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='el salvador' order by E.num_empleado asc union
                SELECT E.id as idE, E.num_empleado, E.nombre, E.cod_division, D.id, D.cod_division, D.pais  
                FROM Empleados E, Divisiones D
                where E.cod_division=D.cod_division and D.pais='guatemala' order by E.num_empleado asc ";

            }
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlbuscarEmpleadoByNumEmpleadoM($tabla,$num_empleado)//para buscar a los nombres de los empleados si no existen en usuarios
        {
            conexion::conectar();
            $query="SELECT correo,nombre,id, num_empleado FROM ".$tabla." where num_empleado='".$num_empleado."'";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
//            mssql_close();

        }

        static public  function mdlDatosEmpleado($num_empleado)
        {
            conexion::conectar();


            $query= "SELECT * FROM Empleados,Divisiones where Empleados.cod_division=Divisiones.cod_division and num_empleado=$num_empleado";// and AP.id_archivo=AR.id "; ,AP.id_archivo,AR.id as ARID,AR.nombre,AR.archivo

            $sql = mssql_query($query);
            while($rs = mssql_fetch_array($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }




        static public function  mdlAbogados()
        {
            conexion::conectar();
            $query="select *from Usuarios where id_perfil in(4,5)";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }
        static public function mdlDivisionesUsuario($idUsuario)
        {
            conexion::conectar();
              $query2= "SELECT D.division,U.id,U.usuario,D.cod_division
                    FROM Divisiones as D,UsuariosDivision as UD,Usuarios as U
                    WHERE U.id=UD.id_usuario and UD.cod_division=D.cod_division and UD.id_usuario=".$idUsuario;
            $sql2 = mssql_query($query2);

            while($rs2 = mssql_fetch_object($sql2))
            {
                $result2[] = $rs2;
            }
            return $result2;

        }

        static public function mdlDivisionesEmpleados($idUsuario)
        {
            conexion::conectar();
//            $query2= "SELECT D.division,U.id,U.usuario,D.cod_division
//                    FROM Divisiones as D,GerentesDivision as GD,Usuarios as U
//                    WHERE U.id=GD.id_gerente and GD.cod_division=D.cod_division and GD.id_gerente=".$idUsuario."
//                    UNION
//                    SELECT D.division,U.id,U.usuario,D.cod_division
//                    FROM Divisiones as D,UsuariosDivision as UD,Usuarios as U
//                    WHERE U.id=UD.id_usuario and UD.cod_division=D.cod_division and UD.id_usuario=".$idUsuario;

            $query2= "SELECT D.division,U.id,U.usuario,D.cod_division
                    FROM Divisiones as D,GerentesDivision as GD,Usuarios as U
                    WHERE U.id=GD.id_gerente and GD.cod_division=D.cod_division and GD.id_gerente=".$idUsuario;



            $sql2 = mssql_query($query2);

            while($rs2 = mssql_fetch_object($sql2))
            {
                $result2[] = $rs2;
            }
            return $result2;

        }



        static public function mdlAgregarUsuarioDivisiones($cod_division,$idUsuario)
        {


            conexion::conectar();

             $query = "insert into UsuariosDivision (id_usuario,cod_division)values(".$idUsuario.",'".$cod_division."')";
//            mssql_query($query);

            if(mssql_query($query))
            {
                return "ok";
            }else
            {
                return "error";
            }


        }

        static public function mdlAgregarEmpleadosDivisiones($cod_division,$idUsuario)
        {


            conexion::conectar();

            $query = "insert into GerentesDivision (id_gerente,cod_division)values(".$idUsuario.",'".$cod_division."')";
//            mssql_query($query);

            if(mssql_query($query))
            {
                return "ok";
            }else
            {
                return "error";
            }


        }
        static public function mdlQuitarUsuarioDivisiones($cod_division,$idUsuario)
        {


            conexion::conectar();

             $query="DELETE FROM UsuariosDivision WHERE id_usuario=".$idUsuario." and cod_division='".$cod_division."'";
            //            mssql_query($query);

            if(mssql_query($query))
            {
                return "ok";
            }else
            {
                return "error";
            }


        }

        static public function mdlQuitarEmpleadosDivisiones($cod_division,$idUsuario)
        {


            conexion::conectar();

            $query="DELETE FROM GerentesDivision WHERE id_gerente=".$idUsuario." and cod_division='".$cod_division."'";
            //            mssql_query($query);

            if(mssql_query($query))
            {
                return "ok";
            }else
            {
                return "error";
            }


        }

        static public function  mdlDivisionesCHLOGIN($id)
        {
            conexion::conectar();
            $query="SELECT * FROM GerentesDivision where id_gerente=".$id;

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }
        static public function  mdlPaisesDivisiones($divisiones)
        {
            conexion::conectar();
            $query="select pais from Divisiones where cod_division in(".$divisiones.")";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }
        static public function  mdlUsuarioDivisionLOGIN($id)
        {
            conexion::conectar();
             $query="SELECT * FROM UsuariosDivision where id_usuario=".$id;

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }

            return $result;


        }

    }