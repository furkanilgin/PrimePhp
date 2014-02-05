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
				$xhtmlFileName = $pageNode["view"];
				$pageDefinitionCount++;
			}
		}
		
		/** Find xml tags and assign them to html element classes */
		
		$xmlStr = file_get_contents("./view/".$xhtmlFileName);
		$root = simplexml_load_string($xmlStr);
		
		$tagClassMapping = array(
			"dropdown" => "Dropdown"
		);
		
		foreach($root as $pageNode){
			$componentArray[] = new $tagClassMapping[$pageNode->getName()];
		}
		
		print_r($componentArray);
	}
}
