"use strict";

$(function () {
  var dataTableOpties = $(".datatables-opties"),
    dt_opties,
    is_moved = false;

  // ajax setup
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  if (dataTableOpties.length) {
    dt_opties = dataTableOpties.DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: `/opty?is_moved=${is_moved}`,
        type: "GET",
        data: function (d) {
          d.search.value = $("input[type=search]").val() || "";
        },
      },
      columns: [
        { data: "" },
        { data: "id" },
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false },
        { data: "code_opty" },
        { data: "project_name" },
        { data: "name" },
        { data: "account_manager" },
        { data: "revenue_sales" },
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
          targets: 7,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + data + "</span>";
          },
        },
        {
          targets: 8,
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
            return (
              '<div class="d-flex align-items-center">' +
              `<a class="btn btn-sm btn-icon me-2" href="/opty/${full["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="ti ti-eye"></i></a>` +
              `<a class="btn btn-sm btn-icon me-2" href="/opty/${full["id"]}/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"><i class="ti ti-edit"></i></a>` +
              '<div class="dropdown">' +
              '<a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              `<a href="javascript:;" class="dropdown-item move" data-id="${full["id"]}" data-bs-target="#moveData" data-bs-toggle="modal" data-bs-dismiss="modal">Pindah ke Project</a>` +
              `<a href="javascript:;" class="dropdown-item delete-record text-danger" data-id="${full["id"]}">Delete</a>` +
              "</div>" +
              "</div>" +
              "</div>"
            );
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
      // Buttons with Dropdown
      buttons: [
        {
          text: '<span class="d-md-inline-block d-none">Add Opty</span> <i class="ti ti-plus me-md-1"></i>',
          className: "btn btn-primary",
          action: function (e, dt, button, config) {
            window.location = "/opty/create";
          },
        },
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return "Details of " + data["project_name"];
            },
          }),
          type: "column",
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
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
        var select = $('<select id="status_opty" class="form-select"></select>')
          .appendTo(".status_opty")
          .on("change", function () {
            var val = $(this).val();
            is_moved = val === "true";
            dt_opties.ajax.url(`/opty?is_moved=${is_moved}`).load();
          });

        select.append('<option value="false">List Opty</option>');
        select.append('<option value="true">List opty ke project</option>');
      },
    });
  }

  // Delete Record
  $(".datatables-opties tbody").on("click", ".delete-record", function () {
    var id = $(this).data("id"),
      dtrModal = $(".dtr-bs-modal.show");
    if (dtrModal.length) {
      dtrModal.modal("hide");
    }
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
      customClass: {
        confirmButton: "btn btn-primary me-3",
        cancelButton: "btn btn-label-secondary",
      },
      buttonsStyling: false,
    }).then(function (result) {
      if (result.isConfirmed) {
        // delete the data
        $.ajax({
          type: "DELETE",
          url: `/opty/${id}`,
          success: function (res) {
            Swal.fire({
              icon: "success",
              title: "Deleted!",
              text: res,
              customClass: {
                confirmButton: "btn btn-success",
              },
            });
            dt_opties.ajax.reload(null, false);
          },
          error: function (error) {
            console.log(error);
            Swal.fire({
              title: "Error!",
              text: error,
              icon: "error",
              customClass: {
                confirmButton: "btn btn-danger",
              },
            });
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: "Cancelled",
          text: "Data is not deleted!",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      }
    });
  });

  // On each datatable draw, initialize tooltip
  dt_opties.on("draw.dt", function () {
    var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        boundary: document.body,
      });
    });
  });
});
