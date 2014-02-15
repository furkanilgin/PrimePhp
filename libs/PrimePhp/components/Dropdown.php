<?php

class Dropdown{

	public $id;
	public $name;
	public $property;
	public $change;
	public $items;
	public $selectedItem;
	
	public function getHtml(){

		$html.= '<select id="'.$this->id.'" name="'.$this->name.'">';
		if(is_array($this->items)){
			foreach($this->items as $key => $value){
				$html.= '<option value="'.$key.'"';
				if($this->selectedItem == $key){ 
					$html .= "selected";
				}
				$html .= '>'.$value.'</option>';
			}
		}
		else{
			throw new Exception("Property must be array");
		}
		$html.= '</select>';
		
		return $html;
	}
	
	public function getJS(){
	
		if(!isset($this->change)){
			$js .= "$('#".$this->id."').puidropdown();";
		}
		else{
			$js .= "$('#".$this->id."').puidropdown({change:function(event){";
			$js .= "$('form').append('<input id=\"action\" name=\"action\" type=\"hidden\" value=\"".$this->change."\"  />');";
			$js .= "$('form').submit();";
			$js .= "$('#action').remove();";
			$js .= "}});";
		}
		
		return $js;
	}
}