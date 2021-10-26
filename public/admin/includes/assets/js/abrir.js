$('.menuicon').on('click', function () {
    $('.page').toggleClass('abrir');
});
$(function(){
  $('#bottomright, #bottomleft').on('click', function(){
    $('#bottom div').toggleClass('hidden');
  });
});
