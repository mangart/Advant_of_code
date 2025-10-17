<?php

function init($file, &$regs, &$prog){
    $lines = file($file);
    $phase = 0;
    foreach($lines as $line) {
        $line = trim($line);
        if($line == ""){
            $phase = 1;
            continue;
        }
        if($phase == 0){
            $reg = explode(":", $line);
            array_push($regs, intval(trim($reg[1])));
        } else {
            $pro = explode(":", $line);
            $pro = trim($pro[1]);
            $prog = array_map("intval", explode(",", $pro));
        }
    }
}

function getComboValue($value, $regA, $regB, $regC){
    if($value >= 0 && $value <= 3) return $value;
    if($value == 4) return $regA;
    if($value == 5) return $regB;
    if($value == 6) return $regC;
    return false;
}

function doMove($opt, $operand, &$regA, &$regB, &$regC, &$ptr, &$output){
    if($opt == 0){
        $operand = getComboValue($operand, $regA, $regB, $regC);
        $regA = intdiv($regA, pow(2, $operand));
    } else if($opt == 1){
        $regB = $operand ^ $regB;
    } else if($opt == 2){
        $operand = getComboValue($operand, $regA, $regB, $regC);
        $regB = $operand % 8;
    } else if($opt == 3){
        if($regA != 0){
            $ptr = $operand;
            return false;
        }
    } else if($opt == 4){
        $regB = $regB ^ $regC;
    } else if($opt == 5){
        $operand = getComboValue($operand, $regA, $regB, $regC);
        $output[] = $operand % 8;
    } else if($opt == 6){
        $operand = getComboValue($operand, $regA, $regB, $regC);
        $regB = intdiv($regA, pow(2, $operand));
    } else if($opt == 7){
        $operand = getComboValue($operand, $regA, $regB, $regC);
        $regC = intdiv($regA, pow(2, $operand));
    }
    return true;
}

function part1($regA, $regB, $regC, $prog){
    $ptr = 0;
    $output = [];
    $length = count($prog);
    while($ptr < $length){
        $opt = $prog[$ptr];
        $operand = $prog[$ptr + 1];
        $inc = doMove($opt, $operand, $regA, $regB, $regC, $ptr, $output);
        if($inc){
            $ptr += 2;
        }
    }
    $outStr = implode(",", $output);
    echo $outStr . "\n";
    return $outStr;
}

function part2($regs, $prog){
    // not yet implemented
}

$regs = [];
$prog = [];
init('day17_input.txt', $regs, $prog);

$srt = microtime(true);
echo "The checksum is: " . part1($regs[0], $regs[1], $regs[2], $prog) . "\n";
echo (microtime(true) - $srt) . " seconds\n";

?>