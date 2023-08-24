<?php


class ControladorCCT
{

    static public function ctrAgregarCCT($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {

//            echo "<pre>CTR";
//            print_r($post);
//            print_r($archivos);
//////        print_r($_SESSION);
////            echo count($archivos);
//
//
//            echo "</pre>";


//            exit();



//            echo "<pre>datos";
//            print_r($datos);
//            echo "</pre>";
//
//            echo getcwd() . "\n";
            $contArchivos=count($archivos);

            for ($x=0;$x<=$contArchivos-1;$x++)
            {

                $archivoname="archivo".$x;

//                echo "<br>";

                 $ruta="/var/www/html/relaciones/vistas/archivos/cct/".$post['año']."";
                //echo "<br>";
                $nombreArchivo=$archivos[$archivoname]['name'];
//                $nombreArchivo2=$_SESSION[]

                $nameArray = explode(".", $nombreArchivo);
//            echo "<pre>datos";
//                print_r($nombreArchivo);
//                print_r($nameArray);
                //echo "</pre>";
                $tipoArchivo=$archivos[$archivoname]['type'];
                $temporal=$archivos[$archivoname]['tmp_name'];
//               echo "<br>";
                $tamañoArchivo=$archivos[$archivoname]['size'];

                move_uploaded_file($temporal, "$ruta/$nombreArchivo");
//                print_r($temporal);
//                print_r($nombreCompleto);
//                print_r($nameArray);


//                echo "</pre>";

                $tabla="Archivos";
                $datos=array(
                    "id_tipo"=>7,
                    "anio"=>$post['año'],
                    "nombre"=>$nombreArchivo,
                    "archivo"=>$nombreArchivo,
                    "id_usuario"=>$post["idUser"],
                    "fecha_alta"=>date('Y-m-d H:i:s'),
                    "cod_division"=>$post['cod_division'],

                );

//                echo "<pre>DATOS";
//                print_r($datos);
//                echo "</pre>";

                $resIngArchivo  = ModeloCCT::mdlIngresarArchivosCCT($tabla,$datos);
//                print_r($resIngArchivo);
                $idArchivo = $resIngArchivo[0]->id;
            //    print_r($idArchivo);
                if ($idArchivo!='' AND $idArchivo!='error')
                {
                    $resIngArchivo  = ModeloCCT::mdlGuardarArchivoCCTSindicato($idArchivo,$post['sindicatoID']);

                    //array_push($arrayIdsArchivos,$idArchivo);
//                    return "finalizado";
                }


            }
            return "finalizado";

            // }//pragmatch
        }// isset
    }

    static public function ctrMostrarCCT($año,$division)
    {
        $respuesta=ModeloCCT::mdlMostrarCCT($año,$division);
        return $respuesta;
    }


//

}