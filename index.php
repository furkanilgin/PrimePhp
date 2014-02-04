<?php

include "./libs/XmlToHtmlConverter.php";

echo XmlToHtmlConverter::convert($_GET["page"]);

//include "view/".$_GET["page"].".php";

?>