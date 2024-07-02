/**
 * App user list (jquery)
 */

"use strict";

$(function () {
  var dataTablePremission = $(".datatables-premission"),
    dt_premission;

  // ajax setup
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  // roles List datatable
  if (dataTablePremission.length) {
    dt_premission = dataTablePremission.DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: "/users",
        type: "GET",
        data: function (d) {
          d.search.value = $("input[type=search]").val() || "";
        },
      },
      columns: [
        { data: "" },
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false },
        { data: "id" },
        { data: "name" },
        { data: "email" },
        { data: "roles" },
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
          targets: 2,
          searchable: false,
          visible: false,
        },
        {
          targets: 3,
          searchable: true,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.name + "</span>";
          },
        },
        {
          targets: 4,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.email + "</span>";
          },
        },
        {
          targets: 5,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.roles + "</span>";
          },
        },
        {
          targets: 6,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.created_at + "</span>";
          },
        },
        {
          targets: -1,
          searchable: false,
          title: "Actions",
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<span class="text-nowrap">' +
              `<button class="btn btn-sm btn-icon me-2 edit-record" data-type="edit" data-id="${full["id"]}"><i class="ti ti-edit"></i></button>` +
              `
              
              <button class="btn btn-sm btn-icon me-2 detail-record" data-bs-target="#detailRoles" data-id="${full["id"]}"data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>
              ` +
              `<button class="btn btn-sm btn-icon delete-record" data-id="${full["id"]}"><i class="ti ti-trash"></i></button>` +
              "</span>"
            );
          },
        },
      ],
      order: [[1, "asc"]],
      dom:
        '<"row mx-1"' +
        '<"col-sm-12 col-md-3" l>' +
        '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
        ">t" +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        ">",
      language: {
        sLengthMenu: "Show _MENU_",
        search: "Search",
        searchPlaceholder: "Search..",
      },
      buttons: [
        {
          text: "Add Users",
          className: "add-new btn btn-primary mb-3 mb-md-0 create-record",
          attr: {
            "data-type": "create",
          },
          init: function (api, node, config) {
            $(node).removeClass("btn-secondary");
          },
        },
      ],
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
    });
  }

  // Delete Record
  $(".datatables-premission tbody").on("click", ".delete-record", function () {
    var rolesById = $(this).data("id"),
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
      if (result.value) {
        // delete the data
        $.ajax({
          type: "DELETE",
          url: `/users/${rolesById}`,
          success: function () {
            dt_premission.ajax.reload(null, false);
          },
          error: function (error) {
            console.log(error);
          },
        });

        // success sweetalert
        Swal.fire({
          icon: "success",
          title: "Deleted!",
          text: "The users has been deleted!",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: "Cancelled",
          text: "The users is not deleted!",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      }
    });
  });

  // detail data users
  $(".datatables-premission tbody").on("click", ".detail-record", function () {
    var id = $(this).data("id");
    $.get(`/users/${id}`, function (data, status) {
      $("#title-detail").text(`Detail users, ${data.name}`);

      $("table.borderless tbody").empty();

      var rows = "";
      for (var key in data) {
        rows +=
          "<tr>" +
          "<td>" +
          key.replace(/_/g, " ").toUpperCase() +
          "</td>" +
          "<td>:</td>" +
          "<td>" +
          data[key] +
          "</td>" +
          "</tr>";
      }

      $("table.borderless tbody").append(rows);
    });
  });

  // MODAL AKSI ADD dan EDIT DAN, VALIDATION
  $(document).on("click", ".create-record", function () {
    $("#addEditPremissionForm").trigger("reset");
    var type = $(this).data("type");
    $("#addEditPremission").modal("show");
    $("#type").val(type);

    $("#title-header").text("Add New Roles");
  });

  $(document).on("click", ".edit-record", function () {
    var type = $(this).data("type"),
      id = $(this).data("id");

    console.log(id);

    $("#addEditPremission").modal("show");
    $("#type").val(type);
    $("#user_id").val(id);

    // edit, menampilkan  data
    $.get(`/users/${id}/edit`, function (data, status) {
      $("#title-header").text(`Edit users, ${data.name}`);
      $("#name").val(data.name); // Mengisi nama
      $("#password").val(data.password); // Mengisi email
      $("#email").val(data.email); // Mengisi email
      // Mengisi nilai select dengan role
      $("#roles").val(data.role); // Menggunakan id dari role yang ingin dipilih
    });
  });

  const addNewPremissionForm = document.getElementById("addEditPremissionForm");

  const fv = FormValidation.formValidation(addNewPremissionForm, {
    fields: {
      password: {
        validators: {
          notEmpty: {
            message: "password tidak boleh kosong",
          },
        },
      },
      name: {
        validators: {
          notEmpty: {
            message: "name tidak boleh kosong",
          },
        },
      },
      email: {
        validators: {
          notEmpty: {
            message: "email tidak boleh kosong",
          },
        },
      },
      role: {
        validators: {
          notEmpty: {
            message: "role tidak boleh kosong",
          },
        },
      },
      permissions: {
        validators: {
          notEmpty: {
            message: "permissions tidak boleh kosong",
          },
        },
      },
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        eleValidClass: "",
        rowSelector: function (field, ele) {
          // field is the field name & ele is the field element
          return ".mb-3";
        },
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      // Submit the form when all fields are valid
      // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus(),
    },
  }).on("core.form.valid", function () {
    var type = $("#type").val(),
      url,
      method,
      user_id = $("#user_id").val();

    // add premission
    if (type == "create") {
      url = `/users`;
      method = "POST";
      // edit persona teams
    } else if (type == "edit" && user_id) {
      url = `/users/${user_id}`;
      method = "PUT";
    } else {
      Swal.fire({
        title: "Error!",
        text: "users ID is missing for editing.",
        icon: "error",
        customClass: {
          confirmButton: "btn btn-danger",
        },
      });
      return;
    }

    $.ajax({
      data: $("#addEditPremissionForm").serialize(),
      url: url,
      type: method,
      contentType: "application/x-www-form-urlencoded",
      success: function (response) {
        $("#addEditPremission").modal("hide");
        Swal.fire({
          icon: "success",
          title: `Successfully ${type === "create" ? "created" : "edited"}!`,
          text: `Users ${response} ${
            type === "create" ? "created" : "edited"
          } successfully.`,
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
        $("#addEditPremissionForm").trigger("reset");
        dt_premission.ajax.reload(null, false);
      },
      error: function (xhr, status, error) {
        Swal.fire({
          title: "Oops!",
          text: error,
          icon: "error",
          customClass: {
            confirmButton: "btn btn-danger",
          },
        });
      },
    });
  });
  //END MODAL AKSI ADD dan EDIT DAN, VALIDATION

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);
});
