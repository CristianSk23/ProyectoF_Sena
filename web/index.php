<?php
include_once "../lib/helpers.php";
include_once "../view/partials/header.php";

echo "<body>";
echo "<div class='container'>";
include_once "../view/partials/navbar.php";
include_once "../view/partials/cart.php";
if (isset($_GET["modulo"])) {
    resolve();
}
if (!isset($_SESSION['auth'])) {
    redirect("login.php");
}
echo "</div>";
include_once "../view/partials/footer.php";
include_once "../view/home/slider.php";
// getUrl("Home", "Home", "home");
include_once "../view/home/home.php";
echo "</body>";
echo "</html>";
