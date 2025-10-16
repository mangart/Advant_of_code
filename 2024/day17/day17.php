<?php

// function for initialization and construction of the grid from input file
function init($file,&$regs,&$prog){
	$lines = file($file);
	$phase = 0;
	foreach($lines as $line) {
		$line = trim($line);
		if($line == ""){
			$phase = 1;
			continue;
		}
		if($phase == 0){
			$reg = explode(":",$line);
			array_push($regs,intval($reg[1]));
		} else {
			$pro = explode(":",$line);
			$pro = $pro[1];
			$prog = array_map("intval",explode(",",$pro));
		}
		$line = str_split($line);
		//array_push($grid,$line);
	}
}






function part1($regs,$prog){
	var_dump($regs);
	var_dump($prog);
}


function part2($regs,$prog){
	
}




$regs = array();
$prog = array();

init('day17_input.txt',$regs,$prog);


$srt = microtime(true);
echo "The checksum is: ".part1($regs,$prog)."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

$srt = microtime(true);
echo "The checksum is: ".part2($regs,$prog)."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

?>