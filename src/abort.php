
<?php
session_start();
if ($_POST['action'] == "unsetsession") {
    session_destroy();
}
?>