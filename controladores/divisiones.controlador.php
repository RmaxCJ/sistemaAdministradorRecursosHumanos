<?php

	class ControladorDivisiones
    {

		static public function ctrMostrarDivisiones($cod_divisiones)
        {

			$respuesta = ModeloDivisiones::mdlMostrarDivisiones($cod_divisiones);
			return $respuesta;
		}

		static public function ctrMostrarDivisionesPais($pais)
        {
			$tabla="Divisiones";
			//    echo $tabla;
			//    echo $item;
			//    echo $valor;
			$respuesta = ModeloDivisiones::mdlMostrarDivisionesPais($tabla,$pais);
			return $respuesta;
		}
    static public function ctrMostrarDivisionesxPais($pais)
    {
        // print_r($pais);
        $respuesta = ModeloDivisiones::mdlMostrarDivisionesxPais($pais);
        return $respuesta;
    }

	
	static public function ctrMostrarDivisionesSoloPais($pais)
	{
		$tabla="Divisiones";
		$respuesta = ModeloDivisiones::mdlMostrarDivisionesSoloPais($tabla,$pais);
		return $respuesta;
	}

	


}