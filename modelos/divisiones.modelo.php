<?php
	require_once "conexion.php";
	class ModeloDivisiones{

// 		static public function mdlEditarSindicatos($tabla,$datos)
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
        


		static public function mdlMostrarDivisiones($cod_divisiones)
        {
            conexion::conectar();
            if ($cod_divisiones!="" || $cod_divisiones!=null)
            {
                // $query="select *from Divisiones where cod_division='".$cod_divisiones."' order by pais asc";
                  $query="select *from Divisiones where cod_division in(".$cod_divisiones.") order by pais asc";


            }
            elseif ($cod_divisiones=="" || $cod_divisiones==null )
            {
                 $query="select *from Divisiones order by pais asc";

            }
            //  $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus FROM ".$tabla." as S, Usuarios as U where U.id=S.id_responsable";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

        static public function mdlMostrarDivisionesPais($tabla,$pais)
        {
            conexion::conectar();
            if($pais=='centroAmerica'){//se ocupa este if para consecuencias
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
            
            $query="SELECT * FROM ".$tabla." where pais='".$pais."' order by cod_division asc";
                //  $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus FROM ".$tabla." as S, Usuarios as U where U.id=S.id_responsable";

                $sql = mssql_query($query);
                while($rs = mssql_fetch_object($sql))
                {
                    $result[] = $rs;
                }
                return $result;
            }
		}
    static public function mdlMostrarDivisionesxPais($pais)
    {
        conexion::conectar();

         $query="SELECT * FROM Divisiones where pais like '%".$pais."%'";
        //  $query="SELECT U.id as idu, U.id_perfil, U.usuario, S.id, S.sindicato, S.nombre_corto, S.cod_division, S.id_responsable, S.estatus FROM ".$tabla." as S, Usuarios as U where U.id=S.id_responsable";

        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public function mdlMostrarDivisionesSoloPais($tabla,$pais)
    {
        conexion::conectar();
        if($pais!=''){
            $query="SELECT DISTINCT  pais FROM Divisiones where pais='".$pais."'";
        }else{
            $query="SELECT DISTINCT  pais FROM Divisiones ";
        }
        
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    static public  function mdlDivisionExternos($idUsuario)
    {
        conexion::conectar();


         $query= "SELECT * 
        FROM UsuariosDivision UD, Divisiones as D
        where UD.cod_division=D.cod_division and UD.id_usuario=$idUsuario";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_array($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }



//         static public function mdlIngresarSindicatos($tabla,$datos)
//         {
			
// 			conexion::conectar();

// 			 $query = "insert into ".$tabla." (sindicato,nombre_corto,cod_division,id_responsable,estatus,fecha_alta)values('".$datos['Sindicato']."','".$datos['NombreCorto']."','".$datos['Cod_Division']."','".$datos['id_Responsable']."','".$datos['estatus']."','".$datos['fecha_alta']."')";
// //            mssql_query($query);

// 			if(mssql_query($query)){
// 				return "ok";
// 			}else{
// 				return "error";
// 			}
// 		}


		// static public function mdlBorrarSindicatos($tabla,$datos)
        // {
        //     conexion::conectar();
        //     // $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['id']."";
        //     $query="UPDATE ".$tabla." SET estatus='B' WHERE id=".$datos['id']."";
        // //    echo $query ="delete from" .$tabla." where id=".$datos['id']."";

        //     if(mssql_query($query))
        //     {
        //         return "ok";
        //     }else{
        //         return "error";
        //     }
		// }
	}