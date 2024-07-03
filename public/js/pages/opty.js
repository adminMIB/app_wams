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
            let html = '<div class="d-flex align-items-center">';

            if (canViewseOpty) {
              html += `<a class="btn btn-sm btn-icon me-2" href="/opty/${full["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="ti ti-eye"></i></a>`;
            }

            if (full.is_moved === false) {
              html += '<div class="d-flex align-items-center">';

              if (canEditOpty) {
                html += `<a class="btn btn-sm btn-icon me-2" href="/opty/${full["id"]}/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"><i class="ti ti-edit"></i></a>`;
              }

              // Only create one dropdown and include both options if the user has permissions
              if (canEditOpty || canDeleteOpty) {
                html += '<div class="dropdown">';
                html +=
                  '<a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a>';
                html += '<div class="dropdown-menu dropdown-menu-end">';

                if (canEditOpty) {
                  html += `<a href="javascript:;" class="dropdown-item move-record" data-id="${full["id"]}">Pindah ke Project</a>`;
                }

                if (canDeleteOpty) {
                  html += `<a href="javascript:;" class="dropdown-item delete-record text-danger" data-id="${full["id"]}">Delete</a>`;
                }

                html += "</div>";
                html += "</div>"; // Close the dropdown div
              }

              html += "</div>"; // Close the d-flex align-items-center div
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
      // Buttons with Dropdown
      buttons: [
        {
          text: '<span class="d-md-inline-block d-none">Add Opty</span> <i class="ti ti-plus me-md-1"></i>',
          className: "btn btn-primary btn-add-opty",
          action: function (e, dt, button, config) {
            window.location = "/opty/create";
          },
        },
      ],
      // For responsive popup
      // responsive: {
      //   details: {
      //     display: $.fn.dataTable.Responsive.display.modal({
      //       header: function (row) {
      //         var data = row.data();
      //         return "Details of " + data["project_name"];
      //       },
      //     }),
      //     type: "column",
      //     renderer: function (api, rowIdx, columns) {
      //       var data = $.map(columns, function (col, i) {
      //         return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
      //           ? '<tr data-dt-row="' +
      //               col.rowIndex +
      //               '" data-dt-column="' +
      //               col.columnIndex +
      //               '">' +
      //               "<td>" +
      //               col.title +
      //               ":" +
      //               "</td> " +
      //               "<td>" +
      //               col.data +
      //               "</td>" +
      //               "</tr>"
      //           : "";
      //       }).join("");

      //       return data
      //         ? $('<table class="table"/><tbody />').append(data)
      //         : false;
      //     },
      //   },
      // },
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

    // Check if user has permission to create reimbursement
    if (!canCreateOpty) {
      dt_opties.buttons(".btn-add-opty").remove();
    }
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
          error: function (xhr, status, error) {
            console.log("error");
            Swal.fire({
              title: "Oops!",
              text: xhr.responseJSON.error || error,
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

  $(".datatables-opties tbody").on("click", ".move-record", function () {
    const id = $(this).data("id");

    $("#moveData").modal("show");
    $("#op_id").val(id);
    $("#moveForm").attr("action", `/move-optyTo-project/${id}`);
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

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);

  // check project id available
  let typingTimer;
  let doneTypingInterval = 500;
  let $input = $("#id_project");
  let $btn = $("#btn-submit");
  let $text = $("#show-available");
  let $spinner = $btn.find(".spinner-border");
  let btnClose = $(".close");

  // On keyup, start the countdown
  $input.on("keyup", function () {
    clearTimeout(typingTimer);
    if ($input.val()) {
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    } else {
      // Show message and disable button if input is empty
      $text
        .addClass("text-danger")
        .removeClass("text-success")
        .text("Project ID harus diisi");
      $btn.prop("disabled", true);
    }
  });

  // On keydown, clear the countdown
  $input.on("keydown", function () {
    clearTimeout(typingTimer);
  });

  // User is "done typing," do something
  function doneTyping() {
    let query = $input.val();

    // Show spinner and disable button
    $spinner.removeClass("d-none");
    $btn.prop("disabled", true);

    $.ajax({
      url: "/project/check-projectID",
      method: "POST",
      data: { q: query },
      success: function (response) {
        // Remove spinner
        $spinner.addClass("d-none");

        if (response.status === true) {
          $btn.prop("disabled", false);
          $text
            .addClass("text-success")
            .removeClass("text-danger")
            .text(response.message);
        } else {
          $btn.prop("disabled", true);
          $text
            .addClass("text-danger")
            .removeClass("text-success")
            .text(response.message);
        }
      },
      error: function (error) {
        // Remove spinner and show error message
        $spinner.addClass("d-none");
        $text
          .addClass("text-danger")
          .removeClass("text-success")
          .text("An error occurred. Please try again.");
        console.error("Error:", error);
      },
    });
  }

  btnClose.on("click", function () {
    $("#moveForm").trigger("reset");
    $text.text("");
  });
});
