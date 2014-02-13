<?php

require_once("./libs/components/Dropdown.php");

class XmlToHtmlConverter{

	private $xhtml;

	public static function convert($page){
		
		/** Find xml file path */
		
		$confStr = file_get_contents("./conf/page-configuration.xml");
		$root = simplexml_load_string($confStr);

		$pageDefinitionCount = 0;
		foreach($root as $pageNode){
			if($pageNode["name"] == $page){
				if($pageDefinitionCount > 0){
					throw new Exception('There must be only one page definition with same name in page-configuration.xml');
				}
				$viewFileName = $pageNode["view"];
				$controllerFileName = $pageNode["controller"];
				$pageDefinitionCount++;
			}
		}
		
		/** Find xml tags and assign them to html components */
		
		$xmlStr = file_get_contents("./view/".$viewFileName);
		$root = simplexml_load_string($xmlStr);
		
		foreach($root as $pageNode){ 
			if($pageNode->getName() == "dropdown"){
				$component = new Dropdown();
				$component->id = $pageNode["id"];
				$component->name = $pageNode["name"];
				$component->property = $pageNode["property"];
			}
			$componentArray[] = $component;
		}
		
		/** Call controller's constructor */

		require_once("./controller/".$controllerFileName);
		$controllerClassName = str_replace(".php", "", $controllerFileName);
		$controller = new $controllerClassName;
		
		/** Set values from model to html components */
		
		foreach($componentArray as $component){ 
			$tmp_val = str_replace("#{", "", $component->property);
			$tmp_val = str_replace("}", "", $tmp_val, $component->property);
			$assignment = '$actualValue = $controller->'.$tmp_val.';';
			eval($assignment);
			$component->property = $actualValue;
		}

		
		/** Convert to html */
		$html = '';
		foreach($componentArray as $component){ 
			$html .= $component->getHtml();
		}
		
		return $html;
	}
}
