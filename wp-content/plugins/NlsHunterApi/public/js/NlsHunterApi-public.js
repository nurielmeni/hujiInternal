(function ($) {
  'use strict';

  var jobIdsSelector = '#modal-wrapper .inner-popup input[name="jobIds"]';

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  function setSearchOptions() {
    // Set the sumoselect values
  }

  /**
   * 
   * Get all the selected jobs 
   */
  function getSelectedJobs() {
    var selected = [];
    $.each($('#search-result-jobs .sr-select input[type="checkbox"]:checked'), function () {
        selected.push($(this).attr('jobcode'));
      }
    );
    $(applyJobIdsField).val(selected);
  }

  function openSubmitForm () {
    // Clear previous validation
    nls.clearFields($('.nls-apply-for-jobs.modal form'));

    // Remove the reply message if exists
    jQuery('#apply-response').remove();

    // Show the form in the modal
    jQuery('.nls-apply-for-jobs.modal').slideDown('slow');
  };

  function clipboardMsg(shareLink, success) {
    var msg = success
      ? $('<div class="flash-message">הקישור הועתק ללוח</div>')
      : $('<div class="flash-message error">בעיה בהעתקת הקישור</div>');
    $(shareLink).append(msg);
    setTimeout(function () {
      $(msg).fadeOut(2000, function () {
        msg.remove();
      });
    }, 3000);
  }

  $(document).ready(function () {
    // The page URL
    var pageURL = new URL(window.location.href);

    // Handle the area filter on search results
    $('.job-content form button').on('click', function () {
      var selectedArea = $(this)
        .parents('form')
        .find('select option:checked')
        .val();
      pageURL.searchParams.delete('areas[]');
      pageURL.searchParams.append('areas[]', selectedArea);

      window.location.href =
        pageURL.protocol +
        '//' +
        pageURL.host +
        pageURL.pathname +
        '?' +
        pageURL.searchParams.toString();
    });

    // Handle the share copy link to clipboard
    $('.share-item.copy').on('click', function () {
      var shareLink = this;
      var text = $(this).data('share-url');

      if (typeof window.clipboardData !== 'undefined') {
        // ie settings
        if (window.clipboardData.setData('Text', text)) {
          clipboardMsg(shareLink, true);
        } else {
          clipboardMsg(shareLink, false);
        }
      } else {
        navigator.clipboard
          .writeText(text)
          .then(function () {
            // Clipboard failed to copy
            console.log('Clipboard success to copy');
            clipboardMsg(shareLink, true);
          })
          .catch(function () {
            // Clipboard failed to copy
            console.log('Clipboard failed to copy');
            clipboardMsg(shareLink, false);
          });
      }
    });

    // Handle the share btn
    $(document).on('click', 'button.huji-btn.share', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).hide().parent().find('.share-widget').fadeIn(800);
    });

    var sumoSelect = $(
      '.nls-search .nls-field select, .nls-apply-field select'
    ).SumoSelect({
      csvDispCount: 2,
      captionFormat: '{0} נבחרו',
      captionFormatAllSelected: 'כל ה-{0} נבחרו!',
      floatWidth: 768,
      forceCustomRendering: false,
      outputAsCSV: false,
      nativeOnDevice: [
        'android',
        'webos',
        'iphone',
        'ipad',
        'ipod',
        'blackberry',
        'iemobile',
        'opera mini',
        'mobi',
      ],
      placeholder: 'בחירה',
      locale: ['אישור', 'ביטול', 'בחר הכל'],
      okCancelInMulti: false,
      isClickAwayOk: true,
      selectAll: true,
    });

    $('select.nls-search').on('sumo:opening', function (sumo) {
      // Turn arrow up make the filler div extend main to reveal all
      var sumoElement = $(this).parent();
      $(sumoElement).find('.CaptionCont>label>i').addClass('flip');
    });

    $('select.nls-search').on('sumo:closing', function (sumo) {
      // Turn arrow down
      var sumoElement = $(this).parent();
      $(sumoElement).find('.CaptionCont>label>i').removeClass('flip');

      $('div.sumo-filler').css('height', 0);
    });

    // Enable/Disable submit to selected jobs
    $('.job-wrap .top-wrap input[type="checkbox"]').on('click', function () {
      $('button.submit-cv.submit-selected')
      .prop('disabled', $('.job-wrap .top-wrap input[type="checkbox"]:checked').length === 0);
    });

    // if sumo select is set
    // Get the search options and set them on the search form
    if (sumoSelect.length > 0) setSearchOptions();

    // Display the form when doc ready (so the sumo select rendered before)
    $('form.nls-search').show();

    // Make the Flash message apear on ready
    $('div.nls-flash-message').css('visibility', 'visible');

    // Make the Flash message remove on click
    $('div.nls-flash-message strong').on('click', function () {
      $(this).parent('div.nls-flash-message').remove();
    });

    // Show the Job Details page (from Search Results and Hot Jobs modules)
    $(document).on('click', '.checkbox.sr-select label', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var jobCode = $(this).attr('for');
      window.location.assign(jobDetailsPageUrl + '?jobcode=' + jobCode);
    });

    // Clear the search form
    $('.nls-search-module a.clear').on('click', nls.clearFields);

    // Back to Search Page
    $(document).on('click', '#nls-search-results-new-search', function () {
      window.location.href = searchPageUrl;
    });

    $('form.nls-search input#search').on('keydown', function (e) {
      if (e.keyCode === 13) {
        e.preventDefault();
        e.stopPropagation();
        $(this).parents('form').submit();
      }
    });

    $('form.nls-search button').on('click', function (e) {
      $(this).parents('form').submit();
    });

    // Open the modal (from search rsults - job card)
    $('.submit-cv').on('click', function (event) {
      // clear previous validation
      var formLocation;

      if ($(this).hasClass('submit-selected')) {
        formLocation = $('.job-wrap:first');
      } else {
        formLocation = $(this).parents('.job-wrap');
      }
      jQuery('.nls-apply-for-jobs.modal').insertAfter(formLocation);
      openSubmitForm();
      var offset = jQuery('.nls-apply-for-jobs.modal').offset();
      jQuery('html, body').animate({ scrollTop: offset.top - 100 });

      var jobids = $(this).attr('jobcode');
      var submitGeneral = $(this).hasClass('submit-general');
      var submitSelected = $(this).hasClass('submit-selected');
      var applyJobIdsField = $(
        '.nls-apply-for-jobs.modal .modal-content .modal-body input.jobids-hidden-field'
      );
      //console.log('Job IDs: ', jobids);
      //console.log('Submit General: ', submitGeneral);
      //console.log('Submit Selected: ', submitSelected);

      // Submit form with the specified Job ID
      if (jobids !== 'undefined') {
        $(applyJobIdsField).val(jobids);
      }

      // Submit to the selected Job IDs (serach results selected jobs)
      if (submitSelected) {
        var selected = [];
        $.each(
          $('#search-result-jobs .sr-select input[type="checkbox"]:checked'),
          function () {
            selected.push($(this).attr('jobcode'));
          }
        );
        $(applyJobIdsField).val(selected);
        //console.log('Selected: ', selected);
      }

      // Submit without specifying Job Code
      if (submitGeneral) {
      }

      event.preventDefault();
    });

    // On job details show the apply form
    $('.site-main.job-details .bottom.actions button').on('click', function() {
      $(this).remove();
      openSubmitForm();
    });
  });
})(jQuery);
