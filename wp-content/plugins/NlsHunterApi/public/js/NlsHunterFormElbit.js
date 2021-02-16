var nls =
  nls ||
  (function ($) {
    "use strict";
    // Will hold the text for the file options
    var fileOptions;

    var Validators = {
      ISRID: {
        fn: function (value) {
          // DEFINE RETURN VALUES
          var R_ELEGAL_INPUT = false; // -1
          var R_NOT_VALID = false; // -2
          var R_VALID = true; // 1

          //INPUT VALIDATION

          // Just in case -> convert to string
          var IDnum = String(value);

          // Validate correct input (Changed from 5 to 9 so only 9 digits are allowed)
          if (IDnum.length > 9 || IDnum.length < 9) return R_ELEGAL_INPUT;
          if (isNaN(IDnum)) return R_ELEGAL_INPUT;

          // The number is too short - add leading 0000
          if (IDnum.length < 9) {
            while (IDnum.length < 9) {
              IDnum = "0" + IDnum;
            }
          }

          // CHECK THE ID NUMBER
          var mone = 0,
            incNum;
          for (var i = 0; i < 9; i++) {
            incNum = Number(IDnum.charAt(i));
            incNum *= (i % 2) + 1;
            if (incNum > 9) incNum -= 9;
            mone += incNum;
          }
          if (mone % 10 == 0) return R_VALID;
          else return R_NOT_VALID;
        },
        msg: "מספר הזהות לא חוקי",
      },

      email: {
        fn: function (value) {
          var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return value && regex.test(String(value).toLowerCase());
        },
        msg: "כתובת האימייל לא חוקית",
      },

      phone: {
        fn: function (value) {
          var regex = /^0[0-9]{1,2}[-\s]{0,1}[0-9]{3}[-\s]{0,1}[0-9]{4}/i;
          return value && regex.test(String(value).trim().toLowerCase());
        },
        msg: "מספר הטלפון לא חוקי",
      },

      required: {
        fn: function (value) {
          return value && value.length > 0;
        },
        msg: "שדה זה הוא שדה חובה",
      },

      // If no option was selected of radi will return false
      radioRequired: {
        fn: function (el) {
          var valid = false;
          var name = $(el).attr("name");
          if (typeof name === "undefined") return valid;

          $(el)
            .parents(".nls-apply-field")
            .find('input[name="' + name + '"]')
            .each(function (i, option) {
              if ($(option).prop("checked")) valid = true;
            });
          return valid;
        },
        msg: "יש לבחור אחת מהאפשרויות",
      },
    };

    var validateSubmit = function (form, formData) {
      clearValidation(form);
      var valid = true;

      $(form)
        .find("input")
        .each(function (i, el) {
          if ($(el).parents(".nls-apply-field").css("display") === "none")
            return;
          if (typeof $(el).attr("validator") === "undefined") return;
          if (!fieldValidate(el)) valid = false;
        });
      console.log("Valid: ", valid);
      validForm();
      return valid;
    };

    var validForm = function () {
      var invalidFields = $(".nls-apply-for-jobs form .nls-invalid");
      if (invalidFields.length > 0) {
        $('.nls-apply-for-jobs .modal-footer .help-block')
          .html('<p><span>*ישנה שגיאה בטופס. אנא בדוק את הנתונים שהזנת.</span></p>')
          .show();
      } else {
        $(".nls-apply-for-jobs .modal-footer .help-block").html("").hide();
      }
    };

    // Validates all of the field validators
    var fieldValidate = function (el) {
      var valid = true;
      var validatorAttr = $(el).attr("validator");
      var validators = validatorAttr.trim().split(" ");
      var type = $(el).attr("type");
      var value = type === "radio" ? el : $(el).val();

      validators.forEach(function (validator) {
        // If invalid skip (show only first error)
        if ($(el).hasClass("nls-invalid")) return;

        if (!Validators[validator].fn(value)) {
          valid = false;
          var invalidElement =
            type === "radio" ? $(el).parents(".options-wrapper") : $(el);

          $(invalidElement).addClass("nls-invalid");
          $(el)
            .parents(".nls-apply-field")
            .find(".help-block")
            .html('<p><span>' + Validators[validator].msg + '</sapn></p>');
        }
      });
      return valid;
    };

    var clearFields = function (form) {
      // Clears the select inputs
      $(form)
        .find('select')
        .each(function () {
          var sumoEl = $(this)[0].sumo;
          if (sumoEl.isMobile()) {
            $('option').prop('selected', false);
            sumoEl.reload();
          } else {
            sumoEl.unSelectAll();
          }
        });

      form.find('input:not([type="radio"],[type="hidden"])').val('');
      form.find('.file-option').text(fileOptions);
      clearValidation(form);
      $('#nls-loader').remove();
    };

    var clearValidation = function (form) {
      form.find(".nls-invalid").removeClass("nls-invalid");
      form.find(".nls-apply-field .help-block").html("");
      validForm();
    };

    var clearFieldValidation = function (el) {
      $(el)
        .parents(".nls-apply-field")
        .find(".nls-invalid")
        .removeClass("nls-invalid");
      $(el).parents(".nls-apply-field").find(".help-block").text("");
    };

    var getParam = function (param) {
      var queryString = window.location.search;
      var urlParams = new URLSearchParams(queryString);
      return urlParams.get(param);
    };

    var clearFileSelect = function() {
      $('.nls-apply-for-jobs.modal .file-option').text(
        'לא נבחר קובץ סוגי הקבצים המומלצים: doc / docx / pdf / rtf'
      );
    }

    $(document).ready(function () {
      // Set the sid if exist
      getParam('sid') && $('input[name="sid"').val(getParam('sid'));

      // Set the file options
      fileOptions = $('form .file-option').text();

      // Add event listeners
      console.log('Ready Function');
      // Apply selected jobs
      $(document).on(
        'click',
        '.nls-apply-for-jobs.modal button.apply-cv',
        function (event) {
          var applyCvButton = this;
          var form = $(this).parents('.nls-apply-for-jobs').find('form');
          var formData = new FormData(form[0]);

          if (!validateSubmit(form, formData)) {
            event.preventDefault();
            return;
          }

          formData.append('action', 'apply_cv_function'),
            $.ajax({
              url: apply_cv_script.applyajaxurl,
              data: formData,
              contentType: false,
              cache: false,
              processData: false,
              dataType: 'json',
              beforeSend: function () {
                $('#modal-wrapper .inner-popup.apply-form').hide();
                $('#modal-wrapper .inner-popup.apply-response').after(
                  '<div id="nls-loader" class="loader">אנא המתן...</div>'
                );
              },
              success: function (response) {
                $('#nls-loader').remove();
                console.log('Status: ', response.status);
                
                // Tag manager
                fbq('track', 'CompleteRegistration');
                
                $('.inner-popup.apply-response').html(response.html).show();
                // Call this function so the wp will inform the change to the post
                $(document.body).trigger('post-load');
              },
              type: 'POST',
            });

          event.preventDefault();
        }
      );

      $('.nls-apply-for-jobs input[type="file"]').on('change', function (e) {
        $('.nls-apply-for-jobs.modal .file-option').text(
          $(this).val().length === 0 ? fileOptions : $(this).val()
        );
        fieldValidate(this);
      });

      // Clear validation errors on focus
      $('input').on('focus', function () {
        clearFieldValidation(this);
      });

      // Validate on blur and change
      $('input:not([type="radio"]):not([type="file"]').on(
        'blur change',
        function () {
          if (typeof $(this).attr('validator') === 'undefined') return;
          clearFieldValidation(this);
          fieldValidate(this);
          validForm();
        }
      );

      // Toggle visibility of radio
      $('input[type="radio"]').on('change', function () {
        var showClass = '.nls-apply-field.' + $(this).attr('name') + '-show';
        $('input[name="' + $(this).attr('name') + '"]').prop('checked')
          ? $(showClass).show()
          : $(showClass).hide();
      });

      // Make sure to initilize the radio display options
      $('input[type="radio"]').trigger('change');

      // Handle close button of the modal
      $('#modal-wrapper').on('click', '.close-popup, a.back-step', function () {
        $(this).parents('#modal-wrapper').hide();
      });
    });

    return {
      clearFields: clearFields,
    };
  })(jQuery);
