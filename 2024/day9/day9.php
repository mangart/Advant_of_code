<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$disk = array();
	foreach($lines as $line) {
		$line = trim($line);
		$disk = str_split($line);
	}
	return $disk;	
}

function izpisi_tabelo($disk){
	for($i = 0;$i < count($disk);$i++){
		if($disk[$i] != "."){
			echo "|$disk[$i]|";
		} else {
			echo "$disk[$i]";
		}
	}
	echo "\n";
}
function part1($disk){
	$array_disk = array();
	$id = 0;
	for($i = 0;$i < count($disk);$i++){
		if($i % 2  == 0){
			$array1 = array_fill(0,$disk[$i],$id);
			$array_disk = array_merge($array_disk,$array1);
			$id += 1;
		} else {
			$array1 = array_fill(0,$disk[$i],".");
			$array_disk = array_merge($array_disk,$array1);
		}
	}

	$front = 0;
	$back = count($array_disk) - 1;
	while($front < $back){
		if($array_disk[$back] == "."){
			$back -= 1;
		}
		if($array_disk[$front] != "."){
			$front += 1;
		}
		if($array_disk[$back] != "." && $array_disk[$front] == "."){
			$array_disk[$front] = $array_disk[$back];
			$array_disk[$back] = ".";
		}
	}

	$vsota = 0;
	for($i = 0;$i < count($array_disk);$i++){
		if($array_disk[$i] == "."){
			break;
		}
		$vsota += $array_disk[$i] * $i;
	}
	return $vsota;
}



function part2($disk){

				
}


$antenas = array();
$start = microtime(true);
$disk = init('day9_input.txt');
echo "The checksum is: ".part1($disk)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2($disk);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>