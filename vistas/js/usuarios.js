$(".nuevaFoto").change(function(){
		var imagen = this.files[0];
		console.log("imagen",imagen["type"])

 

	//Validar el tamaño de la imagen

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

 /*=============================================
    EDITAR USUARIO
    =============================================*/
   
    $(".btnEditarUsuario").click(function(){
      var idUsuario = $(this).attr("idUsuario");
      var datos = new FormData();
      // alert(datos);
      // alert(idusuario);
      console.log("idUsuario",idUsuario);
      datos.append("idUsuario", idUsuario);
      $.ajax({
          url:"ajax/usuarios.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(respuesta){
          console.log("idUsuario","Respuesta");
           $("#editarNombre").val(respuesta['nombre']);
           $("#editarUsuario").val(respuesta['usuario']);
           $("#passwordActual").val(respuesta['password']);
           $("#editarPerfil").html(respuesta['perfil']);
           $("#editarPerfil").val(respuesta['perfil']);
           $("#fotoActual").val(respuesta['foto']);
           if(respuesta['foto']!=""){
            $(".previsualizar").attr("src",respuesta['foto']);   
           }


            },     
          error : function(respuesta) {
              console.log("Error",respuesta);
            }

  });


    })



/*=============================================
    Activar Usuario
    =============================================*/

    $(".btnActivar").click(function(){
      var idUsuario = $(this).attr("idUsuario");
      var estadoUsuario = $(this).attr("estadoUsuario");
      var datos = new FormData();
      datos.append("activarId",idUsuario);
      datos.append("activarUsuario",estadoUsuario);

      $.ajax({
        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType:false,
        processData:false,
        success:function(respuesta){

        }
      })
      if(estadoUsuario==0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Inactivo');
        $(this).attr('estadoUsuario',1);

      }else{
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activo');
        $(this).attr('estadoUsuario',0);
      }
    })

    /*=============================================
    Validad usuario unico
    =============================================*/

    $("#nuevoUsuario").change(function()
    {
      $(".alert").remove();
      var usuario = $(this).val();
      var datos = new FormData();
      datos.append("validarUsuario",usuario);
      $.ajax({
        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType:false,
        processData:false,
        success:function(respuesta){
          console.log("Respuesta",respuesta);
          if(respuesta!="false"){
              console.log("Respuesta2",respuesta);
            $("#nuevoUsuario").parent().after("<div class='alert alert-warning'>Este nombre de usuario ya existe</div>");
            $("#nuevoUsuario").val("");
          }
        }
      })
    })
/*=============================================
Eliminar Usuario
=============================================*/

$(".btnEliminarUsuario").click(function()
{

var idUsuario = $(this).attr("idUsuario");
var fotoUsuario = $(this).attr("fotoUsuario");
var usuario   = $(this).attr("usuario");

  Swal.fire({
  title: '¡Estas seguro que deseas eliminar el Usuario?',
  text: "Si no es asi puedes presionar el boton cancelar",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Borrar usuario'
  }).then((result) => {
    if (result.value) {
       window.location = "index.php?ruta=usuarios&idusuario="+idUsuario+"&usuario="+usuario+"&fotousuario="+fotoUsuario;
     
  }
})
})
/*$(".nuevaFoto").change(function(){
		var imagen = this.files[0];
		console.log("imagen",imagen["type"]);

	//Validar el tamaño de la imagen

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})*/