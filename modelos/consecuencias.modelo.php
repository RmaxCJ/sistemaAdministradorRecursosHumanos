<?php
	require_once "conexion.php";
	class ModeloConsecuencias{

        static public function mdlIngresarAddConsecuencias($tabla,$datos)
        {
			conexion::conectar();
			 $query = "insert into ".$tabla." (pais,amonestacion)values('".$datos['pais']."','".$datos['amonestacion']."')";
			// if(mssql_query($query)){
			// 	return "ok";
			// }else{
			// 	return "error";
			// }
            if(mssql_query($query)){
                $query2    ="SELECT MAX(id) AS id FROM  TiposAmonestacion";
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
        static public function mdlIngresarAmonestacionConsecuencia($tabla2,$id,$datos)
        {			
            //TemasMinuta
            // date('Y-m-d H:i:s'),
			conexion::conectar();
            $arrayConsecuencia = $datos['arregloConsecuencia'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
            if($arrayConsecuencia!=''){
                $array = explode("~", $arrayConsecuencia);//separando por tilde para poder leer los arreglos que vengan
                foreach ($array as $value) {//serecorren los arreglos

                    if ($value === end($array)) {
                        // echo "ÚLTIMO ELEMENTO";
                        return "ok";
                    }else{
                         $query = "insert into ".$tabla2." (id_tipo_amonestacion,consecuencia)values('".$id."','".$value."')";
                        mssql_query($query);
                    }
                }
            }
        }
		static public function mdlEditarAddConsecuencias($tabla,$datos)
        {
            conexion::conectar();
              $query="UPDATE ".$tabla." SET amonestacion='".$datos['amonestacion']."' WHERE id=".$datos['id']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }

        }

        static public function mdlEliminarAmonestacionConsecuencia($tabla2,$id,$datos)
        {
			conexion::conectar();
            $arraycondel = $datos['arraycondel'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
            if($arraycondel!=''){
                $array = explode("~", $arraycondel);//separando por tilde para poder leer los arreglos que vengan
                foreach ($array as $value) {//serecorren los arreglos

                    if ($value === end($array)) {
                        // echo "ÚLTIMO ELEMENTO";
                        return "ok";
                    }else{
                         $query = "DELETE FROM ".$tabla2."  WHERE id=".$value." and id_tipo_amonestacion=".$id;
                        mssql_query($query);
                    }
                }
            }

        }

		static public function mdlEliminarAddConsecuencias($tabla,$datos,$tabla2)
        {
            conexion::conectar();
            $query="DELETE FROM ".$tabla."  WHERE id=".$datos['id']."";
            $query2="DELETE FROM ".$tabla2."  WHERE id_tipo_amonestacion=".$datos['id']."";
            mssql_query($query2);
            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }

        }
		
		static public function mdlMostrarTiposConsecuencias($tabla)
        {
			//  $tabla;
            conexion::conectar();
            $query="SELECT * FROM ".$tabla."  ORDER BY pais asc";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

        static public function mdlMostrarTiposConsecuenciasxPais($tabla,$pais)
        {
			//  $tabla;
            conexion::conectar();

            if($pais=='CentroAmerica'){//se ocupa este if para consecuencias
                $query="select * from ".$tabla." where pais='honduras' union
                select * from ".$tabla." where pais='nicaragua' union
                select * from ".$tabla." where pais='costa rica'  union
                select * from ".$tabla." where pais='el salvador' union
                select * from ".$tabla." where pais='guatemala'";
                $sql = mssql_query($query);
                while($rs = mssql_fetch_object($sql))
                {
                    $result[] = $rs;
                }
                return $result;
            }else{
                $query="SELECT * FROM ".$tabla." where pais='".$pais."' ORDER BY pais asc";
                $sql = mssql_query($query);
                while($rs = mssql_fetch_object($sql))
                {
                    $result[] = $rs;
                }
                return $result;
            }
		}

        static public function mdlMostrarAmonestacionConsecuencia($tabla,$id)
        {
			//  $tabla;
            conexion::conectar();
            $query="SELECT * FROM ".$tabla." where id_tipo_amonestacion=".$id;
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        static public function mdlBuscarAmonestacionConsecuencia($tabla, $datos)//para gestion de consecuencias
        {
            conexion::conectar();
             $query="select * from ".$tabla." where id_tipo_amonestacion=".$datos['tipoConsecuencia'];

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlIngresarConsecuencia($tabla,$datos)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla." (num_empleado, id_vp, id_area, fecha_amonestacion, id_tipo_amonestacion, id_amonestacion_consecuencia, motivo_amonestacion, num_reincidencia, comentarios, cod_division, pais) 
             values('".$datos['num_empleado']."','".$datos['id_vp']."','".$datos['area']."','".$datos['fecha_amonestacion']."','".$datos['id_tipo_amonestacion']."','".$datos['id_amonestacion_consecuencia']."','".$datos['motivo_amonestacion']."','".$datos['num_reincidencia']."','".$datos['comentarios']."','".$datos['cod_division']."','".$datos['pais']."')";
			if(mssql_query($query)){
                $query2     ="SELECT MAX(id) AS id FROM ".$tabla;
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

        static public function mdlIngresarArchivos($tabla2,$datos2)
        {
            conexion::conectar();
              $query = "insert into ".$tabla2." (id_tipo,anio,nombre,archivo,id_usuario,fecha_alta)values(".$datos2['id_tipo'].",'".$datos2['anio']."','".$datos2['nombre']."','".$datos2['archivo']."',".$datos2['id_usuario'].",'".$datos2['fecha_alta']."')";
            if(mssql_query($query)){
                $query2     ="SELECT MAX(id) AS id FROM Archivos";
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
        static public function mdlIngresarArchivosConsecuencia($tabla3,$id,$idArchivo)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla3." (id_consecuencias,id_archivo)values('".$id."','".$idArchivo."')";
			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}
        static public function mdlMostrarConsecuencias($tabla, $pais, $divisiones)
        {
			//  $tabla;
            conexion::conectar();
            // echo $cod_division;
            if($divisiones=='TODAS'){
                $cod="";
            }else{
                // $cod=" and D.cod_division='".$divisiones."' ";
                $cod=" and D.cod_division in(".$divisiones.") ";
                
            }
                if($pais!='CentroAmerica'){
                    $query="select C.id as idC, C.num_empleado,C.id_vp,C.fecha_amonestacion, C.id_tipo_amonestacion, 
                    C.id_amonestacion_consecuencia, C.motivo_amonestacion, C.num_reincidencia, C.comentarios, C.cod_division, C.pais, 
                    D.*, E.nombre, E.posicion,E.area_personal, E.sociedad, E.cod_division, TA.id, TA.amonestacion, V.*,VP.* , A.*
                    from Consecuencias C,Divisiones D, Empleados E , TiposAmonestacion TA, Vicepresidencias V , VP_Areas VP, Areas A
                    where TA.id=C.id_tipo_amonestacion and 
                    E.num_empleado=C.num_empleado and 
                    C.cod_division=D.cod_division and 
                    C.id_vp=V.id and C.id_area=VP.id_area and
                    A.id= VP.id_area and
                    C.pais='".$pais."'  ".$cod."  order by C.id desc";
                }else{
                    $query="select C.id as idC, C.num_empleado,C.id_vp,C.fecha_amonestacion, C.id_tipo_amonestacion, 
                    C.id_amonestacion_consecuencia, C.motivo_amonestacion, C.num_reincidencia, C.comentarios, C.cod_division, C.pais, 
                    D.*, E.nombre, E.posicion,E.area_personal, E.sociedad, E.cod_division, TA.id, TA.amonestacion, V.*,VP.* , A.*
                    from Consecuencias C,Divisiones D, Empleados E , TiposAmonestacion TA, Vicepresidencias V , VP_Areas VP, Areas A
                    where TA.id=C.id_tipo_amonestacion and 
                    E.num_empleado=C.num_empleado and 
                    C.cod_division=D.cod_division and 
                    C.id_vp=V.id and C.id_area=VP.id_area and
                    A.id= VP.id_area and
                    C.pais='honduras' union
                    select C.id as idC, C.num_empleado,C.id_vp,C.fecha_amonestacion, C.id_tipo_amonestacion, 
                    C.id_amonestacion_consecuencia, C.motivo_amonestacion, C.num_reincidencia, C.comentarios, C.cod_division, C.pais, 
                    D.*, E.nombre, E.posicion,E.area_personal, E.sociedad, E.cod_division, TA.id, TA.amonestacion, V.*,VP.* , A.*
                    from Consecuencias C,Divisiones D, Empleados E , TiposAmonestacion TA, Vicepresidencias V , VP_Areas VP, Areas A
                    where TA.id=C.id_tipo_amonestacion and 
                    E.num_empleado=C.num_empleado and 
                    C.cod_division=D.cod_division and 
                    C.id_vp=V.id and C.id_area=VP.id_area and
                    A.id= VP.id_area and
                    C.pais='nicaragua' union
                    select C.id as idC, C.num_empleado,C.id_vp,C.fecha_amonestacion, C.id_tipo_amonestacion, 
                    C.id_amonestacion_consecuencia, C.motivo_amonestacion, C.num_reincidencia, C.comentarios, C.cod_division, C.pais, 
                    D.*, E.nombre, E.posicion,E.area_personal, E.sociedad, E.cod_division, TA.id, TA.amonestacion, V.*,VP.* , A.*
                    from Consecuencias C,Divisiones D, Empleados E , TiposAmonestacion TA, Vicepresidencias V , VP_Areas VP, Areas A
                    where TA.id=C.id_tipo_amonestacion and 
                    E.num_empleado=C.num_empleado and 
                    C.cod_division=D.cod_division and 
                    C.id_vp=V.id and C.id_area=VP.id_area and
                    A.id= VP.id_area and
                    C.pais='costa rica' union
                    select C.id as idC, C.num_empleado,C.id_vp,C.fecha_amonestacion, C.id_tipo_amonestacion, 
                    C.id_amonestacion_consecuencia, C.motivo_amonestacion, C.num_reincidencia, C.comentarios, C.cod_division, C.pais, 
                    D.*, E.nombre, E.posicion,E.area_personal, E.sociedad, E.cod_division, TA.id, TA.amonestacion, V.*,VP.* , A.*
                    from Consecuencias C,Divisiones D, Empleados E , TiposAmonestacion TA, Vicepresidencias V , VP_Areas VP, Areas A
                    where TA.id=C.id_tipo_amonestacion and 
                    E.num_empleado=C.num_empleado and 
                    C.cod_division=D.cod_division and 
                    C.id_vp=V.id and C.id_area=VP.id_area and
                    A.id= VP.id_area and
                    C.pais='el salvador'  union
                    select C.id as idC, C.num_empleado,C.id_vp,C.fecha_amonestacion, C.id_tipo_amonestacion, 
                    C.id_amonestacion_consecuencia, C.motivo_amonestacion, C.num_reincidencia, C.comentarios, C.cod_division, C.pais, 
                    D.*, E.nombre, E.posicion,E.area_personal, E.sociedad, E.cod_division, TA.id, TA.amonestacion, V.*,VP.* , A.*
                    from Consecuencias C,Divisiones D, Empleados E , TiposAmonestacion TA, Vicepresidencias V , VP_Areas VP, Areas A
                    where TA.id=C.id_tipo_amonestacion and 
                    E.num_empleado=C.num_empleado and 
                    C.cod_division=D.cod_division and 
                    C.id_vp=V.id and C.id_area=VP.id_area and
                    A.id= VP.id_area and
                    C.pais='guatemala'";
                }
           

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}
        
        static public function mdlMostrarArchivoConsecuencias($tabla,$idC)
        {
            conexion::conectar();
             $query="select top 1 AC.*, A.* from ".$tabla." AC, Archivos A where AC.id_archivo=A.id and AC.id_consecuencias=".$idC." order by AC.id_archivo desc";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

        static public function mdlActualizarConsecuencia($tabla,$datos)
        {
            conexion::conectar();
              $query="UPDATE ".$tabla." SET fecha_amonestacion='".$datos['fecha_amonestacion']."', motivo_amonestacion='".$datos['motivo_amonestacion']."',num_reincidencia='".$datos['num_reincidencia']."',comentarios='".$datos['comentarios']."' WHERE id=".$datos['idC']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }

        }

        static public function mdlEliminarConsecuencia($tabla,$datos)
        {
            conexion::conectar();
            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idC'];
            // $query="UPDATE ".$tabla." SET estatus='B' WHERE id=".$datos['id']."";
            // $query ="delete from" .$tabla." where id=".$datos['id']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }
		}

		// static public function mdlMostrarTiposConsecuencias($tabla)
        // {
        //     conexion::conectar();
            
        //      $query="SELECT * FROM ".$tabla;
        //     //  $query="SELECT P.id, P.num_proveedor, P.Proveedor, P.rfc, P.correo, P.id_contacto, P.moneda, P.cod_planta, P.estatus, U.id as idu, U.usuario, U.nombre_usuario  FROM ".$tabla." P, Usuarios U";
            
        //     $sql = mssql_query($query);
        //     while($rs = mssql_fetch_object($sql))
        //     {
        //         $result[] = $rs;
        //     }
        //     return $result;
		// }

	}