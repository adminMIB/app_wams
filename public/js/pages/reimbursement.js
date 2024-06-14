$(function () {
  var dataTableReimbursement = $(".datatables-reimbursement"),
    dt_reimbursement;

  // Pengaturan ajax
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  // List datatable
  if (dataTableReimbursement.length) {
    dt_reimbursement = dataTableReimbursement.DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: "/reimbursement",
        type: "GET",
        data: function (d) {
          d.search.value = $("input[type=search]").val() || "";
        },
      },
      columns: [
        { data: "" },
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false },
        { data: "id" },
        { data: "id_reimbursement" },
        { data: "nama_project" },
        { data: "pic_bussiness_channel" },
        { data: "client" },
        { data: "keterangan" },
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
            return (
              '<span class="text-nowrap">' + full.id_reimbursement + "</span>"
            );
          },
        },
        {
          targets: 4,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<span class="text-nowrap">' + full.nama_project + " </span>"
            );
          },
        },
        {
          targets: 5,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<span class="text-nowrap">' +
              full.pic_bussiness_channel +
              "</span>"
            );
          },
        },
        {
          targets: 6,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.client + "</span>";
          },
        },
        {
          targets: 7,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.keterangan + "</span>";
          },
        },
        {
          targets: 8,
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
              '<div class="d-flex align-items-center">' +
              `<a class="btn btn-sm btn-icon me-2" href="/reimbursement/${full["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="ti ti-eye"></i></a>` +
              `<button class="btn btn-sm btn-icon me-2 edit-record" data-type="edit" data-id="${full["id"]}"><i class="ti ti-edit"></i></button>` +
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
          text: "Add Reimbursement",
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

  // Hapus Record
  $(".datatables-reimbursement tbody").on(
    "click",
    ".delete-record",
    function () {
      var idReimbursement = $(this).data("id"),
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
          // hapus data
          $.ajax({
            type: "DELETE",
            url: `/reimbursement/${idReimbursement}`,
            success: function () {
              dt_reimbursement.ajax.reload(null, false);
            },
            error: function (error) {
              console.log(error);
            },
          });

          // SweetAlert sukses
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: "Reimbursement has been deleted!",
            customClass: {
              confirmButton: "btn btn-success",
            },
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: "Cancelled",
            text: "The Reimbursement is not deleted!",
            icon: "error",
            customClass: {
              confirmButton: "btn btn-success",
            },
          });
        }
      });
    }
  );

  // detail data
  $(".datatables-reimbursement tbody").on(
    "click",
    ".detail-record",
    function () {
      var id = $(this).data("id");
      $.get(`/master-data/personel-teams/${id}`, function (data, status) {
        $("#title-detail").text(`Detail Perosonel Teams, ${data.divisi}`);

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
    }
  );

  // MODAL AKSI ADD dan EDIT DAN, VALIDATION
  $(document).on("click", ".create-record", function () {
    $("#addEditReimbursementForm").trigger("reset");
    var type = $(this).data("type");
    $("#addEditReimbursement").modal("show");
    $("#type").val(type);
    $("#_method").val(""); // Clear the method for create
    $("#title-header").text("Add Reimbursement");
    $("#file-info").hide();
  });

  $(document).on("click", ".edit-record", function () {
    var type = $(this).data("type");
    var id = $(this).data("id");

    $("#addEditReimbursement").modal("show");
    $("#type").val(type);
    $("#rembursement_id").val(id);
    $("#_method").val("PUT"); // Set method to PUT for edit

    $.get(`/reimbursement/${id}/edit`, function (data, status) {
      $("#title-header").text(`Edit Reimbursement`);
      $("#id_reimbursement").val(data.reimbursement.id_reimbursement);
      $("#nama_project").val(data.reimbursement.nama_project);
      $("#pic_businees_channels").val(data.reimbursement.pic_bussiness_channel);
      $("#client").val(data.reimbursement.client);
      $("#keterangan").val(data.reimbursement.keterangan);
      $("#file").val(data.reimbursement.file);

      if (data.reimbursement.file) {
        $("#file-info").show();
      } else {
        $("#file-info").hide();
      }
    });
  });

  const addNewReimbursement = document.getElementById(
    "addEditReimbursementForm"
  );

  const fv = FormValidation.formValidation(addNewReimbursement, {
    fields: {
      id_reimbursement: {
        validators: {
          notEmpty: {
            message: "ID Reimbursement tidak boleh kosong",
          },
        },
      },
      nama_project: {
        validators: {
          notEmpty: {
            message: "Nama Project tidak boleh kosong",
          },
        },
      },
      pic_businees_channels: {
        validators: {
          notEmpty: {
            message: "PIC Business Channel tidak boleh kosong",
          },
        },
      },
      client: {
        validators: {
          notEmpty: {
            message: "Client tidak boleh kosong",
          },
        },
      },
      keterangan: {
        validators: {
          notEmpty: {
            message: "Keterangan tidak boleh kosong",
          },
        },
      },
      file: {
        validators: {
          // Gunakan callback untuk menentukan kapan validasi file harus ditampilkan
          callback: {
            message: "File tidak boleh kosong",
            callback: function (value, validator, $field) {
              var type = $("#type").val(); // Dapatkan nilai dari input type
              var fileValue = $("#file").val(); // Dapatkan nilai dari input file

              // Periksa apakah dalam mode create dan file kosong
              if (
                type === "create" &&
                (!fileValue || fileValue.trim() === "")
              ) {
                return false; // Validasi tidak lolos jika mode create dan file kosong
              }

              return true; // Validasi lolos
            },
          },
        },
      },
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: "",
        rowSelector: function (field, ele) {
          return ".mb-3";
        },
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      autoFocus: new FormValidation.plugins.AutoFocus(),
    },
  }).on("core.form.valid", function () {
    var type = $("#type").val(),
      url,
      method,
      rmbs_team_id = $("#rembursement_id").val();

    if (type == "create") {
      url = `/reimbursement`;
      method = "POST";
    } else if (type == "edit" && rmbs_team_id) {
      url = `/reimbursement/${rmbs_team_id}`;
      method = "POST"; // Form method is POST, _method is overridden to PUT
    } else {
      Swal.fire({
        title: "Error!",
        text: "Reimbursement ID is missing for editing.",
        icon: "error",
        customClass: {
          confirmButton: "btn btn-danger",
        },
      });
      return;
    }

    var formData = new FormData(addNewReimbursement);

    $.ajax({
      data: formData,
      url: url,
      type: method,
      processData: false,
      contentType: false,
      beforeSend: function () {
        console.log(...formData.entries()); // Debugging: Menampilkan semua entri form data
      },
      success: function (response) {
        $("#addEditReimbursement").modal("hide");
        Swal.fire({
          icon: "success",
          title: `Successfully ${type === "create" ? "created" : "edited"}!`,
          text: `Reimbursement ${
            type === "create" ? "created" : "edited"
          } successfully.`,
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
        $("#addEditReimbursementForm").trigger("reset");
        dt_reimbursement.ajax.reload(null, false);
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

  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);
});
