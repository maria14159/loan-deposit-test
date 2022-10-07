<?php
require_once 'templates/header.php';
?>
<a href="/" class="mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <span class="ml-4">На главную</span>
</a>
</header>

<?php
$servername = "localhost";
$database = "bank_test";
$username = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
} catch (PDOException $pe) {
    die("Could not connect to the database $database :" . $pe->getMessage());
}

try {

    if (stripos($_SERVER['HTTP_REFERER'], 'physical') !== false) {//call physics
        $form = new PhysicalForm();
        $form->endpoint($pdo, $_POST);

    } elseif (stripos($_SERVER['HTTP_REFERER'], 'legal') !== false) {//call legal
        $form = new LegalForm();
        $form->endpoint($pdo, $_POST);
    }
    echo "Данные отправлены";
} catch (Exception $err) {
    echo "ОШИБКА: " . $err->getMessage();
}