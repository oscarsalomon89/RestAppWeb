﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>Ejemplo de Altas bajas y modificaciones con PHP y Ajax usando jQuery</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- incluyo la libreria jQuery -->
    <script type="text/javascript" src="resources/jquery-1.7.1.min.js"></script>
    <!-- incluyo el archivo que tiene mis funciones javascript -->
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
    <div id ="block"></div>
    <div class="container">
        <div id="popupbox"></div>
        <div id="content">
            <?php include_once ($view->contentTemplate); // incluyo el template que corresponda ?>
        </div>
    </div>
</body>
</html>