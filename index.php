<?php
include "/libs/header.php";
include "./libs/XmlConverter.php";

$componentArray = XmlConverter::convertToComponentArray($_GET["page"]);
echo XmlConverter::convertToHtml($componentArray);
file_put_contents("./libs/script.js", XmlConverter::convertToJS($componentArray));

include "/libs/footer.php";
?>
