<?php
	require_once "conexion.php";
	class ModeloMinutas{

// 		static public function mdlEditarMinutas($tabla,$datos)
//         {
// //            echo "mdl<pre>";
// //            print_r($datos);
// //            echo "</pre>";
//             conexion::conectar();
//              $query="UPDATE ".$tabla." SET sindicato='".$datos['Sindicato']."',nombre_corto='".$datos['NombreCorto']."',cod_division='".$datos['Cod_division']."',id_responsable='".$datos['id_Responsable']."' WHERE id=".$datos['id']."";

//             if(mssql_query($query))
//             {
//                 return "ok";
//             }else{
//                 return "error";
//             }

//         }
        

        // select * from AcuerdosMinuta where id_minuta = 1
		static public function mdlMostrarAcuerdosMinutas($tabla)
        {
            conexion::conectar();
            
             $query="SELECT ACM.id_minuta, ACM.acuerdo, ACM.fecha_compromiso, ACM.responsable, ACM.comentarios FROM  AcuerdosMinuta  ArchivosMinuta as ARM where U.id=M.id_usuario and S.id=M.id_sindicato and M.id=AM.id_minuta and M.id=ACM.id_minuta and M.id=ARM.id_minuta";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }
        
        static public function mdlMostrarMinutas($cod_division,$pais)
        {
            conexion::conectar();


            if ($pais==null|| $pais=="") // perfil 3 (sindicato, solo su division)
            {
                $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id as id_sindicato, S.sindicato, S.nombre_corto, S.cod_division, M.id as idm, M.id_sindicato, M.lugar, M.tema, M.estatus, M.id_usuario, M.fecha_alta, M.generales, M.horainicio, M.horafinal, M.id_usuario_responsable, M.usuario_responsable, ARM.id_minuta, ARM.id_archivo,AR.id as ARID,AR.nombre,AR.archivo 
                        FROM Sindicatos as S, Usuarios as U, Minutas as M, ArchivosMinuta as ARM,Archivos as AR,Divisiones as D
                        where U.id=M.id_usuario and S.id=M.id_sindicato and M.id=ARM.id_minuta  and ARM.id_archivo=AR.id and D.cod_division=S.cod_division and D.cod_division in(".$cod_division.") order by M.fecha_alta DESC";


            }
            elseif ($cod_division==null|| $cod_division=="")// perfil 4 (Abogado general, solo su pais [todas las divisiones])
            {
                $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id as id_sindicato, S.sindicato, S.nombre_corto, S.cod_division, M.id as idm, M.id_sindicato, M.lugar, M.tema, M.estatus, M.id_usuario, M.fecha_alta, M.generales, M.horainicio, M.horafinal, M.id_usuario_responsable, M.usuario_responsable, ARM.id_minuta, ARM.id_archivo,AR.id as ARID,AR.nombre,AR.archivo 
                        FROM Sindicatos as S, Usuarios as U, Minutas as M, ArchivosMinuta as ARM,Archivos as AR,Divisiones as D
                        where U.id=M.id_usuario and S.id=M.id_sindicato and M.id=ARM.id_minuta  and ARM.id_archivo=AR.id and D.cod_division=S.cod_division and D.pais='".$pais."' order by M.fecha_alta DESC";


            }
            elseif ($pais=="admin" && $cod_division=="admin")
            {

                $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id as id_sindicato, S.sindicato, S.nombre_corto, S.cod_division, M.id as idm, M.id_sindicato, M.lugar, M.tema, M.estatus, M.id_usuario, M.fecha_alta, M.generales, M.horainicio, M.horafinal, M.id_usuario_responsable, M.usuario_responsable, ARM.id_minuta, ARM.id_archivo,AR.id as ARID,AR.nombre,AR.archivo 
                        FROM Sindicatos as S, Usuarios as U, Minutas as M, ArchivosMinuta as ARM,Archivos as AR 
                        where U.id=M.id_usuario and S.id=M.id_sindicato and M.id=ARM.id_minuta  and ARM.id_archivo=AR.id order by M.fecha_alta DESC";


            }
















            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

///////////////////////////////////////////////////////////////////////////////ingresar minutas
        static public function mdlIngresarMinutas($tabla,$datos)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla." (id_sindicato,tema,estatus,id_usuario,fecha_alta,generales,horainicio,horafinal,id_usuario_responsable,usuario_responsable,lugar)
             values('".$datos['id_sindicato']."','".$datos['tema']."','".$datos['estatus']."','".$datos['id_usuario']."','".$datos['fecha_alta']."','".$datos['generales']."','".$datos['horainicio']."','".$datos['horafin']."','".$datos['id_usuario_resp']."','".$datos['externo']."','".$datos['lugar']."')";
//            mssql_query($query);
			if(mssql_query($query)){
                //regrear id de guardado de la minuta

                $query2     ="SELECT MAX(id) AS id FROM Minutas";
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
        static public function mdlIngresarTemasMinutas($tabla6,$id,$datos)
        {			
            //TemasMinuta
            // date('Y-m-d H:i:s'),
			conexion::conectar();
            $jsonT = $datos['jsonTemas'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
            $array = explode("~", $jsonT);//separando por tilde para poder leer los arreglos que vengan
            foreach ($array as $value) {//serecorren los arreglos

                if ($value === end($array)) {
                    // echo "ÚLTIMO ELEMENTO";
                    return "ok";
                }else{
                    $query = "insert into ".$tabla6." (id_minuta,tema,fecha)values('".$id."','".$value."','".date('Y-m-d H:i:s')."')";
                    mssql_query($query);
                }
            }
        }
        
        static public function mdlIngresarAsistenteMinuta($tabla2,$id,$datos)
        {			
            conexion::conectar();
            $jsonAsi = $datos['jsonAsistentes'];
            $AsistentesSR = $datos['AsistentesSR'];
            $array = explode("~", $jsonAsi);
            foreach ($array as $value) {//serecorren los arregl
                if ($value === end($array)) {
                    // return "ok";
                    $ok1 = 'ok';
                }else{

                    $query = "insert into ".$tabla2." (id_minuta,nombre_asistente)values('".$id."','".$value."')";
                    mssql_query($query);
                }
            }
            if($AsistentesSR!=''){
                $array2 = explode(",", $AsistentesSR);
                foreach ($array2 as $value2) {//serecorren los arregl
                    if ($value2 === end($array2)) {
                        // return "ok";
                        $ok2 = 'ok';
                    }else{

                         $query = "insert into ".$tabla2." (id_minuta,nombre_asistente,nombre_asistentesr)values('".$id."','NA','".$value2."')";
                        mssql_query($query);
                    }
                }
            }
            if($ok1=='ok' || $ok2=='ok')
            {
                return "ok";
            }
        }
        static public function mdlIngresarAcuerdosMinutas($tabla3,$id,$datos)
        {			
			conexion::conectar();
            $jsonAcu = $datos['jsonAcuerdos'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
            $jsonAcu2 = $datos['jsonAcuerdos2'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
            $array = explode("~", $jsonAcu);//separando por tilde para poder leer los arreglos que vengan
            foreach ($array as $value) {//serecorren los arreglos
                // mssql_query($query);
                if ($value === end($array)) {
                    // echo "ÚLTIMO ELEMENTO";
                    // return "ok";
                    $ok1 = 'ok';
                }else{
                    // return "error";
                    // echo "$value <br>";
                    $array2 = explode("/", $value);
                    $acuerdo = $array2[0]; // primer arreglo
                    $fechaacu = $array2[1]; // segundo arreglo
                    $responsable = $array2[2]; // segundo arreglo
                    $Comentarios = $array2[3]; // segundo arreglo
                    $query = "insert into ".$tabla3." (id_minuta,acuerdo,fecha_compromiso,responsable,comentarios)values('".$id."','".$acuerdo."','".$fechaacu."','".$responsable."','".$Comentarios."')";
                    mssql_query($query);
                }
            }

            if($jsonAcu2!='')
            {
                $array2 = explode("~", $jsonAcu2);
                foreach ($array2 as $value2) {//serecorren los arreglos
                    if ($value2 === end($array2)) {
                        // echo "ÚLTIMO ELEMENTO";
                        // return "ok";
                         $ok2 = 'ok';
                    }else{
                        $array22 = explode("/", $value2);
                        $id_acuerdo = $array22[0]; // primer arreglo id
                        $estatus = $array22[1]; // segundo arreglo estatus
                        $query = "update ".$tabla3." set estatus='".$estatus."' where id=".$id_acuerdo." ";
                        mssql_query($query);
                    }
                }

            }
            if($ok1=='ok' || $ok2=='ok')
            {
                return "ok";
            }
            // echo "no entro";

//             echo $query = "insert into ".$tabla3." (id_minuta,acuerdo,fecha_compromiso,responsable,comentarios)values('".$id."','".$datos['acuerdo']."','".$datos['fcompromiso']."','".$datos['responsable']."','".$datos['comentarios']."')";
//             // insert into AcuerdosMinuta (id_minuta,acuerdo,fecha_compromiso,responsable,comentarios)values('27','acuerdo','2020-12-09','RESPONSABLE','')
// //            mssql_query($query);
// 			if(mssql_query($query)){
//                 //regrear id de guardado de la minuta
// 				return "ok";
// 			}else{
// 				return "error";
// 			}
        }
        static public function mdlIngresarArchivosMinutas($tabla4,$id,$idArchivo)
        {			
			conexion::conectar();
			 $query = "insert into ".$tabla4." (id_minuta,id_archivo)values('".$id."','".$idArchivo."')";
//            mssql_query($query);
			if(mssql_query($query)){
                //regrear id de guardado de la minuta
				return "ok";
			}else{
				return "error";
			}
		}
// /////////////////////////////////////////////////////////////////////////////////////editar minutas
//         static public function mdlEditarMinutas($tabla,$datos)
//         {			
// 			conexion::conectar();           
//              $query="UPDATE ".$tabla." SET id_sindicato='".$datos['id_sindicato']."',tema='".$datos['tema']."',estatus='".$datos['estatus']."',id_usuario='".$datos['id_usuario']."',generales='".$datos['generales']."' WHERE id=".$datos['id']."";
// 			if(mssql_query($query)){
//                 return "ok";
//             }
//             else{
// 				return "error";
// 			}
//         }
        
//         static public function mdlEditarAsistenteMinuta($tabla2,$datos)
//         {			
// 			conexion::conectar();
//             $query="UPDATE ".$tabla2." SET nombre_asistente='".$datos['nombre_asistente']."' WHERE id_minuta=".$datos['id']."";
// 			if(mssql_query($query)){
// 				return "ok";
// 			}else{
// 				return "error";
// 			}
//         }
//         static public function mdlEditarAcuerdosMinutas($tabla3,$datos)
//         {			
// 			conexion::conectar();
//            echo $jsonAcu = $datos['jsonAcuerdos'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
//            echo  $jsonAcuEdit = $datos['jsonAcuerdosEdit'];//variable creada con jquery con arreglos de acuerdos nnumero de acuerdos
            
//             if(isset($datos['jsonAcuerdos'])){
//                 $array = explode("~", $jsonAcu);
//                 // if($jsonAcu!=""){//si si trae algo se insertan nuevos registros
//                     $estatus='';
//                     foreach ($array as $value) {//serecorren los arreglo
//                         if ($value === end($array)) {
//                             // echo "ÚLTIMO ELEMENTO";
//                             // return "ok";
//                             $estatus ='ok';
//                         }else{
//                             // 4/ssdfsdf/2021-01-06/sdfff/sdfsdf~
//                             $array2      = explode("/", $value);
//                             $id_min      = $array2[0]; // primer arreglo
//                             $acuerdo     = $array2[1]; // primer arreglo
//                             $fechaacu    = $array2[2]; // segundo arreglo
//                             $responsable = $array2[3]; // segundo arreglo
//                             $Comentarios = $array2[4]; // segundo arreglo
//                             $query = "insert into ".$tabla3." (id_minuta,acuerdo,fecha_compromiso,responsable,comentarios)values('".$id_min."','".$acuerdo."','".$fechaacu."','".$responsable."','".$Comentarios."')";
//                             // mssql_query($query);
//                         }
//                     }
//             }else{
//                 $estatus = 'ok';
//             }

//             // }
//             if(isset($datos['jsonAcuerdosEdit'])){
//                 if($estatus='ok'){
//                     $arrayedit = explode("~", $jsonAcuEdit);
//                     // if($jsonAcuEdit!=""){//si si trae algo se insertan nuevos registros
//                         foreach ($arrayedit as $value) {//serecorren los arreglo
//                             if ($value === end($array)) {
//                                 // echo "ÚLTIMO ELEMENTO";
//                                 return "fin";
//                             }else{
//                                 // 5/4/acuerdo 2/2020-12-15/responable 2/comentarios 2~ 
//                                 $array2e       = explode("/", $value);
//                                 $id_acuerdo    = $array2e[0]; // primer arreglo
//                                 $id_minu       = $array2e[1]; // primer arreglo
//                                 $acuerdo       = $array2e[2]; // primer arreglo
//                                 $fechaacu      = $array2e[3]; // segundo arreglo
//                                 $responsable   = $array2e[4]; // segundo arreglo
//                                 $Comentarios   = $array2e[5]; // segundo arreglo
//                                 // $query = "insert into ".$tabla3." (id_minuta,acuerdo,fecha_compromiso,responsable,comentarios)values('".$id."','".$acuerdo."','".$fechaacu."','".$responsable."','".$Comentarios."')";
//                                 $query="UPDATE ".$tabla3." SET acuerdo='".$acuerdo."',fecha_compromiso='".$fechaacu."',responsable='".$responsable."',comentarios='".$Comentarios."' WHERE id_minuta=".$id_minu." and id=".$id_acuerdo."";
//                                 // mssql_query($query);
//                             }
//                         }
//                 }
//             }

//             // }




//             // conexion::conectar();
//             //  $query="UPDATE ".$tabla3." SET acuerdo='".$datos['acuerdo']."',fecha_compromiso='".$datos['fcompromiso']."',responsable='".$datos['responsable']."',comentarios='".$datos['comentarios']."' WHERE id_minuta=".$datos['id']."";
// 			// if(mssql_query($query)){
// 			// 	return "ok";
// 			// }else{
// 			// 	return "error";
// 			// }
//         }
//         static public function mdlEditarArchivosMinutas($tabla4,$datos)
//         {			
// 			conexion::conectar();
//              $query="UPDATE ".$tabla4." SET id_archivo='".$datos['id']."' WHERE id_minuta=".$datos['id']."";
// 			if(mssql_query($query)){
// 				return "ok";
// 			}else{
// 				return "error";
// 			}
//         }
/////////////////////////////////////////////////////////////////////////borrar minutas
		static public function mdlBorrarMinutas($tabla,$datos)
        {
            conexion::conectar();
            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";//minutas
            // $query="UPDATE ".$tabla." SET estatus='I' WHERE id=".$datos['id']."";
        //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

            if(mssql_query($query))
            {
                $query2="DELETE FROM  AsistentesMinuta  WHERE id_minuta=".$datos['id']."";//Asistentes minutas
                mssql_query($query2);
                $query3="DELETE FROM  AcuerdosMinuta  WHERE id=".$datos['id']."";//acuerdos minutas minutas
                mssql_query($query3);
                $query4="DELETE FROM  TemasMinuta WHERE id_minuta=".$datos['id']."";//Asistentes minutas
                mssql_query($query4);
                $query5="DELETE FROM  ArchivosMinutas  WHERE id_minuta=".$datos['id']."";//Asistentes minutas
                mssql_query($query5);
                return "ok";
            }else{
                return "error";
            }
        }
        /////////////////////////////////////////////////////////////////////////////mostrar minutasID

        static public function ctrMostrarMinutasID($tabla,$id_minuta)
        {
            conexion::conectar();
            
             $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id as id_sindicato, S.sindicato, S.nombre_corto, M.id as idm, M.id_sindicato, M.tema, M.estatus, M.id_usuario, M.generales, M.horainicio, M.horafinal, M.fecha_alta, M.id_usuario_responsable, M.usuario_responsable, M.lugar, AM.id_minuta, AM.nombre_asistente, ARM.id_minuta, ARM.id_archivo FROM Sindicatos as S, Usuarios as U, Minutas as M, AsistentesMinuta as AM, ArchivosMinuta as ARM where U.id=M.id_usuario and S.id=M.id_sindicato and M.id=AM.id_minuta and M.id=ARM.id_minuta and M.id=".$id_minuta.""; 
           

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }
        // select  M.id, TM.id_minuta, TM.tema from Minutas M, TemasMinuta TM where M.id=TM.id_minuta and TM.id_minuta=13
        static public function ctrMostrarTemasMinutasID($tabla,$id_minuta)
        {
            conexion::conectar();
            // select TM.*, M.id from Minutas as M, TemasMinuta as TM where M.id=TM.id_minuta  and TM.id_minuta=16
             $query="select TM.id, TM.id_minuta, TM.tema, M.id from Minutas as M, TemasMinuta as TM where M.id=TM.id_minuta  and TM.id_minuta=".$id_minuta.""; 
           

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlMostrarAcuerdosMinutasID($tabla,$id_minuta)
        {
            conexion::conectar();
            
             $query="SELECT id, id_minuta, acuerdo, fecha_compromiso, responsable, comentarios FROM  AcuerdosMinuta where id_minuta=".$id_minuta."";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlMostrarIdMaximoAcuerdobyId_sindicato($datos)
        {
            conexion::conectar();

             $query ="select MAX(M.id) AS id from MInutas as M where M.id_sindicato=".$datos['id_sindicato'].""; //para el valor maximo del los acuerdos

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
    
            // and M.id=".$id."
        }

        static public function mdlMostrarAcuerdosMinutasPasadas($datos,$tabla,$tabla2,$idMinuta)//para traer solo la con el id_minuta anterior
        {
            conexion::conectar();

             $query ="SELECT M.id AS id, M.id_sindicato, M.fecha_alta, AM.id as id_acuerdo, AM.id_minuta, AM.acuerdo, AM.fecha_compromiso, AM.responsable, AM.comentarios, AM.estatus from Minutas as M, AcuerdosMinuta AM where M.id=AM.id_minuta AND M.id_sindicato=".$datos['id_sindicato']."  and M.id=".$idMinuta." ORDER BY M.fecha_alta DESC ";
              

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlBuscarAcuerdosMinutasAnterior($id_sindicato)//para buscar el id anterior y mandarlo abajo
        //para todos los acuerdos de las minutas pasadas que tengan que ver con ese sindicato
        {
            conexion::conectar();
             $query ="SELECT DISTINCT  top 2 M.id AS id, AM.id_minuta 
             from Minutas as M, AcuerdosMinuta AM 
             where M.id=AM.id_minuta AND M.id_sindicato=".$id_sindicato."  ORDER BY M.id desc";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlMostrarAcuerdosMinutasPasadasS($id_sindicato,$idMinuta)
        //para todos los acuerdos de las minutas pasadas que tengan que ver con ese sindicato
        {
            conexion::conectar();
            //  $query ="SELECT M.id, M.id_sindicato, M.fecha_alta, AM.id as id_acuerdo, AM.id_minuta, AM.acuerdo, AM.fecha_compromiso, AM.responsable, AM.comentarios from Minutas as M, AcuerdosMinuta AM where M.id=AM.id_minuta AND M.id_sindicato=".$id_sindicato." ORDER BY M.fecha_alta DESC ";
             $query ="SELECT M.id AS id, M.id_sindicato, M.fecha_alta, AM.id as id_acuerdo, AM.id_minuta, AM.acuerdo, AM.fecha_compromiso, AM.responsable, AM.comentarios, AM.estatus from Minutas as M, AcuerdosMinuta AM where M.id=AM.id_minuta AND M.id_sindicato=".$id_sindicato."  and M.id=".$idMinuta." ORDER BY M.fecha_alta DESC ";
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

        static public function mdlMostrarAsistentesMinutasID($tabla,$id_minuta)
        {
            conexion::conectar();
            
             $query="SELECT id, id_minuta, nombre_asistente, nombre_asistentesr FROM  AsistentesMinuta where id_minuta=".$id_minuta."";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }

	}