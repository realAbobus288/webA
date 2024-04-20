<link rel="stylesheet" href="css.css">

<?php

session_start();
if (isset($_POST['ochist'])) {
    $_SESSION['dateZas'] = NULL;
    $_SESSION['dateVis'] = NULL;
}
if (isset($_POST['podtw'])) {
    $_SESSION['dateZas'] = $_POST['dateZas'];
    $_SESSION['dateVis'] = $_POST['dateVis'];
}
?>

<table class="filterTable">
    <tr>
        <td>Выберите дату заселения</td>
        <td>Выберите дату выселения</td>
    </tr>
    <tr>
        <form method="POST">
            <td>
                <input type="date" name="dateZas" value=<? echo $_SESSION["dateZas"] ?>>
            </td>
            <td>
                <input type="date" name="dateVis" value=<? echo $_SESSION["dateVis"] ?>>
            </td>
    <tr>
        <td>
            <button type='submit' class='galB' name='podtw'>Подтвердить</button>
        </td>
        <td>
            <button type='submit' class='galB' name='ochist'>Очистить</button>
        </td>
        </form>
    </tr>
</table>