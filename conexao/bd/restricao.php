
<?PHP

include("rodape.php");
	 
if ($grupo = 2)
	   {
		$erro = "Voce nao tem acesso.";
		header("Location: menu.php?erro=$erro"); 
	   }	  	   	     	   
	   
?>