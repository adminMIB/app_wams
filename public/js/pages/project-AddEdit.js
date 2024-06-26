"use strict";

$(function () {
  $("#principal_id").select2({
    placeholder: "Pilih Principal",
  });

  $("#component").select2({
    placeholder: "Pilih Komponen",
  });

  function toggleInputs() {
    var selectedValues = $("#component").val();

    // Toggle visibility and required attribute for WAPU input
    if (selectedValues.includes("wapu")) {
      $("#showWapu").show();
      $("#wapu").prop("required", true);
    } else {
      $("#showWapu").hide();
      $("#wapu").prop("required", false);
      $("#wapu").val(0);
    }

    // Toggle visibility and required attribute for End User input
    if (selectedValues.includes("end_user")) {
      $("#showEndUser").show();
      $("#end_user").prop("required", true);
    } else {
      $("#showEndUser").hide();
      $("#end_user").prop("required", false);
      $("#end_user").val(0);
    }

    // Toggle visibility and required attribute for Delivery input
    if (selectedValues.includes("delivery")) {
      $("#showDelivery").show();
      $("#delivery").prop("required", true);
    } else {
      $("#showDelivery").hide();
      $("#delivery").prop("required", false);
      $("#delivery").val(0);
    }

    // Toggle visibility and required attribute for Service input
    if (selectedValues.includes("service")) {
      $("#showService").show();
      $("#service").prop("required", true);
    } else {
      $("#showService").hide();
      $("#service").prop("required", false);
      $("#service").val(0);
    }
  }

  function calculateSubtotals() {
    let bmt_awal =
      parseInt(
        $("#bmt_awal")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;
      
    let service =
      parseInt(
        $("#service")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;

    let other =
      parseInt(
        $("#delivery")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;

    let wapu =
      parseInt(
        $("#wapu")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;

    let end_user =
      parseInt(
        $("#end_user")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;

    let delivery =
      parseInt(
        $("#delivery")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;

    let decrement_cost =
      parseInt(
        $("#decrement_cost")
          .val()
          .replace(/[\D\s\._\-]+/g, "")
      ) || 0;

    let subtotal = bmt_awal + service + other + wapu + end_user + delivery;

    let admin_bunga = parseFloat($("#admin_bunga").val()) || 0;
    let bunga_admin = Math.round((admin_bunga / 100) * subtotal);

    $("#admin_cost").val(bunga_admin);
    $("#displayCost").text(numberWithCommas(bunga_admin));

    $("#subtotal").val(subtotal);
    $("#displaySubtotal").text("Rp. " + subtotal.toLocaleString("id-ID"));

    let finalSubtotal = subtotal - bunga_admin - decrement_cost;
    $("#finalSubtotal").val(finalSubtotal);
    $("#displayFinalSubtotal").text(
      "Rp. " + finalSubtotal.toLocaleString("id-ID")
    );
  }

  $(document).ready(function () {
    calculateSubtotals();
    $(".calculate").on("keyup change", function () {
      calculateSubtotals();
    });

    toggleInputs();

    // Attach change event listener
    $("#component").on("change", function () {
      toggleInputs();
    });
  });

  $(document).on("keyup", ".uang", function () {
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

  function numberWithCommas(x) {
    return x.toLocaleString("id-ID");
  }
});
