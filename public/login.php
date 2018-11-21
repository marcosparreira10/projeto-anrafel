<?php require_once("../conexao/bd/conexaobd.php"); ?>
<?php
    // adicionar variaveis de sessao

     session_start();


    if ( isset( $_POST["usuario"] )  ) {
        $usuario    = addslashes($_POST["usuario"]);
        $senha      = addslashes($_POST["senha"]); 
        $senha      = md5($senha);
        
        
        $login = "SELECT * ";
        $login .= "FROM usuarios ";
        $login .= "WHERE login = '{$usuario}' and senha = '{$senha}' ";
        
        $acesso = mysqli_query($conecta, $login);
          
        
             
        
        
        if ( !$acesso ) {
            die("Falha na consulta ao banco");
            
            
        }
    
      
        $informacao = mysqli_fetch_assoc($acesso);
        $tentativa=0;
        if ( empty($informacao) ) {
            $mensagem = "Login sem sucesso.";  
            $informacao = $tentativa+1;
            echo $tentativa;
        }             
        else {
            $_SESSION["user_portal"] = $informacao["codigo"];
            header("location:menu.php");
        }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal Gerencial</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/login.css" rel="stylesheet">
        
    </head>

    <body>
        
        <header>
            <center></center>
            <div id="header_central">
                
            </div>
        </header>
        
        <main>
            
            <div id="janela_login">
                <form action="login.php" method="post">
                    <h2>Login...</h2>
                    <input type="text" name="usuario" placeholder="Usuário">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="submit" value="Login">
                
                    <?php
                        if ( isset($mensagem)) { 
                    ?>
                        <p><?php echo $mensagem ?></p>
                    
                    <?php
                        }
                    ?>                    
                
                
                </form>
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
            </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>