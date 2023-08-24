<?php
require_once "conexion.php";
class ModeloTablasDEV
{

    static public function mdlTablas()
    {
//        echo "mdlTablas";
        conexion::conectar();


        $query= "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE'";
//        $query="SELECT * FROM Pagos";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

///////////////////////////////////////////////////////////////////////////////
    static public function mdlconsultarTabla($post)
    {
//        echo "mdlTablas";
        conexion::conectar();


         $query= "SELECT * FROM ".$post['valueButton'];
//        $query="SELECT * FROM Pagos";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

    ///////////////////////////////////////////////////////////////////////////////
    static public function mdlquerySQL($post)
    {
//        echo "mdlTablas";
        conexion::conectar();
        $query= $post['query'];
//        $query="SELECT * FROM Pagos";
        $sql = mssql_query($query);
        while($rs = mssql_fetch_object($sql))
        {
            $result[] = $rs;
        }
        return $result;
    }

}