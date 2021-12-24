<?php
class CreateStack {
	public $top;
	public $stack = array();

	function __construct() {
		$this->top = -1;
	}

	// create a function to check whether 
	// the stack is empty or not  
	public function isEmpty() {
		if($this->top == -1) {
			return true;
		} 
		return false;
	}

	//create a function to return size of the stack 
	public function size() { 
		return $this->top+1;
	}

	//create a function to add new element 
	public function push($x) {
		$this->stack[++$this->top] = $x;
	}

	//create a function to delete top element   
	public function pop() {
		if($this->top < 0){
			return false;
		} else {
			$x = $this->stack[$this->top--];
		}    
	}

	public function topElement() {
		if($this->top < 0) {
			return false;
		} else {
			return $this->stack[$this->top];
		}
	}
}

function part1($ukazi,$lookup){
	$stack = new CreateStack();
	$pojavitve = array();
	foreach($ukazi as $ukaz){
		for($i = 0;$i < count($ukaz);$i++){
			if($ukaz[$i] == '(' || $ukaz[$i] == '[' || $ukaz[$i] == '{' || $ukaz[$i] == '<'){
				$stack->push($ukaz[$i]);
			}
			else if($ukaz[$i] == ')'){
				$element = $stack->topElement();
				if($element != '('){
					if(isset($pojavitve[')'])){
						$pojavitve[')'] += 1;
					}
					else{
						$pojavitve[')'] = 1;
					}
					break;
				} 
				else {
					$stack->pop();
				}
			}
			else if($ukaz[$i] == ']'){
				$element = $stack->topElement();
				if($element != '['){
					if(isset($pojavitve[']'])){
						$pojavitve[']'] += 1;
					}
					else{
						$pojavitve[']'] = 1;
					}
					break;
				}
				else {
					$stack->pop();
				}
			}
			else if($ukaz[$i] == '}'){
				$element = $stack->topElement();
				if($element != '{'){
					if(isset($pojavitve['}'])){
						$pojavitve['}'] += 1;
					}
					else{
						$pojavitve['}'] = 1;
					}
					break;
				}
				else {
					$stack->pop();
				}
			}
			else if($ukaz[$i] == '>'){
				$element = $stack->topElement();
				if($element != '<'){
					if(isset($pojavitve['>'])){
						$pojavitve['>'] += 1;
					}
					else{
						$pojavitve['>'] = 1;
					}
					break;
				}
				else {
					$stack->pop();
				}
			}
		}
	}
	$vsota = 0;
	foreach($pojavitve as $kljuc => $vred){
		$vsota += $vred * $lookup[$kljuc];
	}
	return $vsota;
}

function part2($ukazi,$lookup){
	$stack = new CreateStack();
	$pojavitve = array();
	// deleting the wrong commands
	for($i = 0;$i < count($ukazi);$i++){
		for($j = 0;$j < count($ukazi[$i]);$j++){
			if($ukazi[$i][$j] == '(' || $ukazi[$i][$j] == '[' || $ukazi[$i][$j] == '{' || $ukazi[$i][$j] == '<'){
				$stack->push($ukazi[$i][$j]);
			}
			else if($ukazi[$i][$j] == ')'){
				$element = $stack->topElement();
				$stack->pop();
				if($element != '('){
					array_splice($ukazi,$i,1);
					$i--;
					break;
				} 
			}
			else if($ukazi[$i][$j] == ']'){
				$element = $stack->topElement();
				$stack->pop();
				if($element != '['){
					array_splice($ukazi,$i,1);
					$i--;
					break;
				}
			}
			else if($ukazi[$i][$j] == '}'){
				$element = $stack->topElement();
				$stack->pop();
				if($element != '{'){
					array_splice($ukazi,$i,1);
					$i--;
					break;
				}
			}
			else if($ukazi[$i][$j] == '>'){
				$element = $stack->topElement();
				$stack->pop();
				if($element != '<'){
					array_splice($ukazi,$i,1);
					$i--;
					break;
				}
			}
		}
	}
	// commpleting the unfinished commands
	$vsote = array();
	for($i = 0;$i < count($ukazi);$i++){
		$stack = new CreateStack();
		$vsota = 0;
		for($j = 0;$j < count($ukazi[$i]);$j++){
			if($ukazi[$i][$j] == '(' || $ukazi[$i][$j] == '[' || $ukazi[$i][$j] == '{' || $ukazi[$i][$j] == '<'){
				$stack->push($ukazi[$i][$j]);
			}
			else if($ukazi[$i][$j] == ')'){
				$element = $stack->topElement();
				if($element == "("){
					$stack->pop();
				}
			}
			else if($ukazi[$i][$j] == ']'){
				$element = $stack->topElement();
				if($element == "["){
					$stack->pop();
				}
			}
			else if($ukazi[$i][$j] == '}'){
				$element = $stack->topElement();
				if($element == "{"){
					$stack->pop();
				}
			}
			else if($ukazi[$i][$j] == '>'){
				$element = $stack->topElement();
				if($element == "<"){
					$stack->pop();
				}
			}			
		}
		while(!$stack->isEmpty()){
			$element = $stack->topElement();
			$vsota = $vsota * 5 + $lookup[$element];
			$stack->pop();
		}
		array_push($vsote,$vsota);
	}
	sort($vsote);
	$index = floor(count($vsote)/2);
	return $vsote[$index];
}

$lines = explode("\n",file_get_contents("input_day10.txt"));
$ukazi = array();
foreach($lines as $line){
	$line = trim($line);
	$vrstica = str_split($line);
	array_push($ukazi,$vrstica);
}
$lookup = array();
$lookup[')'] = 3;
$lookup[']'] = 57;
$lookup['}'] = 1197;
$lookup['>'] = 25137;

$lookup1 = array();
$lookup1['('] = 1;
$lookup1['['] = 2;
$lookup1['{'] = 3;
$lookup1['<'] = 4;

echo "Part 1 resitev je: ".part1($ukazi,$lookup)."\n";
echo "Part 2 resitev je: ".part2($ukazi,$lookup1)."\n";

?>