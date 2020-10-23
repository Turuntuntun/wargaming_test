<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Фильтр кораблей</title>
    <link rel="stylesheet" href="styles/styles.css?11">
</head>
<body>
    <div class="main">
        <form method="GET" class="filter-form" name="ships">
            <input type="text" class="filter-form_name" name="name"  placeholder="Найти корабль..." oninput=sendingForm("ships");>
            <div class="filter-form_selects">
                <?=$selects?>
            </div>
        </form>
        <hr class="main-hr">
        <div class="result">
        </div>
    </div>
    <script src="scripts/main.js"></script>
</body>
</html>