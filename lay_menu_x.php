<?php
//include_once("config.php");

if (!empty($alte_url_pag)){


?>

            <div id="nav">
              <ul>
                <li id="current"><a href="inicio.php">Principal</a></li>
                <li ><a href="forum/forum.php">Forum</a></li>
                <li><a href="comercio/comercio.php">Comprar</a></li>
                <li><a href="mercado/produto.php">Vender</a></li>
                <li><a href="loja/loja.php">Loja</a></li>
                <li><a href="emprego/emprego.php">Emprego</a></li>
                <li><a href="cadastro/cadastro.php">Cadastre_se</a></li>
                <li><a href="batepapo/bate_papo.php">Bate-Papo</a></li>
                <li><a href="downloads/downloads.php">Downloads</a></li>
                <li><a href="fale/fale.php">Contato</a></li>
              </ul>
          </div>

<?php
}else{

header('Location:index.php');

	
}
?>
