<?php

	class ControladorConsecuencias{

		static public function ctrCrearAddConsecuencias($datos)
        {
//			echo "ctr";
//			print_r($datos);
			// $tabla="Proveedores";
			if(isset($datos))
            {
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['proveedor']))
				{


					$tabla = "Proveedores";

					$respuesta  = ModeloConsecuencias::mdlIngresarAddConsecuencias($tabla, $datos);
//					echo $respuesta;
					return $respuesta;


				}//pragmatch
			}// isset
		}
	}