<?php
require_once("/html/header.html");
require_once("./Framework.php");

$framework = new Framework();
$requestedPageConfiguration = $framework->findRequestedPageConfiguration($_GET["page"]);
$framework->checkRequestedPageIsCorrect($requestedPageConfiguration);
$componentArray = $framework->convertXmlToComponentArray($requestedPageConfiguration);
$controller = $framework->createControllerAndModelObject($requestedPageConfiguration);
$controller = $framework->setFromComponentArrayToModel($componentArray, $controller);
$framework->callLoadFunction($controller);
$componentArray = $framework->setFromModelToComponentArray($componentArray, $controller);
$framework->callAction($controller);
$html = $framework->renderHtml($componentArray);
$js = $framework->renderJS($componentArray);

echo $html;
file_put_contents("./js/script.js", $js);

require_once("/html/footer.html");
?>