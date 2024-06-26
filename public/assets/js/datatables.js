/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/assets/js/datatables.js ***!
  \*******************************************/
$(function (e) {
  "use strict"; //______Basic Data Table

  $('#basic-datatable').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      sSearch: ''
    }
  }); //______Basic Data Table

  $('#responsive-datatable').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      scrollX: "100%",
      sSearch: ''
    }
  }); //______File-Export Data Table
  $('#responsive-datatable2').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      scrollX: "100%",
      sSearch: ''
    }
  }); //______File-Export Data Table
  $('#responsive-datatable3').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      scrollX: "100%",
      sSearch: ''
    }
  }); //______File-Export Data Table



  var table = $('#file-datatable').DataTable({
    buttons: ['copy', 'excel', 'pdf', 'colvis'],
    language: {
      searchPlaceholder: 'Search...',
      scrollX: "100%",
      sSearch: ''
    }
  });
  table.buttons().container().appendTo('#file-datatable_wrapper .col-md-6:eq(0)'); //______Delete Data Table

  var table = $('#delete-datatable').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      sSearch: ''
    }
  });
  console.log(table);
  $('#delete-datatable tbody').on('click', 'tr', function () {
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected');
    } else {
      table.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
    }
  });
  $('#button').on('click', function () {
    console.log(table.row('.selected'));
    table.row('.selected').remove().draw(false);
  });
  $('#example3').DataTable({
    responsive: {
      details: {
        display: $.fn.dataTable.Responsive.display.modal({
          header: function header(row) {
            var data = row.data();
            return 'Details for ' + data[0] + ' ' + data[1];
          }
        }),
        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
          tableClass: 'table'
        })
      }
    }
  });
  $('#example2').DataTable({
    responsive: true,
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page'
    }
  }); //______Select2 

  $('.select2').select2({
    minimumResultsForSearch: Infinity
  });
});
/******/ })()
;