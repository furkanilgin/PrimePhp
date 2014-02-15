<?php

class Button{

	public $id;
	public $name;
	public $text;
	public $property;
	public $action;
	
	public function getHtml(){
		
		$html .= '<button id="'.$this->id.'" name="'.$this->name.'" type="button">'.$this->text.'</button>';

		return $html;
	}
	
	public function getJS(){
	
		$js .= "$('#".$this->id."').puibutton({click:function(event){";
		$js .= "$('form').append('<input id=\"action\" name=\"action\" type=\"hidden\" value=\"".$this->action."\"  />');";
		$js .= "$('form').submit();";
		$js .= "$('#action').remove();";
		$js .= "}});";
		
		return $js;
	}
}