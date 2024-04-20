<link rel="stylesheet" href="css.css">

<?php

session_start();

if (isset($_POST['exit'])) {
    $_SESSION['userName'] = null;
    $_SESSION['userID'] = null;
    $_SESSION['login'] = null;
    $_SESSION['password'] = null;
    header("Location: index.php");
$AText = "Авторизация";
    
}

if (isset($_POST['autor'])) {
    include ("Setup.php");
    if (empty($_POST['login']) || empty($_POST['password'])) {
        echo "Заполните все поля авторизации";
    } else {
        $q = mysqli_query($mysqli, "SELECT * FROM user WHERE Login = '$_POST[login]' AND Password = '$_POST[password]'");
        $r = mysqli_fetch_array($q);
        if ($r['idUser'] == NULL) {
            $AText = "Ошибка в логине или пароле!";
        } else {
            $_SESSION['userName'] = $r['Name'];
            $_SESSION['userID'] = $r['idUser'];
            $_SESSION['login'] = $r['Login'];
            $_SESSION['password'] = $r['Password'];
            header("Location: index.php");
        }

    }
}
    if ($_SESSION['userID'] != NULL) {
        echo "<table class='autor'>";
        echo "<tr><td>Здравсвуйте " . $_SESSION['userName'] . "</td></tr>";
        ?>
        <form action='' method='POST'>
            <tr>
                <td><button type='submit' name='exit' class='ab'>Выйти</button></td>
            </tr>
        </form>
        <form action='LK.php'>
            <tr>
                <td><button type='submit' class='ab'>В личный кабинет</button></td>
            </tr>
        </form>
        </table>
        <?php
    } else {
$AText = "Авторизация";

?>



<!-- АВТРИЗАЦИЯ -->
<form method="POST">
    <table class="autor">
        <tr>
            <td colspan="2"><?php echo $AText ?></td>
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
            <td><button type='submit' class='ab' name="autor">Подтверждение</button></td>
</form>
<form action="reg.php">
    <td><button type='submit' class='ab' name="toReg">Регистрация</button></td>
</form>
</tr>
</table>
</form>

<!-- АВТРИЗАЦИЯ -->
<?php
}
?>