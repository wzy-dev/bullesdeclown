function showLoader() {
  $('.popup').removeClass('d-none');
  $('.popup').addClass('d-flex');
  $('.popup').animate({opacity: '1'}, 500);
};

function hideLoader() {
  $('.popup').animate({opacity: '0'}, 500, function() {
    $('.popup').removeClass('d-flex');
    $('.popup').addClass('d-none');
        $('.loader').show();
  });             
};
