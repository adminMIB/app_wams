"use strict";

$(document).on("keyup", ".nominal", function () {
  $(this).val(formatRupiah(this.value));
});

function formatRupiah(angka, prefix) {
  let number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    let separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

function edit_project_maker(id) {
  $.get(`/project-maker/${id}/edit`, {}, function (data, status) {
    $("#title-detail").text("Edit Project Transaction Maker");
    $("#content").html(data);
    $("#modalMaker").modal("show");

    var today = new Date();
    $("#content").find("#date_trx").datepicker({
      format: "yyyy-mm-dd",
      endDate: today,
      autoclose: true,
      todayHighlight: true,
    });
  });
}

function add_project_maker(id) {
  $.get("/project-maker/create", {}, function (data) {
    $("#title-detail").text("Tambah Project Transaction Maker");
    $("#content").html(data);
    $("#modalMaker").modal("show");
    $("#content").find("#projectID").val(id);

    var today = new Date();
    $("#content").find("#date_trx").datepicker({
      format: "yyyy-mm-dd",
      endDate: today,
      autoclose: true,
      todayHighlight: true,
    });
  });
}

$(function () {
  $("#opty").select2({
    placeholder: "Pilih Opty",
    allowClear: true,
  });

  $("#project").select2({
    placeholder: "Pilih Project",
    allowClear: true,
  });

  $("#moveData").on("hidden.bs.modal", function () {
    $("#opty").select2("destroy");
    $("#project").select2("destroy");
  });

  $("#type").on("change", function () {
    const val = $(this).val();
    var showOpty = $("#showOpty"),
      showProject = $("#showProject");

    if (val == "opty") {
      showOpty.show();
      showProject.hide();
      $("#opty").prop("required", true);
      $("#project").prop("required", false);
    } else if (val == "project") {
      showOpty.hide();
      showProject.show();
      $("#opty").prop("required", false);
      $("#project").prop("required", true);
    } else {
      showOpty.hide();
      showProject.hide();
      $("#opty, #project").prop("required", false);
    }
  });

  $(document).on("click", ".move", function () {
    const p_id = $(this).data("project"),
          pm_id = $(this).data('id')
    $("#moveData").modal("show");
    $("#p_id").val(p_id)
    $("#pm_id").val(pm_id)
  });
});
