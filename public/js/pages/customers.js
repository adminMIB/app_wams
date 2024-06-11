/**
 * App user list (jquery)
 */

"use strict";

$(function () {
  var dataTableCustomers = $(".datatables-customers"),
    dt_customers;

  // ajax setup
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  // customers List datatable
  if (dataTableCustomers.length) {
    dt_customers = dataTableCustomers.DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: "/master-data/customers",
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
        { data: "no_npwp" },
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
            return '<span class="text-nowrap">' + full.no_npwp + "</span>";
          },
        },
        {
          targets: 5,
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
              `<button class="btn btn-sm btn-icon me-2 detail-record" data-bs-target="#detailCustomer" data-id="${full["id"]}"data-bs-toggle="modal" data-bs-dismiss="modal"><i class="ti ti-eye"></i></button>` +
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
          text: "Add Customer",
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
  $(".datatables-customers tbody").on("click", ".delete-record", function () {
    var customer_id = $(this).data("id"),
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
          url: `/master-data/customers/${customer_id}`,
          success: function () {
            dt_customers.ajax.reload(null, false);
          },
          error: function (error) {
            console.log(error);
          },
        });

        // success sweetalert
        Swal.fire({
          icon: "success",
          title: "Deleted!",
          text: "The customer has been deleted!",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: "Cancelled",
          text: "The Customer is not deleted!",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      }
    });
  });

  // detail record
  $(".datatables-customers tbody").on("click", ".detail-record", function () {
    var id = $(this).data("id");
    $.get(`/master-data/customers/${id}`, function (data, status) {
      $("#title-detail").text(`Detail Customer ${data.nama_perusahaan}`);

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

  $(document).on("click", ".create-record", function () {
    $("#addEditCustomerForm").trigger("reset");
    var type = $(this).data("type");
    $("#addEditCustomers").modal("show");
    $("#type").val(type);

    $("#title-header").text("Add New Customer")
  });

  $(document).on("click", ".edit-record", function () {
    var type = $(this).data("type"),
      id = $(this).data("id");
    $("#addEditCustomers").modal("show");
    $("#type").val(type);
    $("#cus_id").val(id);

    $.get(`/master-data/customers/${id}/edit`, function (data, status) {
      $("#title-header").text(`Edit Customer ${data.name}`)
      $("#name").val(data.name)
      $("#no_npwp").val(data.no_npwp)
      $("#address").val(data.address)
      $("#pic_name").val(data.pic_name)
      $("#email_pic").val(data.email_pic)
      $("#phone_pic").val(data.phone_pic)
    });
  });

  const addNewCustomerForm = document.getElementById("addEditCustomerForm");

  const fv = FormValidation.formValidation(addNewCustomerForm, {
    fields: {
      name: {
        validators: {
          notEmpty: {
            message: "Nama perusahaan tidak boleh kosong",
          },
        },
      },
      no_npwp: {
        validators: {
          notEmpty: {
            message: "No NPWP Perusahaan tidak boleh kosong",
          },
          stringLength: {
            max: 16,
            message: "No NPWP Perusahaan tidak boleh lebih dari 16 karakter",
          },
          regexp: {
            regexp: /^[0-9]+$/,
            message: "No NPWP Perusahaan hanya boleh berisi angka",
          },
        },
      },
      address: {
        validators: {
          notEmpty: {
            message: "Alamat perusahaan tidak boleh kosong",
          },
        },
      },
      name_pic: {
        validators: {
          notEmpty: {
            message: "Nama PIC tidak boleh kosong",
          },
        },
      },
      phone_pic: {
        validators: {
          notEmpty: {
            message: "No Telp PIC tidak boleh kosong",
          },
          stringLength: {
            max: 12,
            message: "No Telp tidak boleh lebih dari 12 karakter",
          },
          regexp: {
            regexp: /^[0-9]+$/,
            message: "No Telp hanya boleh berisi angka",
          },
        },
      },
      email_pic: {
        validators: {
          notEmpty: {
            message: "Email PIC tidak boleh kosong",
          },
          emailAddress: {
            message: "The value is not a valid email address",
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
      cust_id = $("#cus_id").val();

    if (type == "create") {
      url = `/master-data/customers`;
      method = "POST";
    } else if (type == "edit" && cust_id) {
      url = `/master-data/customers/${cust_id}`;
      method = "PUT";
    } else {
      Swal.fire({
        title: "Error!",
        text: "Customer ID is missing for editing.",
        icon: "error",
        customClass: {
          confirmButton: "btn btn-danger",
        },
      });
      return;
    }

    $.ajax({
      data: $("#addEditCustomerForm").serialize(),
      url: url,
      type: method,
      contentType: "application/x-www-form-urlencoded",
      success: function (response) {
        $("#addEditCustomers").modal("hide");
        Swal.fire({
          icon: "success",
          title: `Successfully ${type === "create" ? "created" : "edited"}!`,
          text: `Customer ${response} ${
            type === "create" ? "created" : "edited"
          } successfully.`,
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
        $("#addEditCustomerForm").trigger("reset");
        dt_customers.ajax.reload(null, false);
      },
      error: function (xhr, status, error) {
        Swal.fire({
          title: "Oops!",
          text: "An error occurred.",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-danger",
          },
        });
      },
    });
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);
});
