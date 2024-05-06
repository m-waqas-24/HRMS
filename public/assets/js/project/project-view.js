/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/project/project-view.js ***!
  \*****************************************************/
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(function (e) {
  'use strict'; // Data tables

  var _$$DataTable, _$$DataTable2, _$$DataTable3, _$$DataTable4;

  $('#task-list').DataTable((_$$DataTable = {
    "order": [[0, "desc"]]
  }, _defineProperty(_$$DataTable, "order", []), _defineProperty(_$$DataTable, "columnDefs", [{
    orderable: false,
    targets: [8]
  }]), _defineProperty(_$$DataTable, "language", {
    searchPlaceholder: 'Search...',
    sSearch: ''
  }), _$$DataTable)); // Data tables

  $('#files-tables').DataTable((_$$DataTable2 = {
    "order": [[0, "desc"]]
  }, _defineProperty(_$$DataTable2, "order", []), _defineProperty(_$$DataTable2, "columnDefs", [{
    orderable: false,
    targets: [3]
  }]), _defineProperty(_$$DataTable2, "language", {
    searchPlaceholder: 'Search...',
    sSearch: ''
  }), _$$DataTable2)); // Data tables

  $('#miles-tables').DataTable((_$$DataTable3 = {
    "order": [[0, "desc"]]
  }, _defineProperty(_$$DataTable3, "order", []), _defineProperty(_$$DataTable3, "columnDefs", [{
    orderable: false,
    targets: [5]
  }]), _defineProperty(_$$DataTable3, "language", {
    searchPlaceholder: 'Search...',
    sSearch: ''
  }), _$$DataTable3)); // Data tables

  $('#invoice-tables').DataTable((_$$DataTable4 = {
    "order": [[0, "desc"]]
  }, _defineProperty(_$$DataTable4, "order", []), _defineProperty(_$$DataTable4, "columnDefs", [{
    orderable: false,
    targets: [6]
  }]), _defineProperty(_$$DataTable4, "language", {
    searchPlaceholder: 'Search...',
    sSearch: ''
  }), _$$DataTable4)); // Datepicker

  $('.fc-datepicker').datepicker({
    dateFormat: "dd M yy",
    monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Maj", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"],
    zIndex: 999998
  }); // Select2 

  $('.select2').select2({
    minimumResultsForSearch: Infinity,
    width: "100%"
  }); // Sidebar

  $(document).ready(function () {
    $('.dismiss').on('click', function () {
      $('.sidebar-modal').removeClass('active');
      $('body').removeClass('overlay-open');
    });
    $('.sidebarmodal-collpase').on('click', function () {
      $('.sidebar-modal').addClass('active');
      $('body').addClass('overlay-open');
    });
    $('body').append('<div class="overlay"></div>');
    $('.overlay').on('click touchstart', function () {
      $('body').removeClass('overlay-open');
      $('.sidebar-modal').removeClass('active');
    });
  });
});
/******/ })()
;