<h1>Error <?= (int) $errorCode ?></h1>
<p><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
<p>
    <a href="?controller=home" 
        onclick="if (history.length > 1) { history.back(); return false; }">
        Volver
    </a>
</p>
