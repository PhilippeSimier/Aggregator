<?php

$str = "Zkouška sirén été Anaïs";



/* Convert UTF-8 to USC-2 */

function strToHex($string){
    $string = mb_convert_encoding($string, "UCS-2", "UTF-8");
	$hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    return strToUpper($hex);
}

echo strToHex($str);

?>