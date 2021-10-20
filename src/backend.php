<div class="header">
    <h2>PHP/Backend Interview Test</h2>
</div>

<?php
if (isset($_GET['input'])) {
    require_once('luhn.php');
}

if (!isset($_GET['input'])) : ?>

    <form action="main.php" method="get">
        <label for="input">Provide an input to be tested by Luhn Algorithm:</label><br>
        <input type="text" id="input" name="input"><br><br>
        <input type="submit" value="Submit">
    </form>

<?php else: ?>

    <a href="main.php">
        <button>
            Try Another Integer
        </button>
    </a>

<?php endif; ?>
