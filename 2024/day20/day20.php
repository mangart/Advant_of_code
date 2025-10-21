<?php

function init($file, &$grid) {
    $lines = file($file);

    foreach ($lines as $line) {
        $line = trim($line);
        $line = str_split($line);
		array_push($grid,$line);
        
    }
}

function getPath($grid,&$start,&$end,&$path,&$reversePath){
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "S"){
				$start = "$i:$j";
				break;
			}
		}
	}
	$end = false;
	$deli = array_map("intval",explode(":",$start));
	$count = 0;
	$temp = array();
	$temp["i"] = $deli[0];
	$temp["j"] = $deli[1];
	array_push($path,$temp);
	$reversePath[$deli[0]][$deli[1]] = $count;
	$count += 1;
	while(!$end){
		$trenutni = $path[count($path)-1];
		if($grid[$trenutni["i"]][$trenutni["j"]] == "E"){
			$end = true;
			continue;
		}
		if(!isset($reversePath[$trenutni["i"]+1][$trenutni["j"]]) && $grid[$trenutni["i"]+1][$trenutni["j"]] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"] + 1;
			$temp["j"] = $trenutni["j"];
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;
			
		} else if(!isset($reversePath[$trenutni["i"]-1][$trenutni["j"]]) && $grid[$trenutni["i"]-1][$trenutni["j"]] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"] - 1;
			$temp["j"] = $trenutni["j"];
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;			
		} else if(!isset($reversePath[$trenutni["i"]][$trenutni["j"]-1]) && $grid[$trenutni["i"]][$trenutni["j"]-1] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"];
			$temp["j"] = $trenutni["j"] - 1;
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;			
		} else if(!isset($reversePath[$trenutni["i"]][$trenutni["j"]+1]) && $grid[$trenutni["i"]][$trenutni["j"]+1] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"];
			$temp["j"] = $trenutni["j"] + 1;
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;			
		}
		
	}
}



function part1($grid,$start,$end) {
	$path = array();
	$reversePath = array();
	getPath($grid,$start,$end,$path,$reversePath);
	
		
	
}

function part2(){

}

$grid = array();
$start = "";
$end = "";
init('day20_sample_input.txt', $grid);

$valid = [];
$srt = microtime(true);
echo "The checksum is: " . part1($grid,$start,$end) . "\n";
echo (microtime(true) - $srt) . " seconds\n";

$srt = microtime(true);
echo "The checksum is: " . part2() . "\n";
echo (microtime(true) - $srt) . " seconds\n";

?>