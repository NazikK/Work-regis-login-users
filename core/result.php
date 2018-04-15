<?php
    function View($path)
    {
        require_once("views/_shared/header.php");
        require_once("views/".$path);
        require_once("views/_shared/footer.php");
    }
?>