<?php

// function for initialization and construction of the grid from input file
function init($file,&$regs,&$prog,&$proStr){
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
			array_push($regs,intval(trim($reg[1])));
		} else {
			$pro = explode(":",$line);
			$pro = trim($pro[1]);
			$proStr = $pro;
			$prog = array_map("intval",explode(",",$pro));
		}
		$line = str_split($line);
		//array_push($grid,$line);
	}
}







function part1($regA,$regB,$regC,$prog){

}


function part2(){
		
}




$regs = array();
$prog = array();
$proStr = "";
init('day18_sample_input.txt',$regs,$prog,$proStr);


$srt = microtime(true);
echo "The checksum is: ".part1()."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

$srt = microtime(true);
echo "The checksum is: ".part2()."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

?>