<?php require_once("../conexao/bd/conexaobd.php"); ?>

<?php
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:login.php");
    }

    // fim do teste de seguranca
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal Gerencial</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/styles.css" rel="stylesheet">
       
    </head>

    <body>
       <?php include_once("_incluir/topo.php");?>
     <div id='cssmenu'>
<ul>
   <li class='active'><a href='#'>Utilitários</a>
      <ul>
          <li><a href='cadastrar_usuario.php'>Cadastrar Usuario</a></li></ul>
   
    <li class='active'><a href='#'>Relatórios</a>
      <ul>
          <li><a href='listagem_produtos.php'>Produtos</a></li>
        <li><a href='listagem_produtosxfornecedor.php'>Produtos x Fornecedor</a></li></ul>
   <li class='active'><a href='#'>Campanhas</a>
      <ul>
          <li><a href='listagem_campanhaxfornecedor.php'>Campanha Fornecedor</a></li>
          <li><a href='listagem_campanhaxproduto.php'>Campanha Produto</a></li>
       </ul>
   <li><a href='#'>Contato</a></li>
</ul>
</div>
        <main>
            
            
            
        </main>
        <?php include_once("_incluir/rodape.php"); ?>  
        
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>