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

function izpisi_disk($diskArray){
	foreach($diskArray as $da){
		for($i = 0;$i < $da['amount'];$i++){
			if($da['type'] == 'data'){
				echo $da['id'];
			} else {
				echo ".";
			}
		}
	}
	echo "\n";
}

function part2($disk){
	$diskArray = array();
	$id = 0;
	for($i = 0;$i < count($disk);$i++){
		if($i % 2 == 0){
			$element = array();
			$element['type'] = 'data';
			$element['amount'] = $disk[$i];
			$element['id'] = $id;
			array_push($diskArray,$element);
			$id += 1;
		} else {
			$element = array();
			$element['type'] = 'empty';
			$element['amount'] = $disk[$i];
			$element['id'] = -1;
			array_push($diskArray,$element);
		}
	}
	
	
	//izpisi_disk($diskArray);
	
	for($i = count($diskArray) - 1;$i >= 0;$i--){
		if($diskArray[$i]['type'] == 'data'){
			for($j = 0;$j < $i;$j++){
				if($diskArray[$j]['type'] == 'empty'){
					if($diskArray[$i]['amount'] == $diskArray[$j]['amount']){
						$diskArray[$j]['type'] = 'data';
						$diskArray[$j]['id'] = $diskArray[$i]['id'];
						
						$diskArray[$i]['type'] = 'empty';
						$diskArray[$i]['id'] = -1;
						break;
					}
					if($diskArray[$i]['amount'] < $diskArray[$j]['amount']){
						$newElement = array();
						$newElement['type'] = 'empty';
						$newElement['amount'] = $diskArray[$j]['amount'] - $diskArray[$i]['amount'];
						$newElement['id'] = -1;
						$diskArray[$j]['type'] = 'data';
						$diskArray[$j]['amount'] = $diskArray[$i]['amount'];
						$diskArray[$j]['id'] = $diskArray[$i]['id'];
						$diskArray[$i]['type'] = 'empty';
						$diskArray[$i]['id'] = -1;
						array_splice($diskArray,$j+1,0,array($newElement));
						break;
					}
				}
			}
		}
	}
	
	//izpisi_disk($diskArray);
	$vsota = 0;
	$indeks = 0;
	for($i = 0;$i < count($diskArray);$i++){
		if($diskArray[$i]['type'] == 'empty'){
			$indeks += $diskArray[$i]['amount'];
		} else {
			for($j = 0;$j < $diskArray[$i]['amount'];$j++){
				$vsota += $diskArray[$i]['id'] * $indeks;
				$indeks++;
			}
		}
	}
	return $vsota;
	
				
}


$antenas = array();
$start = microtime(true);
$disk = init('day9_input.txt');
echo "The checksum is: ".part1($disk)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
echo "The checksum is: ".part2($disk)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>