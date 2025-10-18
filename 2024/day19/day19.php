<?php

// function for initialization and construction of the grid from input file
function init($file,&$patterns,&$wants){
	$lines = file($file);
	$phase = 0;
	foreach($lines as $line) {
		$line = trim($line);
		if($line == ""){
			$phase = 1;
			continue;
		}
		if($phase == 0){
			$line = explode(",",$line);
			foreach($line as $l){
				array_push($patterns,trim($l));
			}
		}
		if($phase == 1){
			array_push($wants,$line);
		}
	}
}



$patterns = array();
$wants = array();

function part1(){

}


function part2(){
	
}


init('day19_sample_input.txt',$patterns,$wants);
var_dump($patterns);
var_dump($wants);

$srt = microtime(true);
echo "The checksum is: ".part1()."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

$srt = microtime(true);
echo "The checksum is: ".part2()."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

?>