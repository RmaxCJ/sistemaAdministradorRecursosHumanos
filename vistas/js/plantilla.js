
  $(document).ready( function () {
    // $('.tabladatatable').DataTable();
    $('.tabladatatable').DataTable( {
        responsive: true,
      // "paging":   false,
      "ordering": false// para desabilitar el ordenamiento y usar el ordenamiento de la bd
      // "info":     false
} );

    $('.tablaDescargaReportes').DataTable( {
        responsive: true,
        "ordering": false,
      dom: 'Bfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ]
        buttons: [
            // {
            //     extend: 'pdfHtml5',
            //     orientation: 'landscape',
            //     // pageSize: 'LEGAL'
            // },
            'excel'
        ]
    } );

} );
