<?php
require_once 'templates/header.php';
?>
<a href="/" class="mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <span class="ml-4">На главную</span>
</a>
<a href="/physical" class="mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <span class="mr-4">Для физических лиц</span>
</a>
</header>
<h2>Оформление заяки для юридических лиц</h2>

<?php
$myForm = new LegalForm();
$myForm->render();
require_once 'templates/footer.php';
?>
