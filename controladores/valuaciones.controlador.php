<?php

	class ControladorValuaciones{

		static public function ctrMostrarValuaciones()
        {
			$tabla="Valuaciones";
			$respuesta = ModeloValuaciones::mdlMostrarValuaciones($tabla);
			return $respuesta;
        }
        static public function ctrMostrarValuacionesDivisiones()
        {
			$tabla="PlantillaValuacion";
			$respuesta = ModeloValuaciones::mdlMostrarValuacionesDivision($tabla);
			return $respuesta;
        }
        static public function ctrBuscarDivisionPersonal($datos)
        {
			$tabla="PlantillaValuacion";
			$respuesta = ModeloValuaciones::mdlBuscarDivisionPersonal($tabla,$datos);
			return $respuesta;
        }

        static public function ctrBuscarBeneficios($id_valuacion)
        {
			$tabla="BeneficiosValuaciones";
			$respuesta = ModeloValuaciones::mdlBuscarBeneficios($tabla,$id_valuacion);
			return $respuesta;
        }
        
        
        static public function ctrBuscarDatos($datos)
        {
			$tabla="PlantillaValuacion";
			$respuesta = ModeloValuaciones::mdlBuscarDatos($tabla,$datos);
			return $respuesta;
        }

        static public function ctrAgregarValuacion($datos)
        {
            if(isset($datos))
            {
                // if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['usuario']))
                // {
                    $tabla = "Valuaciones";
                    $respuesta  = ModeloValuaciones::mdlIngresarValuacion($tabla, $datos);
                    $id_valuacion = $respuesta[0]->id;
                    if($id_valuacion!='' AND $id_valuacion!='error'){
						$tabla2 = "BeneficiosValuaciones";
                        $respuesta2  = ModeloValuaciones::mdlIngresarBeneficiosValuacion($tabla2,$id_valuacion,$datos);
                        // echo "<br>";
                        // print_r($respuesta2);
                        return $respuesta2;
                    }
                    // return $respuesta;
                // }//pragmatch
            }// isset
        }


    }