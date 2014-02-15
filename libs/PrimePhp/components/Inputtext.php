<?php

class Inputtext{

	public $id;
	public $name;
	public $text;
	public $property;
	
	public function getHtml(){
	
		$html = '<input type="text" id="'.$this->id.'" name="'.$this->name.'" value="'.$this->text.'" />';
		
		return $html;
	}
	
	public function getJS(){
	
		$js .= "$('#".$this->id."').puiinputtext();";
		
		return $js;
	}
}