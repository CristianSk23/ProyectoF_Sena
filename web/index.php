<?php
// include_once "../lib/helpers.php";
// include_once "../view/partials/header.php";

// echo "<body>";
// echo "<div class='animsition'>";
// include_once "../view/partials/navbar.php";
// include_once "../view/partials/sideBar.php";
// include_once "../view/partials/cart.php";
// if (isset($_GET["modulo"])) {
//     resolve();
// }
// /* if (!isset($_SESSION['auth'])) {
//     redirect("login.php");
// } */
// echo "</div>";
// include_once "../view/partials/footer.php";
// // include_once "../view/home/slider.php";
// // include_once "../view/home/home.php";
// echo "</body>";
// echo "</html>";


include_once "../lib/helpers.php";
include_once "../view/partials/navbar.php";
include_once "../view/partials/header.php";

echo "<body>";

echo "<div class='wrapper'>";  // Contenedor principal que envuelve todo el contenido

// include_once "../view/partials/navbar.php";
include_once "../view/partials/sideBar.php";
include_once "../view/partials/cart.php";


echo "<div class='main-panel'>";  // Panel principal que contiene el contenido principal de la página

// Incluir la barra de navegación (navbar)
include "../view/partials/navbar.php";

echo "<div class='container'>";  // Contenedor para la estructura de la página
echo "<div class='page-inner'>";  // Contenedor para la sección interna de la página

// Resolver el módulo correspondiente si está definido
if (isset($_GET['modulo'])) {
    resolve();
} else {
    include_once "../view/home/slider.php";
    include_once "../view/home/home.php";
}

echo "</div>";  // Cerrar el contenedor de la sección interna de la página
echo "</div>";  // Cerrar el contenedor de la estructura de la página

echo "</div>";  // Cerrar el panel principal

echo "</div>";  // Cerrar el contenedor principal

// Incluir los scripts necesarios
include_once "../view/partials/footer.php";
if (!isset($_GET['modulo'])) {
    include_once "../view/home/slider.php";
    include_once "../view/home/home.php";
}
echo "</body>";
echo "</html>";
// Selecciona todos los enlaces de la clase .main-menu
