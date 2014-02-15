<?php
require_once("/html/header.html");
require_once("./Framework.php");

$framework = new Framework();
$requestedPageConfiguration = $framework->findRequestedPageConfiguration($_GET["page"]);
$framework->checkRequestedPageIsCorrect($requestedPageConfiguration);
$componentArray = $framework->convertXmlToComponentArray($requestedPageConfiguration);
$controller = $framework->createControllerObject($requestedPageConfiguration);
$componentArray = $framework->setPropertyValuesFromModelToComponentArray($componentArray, $controller);
$html = $framework->renderHtml($componentArray);
$js = $framework->renderJS($componentArray);

echo $html;
file_put_contents("./js/script.js", $js);

require_once("/html/footer.html");
?>