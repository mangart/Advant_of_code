<?php
function preveri_okolico($grid,$i,$j){
	if((isset($grid[$i-1][$j-1]) 
		&& !is_numeric($grid[$i-1][$j-1]) 
	&& $grid[$i-1][$j-1] != '.') || 
	(isset($grid[$i-1][$j]) && !is_numeric($grid[$i-1][$j]) && $grid[$i-1][$j] != '.') || 
	(isset($grid[$i-1][$j+1]) && !is_numeric($grid[$i-1][$j+1]) && $grid[$i-1][$j+1] != '.') || 
	(isset($grid[$i][$j-1]) && !is_numeric($grid[$i][$j-1]) && $grid[$i][$j-1] != '.') || 
	(isset($grid[$i][$j+1]) && !is_numeric($grid[$i][$j+1]) && $grid[$i][$j+1] != '.') || 
	(isset($grid[$i+1][$j-1]) && !is_numeric($grid[$i+1][$j-1]) && $grid[$i+1][$j-1] != '.') || 
	(isset($grid[$i+1][$j]) && !is_numeric($grid[$i+1][$j]) && $grid[$i+1][$j] != '.') || 
	(isset($grid[$i+1][$j+1]) && !is_numeric($grid[$i+1][$j+1]) && $grid[$i+1][$j+1] != '.')){
		return true;
	}
	return false;
}
/*
Function for finding the starting indeks of a number in a row
$row -> a row on the grid
$j -> the index from where we start to find the start of the number
returns: the starting iindex of the number
*/
function find_start($row,$j){
	for($k = $j;$k >= 0 && isset($row[$k]) && is_numeric($row[$k]);$k--){
							
	}
	return $k+1;
}

/*
Function for getting a single number
$row -> a row on the grid
$start -> a variable that holds the index that represents the start of the number
$end -> a variable where the index of the cell that is next to the last digit of the number is stored
returns: the number
*/

function get_number($row,$j,&$end){
	$number = 0;
	$start = find_start($row,$j);
	for($k = $start;isset($row[$k]) && is_numeric($row[$k]);$k++){
		$number = $number * 10 + (int)$row[$k];
	}
	$end = $k;
	return $number;
}

// function to handle upper left corner position (3 positions to check: right, down, right-down)
/*
neighbours: 
- i, j+1
- i+1, j
- i+1,j+1

x----
-----
-----
*/
function handle_upper_left_corner($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	//right neighbour
	if(is_numeric($grid[$i][$j+1])){
		$stevilka = get_number($grid[$i],$j,$end);
		array_push($stevila,$stevilka);
	}
	// bottom middle neighbour
	if(is_numeric($grid[$i+1][$j])){
		$stevilka = get_number($grid[$i+1],$j,$end);
		array_push($stevila,$stevilka);
	// bottom right neighbour
	} else if(is_numeric($grid[$i+1][$j+1])){
		$stevilka = get_number($grid[$i+1],$j+1,$end);
		array_push($stevila,$stevilka);						
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}
}

// function to handle upper right corner (3 positions to check: left, down, left-down)
/*
neighbours:
- i, j-1
- i+1,j
-i+1,j-1

----x
-----
-----
*/
function handle_upper_right_corner($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	//left neighbour
	if(is_numeric($grid[$i][$j-1])){
		$stevilka = get_number($grid[$i],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	// bottom middle neighbour
	if(is_numeric($grid[$i+1][$j])){
		$stevilka = get_number($grid[$i+1],$j,$end);
		array_push($stevila,$stevilka);
	// bottom right neighbour
	} else if(is_numeric($grid[$i+1][$j-1])){
		$stevilka = get_number($grid[$i+1],$j-1,$end);
		array_push($stevila,$stevilka);						
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}	
}

// function to handle lower left corner (3 positions to check: right, up, right-up)
/*
neighbours:
- i, j+1
- i-1, j
- i-1, j+1

-----
-----
x----
*/
function handle_lower_left_corner($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	//left neighbour
	if(is_numeric($grid[$i][$j+1])){
		$stevilka = get_number($grid[$i],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	// bottom middle neighbour
	if(is_numeric($grid[$i-1][$j])){
		$stevilka = get_number($grid[$i-1],$j,$end);
		array_push($stevila,$stevilka);
	// bottom right neighbour
	} else if(is_numeric($grid[$i-1][$j+1])){
		$stevilka = get_number($grid[$i-1],$j+1,$end);
		array_push($stevila,$stevilka);						
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}		
}

// function for handling lower right corner (3 positions to check: left, up, left-up)
/*
neighbours:
- i,j-1
- i-1,j
- i-1, j-1

-----
-----
----x
*/
function handle_lower_right_corner($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	//left neighbour
	if(is_numeric($grid[$i][$j-1])){
		$stevilka = get_number($grid[$i],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	// bottom middle neighbour
	if(is_numeric($grid[$i-1][$j])){
		$stevilka = get_number($grid[$i-1],$j,$end);
		array_push($stevila,$stevilka);
	// bottom right neighbour
	} else if(is_numeric($grid[$i-1][$j-1])){
		$stevilka = get_number($grid[$i-1],$j-1,$end);
		array_push($stevila,$stevilka);						
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}		
}

// function for handling upper row (at most 5 positions to check: left, right, down, right-down, left-down)
/*
neighbours:
- i,j-1
- i,j+1
- i+1,j-1
- i+1,j
- i+1,j+1

--x--
-----
-----
*/
function handle_upper_row($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	if(is_numeric($grid[$i][$j-1])){
		$stevilka = get_number($grid[$i],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i][$j+1])){
		$stevilka = get_number($grid[$i],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i+1][$j-1])){
		$stevilka = get_number($grid[$i+1],$j-1,$end);
		array_push($stevila,$stevilka);
		if($end == $j){
			if(is_numeric($grid[$i+1][$j+1])){
				$stevilka = get_number($grid[$i+1],$j+1,$end);
				array_push($stevila,$stevilka);
			}
		}
	} else if(is_numeric($grid[$i+1][$j])){
		$stevilka = get_number($grid[$i+1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i+1][$j+1])){
		$stevilka = get_number($grid[$i+1],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}		
}

// function for handling left column (the first column) (at most 5 positions to check: up, down, right, right-up, right-down)
/*
neighbours:
- i-1,j
- i-1,j+1
- i,j+1
- i+1,j
- i+1,j+1

-----
x----
-----
*/
function handle_left_column($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	if(is_numeric($grid[$i-1][$j])){
		$stevilka = get_number($grid[$i-1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i-1][$j+1])){
		$stevilka = get_number($grid[$i-1],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i][$j+1])){
		$stevilka = get_number($grid[$i],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i+1][$j])){
		$stevilka = get_number($grid[$i+1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i+1][$j+1])){
		$stevilka = get_number($grid[$i+1],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}
}

// function for handling right column (the last column) (at most 5 positions to check: up, down, left, left-up, left-down)
/*
neighbours:
- i-1,j
- i-1,j-1
- i,j-1
- i+1,j
- i+1,j-1

-----
----x
-----
*/
function handle_right_column($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	if(is_numeric($grid[$i-1][$j])){
		$stevilka = get_number($grid[$i-1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i-1][$j-1])){
		$stevilka = get_number($grid[$i-1],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i][$j-1])){
		$stevilka = get_number($grid[$i],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i+1][$j])){
		$stevilka = get_number($grid[$i+1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i+1][$j-1])){
		$stevilka = get_number($grid[$i+1],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}	
}

// function for handling lower row (the last row) (at most 5 positions to check: left, right, up, left-up, right-up)
/*
neighbours:
- i,j-1
- i,j+1
- i-1,j-1    
- i-1,j
- i-1,j+1

-----
-----
--x--
*/
function handle_lower_row($grid,$i,$j,$ZaSestet){
	$stevila = array();
	$end = -1;
	if(is_numeric($grid[$i][$j-1])){
		$stevilka = get_number($grid[$i],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i][$j+1])){
		$stevilka = get_number($grid[$i],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i-1][$j-1])){
		$stevilka = get_number($grid[$i-1],$j-1,$end);
		array_push($stevila,$stevilka);
		if($end == $j){
			if(is_numeric($grid[$i-1][$j+1])){
				$stevilka = get_number($grid[$i-1],$j+1,$end);
				array_push($stevila,$stevilka);
			}
		}
	} else if(is_numeric($grid[$i-1][$j])){
		$stevilka = get_number($grid[$i-1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i-1][$j+1])){
		$stevilka = get_number($grid[$i-1],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}	
}

// function for handling the middle of the grid (all 8 positions to check: left, left-up, left-down, up, down, right-up, right, right-down)
/*
neighbours:
- i-1,j-1
- i-1,j
- i-1,j+1
- i,j-1
- i,j+1
- i+1,j-1
- i+1,j
- i+1,j+1

-----
--x--
-----
*/
function handle_middle($grid,$i,$j,&$ZaSestet){
	$stevila = array();
	$end = -1;
	// * row
	if(is_numeric($grid[$i][$j-1])){
		$stevilka = get_number($grid[$i],$j-1,$end);
		array_push($stevila,$stevilka);
	}
	if(is_numeric($grid[$i][$j+1])){
		$stevilka = get_number($grid[$i],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	// lower row
	if(is_numeric($grid[$i+1][$j-1])){
		$stevilka = get_number($grid[$i+1],$j-1,$end);
		array_push($stevila,$stevilka);
		if($end == $j){
			if(is_numeric($grid[$i+1][$j+1])){
				$stevilka = get_number($grid[$i+1],$j+1,$end);
				array_push($stevila,$stevilka);
			}
		}
	} else if(is_numeric($grid[$i+1][$j])){
		$stevilka = get_number($grid[$i+1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i+1][$j+1])){
		$stevilka = get_number($grid[$i+1],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	//upper row
	if(is_numeric($grid[$i-1][$j-1])){
		$stevilka = get_number($grid[$i-1],$j-1,$end);
		array_push($stevila,$stevilka);
		if($end == $j){
			if(is_numeric($grid[$i-1][$j+1])){
				$stevilka = get_number($grid[$i-1],$j+1,$end);
				array_push($stevila,$stevilka);
			}
		}
	} else if(is_numeric($grid[$i-1][$j])){
		$stevilka = get_number($grid[$i-1],$j,$end);
		array_push($stevila,$stevilka);
	} else if(is_numeric($grid[$i-1][$j+1])){
		$stevilka = get_number($grid[$i-1],$j+1,$end);
		array_push($stevila,$stevilka);
	}
	
	if(count($stevila) == 2){
		array_push($ZaSestet,$stevila[0]*$stevila[1]);
	}
}  


function part1($file){
	$lines = file($file);
	$vsota = 0;
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		array_push($grid,$line);
	}
	//var_dump($grid);
	$stevilka = 0;
	$v_procesu = false;
	$je_v_redu = false;
	$stevilke = array();
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < strlen($grid[$i]);$j++){
			if(!$v_procesu){
				if(is_numeric($grid[$i][$j])){
					$v_procesu = true;
				}
			}
			if($v_procesu){
				if(is_numeric($grid[$i][$j])){
					$stevilka = $stevilka * 10 + (int)$grid[$i][$j];
					 $v = preveri_okolico($grid,$i,$j);
					 if($v){
						 $je_v_redu = true;
					 }
				} else {
					if($je_v_redu){
						array_push($stevilke,$stevilka);
					}
					$stevilka = 0;
					$je_v_redu = false;
					$v_procesu = false;
				}
			}
		}
	}
	//var_dump($stevilke);
	foreach($stevilke as $stev){
		$vsota += $stev;
	}
	echo "Part1 resitev je: ".$vsota."\n";
}

function part2($file){
	$lines = file($file);
	$vsota = 0;
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		array_push($grid,$line);
	}
	//var_dump($grid);
	$stevilka = 0;
	$v_procesu = false;
	$je_v_redu = false;
	$stevilke = array();
	$ZaSestet = array();
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < strlen($grid[$i]);$j++){
			if($grid[$i][$j] == '*'){
				//echo "Vrstica: ".$i." Stolpec: ".$j."\n";
				// upper left corner
				if($i == 0 && $j == 0){
					handle_upper_left_corner($grid,$i,$j,$ZaSestet);
				// upper right corner
				} else if($i == 0 && $j == (strlen($grid[$i] - 1))){
					handle_upper_right_corner($grid,$i,$j,$ZaSestet);
				// lower left corner 
				} else if($i == (count($grid) - 1) && $j == 0){
					handle_lower_left_corner($grid,$i,$j,$ZaSestet);
				// lower right corner
				} else if($i == (count($grid) - 1) && $j == (strlen($grid[$i]) - 1)){
					handle_lower_right_corner($grid,$i,$j,$ZaSestet);
				// anywhere on the top row
				} else if($i == 0){
					handle_upper_row($grid,$i,$j,$ZaSestet);
				// anywhere on the first (left) column
				} else if($j == 0){
					handle_left_column($grid,$i,$j,$ZaSestet);
				// anywhere on the bottom row
				} else if($i == (count($grid) - 1)){
					handle_lower_row($grid,$i,$j,$ZaSestet);
				// anywhere on the last (right) column
				} else if($j == (strlen($grid[$i]) - 1)){
					handle_right_column($grid,$i,$j,$ZaSestet);
				// anywhere in the middle
				} else {
					handle_middle($grid,$i,$j,$ZaSestet);
				}
			}
		}
	}
	echo "Part2 resitev je: ".array_sum($ZaSestet)."\n";
}

part1('day3_input.txt');
part2('day3_input.txt');
?>

