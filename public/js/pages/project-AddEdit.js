"use strict";

$(function () {
  // Inisialisasi select2
  $("#principal_id, #component").select2({
    placeholder: function() {
      return $(this).data('placeholder');
    }
  });

  // Toggle input visibility dan required attribute
  function toggleInputs() {
    const selectedValues = $("#component").val() || [];
    const components = ['wapu', 'end_user', 'delivery', 'service', 'ca'];

    components.forEach(component => {
      const componentDiv = $(`#show${capitalizeFirstLetter(component)}`);
      const componentInput = $(`#${component}`);

      if (selectedValues.includes(component)) {
        componentDiv.show();
        componentInput.prop("required", true);
      } else {
        componentDiv.hide();
        componentInput.prop("required", false).val(0);
      }
    });

    calculateSubtotals();
  }

  // Hitung subtotal
  function calculateSubtotals() {
    const fields = ['bmt_awal', 'ca', 'service', 'wapu', 'end_user', 'delivery'];
    let subtotal = fields.reduce((acc, field) => acc + parseInt($("#" + field).val().replace(/[\D\s\._\-]+/g, "") || 0, 10), 0);

    let decrement_cost = parseInt($("#decrement_cost").val().replace(/[\D\s\._\-]+/g, "") || 0, 10);
    let admin_bunga = parseFloat($("#admin_bunga").val()) || 0;
    let bunga_admin = Math.round((admin_bunga / 100) * subtotal);

    $("#admin_cost").val(bunga_admin);
    $("#displayCost").text(numberWithCommas(bunga_admin));

    $("#subtotal").val(subtotal);
    $("#displaySubtotal").text("Rp. " + numberWithCommas(subtotal));

    let finalSubtotal = subtotal - bunga_admin - decrement_cost;
    $("#finalSubtotal").val(finalSubtotal);
    $("#displayFinalSubtotal").text(numberWithCommas(finalSubtotal));
  }

  // Format input uang
  function formatRupiah(angka) {
    return angka.replace(/[^,\d]/g, "").toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  // Tambahkan koma ke angka
  function numberWithCommas(x) {
    return x.toLocaleString("id-ID");
  }

  // Utility untuk kapitalisasi huruf pertama
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  // Event listener
  $(document).ready(function () {
    calculateSubtotals();
    $(".calculate").on("keyup change", calculateSubtotals);
    $("#component").on("change", toggleInputs);
    $(document).on("keyup", ".uang", function () {
      $(this).val(formatRupiah(this.value));
    });

    if (project.principal_id !== null) {
      $("#component").val(JSON.parse(project.component)).trigger("change");
    }
  });
});
