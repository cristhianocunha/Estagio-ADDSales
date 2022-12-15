$(function () {
    $('.next-step').click(function (event) {
        event.preventDefault();
        $(this).parents('.form-step').hide().next().show();
        
    });
});


$(document).ready(function () {
    $("form").click(function (event) {
      var formData = {
        name: $("#name").val(),
        email: $("#email").val(),
        superheroAlias: $("#telefone").val(),
      };
  
      $.ajax({
        type: "POST",
        url: "backend.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);
      });
  
      event.preventDefault();
    });
  });
