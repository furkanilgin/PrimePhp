<?php

class XmlToHtmlConverter{

	private $xhtml;

	public static function convert($page){
		
		$confStr = file_get_contents("./conf/page-configuration.xml");
		$root = simplexml_load_string($confStr);

		$pageDefinitionCount = 0;
		foreach($root as $pageNode){
			if($pageNode["name"] == $page){
				if($pageDefinitionCount > 0){
					throw new Exception('There must be only one page definition with same name in page-configuration.xml');
				}
				$xhtml = $pageNode["view"];
				$pageDefinitionCount++;
			}
		}
		
		echo $xhtml; // found xml file
	}
}
