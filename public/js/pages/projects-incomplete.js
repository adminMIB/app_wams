"use strict";

$(function () {
  $("#customer").select2({
    placeholder: "Filter By Customer",
    allowClear: true,
  });

  var dataTableProjectsIncomplete = $(".datatables-incomplete"),
    dt_projects_incomplete,
    customer = "";

  // ajax setup
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  if (dataTableProjectsIncomplete.length) {
    dt_projects_incomplete = dataTableProjectsIncomplete.DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: `/incomplete-projects?customer=${customer}`,
        type: "GET",
        data: function (d) {
          d.search.value = $("input[type=search]").val() || "";
          d.customer = customer;
        },
      },
      columns: [
        { data: "" },
        { data: "id" },
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false },
        { data: "id_project" },
        { data: "project_name" },
        { data: "name" },
        { data: "created_at" },
        { data: "" },
      ],
      columnDefs: [
        {
          className: "control",
          orderable: false,
          searchable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return "";
          },
        },
        {
          targets: 1,
          searchable: false,
          visible: false,
        },
        {
          targets: 3,
          searchable: true,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + data + "</span>";
          },
        },
        {
          targets: 4,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + data + "</span>";
          },
        },
        {
          targets: 5,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + data + "</span>";
          },
        },
        {
          targets: 6,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + data + "</span>";
          },
        },
        {
          targets: -1,
          searchable: false,
          title: "Actions",
          orderable: false,
          render: function (data, type, full, meta) {
            let html = '<div class="d-flex align-items-center">';

            if (canEditProjects) {
              html += `<a class="btn btn-sm btn-icon me-2" href="/project/${full["id"]}/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Lengkapi Data"><i class="ti ti-edit"></i></a>`;
            }

            html += "</div>";
            return html;
          },
        },
      ],
      order: [[1, "desc"]],
      dom:
        '<"row mx-1"' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"status_opty mb-3 mb-md-0">>' +
        '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
        ">t" +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        ">",
      language: {
        sLengthMenu: "Show _MENU_",
        search: "",
        searchPlaceholder: "Search....",
      },
      buttons: [],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return "Details of " + data["name"];
            },
          }),
          type: "column",
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== ""
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    "<td>" +
                    col.title +
                    ":" +
                    "</td> " +
                    "<td>" +
                    col.data +
                    "</td>" +
                    "</tr>"
                : "";
            }).join("");

            return data
              ? $('<table class="table"/><tbody />').append(data)
              : false;
          },
        },
      },
      initComplete: function () {
        $("#customer").on("select2:selecting", function (e) {
          customer = e.params.args.data.id;
          dt_projects_incomplete.ajax.reload();
        });

        $("#customer").on("select2:unselecting", function () {
          customer = "";
          dt_projects_incomplete.ajax.reload();
        });
      },
    });
  }

  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);
});
