<?php
function part1($polje){

}

function part2($polje){

}


$lines = explode("\n",file_get_contents("input_day9.txt"));
$polje = array();
foreach($lines as $line){
	$line = trim($line);
	$vrstica = array_map('intval',str_split($line));
	array_push($polje,$vrstica);
}
//var_dump($polje);
echo "Part 1 resitev je: ".part1($polje)."\n";
echo "Part 2 resitev je: ".part2($polje)."\n";

?>