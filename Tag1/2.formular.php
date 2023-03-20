<form action="2.formular.php" method="post">
    <input type="text" name="vorname">
    <input type="number" name="age">
    <input type="submit" value="submit">
</form>

<hr>

<?php
echo "<pre>";
    print_r($_GET);
echo "</pre>";
echo "<pre>";
    print_r($_POST);
echo "</pre>";
?>