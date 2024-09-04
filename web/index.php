<?php
include_once "../lib/helpers.php";
include_once "../view/partials/navbar.php";
include_once "../view/partials/header.php";

echo "<body>";
echo "<div class='animsition'>";
include_once "../view/partials/cart.php";
if (isset($_GET["modulo"])) {
    resolve();
} else {
    include_once "../view/home/slider.php";
    include_once "../view/home/home.php";
}

echo "</div>";
include_once "../view/partials/footer.php";
echo "</body>";
echo "</html>";
