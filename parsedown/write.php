<html>
<body>

<?php

$contents = file_get_contents('data.md');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

echo '<h1>Write needs to be implemented ;)</h1>';

} else {

echo '<form action="/write.php" method="post">';
echo '<label for="contents">Contents</label><br />';
echo '<textarea id="contents" rows="50" cols="70">';

if(!$contents) {
echo "Dein Markdown hier";
} else {
echo $contents;
} // no contents

echo '</textarea><br /><br />';
echo '<input type="submit" value="Aktualisieren">';
echo '</form>';

} // POST
?>

</body>
</html>
