

$(document).ready(function() {
 console.log('primeiro');
    $("#submit").click(function() {
        console.log('segundo');
        var nome = $("#nome").val();
        var data_nascimento = $("#data_nascimento").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var regiao = $("#regiao").val();
        var unidade = $("#unidade").val();
        
        console.log(nome);
        
        let data = {
            nome: nome,
            data_nascimento: data_nascimento,
            email: email,
            telefone: telefone,
            regiao: regiao,
            unidade: unidade
        };
        console.log(data);

        if(nome==''||data_nascimento==''||email==''||telefone=='' || regiao==''|| unidade=='') {
            alert("por.");
            return false;
        }
    
        $.ajax({
            type: "POST",
            // url: 'http://api-bra1.addsales.com/join-asbr/ti/lead?token=ab565c3c42d7a5253285362dbb3dee40',
            url: "./back-end.php",
            data,   
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
