<?php 
/*
 ----------------------------------------------------------
 Desenvolvido por...: Edson de Araujo
 Finalidade.........: Incluir Resposta Forum
 Criado em Data.....: 02/08/2009
 Ultima Atualiza��o : 02/08/2009 

 DEUS SEJA LOUVADO
 ----------------------------------------------------------
*/

include('aguarde.php');

include('titulo.php');

// Resgata a Sessao
session_start();
$ser_name3_c = strtolower($_SESSION["log_name_c"]);
$acesso_2 = $_SESSION['data_log_2'];

if (empty($ser_name3_c)){
	
//	require("comercio.php");
//	exit;
}

include('../conexao.php');

// Chama o Banco de Dados
$link = @mysql_connect($host,$user,$pass);

@mysql_select_db($db);

$data=date("d/m/Y  H:i:s");
$time=date("YmdHis");
//echo $vt_mail;


$nome       = $_POST['nome'];
$foto_pda   = $_POST['foto_pda'];
$usuario2   = $_POST['usuario2'];
$copra_nome = strtolower($_POST['copra_nome']);
$elm1       = $_POST['elm1'];
$cod_prod   = $_POST['cod_prod'];

$consulta4 = "INSERT INTO `msg_question`    (`nome`, `foto`, `vendedor`, `comprador`, `mensagem`, `data`, `time`, `cod_prod`)    
														        
					                VALUES  ('$nome', '$foto_pda', '$usuario2', '$copra_nome', '$elm1', '$data','$time', '$cod_prod')";

@mysql_query($consulta4, $link)  or

die("echo '<script>alert('Erro: Falha incluindo !!!');</script>'	
     echo '<script>history.go(-1);</script>'");					

// Envia e-mail informando que o produto recebeu uma pergunta

$consulta  = "SELECT * FROM produto2 WHERE codigo = '$cod_prod'";
					
$resultado = @mysql_query($consulta);
					
// Incrementa novo codigo
					
$row = @mysql_fetch_array($resultado);
					

$ID_COD     = encode5t(@$row["codigo"]);
$id_prod    = @$row["codigo"];
$nome       = @$row["nome"];
$descricao  = @$row["descricao"];
$preco1     = @$row["valor1"];
$preco2     = @$row["valor2"];
$foto       = @$row["fot_peq"];
$quantidade = @$row["quantidade"];
$visitas    = @$row["visita"];
$estado     = @$row["local_produto"];
$usuario    = @$row["nome_user"];


// Procura e-mail do vendedor

$consulta2z  = "SELECT * FROM tt_ser_01 WHERE login = '$usuario2'";
					
$resultado2z = @mysql_query($consulta2z);
					
$row2z = @mysql_fetch_array($resultado2z);
					
$mail_des_2z 	= @$row2z["e_mail"];


$assunto   = "Pergunta para o Produto ".$nome;
    
require_once('phpmailer/class.phpmailer.php');

$erros = "";

if( empty($erros) ){

    $phpmail = new PHPMailer();

	$phpmail->IsSMTP();                              // Envia por SMTP
	$phpmail->Mailer   = "smtp";
	$phpmail->Host     = "174.122.66.98";            // SMTP servers
	$phpmail->SMTPAuth = true;                       // Caso o servidor SMTP precise de autentica��o
	$phpmail->Port     = 25;
	$phpmail->Username = "compraai@compraai.com.br";        // SMTP username
	$phpmail->Password = "tty%909$";                 // SMTP password
							
	$phpmail->IsHTML(true);
	$phpmail->From     = "edsonaraujo1@hotmail.com";        // Retorno CC
	$phpmail->FromName = "Compraai.com.br";
							
	$phpmail->AddAddress($mail_des_2z);           // Destino
	//    $phpmail->AddAddress("compraai@compraai.com.br"); // Trocar CCo
    

    $message = "<html>
	            <head>
	            <style>
	            
	            .style1 {
                    	color: #FFFFFF;
	                    font-weight: bold;
                 }
                </style>
	            
	            
				</head>
				<body>

				<table width='513' border='0' align='center' cellpadding='0' cellspacing='0'>
				  <tr>
				    <td width='13'>&nbsp;</td>
				    <td width='489' bgcolor='#FF8401'><div align='center' class='style1'>Fizeram Uma Pergunta para seu Produto                    </div></td>
				    <td width='11'>&nbsp;</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td bgcolor='#CCCCCC'><div align='center'>
				      <p align='center'><br>
				        </b>Produto&nbsp;&nbsp; <strong><b>$nome</b> <br>
				                </strong>em&nbsp;&nbsp;<strong> $data
				          <br>
				          acesse: <a href='http://wwww.compraai.com.br/site/descricao.php?id_prod=$ID_COD'>$nome</a>
				          <br>
			            </strong></p>
				      <p><strong><br>
				          </strong></p>
				    </div></td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td height='23'>&nbsp;</td>
				    <td bordercolor='#999999' bgcolor='#CCCCCC'><div align='left'>
				      <p><b>Pergunta...</b><br>
					     &nbsp;&nbsp;&nbsp; $elm1 <br>
				         
				</p>
				    </div></td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td height='23'>&nbsp;</td>
				    <td bgcolor='#FF8401'><div align='center'><span>Created by Compraai todos direitos reservados 2009</span>                    </div></td>
				    <td>&nbsp;</td>
				  </tr>
				</table>				</body>
				</html>";
    
    $phpmail->Subject = "Fizeram uma Pergunta para o Seu Produto";
 //   $phpmail->Body .= "Nome: ".$_POST["nome"]."<br />";
 //   $phpmail->Body .= "E-mail: ".$_POST["vt_mail"]."<br />";
    $phpmail->Body .= "<br />";
//    $phpmail->Body .= "$assunto";
    $phpmail->Body .= "$message";
    $phpmail->Body .= "<br />";
    
    $send = $phpmail->Send();

    if($send){

?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FF9900"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td bgcolor="#FDECDB"><img src="../graphics/px1.gif" width="15" height="14"><b><font color="#FF6600" face="Arial">Portal da Troca </font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 

    	echo "<body bgcolor='#FFFFFF'><br><br><br><br>";
    	echo "<center><img src='../graphics/ate_logo.gif' width='95' height='40'><br></center>";
		echo "<center><b>Sua Pergunta foi enviada com sucesso!</b><br></center>";
		echo "<center></center><br><br><br><br><br><br><br><br>";
		$faz_x1 = 1;
    	
    }else{
    	
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FF9900"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td bgcolor="#FDECDB"><img src="../graphics/px1.gif" width="15" height="14"><b><font color="#FF6600" face="Arial">Portal da Troca </font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php    	
   	   echo "<body bgcolor='#FFFFFF'><br><br><br><br>";
       echo "<center>N�o foi poss�vel enviar a mensagem. Erro: <br></center>";
	   echo "<center>" .$phpmail->ErrorInfo. "</center><br><br><br><br><br><br><br><br>";


    }

}

?>
<html><head>
<meta HTTP-EQUIV="Refresh" CONTENT="10;URL=descricao.php?id_prod=<?=encode5t($cod_prod);?>"/>
</head>
</html>
<?php 
include('rodape.php');
?>