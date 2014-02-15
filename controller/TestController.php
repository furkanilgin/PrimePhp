<?php

class TestController{

	public $test;

	public function load(){
	
		$this->test->city->items = array("1" => "city1", "2" => "city2", "3" => "city3");
		$this->test->state->items = array("1" => "state1", "2" => "state2", "3" => "state3");
	}
	
	public function basicChangeEvent(){
	
		echo "basicChangeEvent works";
	}
	
	public function basic2ChangeEvent(){
	
		echo "basic2ChangeEvent works";
	}
}