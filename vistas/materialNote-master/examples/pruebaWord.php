<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- MaterializeCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>

    <!-- include skelenote css/js-->
    <link href="../dist/materialnote.css" rel="stylesheet" type="text/css">
    <script src="../dist/materialnote.js"></script>

    <style>
        body {
            width: 1000px;
            max-width: 90%;
            margin: auto;
            padding-top: 30px;
        }
    </style>
</head>

<body>

<?php
require_once("conexion.php");
$archivo="/var/www/html//relaciones/vistas/archivos/editablesCCT/LERMA/CONVENIO REVISIÓN SALARIAL CCT ROTOPLAS LERMA.docx";

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$app = new COM("word.application") or die("Unable to instantiate Word");
$file->Documents->Open($archivo);





//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



$conexion = new conexion;
$linker = $conexion->conectar();
//echo $linker;

if($_REQUEST["summary_body"]!='')
{
    //echo 'entro';
    $texto = $_REQUEST["summary_body"];
    $qry = "insert into Pruebas values('$texto',getdate())";
    //echo $qry;
    mssql_query($qry, $linker);
    echo '<br><br>Filas: '.mssql_rows_affected($linker);
    if (mssql_rows_affected($linker) > 0)
        echo '<br><br>'.'siiii';
    else
        echo '<br><br>'.'noooo';
}

$qryR = "select top 1 * from Pruebas order by id desc";
$sqlR = mssql_query($qryR, $linker);
$rsr = mssql_fetch_object($sqlR);
if($rsr)
{
    $texto = $rsr->contenido;
}
?>

<h2>Materialnote test 1</h2>

<form method="post" action="prueba.php" name="forma">
    <input id="summary_title" name="summary_title" required="required" placeholder="Title" type="text"/>
    <textarea id="summary_body" name="summary_body" required="required" placeholder="Body" rows="15" class="wysiwyg" data-type="summary" data-hash-source="#summary_title" data-upload-url="/media/upload" data-wysiwyg="materialnote">
        <?php echo $content;?>
        </textarea>

    <p><input type="submit" value="Guardar">
</form>

<script type="text/javascript">
    var wysiwyg = $('.wysiwyg');
    var type = wysiwyg.data('type');
    var hash = $(wysiwyg.data('hashSource')).val();
    var upload_url = wysiwyg.data('uploadUrl');
    var wysiwyg_type = wysiwyg.data('wysiwyg') ? wysiwyg.data('wysiwyg') : 'summernote';
    console.log(wysiwyg_type);

    wysiwyg[wysiwyg_type]({
        height: 400,
        focus: false,
        fontNames: ['Arial', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
        fontNamesIgnoreCheck: ['Roboto'],
        toolbar: [
            ['style', ['style']],
            ['fontname', ['fontname']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ],
        onImageUpload: function(files) {
            var file = files[0];
            var data = new FormData();
            data.append('file', file);
            data.append('type', type);
            data.append('hash', hash);
            $.ajax({
                url: upload_url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    var img_node = document.createElement('IMG');
                    img_node.src = data.url;
                    img_node.style = 'width:100%;';
                    wysiwyg[wysiwyg_type]('insertNode', img_node);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                }
            });
        },
        callbacks: {
            onImageUpload: function(files) {
                var file = files[0];
                var data = new FormData();
                data.append('file', file);
                data.append('type', type);
                data.append('hash', hash);
                $.ajax({
                    url: upload_url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(data) {
                        var img_node = document.createElement('IMG');
                        img_node.src = data.url;
                        img_node.style = 'width:100%;';
                        wysiwyg[wysiwyg_type]('insertNode', img_node);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus + " " + errorThrown);
                    }
                });
            }
        }
    });
</script>
</body>
</html>
