<?php

function init($file, &$grid) {
    $lines = file($file);

    foreach ($lines as $line) {
        $line = trim($line);
        $line = str_split($line);
		array_push($grid,$line);
        
    }
}


function part1($grid) {
for($i = 0;$i < count($grid);$i++){
	for($j = 0;$j < count($grid[$i]);$j++){
		if($grid[$i][$j] == "S"){
			$start = "$i:$j";
		}
		if($grid[$i][$j] == "E"){
			$end = "$i:$j";
		}
	}
}
echo "$start $end \n";
}

function part2(){

}

$grid = array();
$start = "";
$end = "";
init('day20_sample_input.txt', $grid);

$valid = [];
$srt = microtime(true);
echo "The checksum is: " . part1($grid) . "\n";
echo (microtime(true) - $srt) . " seconds\n";

$srt = microtime(true);
echo "The checksum is: " . part2() . "\n";
echo (microtime(true) - $srt) . " seconds\n";

?>