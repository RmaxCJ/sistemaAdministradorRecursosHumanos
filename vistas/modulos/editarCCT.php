
<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//$contenido=$_POST['contenido'];
$idContenido=$_POST['idContenido'];
$nombreArchivo=$_POST['nombre'];
$contenido=ControladorNegociaciones::ctrContenidoCCT($idContenido);
//echo "<pre>";
//print_r($contenido[0]->contenido);
//echo "</pre>";
//

if ($_POST['summary_body']!='' || $_POST['summary_body']!=null)
{

    ControladorNegociaciones::ctrModificarWordxSindicato($_POST['summary_body'],$_POST['idContenidoEdit']);


}
//elseif ($_POST['print']!='' || $_POST['print']!=null)
//{
////    print_r($_POST['print']);
//    require_once "../../../mpdf60/mpdf.php";
//
//    $mpdf = new mPDF();
//
//    $stylesheet = file_get_contents('../../vistas/dist/css/estilo_pdf.css');
//    $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
//
////    $mpdf->SetHTMLFooter($footer);
//
//    $mpdf->WriteHTML($_POST['print']);
//    $mpdf->Output();
//    exit;
//}
else
{


?>
<head>
    <!-- jQuery -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- MaterializeCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>

    <!-- include skelenote css/js-->
    <link href="vistas/materialNote-master/dist/materialnote.css" rel="stylesheet" type="text/css">
    <script src="vistas/materialNote-master/dist/materialnote.js"></script>


</head>

<body>

<h2><?php echo $nombreArchivo;?></h2>

<form method="post" action="editarCCT" name="forma">
    <textarea id="summary_body" name="summary_body" required="required" placeholder="Body" class="wysiwyg" data-type="summary" data-hash-source="#summary_title" data-upload-url="/media/upload" data-wysiwyg="materialnote">
        <?php echo $contenido[0]->contenido;?>
        </textarea>
    <input type="hidden" id="idContenidoEdit" name="idContenidoEdit" value="<?php echo $idContenido;?>">
    <br>
    <div align="center">
        <input class="btn btn-file" type="submit" value="Guardar">
        <a href="vistas/modulos/formatoCCT.php?id=<?php echo $idContenido;?>" target=”_blank” style="background-color: red !important;"> <button type="button" class="btn btn-warning" id="descargar pdf" id="<?php echo $idContenido;?>" ><i class="fa fa-print"></i></button></a>

    </div>
    <br>
    <br>
    <br>


</form>

<!--<form method="post" action="formatoCCT" name="print">-->
<!--    <textarea id="print" name="print" >-->
<!--        --><?php //echo $contenido[0]->contenido;?>
<!--        </textarea>-->
<!--    <input type="hidden" id="idContenidoEdit" name="idContenidoEdit" value="--><?php //echo $idContenido;?><!--">-->
<!--    <br>-->
<!--    <div align="center">-->
<!--        <input class="btn btn-file" type="submit" value="Imprimir">-->
<!---->
<!--    </div>-->
<!--    <br>-->
<!--    <br>-->
<!--    <br>-->
<!---->
<!---->
<!--</form>-->

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
            // ['style', ['style']],
            ['fontname', ['fontname']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            // ['print', ['print']],

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
<?php

    include("../../../mpdf60/mpdf.php");

    $mpdf = new mPDF();

    $stylesheet = file_get_contents('../../vistas/dist/css/estilo_pdf.css');
    $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
//    $mpdf->SetHTMLFooter($footer);
    $mpdf->WriteHTML($contenido[0]->contenido);
    $mpdf->Output();
    exit;

}
?>