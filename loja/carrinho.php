<?php 

include('titulo.php');

@session_start();
$ver_car_pg = $_SESSION["ver_car_pag"];


$sabor_01 = $_POST["saborx"];

if ($sabor_01 == "Escolha o Sabor"){
	
	$sabor_01 = " ";
}

// Iniciamos nossa sess�o que vai indicar o usu�rio pela session_id
@session_start();
include("../conexao.php");

include_once('../sql_injection.php');


$hostname_conn = $host;
$database_conn = $db;
$username_conn = $user;
$password_conn = $pass;

// Conectamos ao nosso servidor MySQL
if(!($conn = @mysql_connect($hostname_conn,$username_conn,$password_conn))) 
{
   echo "Erro ao conectar ao MySQL.";
   exit;
}
// Selecionamos nossa base de dados MySQL
if(!($con = @mysql_select_db($database_conn,$conn))) 
{
   echo "Erro ao selecionar ao MySQL.";
   exit;
}

// Recuperamos os valores passados por parametros
$acao = $_GET['acao'];
$cod =  $_GET['cod'];

if (empty($acao)){
	
	$acao = $_POST['acao'];
}

// Verificamos se a acao � igual a incluir
if ($acao == "incluir")
{	
	// Verificamos se cod do produto � diferente de vazio
	if ($cod != '')
	{
		// Se for diferente de vazio verificamos se � num�rico
		if (is_numeric($cod))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$cod = addslashes(htmlentities($cod));
			
			// Verificamos se o produto referente ao $cod j� est� no carrinho para o session id correnpondente
			$query_rs_carrinho = "SELECT * FROM tbl_carrinho WHERE tbl_carrinho.cod = '".$cod."'  AND tbl_carrinho.sessao = '".session_id()."'";
			$rs_carrinho = @mysql_query($query_rs_carrinho, $conn) or die(mysql_error());
			$row_rs_carrinho = @mysql_fetch_assoc($rs_carrinho);
			$totalRows_rs_carrinho = @mysql_num_rows($rs_carrinho);
			
			// Se o total for igual a zero � sinal que o produto ainda n�o est� no carrinho
			if ($totalRows_rs_carrinho == 0)
			{
				// Aqui pegamos os dados do produto a ser incluido no carrinho
				$query_rs_produto = "select * from produto where codigo = '".$cod."'";
				$rs_produto = @mysql_query($query_rs_produto, $conn) or die(mysql_error());
				$row_rs_produto = @mysql_fetch_assoc($rs_produto);
				$totalRows_rs_produto = @mysql_num_rows($rs_produto);
				
				// Se total for maior que zero esse produto existe e ent�o podemos incluir no carrinho
				if ($totalRows_rs_produto > 0)
				{
					$registro_produto = @mysql_fetch_assoc($rs_produto);
					// Incluimos o produto selecionado no carrinho de compras
					$add_sql = "INSERT INTO tbl_carrinho ( cod, nome, preco, qtd, sessao, foto) 
					VALUES
					('".$row_rs_produto['codigo']."','".$row_rs_produto['nome'].' '.$sabor_01."','".$row_rs_produto['valor']."','1','".session_id()."','".$row_rs_produto['fot_peq']."')";
					$rs_produto_add = @mysql_query($add_sql, $conn) or die(mysql_error());
				}
			}		
		}
	}
}	

// Verificamos se a acao � igual a excluir
if ($acao == "excluir")
{
	// Verificamos se cod do produto � diferente de vazio
	if ($cod != '')
	{
		// Se for diferente de vazio verificamos se � num�rico
		if (is_numeric($cod))
		{	
		    // Tratamos a variavel de caracteres indevidos
			$cod = addslashes(htmlentities($cod));
			// Verificamos se o produto referente ao $cod  est� no carrinho para o session id correnpondente
			$query_rs_car = "SELECT * FROM tbl_carrinho WHERE cod = '".$cod."'  AND sessao = '".session_id()."'";
			$rs_car = @mysql_query($query_rs_car, $conn) or die(mysql_error());
			$row_rs_carrinho = @mysql_fetch_assoc($rs_car);
			$totalRows_rs_car = @mysql_num_rows($rs_car);
			
			// Se encontrarmos o registro, excluimos do carrinho
			if ($totalRows_rs_car > 0)
			{
				$sql_carrinho_excluir = "DELETE FROM tbl_carrinho WHERE cod = '".$cod."' AND sessao = '".session_id()."'";	
				$exec_carrinho_excluir = @mysql_query($sql_carrinho_excluir, $conn) or die(mysql_error());
			}
		}
	}
}

// Verificamos se a a��o � de modificar a quantidade do produto
if ($acao == "modifica")
{
	$quant = $_POST['qtd'];
		// Se for diferente de vazio verificamos se � num�rico
		if (is_array($quant))
		{	
		    // Aqui percorremos o nosso array
			foreach($quant as $cod => $qtd)
			{
				// Verificamos se os valores s�o do tipo numeric
				if(is_numeric($cod) && is_numeric($qtd))
				{
					// Fazemos nosso update nas quantidades dos produtos
					$sql_modifica = "UPDATE tbl_carrinho SET qtd = 	'". anti_sql_injection($qtd) ."' WHERE  cod = '$cod' AND sessao = '".session_id()."'";
					$rs_modifica = @mysql_query($sql_modifica, $conn) or die(mysql_error());
				}
			}
		}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Carrinho de Compras</title>
<style type="text/css">
<!--

.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
}
.style2 {font-size: 8px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style3 {font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style4 {
	color: #FF0000;
	font-weight: bold;
}
.style5 {font-size: 9px}
-->
</style>
</head>

<body bgcolor="#E6E6E6">
<table width="100%" border="0" bgcolor="#E6E6E6">
  <tr>
    <td width="1%"><img src="../graphics/px1.gif" width="10" height="10" /></td>
    <td width="98%"><div align="center"><img src="../graphics/carrinho.png" /> </div>
      <form action="carrinho.php?acao=modifica" method="post">
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr class="style2" width="100%" >
            <th width="6%" scope="col">FOTO</th>
            <th width="39%" scope="col">PRODUTO</th>
            <th width="15%" scope="col">PRE&Ccedil;O</th>
            <th width="12%" scope="col">QUANTIDADE</th>
            <th width="14%" scope="col">SUBTOTAL</th>
            <th width="14%" scope="col">&nbsp;</th>
          </tr>
          <?php 
  $sql_meu_carrinho = "SELECT * FROM tbl_carrinho WHERE  sessao = '".session_id()."' ORDER BY nome ASC";
  $exec_meu_carrinho =  @mysql_query($sql_meu_carrinho, $conn) or die(mysql_error());
  $qtd_meu_carrinho = @mysql_num_rows($exec_meu_carrinho);
  
  if ($qtd_meu_carrinho > 0)
  {
  	$soma_carrinho = 0;
  	while ($row_rs_produto_carrinho = @mysql_fetch_assoc($exec_meu_carrinho))
	{
		$soma_carrinho += ($row_rs_produto_carrinho['preco']*$row_rs_produto_carrinho['qtd']);
  ?>
          <tr>
            <td><div align="center"><img src="../graphics/px1.gif" width="5" height="1" /><img src='../<?= $row_rs_produto_carrinho['foto']?>' border='0' width='40' height='40' /><img src="../graphics/px1.gif" width="5" height="1" /></div></td>
            <td><div align="left"> <font size="1" face="Arial"><img src="../graphics/px1.gif" width="3" height="1" />
                    <?= $row_rs_produto_carrinho['nome']?>
            </font></div></td>
            <td><div align="center">
                <font size="1" face="Arial">
                <?=  number_format($row_rs_produto_carrinho['preco'],2,",","."); ?>
            </font></div></td>
            <td><div align="center" class="style3">
                <select name="qtd[<?= $row_rs_produto_carrinho['cod']?>]" value="<?= $row_rs_produto_carrinho['qtd']?>" />
                
                <option value='<?= $row_rs_produto_carrinho['qtd']?>'>
                <?= $row_rs_produto_carrinho['qtd']?>
                </option>
                <option value='1'> 1 </option>
                <option value='2'> 2 </option>
                <option value='3'> 3 </option>
                <option value='4'> 4 </option>
                <option value='5'> 5 </option>
                <option value='6'> 6 </option>
                <option value='7'> 7 </option>
                <option value='8'> 8 </option>
                <option value='9'> 9 </option>
                <option value='10'> 10 </option>
                <option value='11'> 11 </option>
                <option value='12'> 12 </option>
                <option value='13'> 13 </option>
                <option value='14'> 14 </option>
                <option value='15'> 15 </option>
                <option value='16'> 16 </option>
                <option value='17'> 17 </option>
                <option value='18'> 18 </option>
                <option value='19'> 19 </option>
                <option value='20'> 20 </option>
				
				</select>
            </div></td>
            <td width="14%"><div align="center"><font size="1" face="Arial">
                <?=  number_format($row_rs_produto_carrinho['preco']*$row_rs_produto_carrinho['qtd'],2,",","."); ?>
            </font></div></td>
            <td align="center"><div><a href="carrinho.php?cod=<?= $row_rs_produto_carrinho['cod']?>&amp;acao=excluir"><img src="../graphics/del_carrinho.png" width="110" height="21" border="0"/></a></div></td>
          </tr>
          <?php 

$qtd_car_pg = $qtd_car_pg + $row_rs_produto_carrinho['qtd'];

  }
	
}
@session_start();
$_SESSION['meu_carrinho'] = $qtd_car_pg;
$_SESSION['meu_car_seg_2'] = $qtd_car_pg

  ?>
          <tr>
            <td colspan="4"><div align="right"><strong>TOTAL:</strong>&nbsp; </div>
                <div align="right"></div>
                <div align="right"></div></td>
            <td><div align="center" class="style1"> <font color="#FF0000">
                <?=  number_format($soma_carrinho,2,",","."); ?>
            </font></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <?php 
          @session_start();
		  $_SESSION["alte_url_pag"] = "dsds32";
          ?>
                  <th width="33%" height="60" scope="col"><span class="style3"><a href="loja.php"><img src="../graphics/comprando.png" border="0" /></a></span></th>
                  <th width="33%" scope="col">&nbsp;</th>
                  <th width="33%" scope="col">&nbsp;</th>
                  <th width="33%" scope="col"><input type="image" name="imageField" src="../graphics/atualizar.png" /></th>
                  <th width="34%" scope="col"><label> </label></th>
                </tr>
            </table></td>
          </tr>
        </table>
      </form>
      <?php 
                
                @session_start();
		        $_SESSION["car_ver_pag_fim"] = "lkoire54";
                
                ?>
      <form method="post" action="carrinho_fim.php?op=finalizar">
        <center>
          <input name="image" type='image' src="../graphics/pagar1.png"/>
        </center>
      </form>
      <center>
        <center>
          <div align="center"><img src="../graphics/px1.gif" width="20" height="20" /><br />
              <img src="../graphics/Footer_Content.gif" width="700" height="76" /><br />
              <img src="../graphics/px1.gif" width="20" height="20" /><br />
          </div>
        </center>
    </center></td>
    <td width="1%"><img src="../graphics/px1.gif" width="8" height="10" /></td>
  </tr>
</table>
</body>
</html>

<?php 

include('rodape.php');

?>