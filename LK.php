<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Гостиница "Артемовская"</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>

    <?php
    session_start();

    if (isset($_POST['Izmen'])) {
        include ("Setup.php");
        mysqli_query($mysqli, "UPDATE `user` 
    SET `Name` = '$_POST[Name]', 
    `Phone` = '$_POST[Phone]', 
    `Email` = '$_POST[Email]', 
    `Birthday` = '$_POST[Birthday]', 
    `Password` = '$_POST[Password]', 
    `Login` = '$_POST[Login]'
    WHERE idUser = $_SESSION[userID]");

        $_SESSION['userName'] = $_POST['Name'];
        $_SESSION['password'] = $_POST['Password'];
        $_SESSION['login'] = $_POST['Login'];
        mysqli_close($mysqli);
    }


    $nameStr = "Напишите нам письмо!";
    if (isset($_POST['mailB'])) {
        include ("Setup.php");
        $query = mysqli_query($mysqli, "SELECT Name, Email FROM user WHERE idUser = $_SESSION[userID]");
        $result = mysqli_fetch_array($query);
        $name = $result[0];
        $email = $result[1];
        $text = $_POST['mail'];
        if (mail('openServerTest@yandex.ru', $name, $text, $email)) {
            $nameStr = 'Письмо успешно отправлено';
        } else {
            $nameStr = 'Ошибка';
        }
    }
    ?>

    <?php include ("topTable.php") ?>

    <table class="filterTable">
        <form action='' method='POST'>
            <tr>
                <td><?php echo $nameStr ?></td>
            </tr>
            <tr>
                <td>
                    <textarea cols=20 rows=5 name='mail'></textarea>
                </td>
            </tr>
            <tr>
                <td><button type='submit' name="mailB" class="galB">Написать</button></td>
            </tr>

        </form>
    </table>

    <table class="hotelTable">
        <tr>
            <td colspan="6">
                Изменить личные данные
            </td>
        </tr>
        <tr>
            <td>
                Имя
            </td>
            <td>
                Телефон
            </td>
            <td>
                Email
            </td>
            <td>
                Дата рождения
            </td>
            <td>
                Пароль
            </td>
            <td>
                Логин
            </td>
            <td></td>
        </tr>
        <tr>
            <?php
            include ("Setup.php");
            $query = mysqli_query($mysqli, "SELECT * FROM user WHERE idUser = $_SESSION[userID]");
            $result = mysqli_fetch_array($query);
            echo "
            <form method='POST'>
            <td>
            <input type = 'text' name = 'Name' value = $result[Name]>
            </td>
            <td>
            <input type = 'text' name = 'Phone' value = $result[Phone]></td>
            <td>
            <input type = 'text' name = 'Email' value = $result[Email]></td>
            <td>
            <input type = 'date' name = 'Birthday' value = $result[Birthday]></td>
            <td>
            <input type = 'text' name = 'Password' value = $result[Password]></td>
            <td>
            <input type = 'text' name = 'Login' value = $result[Login]></td>
            <td><button type='submit' class='galB' name ='Izmen' value = $result[idUser]>Изменить</button></td>
            </form>
            ";

            mysqli_close($mysqli);
            ?>
        </tr>
    </table>

    <?php
    if (isset($_POST['podtw'])) {
        include ("Setup.php");
        mysqli_query($mysqli, "UPDATE booking SET status = 'Подтверждено' WHERE idBooking = '$_POST[podtw]'");
        mysqli_close($mysqli);
    }
    if (isset($_POST['otmen'])) {
        include ("Setup.php");
        mysqli_query($mysqli, "DELETE FROM booking WHERE idBooking = $_POST[otmen]");
        mysqli_close($mysqli);
    }
    ?>

    <table class="hotelTable">
        <tr>
            <td colspan="12">Подтвердить или удаление бронирования</td>
        </tr>
        <tr>
            <td>
                Статус
            </td>
            <td>
                Название комнаты
            </td>
            <td>
                Дата заселения
            </td>
            <td>
                Дата выселения
            </td>
            <td>
                Цена в сутки (руб)
            </td>
            <td>
                Цена всего (руб)
            </td>
            <td>
                Кроватей
            </td>
            <td>
                Гостей
            </td>
            <td>
                Размеры (м2)
            </td>
            <td>
                Название отеля
            </td>
            <td>
                Адрес
            </td>
            <td>
                Телефон
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <?php
        include ("Setup.php");
        $query = mysqli_query($mysqli, "SELECT * FROM view2 WHERE idUser = $_SESSION[userID]");
        while ($result = mysqli_fetch_array($query)) {
            $db = strtotime($result['dateBeg']);
            $de = strtotime($result['dateEnd']);
            $interval = $de - $db;
            $TOTALCOST = $result['Price'] * round($interval / 86400, 1);
            $db = date("d.m.Y", $db);
            $de = date("d.m.Y", $de);
            echo "
        <form method='POST'>
        <tr>
        <td>$result[status]</td>
        <td>$result[nameRoom]</td>
        <td>$db</td>
        <td>$de</td>
        <td>$result[Price]</td>
        <td>$TOTALCOST</td>
        <td>$result[Beds]</td>
        <td>$result[Persons]</td>
        <td>$result[Size]</td>
        <td>$result[nameHotel]</td>
        <td>$result[Adress]</td>
        <td>$result[Phone]</td>";

            if ($result['status'] == "Ожидает подтверждения") {
                echo "
        <td><button type='submit' class='galB' name ='podtw' value = $result[idBooking]>Подтвердить</button></td>
        <td><button type='submit' class='galB' name ='otmen' value = $result[idBooking]>Отменить</button></td>
        </tr>
        </form>
        ";
            }
        }
        mysqli_close($mysqli);
        ?>
    </table>
</body>