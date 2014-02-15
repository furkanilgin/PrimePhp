<?php
include "/html/header.html";
include "./Framework.php";

$framework = new Framework();
$requestedPageConfiguration = $framework->findRequestedPageConfiguration($_GET["page"]);
$componentArray = $framework->convertXmlToComponentArray($requestedPageConfiguration);
$controller = $framework->createControllerObject($requestedPageConfiguration);
$componentArray = $framework->setPropertyValuesFromModelToComponentArray($componentArray, $controller);
$html = $framework->renderHtml($componentArray);
$js = $framework->renderJS($componentArray);

echo $html;
file_put_contents("./js/script.js", $js);

include "/html/footer.html";
?>