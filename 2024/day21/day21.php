<?php

function init($file, &$codes) {
    $lines = file($file);

    foreach ($lines as $line) {
        $line = trim($line);
		array_push($codes,$line);
    }
}

function part1($codes) {

}

function part2($codes){

}

$codes = array();

init('day21_sample_input.txt',$codes);

var_dump($codes);

$srt = microtime(true);
echo "The checksum is: ".part1($codes)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($codes)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>