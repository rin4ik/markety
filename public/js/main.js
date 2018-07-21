$(function() {
  
  $('.carousel').carousel({
    interval: false
}); 
  
  /*
  
    $(".input-group > .form-control").focus(function(e){
        $(this).parent().addClass("focused");
    }).blur(function(e){
        $(this).parent().removeClass("focused");
    });

  */
  
  
  $('.header-category-toggle').click(function(){
    $('.categories').toggle()

  })
/*
 $( ".app" ).html( '<header class="header"><div class="header-main"><div class="container"><div class="row"></div><div class="header-main-left c-sm-3"><a class="header-logo" href="/www"><img src="/template/img/logo.png"></a></div></div></div></header>' );



  
  $('.header-search .form-control').focus(function(){
    $('.header-search .btn').addClass('btn-blue')
  })
  
  $('.header-category .btn').click(function(){
    $('.categories').show()
    $('body').addClass('overflow-hidden')
    showBackdrop()
  })
  
  
  $('.side-left .nav').on('mouseover', function(){
    $('.categories').show()
    showBackdrop()
  })
  
  
  $('.categories').mdouseleave(function(){
   $('.categories').hide()
   hideBackdrop()
  })
  

  
  $('.header-category .btn').mouseover(function(){
    $('#categories').modal('show')
  })
  
   */
  
  
  

});


function showBackdrop(){
    $('.backdrop').remove();
  $(document.body).append('<div class="backdrop"></div>');
  $('.backdrop').addClass('show');
  $('.backdrop').addClass('test');
}
function hideBackdrop(){
  $('.backdrop').removeClass('show');
  $('.backdrop').remove();
  
}

/*


$(document).ready(function () {
  $('.modal').on('shown.bs.modal', function (e) {
     window.location.hash = $(e.currentTarget).attr('id');
  });
  $('.modal').on('hidden.bs.modal', function (e) {
    window.location.hash = ''
  });
});*/