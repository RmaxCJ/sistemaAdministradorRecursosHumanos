<?php
require_once "conexion.php";
class ModeloIdioma{

    static public function mdlTextosIdioma($tabla,$lang)
    {
        conexion::conectar();
        $query="SELECT ".$lang." FROM ".$tabla;

        $sql = mssql_query($query);
        while($rs = mssql_fetch_assoc($sql))
        {
            $result[] = $rs;
        }

        return $result;


    }



}