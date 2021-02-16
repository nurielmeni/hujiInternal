(function ($) {
  // Toggle tooltip
  $('.tooltip').on('click', function (event) {
    if ($('#tooltip-container').length > 0) {
        $('#tooltip-container').remove();
        return;
    }

    var position = $(this).position();
    var styles = {
      backgroundColor: '#ffffff',
      border: '1px solid #efc265',
      zIndex: '2000',
      boxShadow: '0 3px 6px 0 rgba(0, 0, 0, 0.16)',
      borderRadius: '4px',
      whiteSpace: 'wrap',
      position: 'absolute',
      top: position.top + 6,
      left: position.left - 50,
      width: '20rem',
      padding: '0.3rem 1rem',
      fontSize: '0.75rem',
    };

    var element = $('<div id="tooltip-container"></div>');

    $(element).css(styles);
    $(element).css('top', '+=20');
    $(element).text($(this).attr('title'));

    $('body').append($(element));

  });
})(jQuery);
