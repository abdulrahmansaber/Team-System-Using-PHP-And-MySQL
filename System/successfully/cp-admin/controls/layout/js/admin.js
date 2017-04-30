$(function () {

    $('[placeholder]').focus(function () {
      $(this).attr('data-text', $(this).attr('placeholder'));
      $(this).attr('placeholder', '');
    }).blur(function () {
      $(this).attr('placeholder', $(this).attr('data-text'));
    });

    $('.open-new-member-form').click(function () {
      $('.new-member-form').slideDown('slow');
    });

    $('.close-insert-alerts').click(function () {
      $(this).fadeOut('slow');
      $('.insert-errors').fadeOut('slow');
    });

    $('.close-inserted-alert').click(function () {
      $(this).fadeOut('slow');
      $('.inserted-successfully').fadeOut('slow');
    });
});
