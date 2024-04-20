<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Гостиница "Артемовская"</title>
    <link rel="stylesheet" href="css.css">
</head>

<?php
session_start();
include ("Setup.php");
if (isset($_POST['toGal'])) {
    $str = explode(';', $_POST['toGal']);
    $_SESSION['idRoom'] = $str[0];
    $_SESSION['idHotel'] = $str[1];
    header("Location: gal.php");
}
if (isset($_POST['zabr'])) {
    if ($_SESSION['dateZas'] == NULL || $_SESSION['dateVis'] == NULL) {
        echo "Выберите дату";
    } else {
        if ($_SESSION['userID'] == NULL) {
            echo "Авторизуйтесь";
        } else {
            $query = mysqli_query($mysqli, "INSERT INTO booking 
            (idBooking, status, IdUser, idRoom, dateBeg, dateEnd)
            VALUES
            (NULL, 'Ожидает подтверждения', '$_SESSION[userID]', '$_POST[zabr]', '$_SESSION[dateZas]', '$_SESSION[dateVis]')");
            // echo "INSERT INTO booking 
            // (idBooking, status, IdUser, idRoom, dateBeg, dateEnd)
            // VALUES
            // (NULL, '$_SESSION[userID]', 'Ожидает подтверждения', '$_POST[zabr]', '$_SESSION[dateZas]', '$_SESSION[dateVis]')";
            header("Location: LK.php");
        }
    }
}
$query = mysqli_query($mysqli, "SELECT * FROM view1");
?>

<body>

    <?php include ("topTable.php") ?>

    <?php include ("filtr.php") ?>
    <?php include ("date.php") ?>


    <table class="hotelTable">
        <tr>
            <td>Комната</td>
            <td>Цена(руб)</td>
            <td>Кроватей</td>
            <td>Гостей</td>
            <td>Размеры(м2)</td>
            <td>Отель</td>
            <td>Адрес</td>
            <td>Телефон</td>
            <td>Галерея</td>
            <td></td>
        </tr>
        <?php

        while ($result = mysqli_fetch_array($query)) {
            echo "
                    <tr>
                    <td>$result[NameRoom]</td>
                    <td>$result[Price]</td>
                    <td>$result[Beds]</td>
                    <td>$result[Persons]</td>
                    <td>$result[Size]</td>
                    <td>$result[NameHotel]</td>
                    <td>$result[Adress]</td>
                    <td>$result[Phone]</td>
                    <form action='' method = 'POST'>
                        <td><button type='submit' class='galB' name ='toGal' value = '$result[idRoom];$result[idHotel]'>Смотреть</button></td>
                    </form>
                    <form action='' method = 'POST'>
                        <td><button type='submit' class='galB' name ='zabr' value = $result[idRoom]>Забронировать</button></td>
                    </form>
                    </tr>
                    ";
        }
        mysqli_close($mysqli);

        ?>
    </table>
</body>

</html>