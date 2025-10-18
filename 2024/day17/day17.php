<?php

// function for initialization and construction of the grid from input file
function init($file,&$regs,&$prog,&$proStr){
	$lines = file($file);
	$phase = 0;
	foreach($lines as $line) {
		$line = trim($line);
		if($line == ""){
			$phase = 1;
			continue;
		}
		if($phase == 0){
			$reg = explode(":",$line);
			array_push($regs,intval(trim($reg[1])));
		} else {
			$pro = explode(":",$line);
			$pro = trim($pro[1]);
			$proStr = $pro;
			$prog = array_map("intval",explode(",",$pro));
		}
		$line = str_split($line);
		//array_push($grid,$line);
	}
}


function getComboValue($value,$regA,$regB,$regC){
	if($value >= 0 && $value <= 3){
		return $value;
	} else if($value == 4){
		return $regA;
	} else if($value == 5){
		return $regB;
	} else if($value == 6){
		return $regC;
	}
	return false;
}


function doMove($opt,$operand,&$regA,&$regB,&$regC,&$ptr,&$out){
	if($opt == 0){
		$operand = getComboValue($operand,$regA,$regB,$regC);
		$regA = intdiv($regA,pow(2,$operand));
	} else if($opt == 1){
		$regB = $operand ^ $regB;
	} else if($opt == 2){
		$operand = getComboValue($operand,$regA,$regB,$regC);
		$regB = $operand % 8;
	} else if($opt == 3){
		if($regA != 0){
			$ptr = $operand;
			return false;
		}
	} else if($opt == 4){
		$regB = $regB ^ $regC;
	} else if($opt == 5){
		$operand = getComboValue($operand,$regA,$regB,$regC);
		$operand = $operand % 8;
		array_push($out,$operand);
	} else if($opt == 6){
		$operand = getComboValue($operand,$regA,$regB,$regC);
		$regB = intdiv($regA,pow(2,$operand));
	} else if($opt == 7){
		$operand = getComboValue($operand,$regA,$regB,$regC);
		$regC = intdiv($regA,pow(2,$operand));
	}
	return true;
}


function part1($regA,$regB,$regC,$prog){
	$ptr = 0;
	$out = array();
	$length = count($prog);
	while($ptr < $length){
		$opt = $prog[$ptr];
		$operand = $prog[$ptr+1];
		$inc = doMove($opt,$operand,$regA,$regB,$regC,$ptr,$out);
		if($inc){
			$ptr += 2;
		}
	}
	echo "\n";
	return implode(",",$out);
}

function loop($regA,$regB,$regC,$prog){
	$ptr = 0;
	$out = array();
	$length = count($prog);
	while($ptr < $length){
		$opt = $prog[$ptr];
		$operand = $prog[$ptr+1];
		$inc = doMove($opt,$operand,$regA,$regB,$regC,$ptr,$out);
		if($inc){
			$ptr += 2;
		}
	}
	return $out;
}

function getSmallest($regA,$regB,$regC,$prog,$itr,&$nums){
	if($itr == count($prog)){
		array_push($nums,intdiv($regA,8));
		return true;
	}
	for($i = 0;$i < 8;$i++){
		$curnum = $regA + $i;
		$out = loop($curnum,$regB,$regC,$prog);
		if($out[0] == $prog[count($prog) - $itr - 1]){
			getSmallest($curnum * 8,$regB,$regC,$prog,$itr + 1,$nums);
		}
	}
}

function part2($regA,$regB,$regC,$prog){
		$nums = array();
		getSmallest(0,$regB,$regC,$prog,0,$nums);
		return min($nums);
}




$regs = array();
$prog = array();
$proStr = "";
init('day17_input.txt',$regs,$prog,$proStr);


$srt = microtime(true);
echo "The checksum is: ".part1($regs[0],$regs[1],$regs[2],$prog)."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

$srt = microtime(true);
echo "The checksum is: ".part2($regs[0],$regs[1],$regs[2],$prog)."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

?>