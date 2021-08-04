<?php
	$xmlDoc=new DOMDocument();
	$xmlDoc->load("./files/DB/namen.xml");
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['add'])) {
            $namesDB=$xmlDoc->getElementsByTagName('namenDB')->item(0);
            $nameNeu = $_GET['add'];
            $nameTag=$xmlDoc->createElement("name");
            $nameText=$xmlDoc->createTextNode(utf8_encode($nameNeu));
            $nameTag->appendChild($nameText);
            $namesDB->appendChild($nameTag);
            $namesDB->appendChild($xmlDoc->createTextNode("\n\n"));
        } elseif (isset($_GET['delete'])) {
            $doc = $xmlDoc->documentElement;
            $delete = $_GET['delete'];
            $names=$xmlDoc->getElementsByTagName('name');
            $nodeToRemove = $names->item($delete);
            if ($nodeToRemove != null){
                $doc->removeChild($nodeToRemove);
            }
        }
        $xmlDoc->save("./files/DB/namen.xml");
    }
    $names=$xmlDoc->getElementsByTagName('name');

	$ausgabe = "";

	for($i=0; $i<($names->length); $i++) {
		$ausgabe .= '<section>';
		
	    $name=$names->item($i)->childNodes->item(0)->nodeValue;
		$ausgabe .= '<h2>' . $name . '</h2>';
        $ausgabe .= '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="get">';
        $ausgabe .= '<input type="hidden" name="delete" value="' . $i . '">';
        $ausgabe .= '<input type="submit" value="Löschen">';
        $ausgabe .= '</form>';
		$ausgabe .= '</section>';
	}
	
	/*if ($names->length <= 0) {
		$ausgabe .= '<section>';
		$ausgabe .= '<h2>Aktuell gibt es keine Neugeborenen</h2>';
		$ausgabe .= '</section>';
	}*/
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
            <section>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                    <input type="text" name="add" placeholder="Max Musterman" required>
                    <input type="submit" value="Speichern">
                </form>
            </section>
        </main>
        <footer>
            <img class="logo" src="./img/logo.png">
            <div class="madeby">
                <p>Made by:</p>
                <img src="./img/branding.png">
            </div>
        </footer>
    </body>
</html>