let nome = document.getElementsByName("nome");
let telefone = document.getElementsByName("telefone");
let email = document.getElementsByName("email");
let data_nascimento = document.getElementsByName("data_nascimento");
let regiao = document.getElementsByName("regiao");
                
                var formCadUsuario = [nome, telefone, email, data_nascimento, regiao];
                
                    
                    
                   
                    console.log(formCadUsuario);
                    



                    if (formCadUsuario) {
                        
                            // Receber os dados do formulario
                            const dadosForm = new FormData(formCadUsuario);
                    
                            // Enviar os dados para o arquivo "cadastrar.php", deve salvar no BD
                            const dados = await fetch("back-end.php", {
                                method: "POST",
                                body: dadosForm
                            });
                            const resposta = await dados.json();
                            //console.log(resposta);
                    
                            
                        };
                    