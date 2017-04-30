$(function () {
  $('.open-dropdown').click(function () {
    $('.dropdown').toggle('slow');
  });

  $('.open-edit-form').click(function () {
    $('.edit-form').slideToggle('fast');
  });

  $('.updated i').click(function () {
    $('.updated').fadeOut(500);
  });

  $('.tool-website > i').click(function () {
    $('.tool-website .options').slideToggle(500);
  });

  $('.updates-errors i.close-update-error').click(function () {
    $('.updates-errors').fadeOut(500);
  });

});
