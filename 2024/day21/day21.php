<?php

function init($file, &$codes) {
    $lines = file($file);

    foreach ($lines as $line) {
        $line = trim($line);
		array_push($codes,$line);
    }
}


function getSequence($whereToI,$whereToJ,$currI,$currJ,$gapI,$gapJ,&$sequences,$sequence){
	if($currI == $whereToI && $whereToJ == $currJ){
		array_push($sequences,$sequence."A");
		return true;
	}
	if($currI == $gapI && $currJ == $gapJ){
		return false;
	}
	if($currI != $whereToI){
		if($whereToI > $currI){
			getSequence($whereToI,$whereToJ,$currI+1,$currJ,$gapI,$gapJ,$sequences,$sequence."V");
		} else {
			getSequence($whereToI,$whereToJ,$currI-1,$currJ,$gapI,$gapJ,$sequences,$sequence."^");
		}
	}
	if($currJ != $whereToJ){
		if($whereToJ > $currJ){
			getSequence($whereToI,$whereToJ,$currI,$currJ+1,$gapI,$gapJ,$sequences,$sequence.">");
		} else {
			getSequence($whereToI,$whereToJ,$currI,$currJ-1,$gapI,$gapJ,$sequences,$sequence."<");
		}
	}
	return false;
}

function createGlobalSequences($globalSequences,$sequences){
	$newSequences = array();
	if(count($globalSequences) < 1){
		return $sequences;
	}
	
	foreach($globalSequences as $globSeq){
		foreach($sequences as $seq){
			array_push($newSequences,$globSeq.$seq);
		}
	}
	return $newSequences;
}

function part1($codes,$numerical,$directional) {
	// gap index mapping for the numerical and directional keypad
	$numGap = 30;
	$dirGap = 0;
	// current position on the numerical and directional keypad
	$numCurr = 32;
	$dirCurr = 2;
	$gapI = intdiv($numGap,10);
	$gapJ = $numGap % 10;
	foreach($codes as $code){
		$globalSequences = array();
		echo "Koda $code \n";
		$currI = intdiv($numCurr,10);
		$currJ = $numCurr % 10;
		$len = strlen($code);
		
		for($i = 0;$i < $len;$i++){
			$sequences = array();
			$current = $code[$i];
			$whereTo = $numerical[$current];
			$whereToI = intdiv($whereTo,10);
			$whereToJ = $whereTo % 10;
			getSequence($whereToI,$whereToJ,$currI,$currJ,$gapI,$gapJ,$sequences,"");
			$currI = $whereToI;
			$currJ = $whereToJ;
			//echo "Trenutni znak: $current \n";
			//var_dump($sequences);
			$globalSequences = createGlobalSequences($globalSequences,$sequences);
			$sequences = array();
			
		}
		echo "Sekvence za kodo: $code \n";
		var_dump($globalSequences);
	}
}

function part2($codes){

}

$codes = array();
// numerical keypad mappings
$numerical = array();
// first (or zeroth) row
$numerical[7] = 0;
$numerical[8] = 1;
$numerical[9] = 2;

// second row
$numerical[4] = 10;
$numerical[5] = 11;
$numerical[6] = 12;

// third row
$numerical[1] = 20;
$numerical[2] = 21;
$numerical[3] = 22;

// forth row
$numerical[0] = 31;
$numerical["A"] = 32;

// directional keypad mappings
$directional = array();

// first (or zeroth) row
$directional["^"] = 1;
$directional["A"] = 2;

// second row
$directional["<"] = 10;
$directional["V"] = 11;
$directional[">"] = 12;



init('day21_sample_input.txt',$codes);

var_dump($codes);

$srt = microtime(true);
echo "The checksum is: ".part1($codes,$numerical,$directional)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($codes)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>