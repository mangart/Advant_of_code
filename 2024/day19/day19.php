<?php

function init($file, &$patterns, &$wants) {
    $lines = file($file);
    $phase = 0;
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line == "") {
            $phase = 1;
            continue;
        }
        if ($phase == 0) {
            $line = explode(",", $line);
            foreach ($line as $l) {
                $patterns[] = trim($l);
            }
        } else {
            $wants[] = $line;
        }
    }
}

// calculate way to construct a design
function makeDesign($patterns,$want,$pos,&$memo) {
    $n = strlen($want);
	// return 1 if we reach the end of the string
    if($pos == $n){
		return 1;
	}
    // if the count for the length is already computed we return it
    if(isset($memo[$pos])){
		return $memo[$pos];
	}
    $count = 0;
    foreach ($patterns as $pattern) {
        $len = strlen($pattern);
        if((($pos + $len) <= $n) && (substr($want, $pos, $len) === $pattern)){
            $count += makeDesign($patterns, $want, $pos + $len, $memo);
        }
    }
    $memo[$pos] = $count;
    return $count;
}

// we compute the valid designes (designes we can construct) and for each of them we also store their count of ways we can make a design (for part 2)
function part1($patterns, $wants, &$valid) {
    foreach ($wants as $want) {
        $memo = [];
        $ways = makeDesign($patterns, $want, 0, $memo);
        if ($ways > 0) {
            $valid[$want] = $ways;
        }
    }
    return count($valid);
}


// since we already have the counts from part 1 we just sum over them
function part2($valid){
	$vsota = 0;
	foreach($valid as $val){
		$vsota += $val;
	}
	return $vsota;
}

$patterns = [];
$wants = [];
init('day19_input.txt', $patterns, $wants);

$valid = [];
$srt = microtime(true);
echo "The checksum is: " . part1($patterns, $wants, $valid) . "\n";
echo (microtime(true) - $srt) . " seconds\n";

$srt = microtime(true);
echo "The checksum is: " . part2($valid) . "\n";
echo (microtime(true) - $srt) . " seconds\n";

?>