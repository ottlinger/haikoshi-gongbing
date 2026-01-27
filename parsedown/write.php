<html>
<body>

<?php

$contents = file_get_contents('data.md');
if(!$contents) {
echo "Leer"; 
} else {
echo $contents;
}
?>

</body>
</html>
