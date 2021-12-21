<?php
// not optimal solution
function part1($ribe,$dni){
	for($i = 0;$i < $dni;$i++){
		simuliraj_dan($ribe);
	}
	return count($ribe);
}

// very space efficient solution
function part2($ribe,$dni){
	$koraki = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0);
	foreach($ribe as $rib){
		if(isset($koraki[$rib])){
			$koraki[$rib] += 1;
		} 
	}
	for($i = 0;$i < $dni;$i++){
		$koraki = simuliraj_dan1($koraki);
	}
	return sestej($koraki);
	
}

function simuliraj_dan1($koraki){
	$koraki1 = array();
	$koraki1[0] = $koraki[1];
	$koraki1[1] = $koraki[2];
	$koraki1[2] = $koraki[3];
	$koraki1[3] = $koraki[4];
	$koraki1[4] = $koraki[5];
	$koraki1[5] = $koraki[6];
	$koraki1[6] = $koraki[7];
	$koraki1[6] += $koraki[0];
	$koraki1[7] = $koraki[8];
	$koraki1[8] = $koraki[0];
	return $koraki1;
}

function simuliraj_dan(&$ribe){
	for($i = 0;$i < count($ribe);$i++){
		if($ribe[$i] < 1){
			$ribe[$i] = 6;
			array_push($ribe,9);
		}
		else {
			$ribe[$i] -= 1;
		}
	}
}

function sestej($koraki){
	$vsota = 0;
	foreach($koraki as $korak){
		$vsota += $korak;
	}
	return $vsota;
}

$ribe = array_map('intval',explode(",",file_get_contents("input_day6.txt")));

echo "Part 1 resitev je: ".part2($ribe,80)."\n";
echo "Part 2 resitev je: ".part2($ribe,256)."\n";

?>