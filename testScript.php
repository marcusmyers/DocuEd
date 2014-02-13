<?php

$in = $argv[1];

function removeAnomalies($txt)
{

    $str1 = "I\/I";
    $str2 = "l\/l";
    $str3 = "l\/I";

    $string = str_replace($str1, "M", $txt);
    $string = str_replace($str2, "M", $string);
    $string = str_replace($str3, "M", $string);

    return $string;
}

$temp = explode(".", $in);

$dir = $temp[0];

if(!file_exists($dir)){
   mkdir("./".$dir);
}

shell_exec('pdftk '.$in.' burst output '.$dir.'/'.$dir.'_%02d.pdf');

$pdfs = scandir("./".$dir);

foreach($pdfs as $key=>$value){
    if($value != "." || $value != ".."){
	$tempFile = explode(".", $value);
	shell_exec('gs -dNOPAUSE -sDEVICE=tiffg4 -r600x600 -dBATCH -sPAPERSIZE=letter -sOutputFile=./'.$dir.'/'.$tempFile[0].'.tif ./'.$dir.'/'.$value);
    }
}

shell_exec('rm ./'.$dir.'/*.pdf');

$tiffs = scandir("./".$dir);

foreach($tiffs as $key=>$value){
    if($value != "." || $value != ".." || $value != "./".$dir."/." || $value != "./".$dir."/.."){
	$tempFile = explode(".", $value);
	shell_exec('tesseract ./'.$dir.'/'.$value.' ./'.$dir.'/'.$tempFile[0].' -l eng');
    }
}

mkdir("./".$dir."/tiffs");

shell_exec('mv ./'.$dir.'/*.tif ./'.$dir.'/tiffs');

$txt = scandir("./".$dir);

foreach($txt as $key=>$value){
    if($value != "." || $value != ".." || $value != "tiffs"){
	$tempFile = explode(".", $value);
	$data = file_get_contents("./".$dir."/".$value);
	$convert = explode("\n",$data);
	$pos = strpos("Parents",$convert[7]);
	if($pos === false ){
	    $newFileName = str_replace(" ","_",strtoupper(removeAnomalies($convert[7])));
	} else {
	    $newFileName = str_replace(" ","_",strtoupper(removeAnomalies($convert[8])));
	}
	shell_exec('mv ./'.$dir.'/tiffs/'.$tempFile[0].'.tif ./'.$dir.'/'.$newFileName.'.tif');
    }
}

mkdir("./".$dir."/txts");

shell_exec('mv ./'.$dir.'/*.txt ./'.$dir.'/txts');
