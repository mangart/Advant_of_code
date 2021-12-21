<?php
function part1($vsebina){
	$x = 0;
	$y = 0;
	for($i = 0;$i < count($vsebina);$i++){
		$vrstica = explode(" ",$vsebina[$i]);
		switch ($vrstica[0]) {
			case "forward":
				$x += (int)$vrstica[1];
				break;
			case "down":
				$y += (int)$vrstica[1];
				break;
			case "up":
				$y -= (int)$vrstica[1];
				break;
		}
	}
	return $x * $y;
}

function part2($vsebina){
	$x = 0;
	$y = 0;
	$aim = 0;
	for($i = 0;$i < count($vsebina);$i++){
		$vrstica = explode(" ",$vsebina[$i]);
		switch ($vrstica[0]) {
			case "forward":
				$x += (int)$vrstica[1];
				$y += $aim * (int)$vrstica[1];
				break;
			case "down":
				$aim += (int)$vrstica[1];
				break;
			case "up":
				$aim -= (int)$vrstica[1];
				break;
		}
	}
	return $x * $y;
}

$vsebina = explode("\n",file_get_contents("input_day2.txt"));

echo "Part 1 resitev je: ".part1($vsebina)."\n";
echo "Part 2 resitev je: ".part2($vsebina)."\n";

?>