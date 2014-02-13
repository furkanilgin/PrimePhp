<?php
require_once("./model/Test.php");

class TestController{

	public $test;

	public function __construct(){
	
		$this->test = new Test();
		$this->test->cities = array("1" => "city1", "2" => "city2", "3" => "city3");
		$this->test->states = array("1" => "state1", "2" => "state2", "3" => "state3");
	}

}