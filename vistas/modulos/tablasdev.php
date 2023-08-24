<?php
echo "<pre>";
print_r($textosArray);
echo "</pre>";
//serv28@!581321
$password = "f946990dad240c48f4900754088646f7";
if (md5($_POST['password']) != $password)
{
?>
<form name="form" method="post" action="tablasdev">
    <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>
<?php
}else
{



$tablas=ModeloTablasDEV::mdlTablas();
//echo "<pre>";
//print_r($tablas);
//print_r(count($tablas));
//echo "</pre>";

//for ($x=0;x<=count($tablas);$x++)
//{
//print_r($tablas[$x]);
//
//}
//print_r($tablas['TABLE_NAME']);


?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tablas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                            <li class="breadcrumb-item active">Tablas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

                        <div class="row" >
                            <div class="col-md-12" >
                                <div class="card" >
                                    <div class="card-header" >
                                        <h5 class="card-title">Tablas</h5>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                                   <?php
                                                   foreach ($tablas as $key => $values)
                                                   {
//    print_r($values);
                                                       echo '  <div class="col-md-3">
                                                                    <div class="input-group"> 
                                                                        <input  type="button" class="form-control btn btn-primary btn-xl consultarTabla"  value="'.$values->TABLE_NAME.'">
                                                                     </div>
                                                                </div>';
                                                   }
                                                   ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
<!--             /.card-->
                            </div>

            <div class="row" >
                <div class="col-md-12" >
                    <div class="card" >
                        <div class="card-body">
                            <div class="row">

                                <textarea  type="button" class="form-control btn btn-default btn-xl" id="sqlQuery" value=""></textarea>
                                <input type="button" class="form-control btn btn-success btn-xl sqlQuery" value="Consultar">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row" >
                <div class="col-md-12" >
                    <div class="card" >
                        <div class="card-body">
                            <div class="row">

                                <textarea  type="button" class="form-control btn btn-default btn-xl textareaResponse"  value="" readonly></textarea>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<script>
    $(".consultarTabla").click(function()
    {
        let valueButton = $(this).attr("value");
       //alert(valueButton);
        var datos = new FormData();
        var funcion         ="consultarTabla";
        datos.append("valueButton", valueButton);
        datos.append("funcion", funcion);
        $.ajax({
            url:"ajax/dev.ajax.php",
            method: "POST",
            data: datos,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta)
            {
                // console.log(Object.keys(respuesta));
                // $.each(respuesta, function(key,value)
                // {
                //     console.log(key);
                //     console.log(value);
                //     // console.log(i);
                //     // var $tr = $('<tr>').append(
                //     //     $('<td>').text(item),
                //     //     // $('<td>').text(item.content),
                //     //     // $('<td>').text(item.UID)
                //     // ); //.appendTo('#records_table');
                //     // console.log($tr.wrap('<p>').html());
                // });

                $('.textareaResponse').val(JSON.stringify(respuesta));
                console.log(respuesta);

            },
            error : function(respuesta)
            {
                Swal.fire({
                    title: 'Error!',
                    text: '¡error al guardar!',
                    icon: 'error',
                    confirmButtonText:'Ok'
                });
            }

        }).done(function ()
        {
            $('.succes').show();
        });

    });

    $(".sqlQuery").click(function()
    {
        let query = $('#sqlQuery').val();
        //alert(valueButton);
        var datos = new FormData();
        var funcion         ="querySQL";
        datos.append("query", query);
        datos.append("funcion", funcion);
        $.ajax({
            url:"ajax/dev.ajax.php",
            method: "POST",
            data: datos,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta)
            {

                // $.each(respuesta, function(i, item)
                // {
                //     var $tr = $('<tr>').append(
                //         $('<td>').text(item.rank),
                //         $('<td>').text(item.content),
                //         $('<td>').text(item.UID)
                //     ); //.appendTo('#records_table');
                //     console.log($tr.wrap('<p>').html());
                // });
                $('.textareaResponse').val(JSON.stringify(respuesta));
                console.log(respuesta);

            },
            error : function(respuesta)
            {
                Swal.fire({
                    title: 'Error!',
                    text: '¡error al guardar!',
                    icon: 'error',
                    confirmButtonText:'Ok'
                });
            }

        }).done(function ()
        {
            $('.succes').show();
        });

    });
</script>
<?php
}
?>