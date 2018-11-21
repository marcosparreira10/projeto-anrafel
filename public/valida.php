<?php require_once("../conexao/bd/conexaobd.php"); ?>
<?php
    if ($_POST) {
 
      
        $login = trim($_POST["login"]);
        $senha = trim($_POST["senha"]);
  
        // Digitou Usuario ?
        if (empty($login)) {
            echo "<script>alert('Preencha o Login');</script>";
        }
        //Digitou a Senha?
        else if (empty($senha)) {
             
            echo "<script>alert('Preencha o campo senha');</script>";
        }
        else {
 
            $sql = "select codigo,ds_pass,qt_falha,dh_bloqueio,current_timestamp as dh_atual from usuario where cd_usuario = '$login'";
 
            $resultado = mysql_query($sql);
 
            $linha = mysql_fetch_array($resultado);
            $login2 = $linha["cd_usuario"];
            $senha2 = $linha["ds_pass"];
            $falha2 = $linha["qt_falha"];
            $bloqueio2 = $linha["dh_bloqueio"];     
            $dataatual2 = $linha["dh_atual"];   
 
         
            // usuario informado existe ?
            if (empty($login2)) {
                echo "<script>alert('Usuario nao existe');</script>";               
            // quando a tentativa for inferior a meia hora ele informa que o usuario esta bloqueado
            } else {
 
                if ((strtotime($dataatual2)-strtotime($bloqueio2)) <= 10) {
                  echo "<script>alert('Usuário Bloqueado');</script>";
                 
                } else {            
                    if ($bloqueio2<>'') {
                      mysql_query("UPDATE usuario SET qt_falha= 0,dh_bloqueio=NULL where cd_usuario= '$login'");
                      $falha2 = 0;
                    }
                    // senha confere ? ou ja passou da meia hora
                    if ($senha != $senha2) {                
                        if ($falha2<2) {
                          mysql_query("UPDATE usuario SET qt_falha= qt_falha+1 where cd_usuario= '$login'");
                          echo "<script>alert('Senha inválida');</script>";
                        } else {
                          mysql_query("UPDATE usuario SET qt_falha= qt_falha+1,dh_bloqueio=current_timestamp where cd_usuario= '$login'");
                          echo "<script>alert('Usuario bloqueado por excesso de tentativa invalida');</script>";
                        }  
                                     
                    } else {
                        mysql_query("UPDATE usuario SET qt_falha= 0,dh_bloqueio=NULL where cd_usuario= '$login'");
                        header("Location: administracao.php");
        
                    } 
                }
            }
        }
    }   
?>
RESPONDER CITAR