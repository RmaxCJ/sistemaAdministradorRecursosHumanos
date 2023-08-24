<?php

	class ControladorUsuarios{

	    static public function  ctrPerfiles()
        {   $tabla="Perfiles";
            $respuesta=ModeloUsuarios::mdlPerfiles($tabla);
            return $respuesta;
        }

		static public function ctrEditarUsuario($datos)
        {
//            			echo "ctr";
//			print_r($datos);
            // $tabla="Usuarios";
            if(isset($datos))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['usuario']))
                {


                    $tabla = "Usuarios";
                    $respuesta  = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
//					echo $respuesta;
                    return $respuesta;


                }//pragmatch
            }// isset
		}


		static public function ctrCrearUsuario($datos)
        {
//			echo "ctr";
//			print_r($datos);
			// $tabla="Usuarios";
			if(isset($datos))
            {
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['usuario']))
				{


					$tabla = "Usuarios";

					$respuesta  = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
//					 print_r($respuesta);
                    $idUsuario = $respuesta[0]->id;

                    if ($idUsuario!='' AND $idUsuario!='error')
                    {
                        $respuesta2=ModeloUsuarios::mdlUsuarioDivision($idUsuario,$datos['division']);
                        return $respuesta2;
                    }



				}//pragmatch
			}// isset
		}

        static public function ctrGuardarDivisiones($datos)
        {

            if(isset($datos))
            {

                    $cont=0;
                    $divisiones=explode(',',$datos['divisiones']);
//                    echo count($divisiones);

                    if ($datos['NumEmpleadoUsuario']=='Externo')
                    {

                        for ($x=0;$x< count($divisiones);$x++)
                        {
                            $cont++;

//                        echo $divisiones[$x];
//                        echo "<br>";
                            $respuesta  = ModeloUsuarios::mdlAgregarUsuarioDivisiones($divisiones[$x],$datos['idUsuario']);
                        }

//                    exit();
                        if ($cont==count($divisiones))
                        {
                            return $respuesta;


                        }


                    }
                    elseif ($datos['NumEmpleadoUsuario']!='Externo')
                    {

                        for ($x=0;$x< count($divisiones);$x++)
                        {
                            $cont++;

//                        echo $divisiones[$x];
//                        echo "<br>";
                            $respuesta  = ModeloUsuarios::mdlAgregarEmpleadosDivisiones($divisiones[$x],$datos['idUsuario']);
                        }

//                    exit();
                        if ($cont==count($divisiones))
                        {
                            return $respuesta;


                        }



                    }



            }//
        }
        static public function ctrQuitarDivisiones($datos)
        {

            if(isset($datos))
            {

                $cont=0;
                $divisiones=explode(',',$datos['divisiones']);
//                echo count($divisiones);
                if ($datos['NumEmpleadoUsuario']=='Externo')
                {

                    for ($x = 0; $x < count($divisiones); $x++) {
                        $cont++;

//                        echo $divisiones[$x];
//                        echo "<br>";
                        $respuesta = ModeloUsuarios::mdlQuitarUsuarioDivisiones($divisiones[$x], $datos['idUsuario']);
                    }

//                    exit();
                    if ($cont == count($divisiones)) {
                        return $respuesta;


                    }
                }
                elseif ($datos['NumEmpleadoUsuario']!='Externo')
                {


                    for ($x = 0; $x < count($divisiones); $x++) {
                        $cont++;

//                        echo $divisiones[$x];
//                        echo "<br>";
                        $respuesta = ModeloUsuarios::mdlQuitarEmpleadosDivisiones($divisiones[$x], $datos['idUsuario']);
                    }

//                    exit();
                    if ($cont == count($divisiones)) {
                        return $respuesta;


                    }





                }


            }//
        }



        static public function ctrIngreso()
        {
//            echo "<pre>CTR POST";
//            print_r($_POST);
//            echo "</pre>";
            if(isset($_POST['ingUsuario']))
            {



//                if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword']))
//                {
                     $usuario=$_POST['ingUsuario'];
                    $pass=$_POST['ingPassword'];
                    $respuesta  = ModeloUsuarios::mdlActive($usuario);
//                   echo "<pre> mdlActive";
//                    print_r($respuesta);
////                    print_r($respuesta['active']);
//                    echo "</pre>";
                if($respuesta['active'] == 'S')
                {
//                    require_once("includes/loginAC.inc.php");
//                    $login = new LoginAD;

                    //echo 'entro - ';
                    $result= ModeloUsuarios::mdlAutentica($usuario,$pass);
//                    $result = $login->autentica($usuario, $contrasena);
//                     print_r($result);
//                     exit();
                    //echo $result;
                    if($result == 1)
                    {
                        //echo '<br>entro 2';
//                        $datosU = $obj_validar->datos_usuario($usuario);
//                        echo count($respuesta);
//                        echo "<br>";
//                        exit();
                        if(count($respuesta)>0)
                        {

                            $_SESSION['iniciarSesion']="ok";
                            $_SESSION["id"] = $respuesta['id'];
                            $_SESSION["usuario"] = $respuesta['usuario'];
                            $_SESSION["id_perfil"] = $respuesta['id_perfil'];

                            $divisionesEmpleado=ModeloUsuarios::mdlDivisionesCHLOGIN($respuesta['id']);
//                            echo "<pre>";
//                            print_r($divisionesEmpleado);
//                            echo "</pre>";
                            $concatDiv="";
                            foreach ($divisionesEmpleado as $divEmp)
                            {
                                $concatDiv.="'";
                                $concatDiv.=$divEmp->cod_division;
                                $concatDiv.="'";
                                $concatDiv.=",";

                            }
                            $concatDiv2 = substr($concatDiv, 0, -1);
//                            echo $concatDiv2;
                            $_SESSION['divisiones']=$concatDiv2;

                            $paisesDivisiones=ModeloUsuarios::mdlPaisesDivisiones($concatDiv2);
                            $_SESSION['paisesDivisiones']=$paisesDivisiones;

//                            $concatPaises="";
//                            foreach ($divisionesEmpleado as $divEmp)
//                            {
//                                $concatPaises.="'";
//                                $concatPaises.=$divEmp->cod_division;
//                                $concatPaises.="'";
//                                $concatPaises.=",";
//
//                            }



//                            exit();
                            $_SESSION["correo"] = $respuesta['correo'];
                            $_SESSION["num_empleado"] = $respuesta['num_empleado'];
//                            $_SESSION["num_empleado"] = $respuesta['num_empleado'];
                            $datosE=ModeloUsuarios::mdlDatosEmpleado($respuesta['num_empleado']);

//                            echo "<pre>";
//                            print_r($datosE[0]['nombre']);
//                            echo "</pre>";
                            $_SESSION["nombre"] = $datosE[0]['nombre'];
                            $_SESSION["division"] = $datosE[0]['division'];
                            $_SESSION["cod_division"] = $datosE[0]['cod_division'];
                            $_SESSION["pais"] = $datosE[0]['pais'];

//                            exit();
//                            $_SESSION["nombreEmpleado"] = $respuesta['nombre'];
//
                           $res= ModeloUsuarios::mdlRegistra_acceso($respuesta['id']);
//                           print_r($res);
//                            $obj_validar2->registra_acceso($id_usuario);


                            echo '<script>
									window.location="inicio";
									</script>';
                        }
                        else
                            $msg = "Los datos son incorrectos, intente de nuevo";
                    }
                    else
                        $msg = "Los datos son incorrectos, intente de nuevo";
                }elseif ($respuesta['active'] == 'N')
                {
//                    echo "aqui N";
//                    exit();


                     $contrasena = md5($pass);

                    ///valida sin active
                    $datosU= ModeloUsuarios::mdlLogin($usuario, $contrasena);
//                    echo "<pre>";
//                    print_r($datosU);
//                    echo "</pre>";
//                    exit();
//                    $datosU = $obj_validar->login($usuario, $contrasena);


                    foreach($datosU as $dat)
                    {
// +++++ solo para pruebas, comentar despues el IF extermp




                        if($dat->id > 0)
                        {

                            $_SESSION['iniciarSesion']="ok";
                            $_SESSION["id"] = $dat->id;
                            $_SESSION["usuario"] = $dat->usuario;
                            $_SESSION["id_perfil"] =$dat->id_perfil;
                            if ($dat->num_empleado!='Externo')
                            {
                                $divisionesEmpleado=ModeloUsuarios::mdlDivisionesCHLOGIN($respuesta['id']);
                                //                            echo "<pre>";
                                //                            print_r($divisionesEmpleado);
                                //                            echo "</pre>";
                                $concatDiv="";
                                foreach ($divisionesEmpleado as $divEmp)
                                {
                                    $concatDiv.="'";
                                    $concatDiv.=$divEmp->cod_division;
                                    $concatDiv.="'";
                                    $concatDiv.=",";

                                }
                                $concatDiv2 = substr($concatDiv, 0, -1);
                                //                            echo $concatDiv2;
                                $_SESSION['divisiones']=$concatDiv2;
                            }
                            else
                            {
                                $divisionesExterno=ModeloUsuarios::mdlUsuarioDivisionLOGIN($dat->id);
//                            echo "<pre>";
//                            print_r($divisionesExterno);
//                            echo "</pre>";
                                $concatDiv="";
                                foreach ($divisionesExterno as $divExt)
                                {

                                    $concatDiv.="'";
                                    $concatDiv.=$divExt->cod_division;
                                    $concatDiv.="'";
                                    $concatDiv.=",";

                                }
                                $concatDiv2 = substr($concatDiv, 0, -1);
//                            echo $concatDiv2;
                                $_SESSION['divisiones']=$concatDiv2;
                            }





//                            echo "<pre>";
//                            print_r($concatDiv);
//                            echo "</pre>";
//                            exit();
                            $_SESSION["correo"] = $dat->correo;
                            $_SESSION["num_empleado"] =$dat->num_empleado;
                            $_SESSION["nombre"] =$dat->nombre_usuario;
                            $_SESSION["resetear_pass"] =$dat->resetear_pass;
                            $datosE=ModeloUsuarios::mdlDatosEmpleado($dat->num_empleado);
                            if ($dat->num_empleado=='Externo' && $dat->id_perfil!=1)
                            {
//                                echo "externo aqui";
//                                echo $dat->id_perfil;
//                                exit();
                                $datosEXDiv=ModeloDivisiones::mdlDivisionExternos($dat->id);
//                                echo "<pre>";
//                                print_r($datosEXDiv);
//                                echo "</pre>";

//                                exit();
                                $_SESSION["division"] = $datosEXDiv[0]['division'];
                                $_SESSION["cod_division"] = $datosEXDiv[0]['cod_division'];
                                $_SESSION["pais"] = $datosEXDiv[0]['pais'];
//                                echo "<pre>";
//                                print_r($_SESSION);
//                                echo "</pre>";
//                                exit();
                                $res= ModeloUsuarios::mdlRegistra_acceso($respuesta['id']);
                                echo '<script>
									window.location="inicio";
									</script>';

                            }
                            elseif ($dat->num_empleado=='Externo' && $dat->id_perfil==1 )
                            {
//                                echo "externo admin";
//                                echo $dat->id_perfil;

                                $_SESSION["cod_division"] = 'TODAS';
                                $_SESSION["pais"] = 'Mexico';
//                                echo "<pre>";
//                                print_r($_SESSION);
//                                echo "</pre>";
                                $res= ModeloUsuarios::mdlRegistra_acceso($respuesta['id']);
                                echo '<script>
									window.location="inicio";
									</script>';
//                                exit();
                            }
                            else
                            {
                                $_SESSION["nombre"] = $datosE[0]['nombre'];
                                $_SESSION["division"] = $datosE[0]['division'];
                                $_SESSION["cod_division"] = $datosE[0]['cod_division'];
                                $_SESSION["pais"] = $datosE[0]['pais'];

                                $res= ModeloUsuarios::mdlRegistra_acceso($respuesta['id']);
                                echo '<script>
									window.location="inicio";
									</script>';

                            }




//                            $obj_validar2->registra_acceso($id_usuario);
//                            $res= ModeloUsuarios::mdlRegistra_acceso($respuesta['id']);
//                            echo '<script>
//									window.location="inicio";
//									</script>';

                        }
                        else
                            $msg = "Los datos son incorrectos, intente de nuevo";
                    }




                }

            }

        }


		static public function ctrMostrarUsuarios()
        {
			$tabla="Usuarios";
//            echo $tabla;
//            echo $item;
//            echo $valor;
			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla);
			return $respuesta;
        }


        static public function ctrMostrarUsuariosResponsables()
        {


            $respuesta = ModeloUsuarios::mdlMostrarUsuariosResponsables();
            return $respuesta;
        }
        
        ///////////////////////para mostrar en sindicatos
        static public function ctrMostrarUsuariosSencillo()
        {
			$tabla="Usuarios";
//            echo $tabla;
//            echo $item;
//            echo $valor;
			$respuesta = ModeloUsuarios::mdlMostrarUsuariosSencillo($tabla);
			return $respuesta;
        }
        ///////////////////////para mostrar en sindicatos
        static public function ctrMostrarEmpleados()
        {
            $tabla="Empleados";
//            echo $tabla;
//            echo $item;
//            echo $valor;
            $respuesta = ModeloUsuarios::mdlMostrarEmpleados($tabla);
            return $respuesta;
        }


		static public function ctrBajaUsuario($datos)
        {
			if(isset($datos))
			{
				$tabla = "Usuarios";
                $respuesta = ModeloUsuarios::mdlBajaUsuario($tabla,$datos);
                return $respuesta;
				
			}
		}
        static public function ctrEliminarUsuario($datos)
        {
            if(isset($datos))
            {
                $tabla = "Usuarios";
                $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla,$datos);
                return $respuesta;

            }
        }

        static public function ctrResetPass($datos)
        {
            if(isset($datos))
            {
                $tabla = "Usuarios";
                $respuesta = ModeloUsuarios::mdlRe<setPass($tabla,$datos);
                return $respuesta;

            }
        }
        static public function ctrResetPassUser($datos)
        {
            if(isset($datos))
            {
                $tabla = "Usuarios";
                $respuesta = ModeloUsuarios::mdlResetPassUser($tabla,$datos);
                return $respuesta;

            }
        }


        static public function ctrbuscarEmpleadoByNumEmpleado($datos) //funcion para buscar Usuarios en alta usuarios
        {
            $tabla="Empleados";
              $datos = array(
                    "numEmpleadoActive"         =>$datos['numEmpleadoActive'],
                );

            $respuesta = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleado($tabla,$datos);

//            echo "<pre>";
//            print_r($respuesta);
//            echo "</pre>";
            return $respuesta;
        }

        static public function ctrDatosEmpleadoByNumemp($datos) //funcion para buscar Usuarios en alta usuarios
        {


            $respuesta = ModeloUsuarios::mdlDatosEmpleadoByNumemp($datos);

//            echo "<pre>";
//            print_r($respuesta);
//            echo "</pre>";
            return $respuesta;
        }

        static public function ctrbuscarEmpleadoByNumEmpleadoM($num_empleado)//para empleados si no existen sus nombres en usuarios
        {
            $tabla="Empleados";
            $respuesta = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoM($tabla,$num_empleado);
            return $respuesta;
        }

        static public function ctrbuscarEmpleadoPais()
        {
            $tabla="Empleados";
//              $datos = array(
//                    "numEmpleadoActive"         =>$datos,
//                );
            $respuesta = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoPais($tabla);

//            echo "<pre>";
//            print_r($respuesta);
//            echo "</pre>";
            return $respuesta;
        }

        static public function ctrbuscarEmpleadoByNumEmpleadoDEMANDAS($datos)
        {

            $respuesta = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoDEMANDAS($datos);




// corregir acentos Division
            $titleUTF8Array=array();
            foreach ($respuesta as $key => $value)
            {
//                          echo "id->".$value->id;
//                          echo "<br>";
//                          echo "start->".$value->start;
//                          echo "<br>";
//                          echo "title->".$value->title;
                $titleUTF8=utf8_encode($value->division);
                array_push($titleUTF8Array,$titleUTF8 );

//                          echo "<br>";

            }
            for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
            {
                $respuesta[$i]->division=$titleUTF8Array[$i];
//                            echo $i;
            }
// corregir acentos nombre
            $titleUTF8Arra2=array();
            foreach ($respuesta as $key => $value2)
            {
//                          echo "id->".$value2->id;
//                          echo "<br>";
//                          echo "start->".$value2->start;
//                          echo "<br>";
//                          echo "title->".$value2->title;
                $titleUTF8_2=utf8_encode($value2->nombre);
                array_push($titleUTF8Arra2,$titleUTF8_2 );

//                          echo "<br>";

            }
            for ($x=0;$x<=count($titleUTF8Arra2)-1;$x++)
            {
                $respuesta[$x]->nombre=$titleUTF8Arra2[$x];
//                            echo $i;
            }

// corregir acentos puesto
//            $titleUTF8Arra_3=array();
//            foreach ($respuesta as $key => $value3)
//            {
////                          echo "id->".$value3->id;
////                          echo "<br>";
////                          echo "start->".$value3->start;
////                          echo "<br>";
////                          echo "title->".$value3->title;
//                $titleUTF8_3=utf8_encode($value3->puesto);
//                array_push($titleUTF8Arra_3,$titleUTF8_3 );
//
////                          echo "<br>";
//
//            }
//            for ($y=0;$y<=count($titleUTF8Arra_3)-1;$y++)
//            {
//                $respuesta[$y]->puesto=$titleUTF8Arra_3[$y];
////                            echo $i;
//            }


//            echo "<pre>";
//            print_r($respuesta);
//            echo "</pre>";

            return $respuesta;
        }

        static public function ctrbuscarEmpleadoByNumEmpleadoConsecuencias($datos)
        {
            $respuesta = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoConsecuencias($datos);
            // corregir acentos 
            $titleUTF8Array=array();
            foreach ($respuesta as $key => $value)
            {
                $titleUTF8=utf8_encode($value->division);
                array_push($titleUTF8Array,$titleUTF8 );
            }
            for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
            {
                $respuesta[$i]->division=$titleUTF8Array[$i];
            }
            ///////////////////////////////////////////////////
            $titleUTF8Arra2=array();
            foreach ($respuesta as $key => $value2)
            {
                $titleUTF8_2=utf8_encode($value2->nombre);
                array_push($titleUTF8Arra2,$titleUTF8_2 );
            }
            for ($x=0;$x<=count($titleUTF8Arra2)-1;$x++)
            {
                $respuesta[$x]->nombre=$titleUTF8Arra2[$x];
            }
            ///////////////////////////////////////////////////

            //corregir acentos posicion
           $titleUTF8Arra_3=array();
           foreach ($respuesta as $key => $value3)
           {
               $titleUTF8_3=utf8_encode($value3->posicion);
               array_push($titleUTF8Arra_3,$titleUTF8_3 );
           }
           for ($y=0;$y<=count($titleUTF8Arra_3)-1;$y++)
           {
               $respuesta[$y]->posicion=$titleUTF8Arra_3[$y];
           }
           //////////////////////////////////////////////////
            //corregir acentos area_personal
            $titleUTF8Arra_4=array();
            foreach ($respuesta as $key => $value3)
            {
                $titleUTF8_3=utf8_encode($value3->area_personal);
                array_push($titleUTF8Arra_4,$titleUTF8_3 );
            }
            for ($y=0;$y<=count($titleUTF8Arra_4)-1;$y++)
            {
                $respuesta[$y]->area_personal=$titleUTF8Arra_4[$y];
            }
            //////////////////////////////////////////////////
            //corregir acentos sociedad
            $titleUTF8Arra_5=array();
            foreach ($respuesta as $key => $value3)
            {
                $titleUTF8_3=utf8_encode($value3->sociedad);
                array_push($titleUTF8Arra_5,$titleUTF8_3 );
            }
            for ($y=0;$y<=count($titleUTF8Arra_5)-1;$y++)
            {
                $respuesta[$y]->sociedad=$titleUTF8Arra_5[$y];
            }
            //////////////////////////////////////////////////
            return $respuesta;
        }

        static public function ctrbuscarEmpleadoxPais($pais)
        {
            $respuesta = ModeloUsuarios::mdlBuscarEmpleadoxPais($pais);
            return $respuesta;
        }

        static public function ctrbuscarEmpleadoxDivisiones($divisiones,$pais)//para consecuencias
        {
            // print_r($divisiones);
            // print_r($pais);
            $respuesta = ModeloUsuarios::mdlBuscarEmpleadoxDivisiones($divisiones,$pais);
            return $respuesta;
        }


        static public function ctrCrearUsuarioEmpleado($datos)
        {
//			echo "ctr";
//			print_r($datos);
            // $tabla="Usuarios";
            if(isset($datos))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['usuario']))
                {


                    $tabla = "Usuarios";

                    $respuesta  = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla, $datos);
//					echo $respuesta;
                    return $respuesta;


                }//pragmatch
            }// isset
        }


        static public function ctrAbogados()
        {
            $respuesta=ModeloUsuarios::mdlAbogados();
            return $respuesta;
        }

        static public function ctrDivisionesUsuario($idUsuario)
        {
            $respuesta=ModeloUsuarios::mdlDivisionesUsuario($idUsuario);

            return $respuesta;
        }

        static public function ctrDivisionesEmpleados($idUsuario)
        {
            $respuesta=ModeloUsuarios::mdlDivisionesEmpleados($idUsuario);

            return $respuesta;
        }


    }