<?php
require_once("./components/Dropdown.php");

class Framework{

	public function findRequestedPageConfiguration($page){
	
		$confStr = file_get_contents("../../conf/page-configuration.xml");
		$root = simplexml_load_string($confStr);

		$pageDefinitionCount = 0;
		foreach($root as $pageNode){
			if($pageNode["name"] == $page){
				if($pageDefinitionCount > 0){
					throw new Exception('There must be only one page definition with same name in page-configuration.xml');
				}
				$requestedPageConfiguration = $pageNode;
				$pageDefinitionCount++;
			}
		}
		
		return $requestedPageConfiguration;
	}
	
	public function convertXmlToComponentArray($requestedPageConfiguration){
		
		$xmlStr = file_get_contents("../../view/".$requestedPageConfiguration["view"]);
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
		
		return $componentArray;
	}
	
	public function createControllerObject($requestedPageConfiguration){

		require_once("../../model/".$requestedPageConfiguration["model"]); // import model
		require_once("../../controller/".$requestedPageConfiguration["controller"]);
		$controllerClassName = str_replace(".php", "", $requestedPageConfiguration["controller"]);
		$controller = new $controllerClassName;
		
		return $controller; 
	}
	
	public function setPropertyValuesFromModelToComponentArray($componentArray, $controller){
	
		foreach($componentArray as $component){ 
			$tmp_val = str_replace("#{", "", $component->property);
			$tmp_val = str_replace("}", "", $tmp_val, $component->property);
			$assignment = '$actualValue = $controller->'.$tmp_val.';';
			eval($assignment);
			$component->property = $actualValue;
		}
		
		return $componentArray;
	}
	
	public function renderHtml($componentArray){
		
		/** Convert to html */
		$html = '';
		foreach($componentArray as $component){ 
			$html .= $component->getHtml();
		}

		return $html;
	}
	
	public function renderJS($componentArray){
	
		$jsHeader = file_get_contents('./js/scriptHeader.js');
		$jsFooter = file_get_contents('./js/scriptFooter.js');
		
		foreach($componentArray as $component){
			if(get_class($component) == "Dropdown"){
				$jsContent .= "$('#".$component->id."').puidropdown();";
			}
		}
		
		return $jsHeader.$jsContent.$jsFooter;
	}
}
