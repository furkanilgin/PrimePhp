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
	
	public function checkRequestedPageIsCorrect($requestedPageConfiguration){
		
		if(!isset($requestedPageConfiguration)){
			require_once("./html/404.html");
			exit;
		}
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
				$component->change = $pageNode["change"];
				$component->selectedItem = $_POST[(string)$component->id];
			}
			$componentArray[] = $component;
		}

		return $componentArray;
	}
	
	public function createControllerAndModelObject($requestedPageConfiguration){

		require_once("../../model/".$requestedPageConfiguration["model"]); // import model
		require_once("../../controller/".$requestedPageConfiguration["controller"]);
		$controllerClassName = str_replace(".php", "", $requestedPageConfiguration["controller"]);
		$modelClassName = str_replace(".php", "", $requestedPageConfiguration["model"]);
		$controller = new $controllerClassName;
		$controller->{strtolower($modelClassName)} = new $modelClassName;
		
		return $controller; 
	}
	
	public function setFromComponentArrayToModel($componentArray, $controller){
	
		foreach($componentArray as $component){
			$tmp_val = str_replace("#{", "", $component->property);
			$property = str_replace("}", "", $tmp_val);
			$assignmentStatement = '$controller->'.$property.' = $component;';
			eval($assignmentStatement);
		}

		return $controller;
	}
	
	public function callLoadFunction($controller){
		$controller->load($controller);
	}
	
	public function setFromModelToComponentArray($componentArray, $controller){
	
		foreach($componentArray as $component){
			$tmp_val = str_replace("#{", "", $component->property);
			$property = str_replace("}", "", $tmp_val);
			$assignmentStatement = '$component = $controller->'.$property.';';
			eval($assignmentStatement);
		}
		
		return $componentArray;
	}
	
	public function callAction($controller){
	
		if(!empty($_POST)){
			$method = $_POST["action"];
			$callStatement = '$controller->'.$method;
			eval($callStatement);
		}
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
				$jsContent .= $component->getJS();
			}
		}
		
		return $jsHeader.$jsContent.$jsFooter;
	}
}
