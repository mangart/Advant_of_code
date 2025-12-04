<?php

function init($file) {
    $lines = file($file);
	$grid = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
    }
	return $grid;
}

function part1($grid){
	$vsota = 0;
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "@"){
				$counter = 0;
				for($ii = -1;$ii < 2;$ii++){
					for($jj = -1;$jj < 2;$jj++){
						if($ii == 0 && $jj == 0){
							continue;
						} else {
							if(isset($grid[$i+$ii][$j+$jj])){
								if($grid[$i+$ii][$j+$jj] == '@'){
									$counter += 1;
								}
							}
						}
						if($counter > 3){
							break 2;
						}
					}
				}
				if($counter < 4){
					$vsota += 1;
				}
			}
		}
	}
	return $vsota;
}

function part2($grid){
	$vsota = 0;

	return $vsota;
}

$grid = init('day4_input.txt');


$srt = microtime(true);
echo "The checksum for part1 is: ".part1($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum for part2 is: ".part2($grid)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>