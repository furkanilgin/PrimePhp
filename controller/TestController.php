<?php

class TestController{

	public $test;

	public function load(){

		$this->test->city_Dropdown->items = array("1" => "city1", "2" => "city2", "3" => "city3");
		$this->test->state_Dropdown->items = array("1" => "state1", "2" => "state2", "3" => "state3");
		//$this->test->save_Button->text = "Kaydet";
		if(empty($_POST)){
			$this->test->txt_Inputtext->text = "deneme";
		}
	}
	
	public function basicChangeEvent(){
		$this->test->txt_Inputtext->text = "basic";
		//echo "basicChangeEvent works";
	}
	
	public function basic2ChangeEvent(){
	
		//echo "basic2ChangeEvent works";
	}
	
	public function save(){
		$this->test->txt_Inputtext->text = "Saved";
		//echo $this->test->txt_Inputtext->text;
		//echo "Saved";
	}
}