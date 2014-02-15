<?php

class Dropdown{

	public $id;
	public $name;
	public $property;
	
	public function getHtml(){
	
		$html.= '<select id="'.$this->id.'" name="'.$this->name.'">';
		if(is_array($this->property)){
			foreach($this->property as $key => $value){
				$html.= '<option value="'.$key.'">'.$value.'</option>';
			}
		}
		else{
			throw new Exception("Property must be array");
		}
		$html.= '</select>';
		
		return $html;
	}
}