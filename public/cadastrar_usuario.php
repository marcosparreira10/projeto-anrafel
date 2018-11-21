<?php require_once("../conexao/bd/conexaobd.php"); ?>




<?php


    //Insercao no banco

        
        
        if(isset($_POST["Nome"])){
        $nome       = $_POST["Nome"];
        $login      = $_POST["Login"];
        $senha      = $_POST["Senha"];
        $senha = md5($senha);
        $email      = $_POST["Email"];
        $tel        = $_POST["Telefone"];
        $situacao   = $_POST["Situacao"];
        $grupo      = $_POST["grupo"];
        
        $inserir = "INSERT INTO USUARIOS ";
        $inserir .="(nome,login,senha,email,tel,situacao,cod_grupo) ";
        $inserir .="VALUES ";
        $inserir .="('$nome','$login','$senha','$email','$tel','$situacao',$grupo)";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir){
            die("Erro ao inserir");
        }
        
    }



    //Selecao de Grupo
    $select = "select cod_grupo,nome_grupo ";
    $select .="From grupo ";
    $lista_grupo = mysqli_query($conecta,$select);
    if(!$lista_grupo){
        die("Erro ao listar grupo");
    }

?>

<?php
    // teste de segurança

    session_start();
  
    if ( !isset($_SESSION["user_portal"])) {
        header("location:login.php");
    }

    // fim do teste de seguranca
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuario</title>
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    <body>
        <?php include_once("_incluir/topo.php");?>

        
        <main>
            <div id="janela_formulario">
            <form action="cadastrar_usuario.php" method="post">
                <input type="text" name="Nome" placeholder="Nome do Usuario">
                <input type="text" name="Login" placeholder="Login do Usuario">
                <input type="password" name="Senha" placeholder="Senha">
                <input type="text" name="Email" placeholder="email">
                <input type="text" name="Telefone" placeholder="Telefone">
                <input type="text" name="Situacao" placeholder="Situacao">
                <select name="grupo">
                    <?php
                        while($linha= mysqli_fetch_assoc($lista_grupo)){                    
                    ?>
                <option value="<?php echo $linha["cod_grupo"];  ?>">
                    <?php echo utf8_encode($linha["nome_grupo"]);?>
                </option>
                    <?php
                        }
                    ?>
                </select>
                <input type="submit" value="Inserir">
                
                
                
            
                
            </form>
            
            
            </div>
            
            
            
        
        </main>
        </body>
    
    
    
    
    </head>




</html>