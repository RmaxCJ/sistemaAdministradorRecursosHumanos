<?php


require_once "conexion.php";

class ModeloConceptos
{


    static public function mdlAgregarMedioDefensa($datos)
    {

//        echo "mdl";
//        print_r($datos);

        conexion::conectar();
        $query = "insert into MediosDefensa(medio_defensa, descripcion)values('".$datos['defensa']."','" . $datos['descripcionDefensa'] . "')";
//            mssql_query($query);
//        echo mssql_query($query);
        if (mssql_query($query)) {
            return "ok";
        } else {
            return "error";
        }


    }
    static public function mdlAgregarEstatus($datos)
    {

//        echo "mdl";
//        print_r($datos);

        conexion::conectar();
        $query = "insert into EstatusRevisionMulta(estatus, descripcion)values('".$datos['estatus']."','" . $datos['descripcionEstatus'] . "')";
//            mssql_query($query);
//        echo mssql_query($query);
        if (mssql_query($query)) {
            return "ok";
        } else {
            return "error";
        }


    }

    static public function mdlAgregarArea($datos)
    {

//        echo "mdl";
//        print_r($datos);

        conexion::conectar();
        $query = "insert into AreasRevisionMulta(area_revision_multa, descripcion)values('".$datos['area']."','" . $datos['descripcionArea'] . "')";
//            mssql_query($query);
//        echo mssql_query($query);
        if (mssql_query($query)) {
            return "ok";
        } else {
            return "error";
        }


    }
    static public function mdlAgregarResultado($datos)
    {

//        echo "mdl";
//        print_r($datos);

        conexion::conectar();
        $query = "insert into ResultadosRevisionMulta(resultado, descripcion)values('".$datos['resultado']."','" . $datos['descripcionResultado'] . "')";
//            mssql_query($query);
//        echo mssql_query($query);
        if (mssql_query($query)) {
            return "ok";
        } else {
            return "error";
        }


    }

    static public function mdlMostrarDefensas()
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2 = "SELECT * FROM MediosDefensa";

        $sql2 = mssql_query($query2);

        while ($rs2 = mssql_fetch_object($sql2)) {
            $result2[] = $rs2;
        }
        return $result2;

    }
    static public function mdlMostrarEstatus()
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2 = "SELECT * FROM EstatusRevisionMulta";

        $sql2 = mssql_query($query2);

        while ($rs2 = mssql_fetch_object($sql2)) {
            $result2[] = $rs2;
        }
        return $result2;

    }
    static public function mdlMostrarAreas()
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2 = "SELECT * FROM AreasRevisionMulta";

        $sql2 = mssql_query($query2);

        while ($rs2 = mssql_fetch_object($sql2)) {
            $result2[] = $rs2;
        }
        return $result2;

    }

    static public function mdlMostrarResultados()
    {
//        echo "mdlMostrarPagosPorDia";
        conexion::conectar();

        $query2 = "SELECT * FROM ResultadosRevisionMulta";

        $sql2 = mssql_query($query2);

        while ($rs2 = mssql_fetch_object($sql2)) {
            $result2[] = $rs2;
        }
        return $result2;

    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    static public function mdlEliminarDefensa($post)
    {


        conexion::conectar();
        $query="DELETE FROM MediosDefensa where id=".$post['idDefensa'];

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }
    static public function mdlEliminarEstatus($post)
    {


        conexion::conectar();
        $query="DELETE FROM EstatusRevisionMulta where id=".$post['idEstatus'];

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }
    static public function mdlEliminarArea($post)
    {


        conexion::conectar();
        $query="DELETE FROM AreasRevisionMulta where id=".$post['idArea'];

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }
    static public function mdlEliminarResultado($post)
    {


        conexion::conectar();
        $query="DELETE FROM ResultadosRevisionMulta where id=".$post['idResultado'];

//            $query="DELETE FROM  ".$tabla."  WHERE id=".$datos['idUsuario']."";

        if(mssql_query($query))
        {
            return "ok";
        }else{
            return "error";
        }

    }


}