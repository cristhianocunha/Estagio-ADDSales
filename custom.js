
$(document).ready(function() {
 
$("#submit").click(function() {
 
var nome = $("#nome").val();
var data_nascimento = $("#data_nascimento").val();
var email = $("#email").val();
var telefone = $("#telefone").val();
 


if(nome==''||data_nascimento==''||email==''||telefone=='') {
alert("Please fill all fields.");
return false;
}
 
$.ajax({
type: "POST",
url: "back-end.php",
data: {
firsnometName: nome,
data_nascimento: data_nascimento,
email: email,
telefone: telefone
},
cache: false,
success: function(data) {
alert(data);
},
error: function(xhr, status, error) {
console.error(xhr);
}
});
});
 
});
