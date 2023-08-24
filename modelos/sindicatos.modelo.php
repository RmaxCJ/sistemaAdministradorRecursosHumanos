<?php
	require_once "conexion.php";
	class ModeloSindicatos{

		static public function mdlEditarSindicatos($tabla,$tabla2,$datos,$datos2)
        {
//            echo "mdlEditarSindicatos";
//            echo "<pre>";
//            print_r($tabla);
//            print_r($tabla2);
//            print_r($datos);
//            print_r($datos2);
//            echo "</pre>";

//            exit();

            conexion::conectar();
              $query="UPDATE ".$tabla." SET sindicato='".utf8_decode($datos['Sindicato'])."',nombre_corto='".$datos['NombreCorto']."',cod_division='".$datos['Cod_division']."',id_responsable='".$datos['id_Responsable']."' WHERE id=".$datos['id']." AND id_proveedor=".$datos['id_proveedor']."";
//            echo "<br>";
            if(mssql_query($query))
            {
                if (!empty($datos2['archivo']))
                {//si si existen valores se actualiza si no no
                      $updatef1 = "UPDATE ".$tabla." set logo='".$datos2['archivo']."' WHERE id=".$datos['id']."";
                    mssql_query($updatef1);
//                    echo "<br>";

                }

                $query2="UPDATE ".$tabla2." SET num_proveedor='".$datos['num_proveedor']."',rfc='".$datos['rfc']."',correo='".$datos['correo']."',moneda='".$datos['moneda']."' WHERE id=".$datos['id_proveedor']."";
//                echo "<br>";

                if(mssql_query($query2))
                {
                    return "ok";
                }else{
                    return "error";
                }
            }else{
                return "error";
            }

        }
		static public function mdlMostrarSindicatos($pais,$cod_division)
        {
            conexion::conectar();
            

            if ($pais=="" && $cod_division=="" || $pais!=null && $cod_division!=null)
            {
                  $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus, S.logo, D.cod_division, D.division, D.pais, P.id as idp, P.num_proveedor, P.rfc, P.correo, P.moneda, P.cod_planta 
                FROM Sindicatos S, Usuarios U, Divisiones D, Proveedores P 
                where U.id=S.id_responsable AND S.cod_division=D.Cod_Division AND P.id=S.id_proveedor";

            }
            elseif ($pais=="" && $cod_division!="" || $pais==null && $cod_division!=null)
            {
//                 $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus, S.logo, D.cod_division, D.division, D.pais, P.id as idp, P.num_proveedor, P.rfc, P.correo, P.moneda, P.cod_planta
//                FROM Sindicatos S, Usuarios U, Divisiones D, Proveedores P
//                where U.id=S.id_responsable AND S.cod_division=D.Cod_Division AND P.id=S.id_proveedor and D.cod_division= '".$cod_division."'";

                 $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus, S.logo, D.cod_division, D.division, D.pais, P.id as idp, P.num_proveedor, P.rfc, P.correo, P.moneda, P.cod_planta 
                FROM Sindicatos S, Usuarios U, Divisiones D, Proveedores P 
                where U.id=S.id_responsable AND S.cod_division=D.Cod_Division AND P.id=S.id_proveedor and D.cod_division in(".$cod_division.") ";


            }
            elseif ($pais!="" && $cod_division=="TODAS" || $pais!=null && $cod_division==null)
            {
                 $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus, S.logo, D.cod_division, D.division, D.pais, P.id as idp, P.num_proveedor, P.rfc, P.correo, P.moneda, P.cod_planta 
                FROM Sindicatos S, Usuarios U, Divisiones D, Proveedores P 
                where U.id=S.id_responsable AND S.cod_division=D.Cod_Division AND P.id=S.id_proveedor and D.pais like '%".$pais."%'";

            }



            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlMostrarSindicatosLider($tabla,$datos)
        {
            conexion::conectar();
            //  $query="SELECT * FROM ".$tabla." where id_sindicato=".$id_sindicato;
            // echo  $query="SELECT SL.id, SL.id_sindicato, SL.id_lider, U.id as idu, U.usuario, U.num_empleado, U.nombre_usuario FROM ".$tabla." as SL, Usuarios U where id_sindicato=".$datos['id_sindicato']."  AND SL.id_lider=U.id ";

            //   $query="SELECT SL.id, SL.id_sindicato, SL.id_lider, U.id as idu, U.usuario, U.num_empleado, U.nombre_usuario FROM ".$tabla." as SL, Usuarios U where id_sindicato=1  AND SL.id_lider=U.id ";

             $query="select * from SindicatosLiderVista where id_sindicato=".$datos['id_sindicato']." union select * from SindicatosLiderVista2 where id_sindicato=".$datos['id_sindicato']."";
            //   --- datos de usuarios que existen en Empleados
            // --- datos de usuarios que no existen en Empleados
            // id =id_lider/ id_sindicato/ id_lider/ nombre/num_empleado/id_perfil
             
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

/////////////////////////////////////////////////////////////////////////////Proveedorsindicato
        static public function mdlIngresarProveedorSindicato($tabla2,$datos)
        {
			conexion::conectar();
            $query = "insert into ".$tabla2." (num_proveedor,rfc,correo,moneda,estatus,fecha_alta)values('".$datos['num_proveedor']."','".$datos['rfc']."','".$datos['correo']."','".$datos['moneda']."','".$datos['estatus']."','".$datos['fecha_alta']."')";

            if(mssql_query($query)){
                //regrear id de guardado de la minuta
                $query2     ="SELECT MAX(id) AS id FROM Proveedores";
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
//////////////////////////////////////////////////////////////////////////////sindicato
        static public function mdlIngresarSindicatos($tabla,$datos,$id_prov,$datos2)
        {
			conexion::conectar();
             $query = "insert into ".$tabla." (sindicato,nombre_corto,cod_division,id_proveedor,id_responsable,logo,estatus,fecha_alta)values('".$datos['Sindicato']."','".$datos['NombreCorto']."','".$datos['Cod_Division']."','".$id_prov."','".$datos['id_Responsable']."','".$datos2['archivo']."','".$datos['estatus']."','".$datos['fecha_alta']."')";
            if(mssql_query($query))
            { 
                return "ok";
            }else{
                
                return "error";
            }
        }
        // DBCC CHECKIDENT('dbo.', RESEED, 17)Restablecer autoincrement de sqlserver
        static public function mdlAgregarLideresSindicatos($tabla,$datos)
        {
            conexion::conectar();
            // $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
            // $query="UPDATE ".$tabla." SET estatus='B' WHERE id=".$datos['id']."";
            $jsonLid = $datos['jsonLideres'];
            $jsonLidG = $datos['jsonLideresG'];
            if($jsonLid!=''){
                $array = explode("~", $jsonLid);
                foreach ($array as $value) {//serecorren los arregl
                    if ($value === end($array)) {
                        // return "ok";
                        $ok1 = 'ok';
                    }else{

                        $query = "insert into ".$tabla." (id_sindicato,id_lider)values('".$datos['id_sindicato']."','".$value."')";
                        mssql_query($query);
                    }
                }
            }
            if($jsonLidG!=''){
                $array2 = explode("~", $jsonLidG);
                foreach ($array2 as $value2) {//serecorren los arregl
                    if ($value2 === end($array2)) {
                        // return "ok";
                        $ok2 = 'ok';
                    }else{

                        $query="DELETE FROM  ".$tabla."  WHERE id=".$value2."";
                        mssql_query($query);
                    }
                }
            }
            if($ok1=='ok' || $ok2=='ok')
            {
                return "ok";
            }
            
		}

        static public function mdlBorrarSindicatos($tabla,$datos)
        {
            conexion::conectar();
            // $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
            $query="UPDATE ".$tabla." SET estatus='B' WHERE id=".$datos['id']."";
        //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }
		}

        static public function mdlBorrarSindicatos2($tabla,$datos)
        {
            conexion::conectar();
            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
            // $query="UPDATE ".$tabla." SET estatus='B' WHERE id=".$datos['id']."";
        //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }
		}

    static public function mdlMostrarSindicatoxDivision($divisiones)
    {
        conexion::conectar();

          $query="SELECT S.id,S.sindicato,D.division,D.cod_division FROM Sindicatos as s,Divisiones as D 
        where D.cod_division=S.cod_division and D.cod_division in(".$divisiones.")";
        //  $query="SELECT P.id, P.num_proveedor, P.Proveedor, P.rfc, P.correo, P.id_contacto, P.moneda, P.cod_planta, P.estatus, U.id as idu, U.usuario, U.nombre_usuario  FROM ".$tabla." P, Usuarios U";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }



    static public function mdlMostrarResponsableSindicato($idSindicato)
    {
        conexion::conectar();

         echo  $query="SELECT U.nombre_usuario FROM Sindicatos as s,Usuarios as U 
where U.id=S.id_responsable and S.id='".$idSindicato."'";
        //  $query="SELECT P.id, P.num_proveedor, P.Proveedor, P.rfc, P.correo, P.id_contacto, P.moneda, P.cod_planta, P.estatus, U.id as idu, U.usuario, U.nombre_usuario  FROM ".$tabla." P, Usuarios U";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

	}