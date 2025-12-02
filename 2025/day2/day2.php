<?php

function init($file) {
    $lines = file($file);
	$intervals = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$vmes = explode(",",$line);
		foreach($vmes as $v){
			$interval = explode("-",$v);
			$temp = array();
			$temp["begin"] = $interval[0];
			$temp["end"] = $interval[1];
			array_push($intervals,$temp);
		}
    }
	return $intervals;
}




function part1($intervals) {
	$vsota = 0;
	//var_dump($intervals);
	foreach($intervals as $interval){
		if(strlen($interval["begin"]) % 2 == 1 && strlen($interval["end"]) % 2 == 1 && strlen($interval["begin"]) == strlen($interval["end"])){
			continue;
		}
		$beg = intval($interval["begin"]);
		$end = intval($interval["end"]);
		
		for($i = $beg;$i <= $end;$i++){
			$string = strval($i);
			
			$dolzina = strlen($string);
			if($dolzina % 2 == 1){
				continue;
			}
			$sredina = intdiv($dolzina,2);
			$leva = substr($string,0,$sredina);
			$desna = substr($string,$sredina,$sredina);
			if($leva == $desna){
				$vsota += $i;
			}
		}
	}
	return $vsota;

}



function part2($intervals){
	$vsota = 0;
	foreach($intervals as $interval){
		$beg = intval($interval["begin"]);
		$end = intval($interval["end"]);
		for($i = $beg;$i <= $end;$i++){
			$string = strval($i);
			$dolzina = strlen($string);
			for($delcki = 1;$delcki <= $dolzina;$delcki++){
				if ($dolzina % $delcki !== 0) {
					continue; 
				}
				$chunks = str_split($string, $delcki);
				if (count($chunks) < 2){
					continue;
				}
				if(count(array_unique($chunks)) === 1){
					$vsota += $i;
					break;
				}
			}
		}
	}
	return $vsota;
}








$intervals = init('day2_input.txt');




$srt = microtime(true);
echo "The checksum is: ".part1($intervals)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($intervals)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>