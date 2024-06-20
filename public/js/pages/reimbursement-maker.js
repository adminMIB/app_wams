$(function () {
  var dataTableReimbursementMaker = $(".datatables-reimbursement-maker"),
    dt_reimbursement_maker;

  var totalAdvanceMakerReimbursement = $(".total-advance-reimbuersement-maker");

  var reimbursementId = $("#rembursement_id_detail").val();

  // Pengaturan ajax
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  // List datatable
  if (dataTableReimbursementMaker.length) {
    dt_reimbursement_maker = dataTableReimbursementMaker.DataTable({
      serverSide: true,
      processing: true,
      ajax: {
        url: `/reimbursement/${reimbursementId}/details`,
        type: "GET",
        // data: function (d) {
        //   d.search.value = $("input[type=search]").val() || "";
        // },
        dataSrc: function (json) {
          var total = 0;
          json.data.forEach(function (item) {
            // Hapus "Rp." dan titik agar bisa diubah menjadi angka dengan benar
            var nominal = item.nominal.replace(/[^0-9]/g, "");
            total += parseFloat(nominal);
          });

          totalAdvanceMakerReimbursement.text(
            "Total Advance : Rp. " + total.toLocaleString("id-ID")
          );
          return json.data;
        },
      },
      columns: [
        { data: "" },
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false },
        { data: "id" },
        { data: "tanggal" },
        { data: "nama_pic" },
        { data: "nominal" },
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
            return '<span class="text-nowrap">' + full.tanggal + "</span>";
          },
        },
        {
          targets: 4,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.nama_pic + "</span>";
          },
        },
        {
          targets: 5,
          orderable: false,
          render: function (data, type, full, meta) {
            return '<span class="text-nowrap">' + full.nominal + "</span>";
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
              `<button class="btn btn-sm btn-icon me-2 edit-record" data-type="edit" data-id="${full["id"]}"><i class="ti ti-edit"></i></button>` +
              '<div class="dropdown">' +
              `<button class="btn btn-sm btn-icon delete-record" data-id="${full["id"]}"><i class="ti ti-trash"></i></button>` +
              '<a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              `<a href="javascript:;" class="dropdown-item move pindah-data-record" data-id="${full["id"]}" data-bs-target="#pindahDataReimbursementMaker data-bs-toggle="modal" data-bs-dismiss="modal">Pindah ke Project</a>` +
              // `<a href="javascript:;" class="dropdown-item move pindah-data-record" data-id="${full["id"]}" data-bs-toggle="modal" data-bs-target="#pindahDataReimbursementMaker>Pindah ke Project</a>` +
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
        '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"B>>>' +
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
          text: "Add Maker",
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
  $(".datatables-reimbursement-maker tbody").on(
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
            url: `/reimbursement-maker/${idReimbursement}`,
            success: function () {
              dt_reimbursement_maker.ajax.reload(null, false);
            },
            error: function (error) {
              console.log(error);
            },
          });

          // SweetAlert sukses
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: "Transaction Maker has been deleted!",
            customClass: {
              confirmButton: "btn btn-success",
            },
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: "Cancelled",
            text: "The Transaction Maker is not deleted!",
            icon: "error",
            customClass: {
              confirmButton: "btn btn-success",
            },
          });
        }
      });
    }
  );

  // MODAL AKSI ADD dan EDIT DAN, VALIDATION
  $(document).on("click", ".create-record", function () {
    $("#addEditReimbursementFormMaker").trigger("reset");
    var type = $(this).data("type");
    $("#addEditReimbursementMaker").modal("show");
    $("#type").val(type);
    $("#_method").val(""); // Clear the method for create
    $("#title-header").text("Add Transaction Maker ");
    $("#file-info").hide();
    $("#file-info2").hide();
  });

  $(document).on("click", ".edit-record", function () {
    var id = $(this).data("id");

    $("#addEditReimbursementMaker").modal("show");
    $("#type").val("edit");
    // $("#rembursement_id").val(id);
    $("#_method").val("PUT"); // Set method to PUT for edit

    $.ajax({
      url: `/reimbursement-maker/${id}/edit`,
      type: "GET",
      success: function (data, status) {
        $("#title-header").text(`Edit Transaction Maker`);
        $("#tanggal_reimbursement").val(data.reimbursementMaker.tanggal);
        $("#nama_pic").val(data.reimbursementMaker.nama_pic);
        $("#nominal_reimbursement").val(data.reimbursementMaker.nominal);
        $("#keterangan").val(data.reimbursementMaker.keterangan);
        $("#file").val(data.reimbursementMaker.file);
        $("#file-info").show();
        $("#file-info2").show();
        $("#id").val(id);
      },
      error: function () {
        alert("Terjadi kesalahan. Silakan coba lagi.");
      },
    });
  });

  // fitur pindah data
  $(document).on("click", ".pindah-data-record", function () {
    var id = $(this).data("id");
    // Set value of hidden input 'id'
    $("#id_maker").val(id);

    // Show the modal
    $("#pindahDataReimbursementMaker").modal("show");

    // Make AJAX call to fetch data
    $.ajax({
      url: `/reimbursement-maker/${id}/edit`,
      type: "GET",
      success: function (data) {
        $("#title-header").text(`Move Transaction Maker`);
        $("#id_project_reimbursement").val(
          data.reimbursement.id_project_reimbursement
        );
      },
      error: function () {
        alert("Terjadi kesalahan. Silakan coba lagi.");
      },
    });
  });

  const addNewReimbursementMaker = document.getElementById(
    "addEditReimbursementFormMaker"
  );

  const fv = FormValidation.formValidation(addNewReimbursementMaker, {
    fields: {
      tanggal_reimbursement: {
        validators: {
          notEmpty: {
            message: "Tanggal Reimbursement tidak boleh kosong",
          },
        },
      },
      nama_pic: {
        validators: {
          notEmpty: {
            message: "Nama PIC tidak boleh kosong",
          },
        },
      },
      nominal_reimbursement: {
        validators: {
          notEmpty: {
            message: "Nominal Reimbursement tidak boleh kosong",
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
      file_kwitansi: {
        validators: {
          // Gunakan callback untuk menentukan kapan validasi file harus ditampilkan
          callback: {
            message: "File tidak boleh kosong",
            callback: function (value, validator, $field) {
              var type = $("#type").val(); // Dapatkan nilai dari input type
              var fileValue = $("#file_kwitansi").val(); // Dapatkan nilai dari input file

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
      file_mom: {
        validators: {
          // Gunakan callback untuk menentukan kapan validasi file harus ditampilkan
          callback: {
            message: "File tidak boleh kosong",
            callback: function (value, validator, $field) {
              var type = $("#type").val(); // Dapatkan nilai dari input type
              var fileValue = $("#file_mom").val(); // Dapatkan nilai dari input file

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
      rembursement_id = $("#rembursement_id").val();

    if (type == "create") {
      url = `/reimbursement-maker`;
      method = "POST";
    } else if (type == "edit" && rembursement_id) {
      url = `/reimbursement-maker/${rembursement_id}`;
      method = "POST"; // Form method is POST, _method is overridden to PUT
    } else {
      Swal.fire({
        title: "Error!",
        text: "Transaction Maker ID is missing for editing.",
        icon: "error",
        customClass: {
          confirmButton: "btn btn-danger",
        },
      });
      return;
    }

    var formData = new FormData(addNewReimbursementMaker);

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
        $("#addEditReimbursementMaker").modal("hide");
        Swal.fire({
          icon: "success",
          title: `Successfully ${type === "create" ? "created" : "edited"}!`,
          text: `Transaction Maker ${
            type === "create" ? "created" : "edited"
          } successfully.`,
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
        $("#addEditReimbursementFormMaker").trigger("reset");
        dt_reimbursement_maker.ajax.reload(null, false);
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
