<?php

class ControladorExcel
{

    static public function ctrSubirExcelPagos()
    {

        $id_usuario = $_SESSION['id'];
        $success = 0;
//        echo "<pre>";
//        print_r($_POST);
//        print_r($_FILES);
//        echo "</pre>";
//        exit();
        $accion="";
        $archivo = $_FILES["archivoExcel"];
        $anio = $_REQUEST["anioExcel"];

        $nb_archivo = '';
        //$path = getcwd();
        $path = '/var/www/html/relaciones/';
        //echo $path;
        $dir = "vistas/archivos/pagos";

        $nombre_archivo = 'archivo_pagos';
        $nb_ori = $archivo['name'];
        if ($archivo['name'] != "")
        {
            $ext = explode('.',$archivo['name']);
//            echo "<pre>";
//            print_r($ext);
//            print_r($archivo['size']);
//            echo "</pre>";
//            echo "</  pre>";

            //verifica tamaño (no mayor a 10 Mega
            if ($archivo['size'] < 10000001)
            {
                $dia = date('d').date('s');
                $nombre_archivo = $nombre_archivo.$dia;
                $nombre_archivo = md5($nombre_archivo).'.'.$ext[1];

                 $archivo_destino = $dir."/".$nombre_archivo;
//exit();
                //reemplazamos comillas simples por nada
                $reemplazar = "'";
                $cadenaNueva = "";
                $archivo_destino = ereg_replace($reemplazar,$cadenaNueva,$archivo_destino);

                if($ext[1]=='xls' || $ext[1]=='xlsx')
                {
//                    echo "<br>copia archivo";
                    if (copy($archivo['tmp_name'], $path.$archivo_destino))
                    {	chmod($path.$archivo_destino, 0644 );
                        $nb_archivo = $archivo_destino;

                        $datos = array("anio"=>$anio, "nb_archivo"=>$nb_ori, "archivo"=>$nb_archivo, "id_usuario"=>$id_usuario);
//                        echo "<pre>";
//                        print_r($datos);
                       $resp= ModeloExcel::sube_archivo($datos,31);
//                       print_r($resp);
//                        echo "</pre>";
//                        exit();

                        if($resp=="ok")
                        {
                             $leyenda = 'Todo Bien';
                             $success = 1;
                            $accion = 'envia';

                        }
                        else
                        {	$leyenda = 'Si subio archivo, no registro en la BD';
                        }
                    }
                    else
                    {	$leyenda = 'No sube archivo';
                    }
                }
                else
                {	$leyenda = 'No es extensión xls o xlsx';
                }
            }
            else
            {	$leyenda = 'Pesa mas de 10Mb';
            }
        }
        else
        {	$leyenda = 'No ha seleccionado archivo';
        }

        if($accion == 'envia')
        {
//            $res0=ModeloExcel::borra_pagos($anio);
//            echo "entra en envia";
            ///ultimo archivo insertado
            $resp2 = ModeloExcel::max_archivo($anio, 31);
//            echo "<pre>resp2";
//            print_r($resp2);
            //$archivo = '../'.$dir.'/'.$archivo;	///coloca la dirección completa
            $archivo = $path.$resp2[0]->archivo;
//            print_r($archivo);

//            echo "</pre>";

            require_once 'Classes/PHPExcel/IOFactory.php';
            $XLFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($XLFileType);
            $objPHPExcel = $objReader->load($archivo);

            $colinit = 0;
            $rowinit = 2;
            $rows=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
            $cols=$objPHPExcel->getActiveSheet()->getHighestRow();

            $rows = 6;	///numero de columnas

            ///primero borra la tabla Pagos del año seleccionado
            //$obj_archivo->borra_pagos($anio);
            
//            echo '<table border=1>';
            for($i=$rowinit;$i<=$cols;$i++)
            {
                $datos = array();
//                echo '<tr>';

                $pasa = 'N';
                for($j=$colinit;$j<=$rows;$j++)
                {
                    $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();
//                    echo "<td>$cell</td>";
                    array_push($datos, $cell);
                }
//                echo '</tr>';

                $paso = 0;
                $resp3=ModeloExcel::registro_batch_pagos($datos, $anio);
//                echo "<pre>resp3";
//                print_r($resp3);
//                echo "</pre>";
//                exit();
                if($resp3)
                {
                    $paso = 1;

                }

                unset($datos);
            }
            echo "<script>
                    Swal.fire({
                         title: 'Success!',
                         text: '¡Se registraron correctamente los pagos!',
                         icon: 'success',
                         confirmButtonText:'Ok'
                     });
                  </script>";
//            echo '</table>';
        }

    }

    static public function ctrSubirNegociaciones()
    {
//        echo "<pre>";
//        print_r($_POST);
//        print_r($_FILES);
//        echo "</pre>";
//        exit();

        $id_usuario = $_SESSION['id'];

        $archivo = $_FILES["archivoExcel"];
        $anio = $_REQUEST["anioExcel"];

        $nb_archivo = '';
        //$path = getcwd();
        $path = '/var/www/html/relaciones/';
        //echo $path;
        $dir = "vistas/archivos/negociaciones";

        $nombre_archivo = 'subir_archivo_negociaciones';
        $nb_ori = $archivo['name'];
        if ($archivo['name'] != "")
        {	$ext = explode('.',$archivo['name']);

            //verifica tamaño (no mayor a 10 Mega
            if ($archivo['size'] < 10000001)
            {
                $dia = date('d').date('s');
                $nombre_archivo = $nombre_archivo.$dia;
                $nombre_archivo = md5($nombre_archivo).'.'.$ext[1];

                $archivo_destino = $dir."/".$nombre_archivo;

                //reemplazamos comillas simples por nada
                $reemplazar = "'";
                $cadenaNueva = "";
                $archivo_destino = ereg_replace($reemplazar,$cadenaNueva,$archivo_destino);

                if($ext[1]=='xls' || $ext[1]=='xlsx')
                {
                    //copia archivo
                    if (copy($archivo['tmp_name'], $path.$archivo_destino))
                    {	chmod($path.$archivo_destino, 0644 );
                        $nb_archivo = $archivo_destino;

                        $datos = array(anio=>$anio, nb_archivo=>$nb_ori, archivo=>$nb_archivo, id_usuario=>$id_usuario);

                        $resp= ModeloExcel::sube_archivo($datos,43);
//                        echo "<pre>";
//                        print_r($resp);
//                        echo "</pre>";

                        if($resp=="ok")
                        {
                            $leyenda = 'Todo Bien';
                            $success = 1;
                            $accion = 'envia';

                        }
                        else
                        {	$leyenda = 'Si subio archivo, no registro en la BD';
                        }
                    }
                    else
                    {	$leyenda = 'No sube archivo';
                    }
                }
                else
                {	$leyenda = 'No es extensión xls o xlsx';
                }
            }
            else
            {	$leyenda = 'Pesa mas de 10Mb';
            }
        }
        else
        {	$leyenda = 'No ha seleccionado archivo';
        }

        if($accion == 'envia')
        {
            ///ultimo archivo insertado
//            $archivo = $obj_archivo->max_archivo($anio, 43);
//            //$archivo = '../'.$dir.'/'.$archivo;	///coloca la dirección completa
//            $archivo = $path.$archivo;
            $resp2 = ModeloExcel::max_archivo($anio, 43);
            $archivo = $path.$resp2[0]->archivo;




            require_once 'Classes/PHPExcel/IOFactory.php';
            $XLFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($XLFileType);
            $objPHPExcel = $objReader->load($archivo);

            $colinit = 0;
            $rowinit = 2;
            $rows=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
            $cols=$objPHPExcel->getActiveSheet()->getHighestRow();

            $rows = 10;	///numero de columnas

            ///primero borra la tabla Negociaciones del año seleccionado
            //$obj_archivo->borra_negociaciones($anio);
            $res0=ModeloExcel::borra_negociaciones($anio);

//            echo '<table border=1>';
            for($i=$rowinit;$i<=$cols;$i++)
            {
                $datos = array();
//                echo '<tr>';

                $pasa = 'N';
                for($j=$colinit;$j<=$rows;$j++)
                {
                    $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();
//                    echo "<td>$cell</td>";
                    array_push($datos, $cell);
                }
//                echo '</tr>';

                $paso = 0;
                $resp3=ModeloExcel::registro_batch_negociaciones($datos, $anio);
//                echo "<pre>resp3";
//                print_r($resp3);
//                echo "</pre>";
//                exit();
                if($resp3)
                {
                    $paso = 1;

                }


//                if($obj_archivo->registro_batch_negociaciones($datos, $anio))
//                    $paso = 1;

                unset($datos);
            }
            echo "<script>
                    Swal.fire({
                         title: 'Success!',
                         text: '¡Se registraron correctamente las Negociaciones!',
                         icon: 'success',
                         confirmButtonText:'Ok'
                     });
                  </script>";
//            echo '</table>';
        }



    }









    static public function ctrSubirPlantilla()
    {

        $id_usuario = $_SESSION['id'];
        $accion="";


        $archivo = $_FILES["archivoExcel"];
        $anio = $_REQUEST["anioExcel"];
        $cod_division = $_REQUEST["division"];

        $nb_archivo = '';
        //$path = getcwd();
        $path = '/var/www/html/relaciones/';
        //echo $path;
        $dir = "vistas/archivos/plantillas";

        $nombre_archivo = 'archivo_plantilla';
        $nb_ori = $archivo['name'];
        if ($archivo['name'] != "")
        {	$ext = explode('.',$archivo['name']);

            //verifica tamaño (no mayor a 10 Mega
            if ($archivo['size'] < 10000001)
            {
                $dia = date('d').date('s');
                $nombre_archivo = $nombre_archivo.$dia;
                $nombre_archivo = md5($nombre_archivo).'.'.$ext[1];

                $archivo_destino = $dir."/".$nombre_archivo;

                //reemplazamos comillas simples por nada
                $reemplazar = "'";
                $cadenaNueva = "";
                $archivo_destino = ereg_replace($reemplazar,$cadenaNueva,$archivo_destino);

                if($ext[1]=='xls' || $ext[1]=='xlsx')
                {
                    //copia archivo
                    if (copy($archivo['tmp_name'], $path.$archivo_destino))
                    {	chmod($path.$archivo_destino, 0644 );
                        $nb_archivo = $archivo_destino;

                        $datos = array("anio"=>$anio, "nb_archivo"=>$nb_ori, "archivo"=>$nb_archivo, "id_usuario"=>$id_usuario);
                        $resp= ModeloExcel::sube_archivo($datos,32);
                        if($resp=="ok")
                        {
                            $leyenda = 'Todo Bien';
                            $success = 1;
                            $accion = 'envia';

                        }
                        else
                        {	$leyenda = 'Si subio archivo, no registro en la BD';
                        }
                    }
                    else
                    {	$leyenda = 'No sube archivo';
                    }
                }
                else
                {	$leyenda = 'No es extensión xls o xlsx';
                }
            }
            else
            {	$leyenda = 'Pesa mas de 10Mb';
            }
        }
        else
        {	$leyenda = 'No ha seleccionado archivo';
        }
        if($accion == 'envia')
        {
            ///ultimo archivo insertado
//            $archivo = $obj_archivo->max_archivo($anio, 32);
            $resp2 = ModeloExcel::max_archivo($anio, 32);

            //$archivo = '../'.$dir.'/'.$archivo;	///coloca la dirección completa
            $archivo = $path.$resp2[0]->archivo;

            require_once 'Classes/PHPExcel/IOFactory.php';
            $XLFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($XLFileType);
            $objPHPExcel = $objReader->load($archivo);

            $colinit = 0;
            $rowinit = 2;
            $rows=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
            $cols=$objPHPExcel->getActiveSheet()->getHighestRow();

            $rows = 27;	///numero de columnas

            ///primero borra la tabla PlantillaValuacion del año y division seleccionado
            $rsp=ModeloExcel::borrar_plantilla($anio,$cod_division);
//            $resp3=ModeloExcel::registro_batch_plantilla($datos, $anio, $cod_division);

//            echo '<table border=1>';
            for($i=$rowinit;$i<=$cols;$i++)
            {
                $datos = array();
//                echo '<tr>';

                $pasa = 'N';
                for($j=$colinit;$j<=$rows;$j++)
                {
                    $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();
//                    echo "<td>$cell</td>";
                    array_push($datos, $cell);
                }
//                echo '</tr>';

                $paso = 0;
//                if($obj_archivo->registro_batch_plantilla($datos, $anio, $cod_division))
//                    $paso = 1;
                $resp3=ModeloExcel::registro_batch_plantilla($datos, $anio, $cod_division);
//                echo "<pre>resp3";
//                print_r($resp3);
//                echo "</pre>";
//                exit();
                if($resp3)
                {
                    $paso = 1;

                }
                //echo ' -- '.$paso;

                unset($datos);
            }
            echo "<script>
                    Swal.fire({
                         title: 'Success!',
                         text: '¡Archivo Registrado Correctamente!',
                         icon: 'success',
                         confirmButtonText:'Ok'
                     });
                  </script>";
//            echo '</table>';
        }

        echo '<br>'.$leyenda;


    }

    public static function ctrSubirTabuladores()
    {
//        echo "<pre>";
//        print_r($_POST);
//        print_r($_FILES);
//        echo "</pre>";
//        exit();
        $archivo = $_FILES["archivoExcel"];
        $anio = $_REQUEST["anioExcel"];
        $id_usuario = $_SESSION['id'];
        $accion="";
        $nb_archivo = '';
        //$path = getcwd();
        $path = '/var/www/html/relaciones/';
        //echo $path;
        $dir = "vistas/archivos/plantillas";

        $nombre_archivo = 'archivo_tabuladores';
        $nb_ori = $archivo['name'];
        if ($archivo['name'] != "")
        {	$ext = explode('.',$archivo['name']);

            //verifica tamaño (no mayor a 10 Mega
            if ($archivo['size'] < 10000001)
            {
                $dia = date('d').date('s');
                $nombre_archivo = $nombre_archivo.$dia;
                $nombre_archivo = md5($nombre_archivo).'.'.$ext[1];

                $archivo_destino = $dir."/".$nombre_archivo;

                //reemplazamos comillas simples por nada
                $reemplazar = "'";
                $cadenaNueva = "";
                $archivo_destino = ereg_replace($reemplazar,$cadenaNueva,$archivo_destino);

                if($ext[1]=='xls' || $ext[1]=='xlsx')
                {
                    //copia archivo
                    if (copy($archivo['tmp_name'], $path.$archivo_destino))
                    {	chmod($path.$archivo_destino, 0644 );
                        $nb_archivo = $archivo_destino;

                        $datos = array("anio"=>$anio, "nb_archivo"=>$nb_ori, "archivo"=>$nb_archivo, "id_usuario"=>$id_usuario);

                        $resp= ModeloExcel::sube_archivo($datos,33);
//                        echo "<pre>resp";
//                        print_r($resp);
//                        echo "</pre>";
//                        exit();

                        if($resp=="ok")
                        {
                            $leyenda = 'Todo Bien';
                            $success = 1;
                            $accion = 'envia';

                        }
                        else
                        {	$leyenda = 'Si subio archivo, no registro en la BD';
                        }
                    }
                    else
                    {	$leyenda = 'No sube archivo';
                    }
                }
                else
                {	$leyenda = 'No es extensión xls o xlsx';
                }
            }
            else
            {	$leyenda = 'Pesa mas de 10Mb';
            }
        }
        else
        {	$leyenda = 'No ha seleccionado archivo';
        }

        if($accion == 'envia')
        {
            ///ultimo archivo insertado
            $resp2 = ModeloExcel::max_archivo($anio, 33);
            //$archivo = '../'.$dir.'/'.$archivo;	///coloca la dirección completa
            $archivo = $path.$resp2[0]->archivo;

                require_once 'Classes/PHPExcel/IOFactory.php';
                $XLFileType = PHPExcel_IOFactory::identify($archivo);
                $objReader = PHPExcel_IOFactory::createReader($XLFileType);
                $objPHPExcel = $objReader->load($archivo);

                $colinit = 0;
                $rowinit = 2;
                $rows=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
                $cols=$objPHPExcel->getActiveSheet()->getHighestRow();

                $rows = 4;	///numero de columnas

                    ///primero borra la tabla Tabuladores del año seleccionado
                $rsp=ModeloExcel::borra_tabulador($anio);
                print_r($rsp);
        //        echo '<table border=1>';
                for($i=$rowinit;$i<=$cols;$i++)
                {
                $datos = array();
        //        echo '<tr>';

                $pasa = 'N';
                for($j=$colinit;$j<=$rows;$j++)
                {
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();
        //        echo "<td>$cell</td>";
                array_push($datos, $cell);
                }
        //        echo '</tr>';

                $paso = 0;
                    $resp3=ModeloExcel::registro_batch_tabulador($datos, $anio);
        //                echo "<pre>resp3";
        //                print_r($resp3);
        //                echo "</pre>";
        //                exit();
                    if($resp3)
                    {
                        $paso = 1;

                    }
                unset($datos);
                }
            echo "<script>
                    Swal.fire({
                         title: 'Success!',
                         text: '¡Archivo Registrado Correctamente!',
                         icon: 'success',
                         confirmButtonText:'Ok'
                     });
                  </script>";
        //        echo '</table>';
                }




    }

}