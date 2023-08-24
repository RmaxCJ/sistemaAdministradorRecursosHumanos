<?php
	require_once "conexion.php";
	class ModeloProveedores{

		static public function mdlEditarProveedores($tabla,$datos)
        {
        //    echo "mdl<pre>";
        //    print_r($datos);
        //    echo "</pre>";
            conexion::conectar();
              $query="UPDATE ".$tabla." SET num_proveedor='".$datos['num_proveedor']."',proveedor='".$datos['proveedor']."',rfc='".$datos['rfc']."',correo='".$datos['correo']."',id_contacto='".$datos['contacto']."',moneda='".$datos['moneda']."',cod_planta='".$datos['cod_planta']."',estatus='".$datos['estatus']."' WHERE id=".$datos['id']."";

            if(mssql_query($query))
            {
                return "ok";
            }else{
                return "error";
            }

        }
		static public function mdlMostrarProveedores($tabla)
        {
            conexion::conectar();
            
             $query="SELECT * FROM ".$tabla;
            //  $query="SELECT P.id, P.num_proveedor, P.Proveedor, P.rfc, P.correo, P.id_contacto, P.moneda, P.cod_planta, P.estatus, U.id as idu, U.usuario, U.nombre_usuario  FROM ".$tabla." P, Usuarios U";
            
            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
		}

        static public function mdlMostrarProveedoresSindicato($pais)
        {
            conexion::conectar();

            $query="SELECT * 
FROM Proveedores as P, Sindicatos as S, Divisiones as D
WHERE P.id=S.id_proveedor and S.cod_division=D.cod_division and D.pais like '%".$pais."%'";
            //  $query="SELECT P.id, P.num_proveedor, P.Proveedor, P.rfc, P.correo, P.id_contacto, P.moneda, P.cod_planta, P.estatus, U.id as idu, U.usuario, U.nombre_usuario  FROM ".$tabla." P, Usuarios U";

            $sql = mssql_query($query);
            while($rs = mssql_fetch_object($sql))
            {
                $result[] = $rs;
            }
            return $result;
        }



        static public function mdlIngresarProveedores($tabla,$datos)
        {
			
			conexion::conectar();

			 $query = "insert into ".$tabla." (num_proveedor,proveedor,rfc,correo,id_contacto,moneda,cod_planta,estatus,fecha_alta)values('".$datos['num_proveedor']."','".$datos['proveedor']."','".$datos['rfc']."','".$datos['correo']."','".$datos['contacto']."','".$datos['moneda']."','".$datos['codplanta']."','".$datos['estatus']."','".$datos['fecha_alta']."')";
//            mssql_query($query);

			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}


		// static public function mdlBorrarProveedores($tabla,$datos)
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