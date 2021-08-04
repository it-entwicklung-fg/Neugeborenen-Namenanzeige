<?php
	$xmlDoc=new DOMDocument();
	$xmlDoc->load("./files/DB/namen.xml");
    $names=$xmlDoc->getElementsByTagName('name');

	$ausgabe = "";

	for($i=0; $i<($names->length); $i++) {
		$ausgabe .= '<section>';
		
	    $name=$names->item($i)->childNodes->item(0)->nodeValue;
		$ausgabe .= '<h2>' . $name . '</h2>';
		$ausgabe .= '</section>';
	}
	
	if ($names->length <= 0) {
		$ausgabe .= '<section>';
		$ausgabe .= '<h2>Aktuell gibt es keine Neugeborenen</h2>';
		$ausgabe .= '</section>';
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="./css/default.css">
    </head>
    <body>
        <center><h1>Unsere Neugeborenen</h1></center>
        <main>
            <?php echo $ausgabe; ?>
        </main>
        <footer>
            <img class="logo" src="./img/logo.png">
        </footer>
    </body>
</html>