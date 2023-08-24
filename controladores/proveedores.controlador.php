<?php

	class ControladorProveedores{


		static public function ctrEditarProveedores($datos)
        {
//            			echo "ctr";
//			print_r($datos);
            // $tabla="Proveedores";
            if(isset($datos))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['proveedor']))
                {


                    $tabla = "Proveedores";
                    $respuesta  = ModeloProveedores::mdlEditarProveedores($tabla, $datos);
//					echo $respuesta;
                    return $respuesta;


                }//pragmatch
            }// isset
		}


		static public function ctrCrearProveedores($datos)
        {
//			echo "ctr";
//			print_r($datos);
			// $tabla="Proveedores";
			if(isset($datos))
            {
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['proveedor']))
				{


					$tabla = "Proveedores";

					$respuesta  = ModeloProveedores::mdlIngresarProveedores($tabla, $datos);
//					echo $respuesta;
					return $respuesta;


				}//pragmatch
			}// isset
		}

		static public function ctrMostrarProveedores()
        {
			$tabla="Proveedores";
			$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla);
			return $respuesta;
		}
        static public function ctrMostrarProveedoresSindicato($pais)
        {

            $respuesta = ModeloProveedores::mdlMostrarProveedoresSindicato($pais);
            return $respuesta;
        }




        // static public function ctrBorrarProveedores($datos)
        // {
        //     // print_r($datos);
		// 	if(isset($datos))
		// 	{
		// 		$tabla = "Proveedores";
        //         $respuesta = ModeloProveedores::mdlBorrarProveedores($tabla,$datos);
        //         return $respuesta;
				
		// 	}
		// }
	}