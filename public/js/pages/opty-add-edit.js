"use strict";

$(function () {  
  var form = document.getElementById("storeFormOpty"),
  formValidation = FormValidation.formValidation(form, {
    fields: {
      code_opty: {
        validators: {
          notEmpty: {
            message: "ID Project Opty tidak boleh kosong",
          },
        },
      },
      project_name: {
        validators: {
          notEmpty: {
            message: "Nama Project tidak boleh kosong",
          },
        },
      },
      account_manager: {
        validators: {
          notEmpty: {
            message: "Nama Account Manager tidak boleh kosong",
          },
        },
      },
      revenue_sales: {
        validators: {
          notEmpty: {
            message: "Sales Revenue tidak boleh kosong",
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

  formValidation
    .on("core.form.valid", function() {
      // Submit the form if valid
      form.submit();
    })
});
