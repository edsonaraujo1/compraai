<?php

/**
 * @author holodek
 * @copyright 2009
 */



function retiraCaracteres($string) { // Fun��o para converter caracteres
$arrayRetira = array(   "porra ",
                        "porra, ",
	                    "caralho ",
	                    "caralho, ",
						"cuz�o ",
						"cuz�o, ",
						"puta ",
						"puta, ",
						"vagabunda ",
						"vagabunda, ",
						"merda ",
						"merda, ",
						"buceta ",
						"buceta, ",
						"cu ",
						"cu, ",
						"vadia ",
						"vadia, ",
						"bosta ",
						"bosta, ",
						"pinto ",
						"pinto, ",
						"verme ",
						"verme, ",
						"noia ",
						"noia, ",
						"safado ",
						"safado, ",
						"pilantra ",
						"pilantra, ",
						"bundao ",
						"bundao, ",
						"viado ",
						"viado, ",
						"bicha ",
						"bicha, ",
						"arrambado ",
						"arrambado, ",
						"ANUS ",
						"ANUS, ",
						"�NUS ",
						"�NUS, ",
						"BABA-OVO ",
						"BABAOVO ",
						"BABACA ",
						"BACURA ",
						"BAGOS ",
						"BAITOLA ",
						"BEBUM ",
						"BESTA ",
						"BICHA ",
						"BISCA ",
						"BIXA ",
						"BOAZUDA ",
						"BOCETA ",
						"BOCO ",
						"BOC� ",
						"BOIOLA ",
						"BOLAGATO ",
						"BOQUETE ",
						"BOLCAT ",
						"BOSSETA ",
						"BOSTA ",
						"BOSTANA ",
						"BRECHA ",
						"BREXA ",
						"BRIOCO ",
						"BRONHA ",
						"BUCA ",
						"BUCETA ",
						"BUNDA ",
						"BUNDUDA ",
						"BURRA ",
						"BURRO ",
						"BUSSETA ",
						"CACHORRA ",
						"CACHORRO ",
						"CADELA ",
						"CAGA ",
						"CAGADO ",
						"CAGAO ",
						"CAGONA ",
						"CANALHA ",
						"CARALHO ",
						"CASSETA ",
						"CASSETE ",
						"CHECHECA ",
						"CHERECA ",
						"CHIBUMBA ",
						"CHIBUMBO ",
						"CHIFRUDA ",
						"CHIFRUDO ",
						"CHOTA ",
						"CHOCHOTA ",
						"CHUPADA ",
						"CHUPADO ",
						"CLITORIS ",
						"CLIT�RIS ",
						"COCAINA ",
						"COCA�NA ",
						"COCO ",
						"COC� ",
						"CORNA ",
						"CORNO ",
						"CORNUDA ",
						"CORNUDO ",
						"CORRUPTA ",
						"CORRUPTO ",
						"CRETINA ",
						"CRETINO ",
						"CRUZ-CREDO ",
						"CU ",
						"C� ",
						"CULHAO ",
						"CULH�O ",
						"CULH�ES ",
						"CURALHO ",
						"CUZAO ",
						"CUZ�O ",
						"CUZUDA ",
						"CUZUDO ",
						"DEBIL ",
						"DEBILOIDE ",
						"DEFUNTO ",
						"DEMONIO ",
						"DEM�NIO ",
						"DIFUNTO ",
						"DOIDA ",
						"DOIDO ",
						"EGUA ",
						"�GUA ",
						"ESCROTA ",
						"ESCROTO ",
						"ESPORRADA ",
						"ESPORRADO ",
						"ESPORRO ",
						"ESP�RRO ",
						"ESTUPIDA ",
						"EST�PIDA ",
						"ESTUPIDEZ ",
						"ESTUPIDO ",
						"EST�PIDO ",
						"FEDIDA ",
						"FEDIDO ",
						"FEDOR ",
						"FEDORENTA ",
						"FEIA ",
						"FEIO ",
						"FEIOSA ",
						"FEIOSO ",
						"FEIOZA ",
						"FEIOZO ",
						"FELACAO ",
						"FELA��O ",
						"FENDA ",
						"FODA ",
						"FODAO ",
						"FOD�O ",
						"FODE ",
						"FODIDA ",
						"FODIDO ",
						"FORNICA ",
						"FUDENDO ",
						"TETUDA ",
						"Tes�o ", 
						"Tosco ", 
						"Tragado ", 
						"Tapado ", 
						"Rapariga ", 
						"Rampero ", 
						"Rusguento ", 
						"Porra ", 
						"Pinto ", 
						"Puta ", 
						"Puta ",
						"merda ", 
						"Pederasta ", 
						"Pau no teu cu ", 
						"Pregui�oso ", 
						"Pan�a ",
						"Viado ",
						"nadegas ", 
						"Noia ", 
						"Jumento ", 
						"Jegue ", 
						"Inasc�vel ", 
						"Idiota ", 
						"Imundo ", 
						"Homossexual ", 
						"Herege ",
						"Gay ", 
						"Ricard�o ", 
						"gozado ", 
						"Ogro ", 
						"Fiof� ", 
						"Foda ", 
						"Fuder ", 
						"Fudido ", 
						"Fella da Puta ", 
						"Falso ", 
						"Feio ", 
						"Erudito ", 
						"Escroto ", 
						"Est�pido ", 
						"Exdr�xulo ", 
						"Esporrado ", 
						"Desgra�ado ", 
						"c� ", 
						"merda ", 
						"buceta ",
						"arrombada ", 
						"Caralho ", 
						"Cacete ", 
						"Cu ", 
						"Catso ", 
						"Cazzo ", 
						"Corno ", 
						"Capeta ", 
						"caralho ", 
						"Bosta ", 
						"Buceta ", 
						"Bicha ", 
						"Babaca ", 
						"Boca-de-burro ", 
						"Burro ", 
						"Bund�o ", 
						"Bobo ", 
						"Bo�al ", 
						"Esperma ", 
						"Baleia ", 
						"Barril ", 
						"Arrombado ",
						"gozo ",
						"p� ", 
						"Alienado ", 
						"arrobado ",
						"espirante ",
						"piriguete ",
						"piriguetes ",
						"PIRIGUETE ",
						"Filha da Puta ",
						"Filhas da Puta ",
						"vaca ",
						"foder ",
						"cabroes ",
						"xupam ",
						"pintelhos ",
						"pentelhos ",
						"diabo ",
						"diabo, ",
						"peste ",
						"praga ",
						"peste ",
						"arrombados ",
						"bucetuda ",
						"capeta ",
						"filhos do diabo ",
						"arrombado ",
						"arrombado, ",
						"safada ",
						"safada, ",
						"pario ");
						
for($i = 0; $i < count($arrayRetira); $i++){
$string = ereg_replace(strtolower(retirar_carac($arrayRetira[$i])),"<img src='../graphics/c-angry.png' width=50 height=20>",strtolower($string));

}
return $string;
}

$database =	$db;     // Banco de Dados


function encode_msg ($smil) {
    global $image_dir,$database;
    if ($smil) {
        $smil = str_replace("\r", "", $smil);             // Replace carrige return
        $smil = str_replace("\n", "<BR>", $smil); 	// Replace newline with <br>
	$result = mysql_db_query($database, "SELECT * FROM smilies") or died("Query Error");
        while ($db = mysql_fetch_array($result)) {
	    $smil = str_replace($db[code], "<img src=".$image_dir."../graphics/smilies/".$db[file].">", $smil); // Smilie
        }
    }
    return $smil;
}

Function retirar_carac($var){

$var = ereg_replace("[���]",        "A",$var);
$var = ereg_replace("[���]",       "a",$var);
$var = ereg_replace("[���]",         "E",$var);
$var = ereg_replace("[���]",         "e",$var);
$var = ereg_replace("[����]",        "O",$var);
$var = ereg_replace("[�����]",       "o",$var);
$var = ereg_replace("[���]",         "U",$var);
$var = ereg_replace("[���]",         "u",$var);
$var = ereg_replace("[*#'�`!$%�]",  " ",$var);
$var = str_replace("\\",             " ",$var);
$var = str_replace(" or ",           " ",$var);
$var = str_replace("select ",        " ",$var);
$var = str_replace("delete ",        " ",$var);
$var = str_replace("create ",        " ",$var);
$var = str_replace("drop ",          " ",$var);
$var = str_replace("update ",        " ",$var);
$var = str_replace("drop table",     " ",$var);
$var = str_replace("show table",     " ",$var);
$var = str_replace("applet",         " ",$var);
$var = str_replace("objetc",         " ",$var);
$var = str_replace("where",          " ",$var);

return($var);
}

?>