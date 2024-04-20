<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Гостиница "Артемовская"</title>
    <link rel="stylesheet" href="css.css">
</head>


<form action="index.php">
    <td><button type='submit' class='otmenaB' style=" width: 8%;">Отмена</button></td>
</form>


<?php
session_start();
if (isset($_POST['reg'])){
    echo $_POST['login'].$_POST['password'].$_POST['name'].$_POST['phone'].$_POST['email'].$_POST['date'];
    if(empty($_POST['login']) || empty($_POST['password']) || empty($_POST['name'])
        || empty($_POST['phone']) || empty($_POST['email']) ||  empty($_POST['date'])){
            echo "Заполните все поля регистрации";
        }else{
            include("Setup.php");
            $query = mysqli_query($mysqli, "SELECT COUNT(*) FROM user WHERE Login = '$_POST[login]'");
            $result = mysqli_fetch_array($query);
            if($result[0]>0) echo "Пользователь уже зарегистрировался";
            if($result[0]==0)
            {
                $query = mysqli_query($mysqli, "
                INSERT INTO `user` (`idUser`, `Login`, `Password`, `Phone`, `Email`, `Name`, `Birthday`) 
                VALUES (NULL, '$_POST[login]', '$_POST[password]', '$_POST[phone]', '$_POST[email]', '$_POST[name]', '$_POST[date]');");

                $_SESSION['userName'] = $_POST['name'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['userID'] = $mysqli->insert_id;;
                header("Location: index.php");
            }
            mysqli_close($mysqli);
        }
}
?>

<body>
    <h1>Заполните все поля регистрации</h1>
    <!-- РЕГИСТРАЦИЯ -->
    <form method="POST">
        <table class="regTable" style="display: <?php echo $displayREG ?>">
            <tr>
                <td colspan="2"><?php echo $AText ?></td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td>
                    <input type="text" name="phone">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="email">
                </td>
            </tr>
            <tr>
                <td>День рождения</td>
                <td>
                    <input type="date" name="date">
                </td>
            </tr>
            <tr>
                <td>Логин</td>
                <td>
                    <input type="text" name="login">
                </td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td colspan="2"><button type='submit' class='otmenaB' name="reg">Подтверждение</button></td>
    </form>
    </tr>
    </table>

    <!-- РЕГИСТРАЦИЯ -->
</body>