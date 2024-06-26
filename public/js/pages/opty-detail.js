"use strict";

$(function () {
  var href = location.href,
      today = new Date();

  $(".uang").mask("000.000.000.000.000", {
    reverse: true,
  });

  var form = document.getElementById("addEditOptyMakerFrom"),
    formValidation = FormValidation.formValidation(form, {
      fields: {
        date_trx: {
          validators: {
            notEmpty: {
              message: "Tanggal transaksi tidak boleh kosong",
            },
          },
        },
        jenis_trx: {
          validators: {
            notEmpty: {
              message: "Jenis transaksi tidak boleh kosong",
            },
          },
        },
        nominal_trx: {
          validators: {
            notEmpty: {
              message: "Nominal transaksi tidak boleh kosong",
            },
          },
        },
        nama_penerima: {
          validators: {
            notEmpty: {
              message: "Nama penerima tidak boleh kosong",
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
            notEmpty: {
              message: "file tidak boleh kosong",
            },
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: "",
          rowSelector: function (field, ele) {
            return ".mb-4";
          },
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus(),
      },
    });

  formValidation.on("core.form.valid", function () {
    // Submit the form if valid
    form.submit();
  });

  $("#addData").on("click", function () {
    const opty_id = href.match(/([^\/]*)\/*$/)[1];
    $("#addEditOptyMakerFrom").trigger("reset");
    $("#addEditOptyMakerModal").modal("show");
    $("#addEditOptyMakerFrom").attr("action", `/opty-maker/${opty_id}`);
    $("#file-edit").text("");
    
    formValidation.updateValidatorOption('file', 'notEmpty', 'enabled', true);
    formValidation.enableValidator('file', 'notEmpty');
  });

  $("#date_trx").datepicker({
    format: "yyyy-mm-dd",
    endDate: today,
    autoclose: true,
    todayHighlight: true,
  });

  $(".edit_data").on("click", function () {
    const id = $(this).data("id");
    $("#addEditOptyMakerModal").modal("show");

    $.get(`/opty-maker/${id}`, function (data, status) {
      $("#addEditOptyMakerFrom").attr("action", `/opty-maker/${id}/update`);
      $("#date_trx").val(data.date_trx);
      $("#jenis_trx").val(data.jenis_trx);
      $("#nama_penerima").val(data.nama_penerima);
      $("#nominal_trx").val(data.nominal_trx);
      $("#keterangan").val(data.keterangan);
      $("#file-edit").text("Biarkan kosong bila tidak ingin mengganti file");
      
      formValidation.updateValidatorOption('file', 'notEmpty', 'enabled', false);
      formValidation.disableValidator('file', 'notEmpty');
    });
  });
});
