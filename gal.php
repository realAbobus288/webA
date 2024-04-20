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
//echo $_SESSION['idRoom'];
// $NUMB = array(111, 112, 113, 114, 115); $NUMB[] = (int)substr($result['Name'], -7, 3);


include ("Setup.php");
$query = mysqli_query($mysqli, "SELECT Name FROM room_photo WHERE idRoom = $_SESSION[idRoom]");
while ($result = mysqli_fetch_array($query)) {
    $NUMB[] = "roomPhoto\\" . $result['Name'];
}
$query = mysqli_query($mysqli, "SELECT PhotoName FROM hotel_photo WHERE idHotel = $_SESSION[idHotel]");
while ($result = mysqli_fetch_array($query)) {
    $NUMBG[] = "hotelPhoto\\" . $result['PhotoName'];
}
mysqli_close($mysqli);


if ($_SESSION['nowN'] == NULL) {
    $_SESSION['nowN'] = array(0, $NUMB[0]);
}
if ($_SESSION['nowG'] == NULL) {
    $_SESSION['nowG'] = array(0, $NUMBG[0]);
}

// КОМНАТА
if (isset($_POST['left'])) {
    if ($_SESSION['nowN'][0] == 0) {
        $_SESSION['nowN'][0] = count($NUMB) - 1;
    } else {
        $_SESSION['nowN'][0] = $_SESSION['nowN'][0] - 1;
    }
    $_SESSION['nowN'][1] = $NUMB[$_SESSION['nowN'][0]];
}
if (isset($_POST['right'])) {
    if ($_SESSION['nowN'][0] == count($NUMB) - 1) {
        $_SESSION['nowN'][0] = 0;
    } else {
        $_SESSION['nowN'][0] = $_SESSION['nowN'][0] + 1;
    }
    $_SESSION['nowN'][1] = $NUMB[$_SESSION['nowN'][0]];
}
// КОМНАТА

// ОТЕЛЬ
if (isset($_POST['leftG'])) {
    if ($_SESSION['nowG'][0] == 0) {
        $_SESSION['nowG'][0] = count($NUMBG) - 1;
    } else {
        $_SESSION['nowG'][0] = $_SESSION['nowG'][0] - 1;
    }
    $_SESSION['nowG'][1] = $NUMBG[$_SESSION['nowG'][0]];
}
if (isset($_POST['rightG'])) {
    if ($_SESSION['nowG'][0] == count($NUMBG) - 1) {
        $_SESSION['nowG'][0] = 0;
    } else {
        $_SESSION['nowG'][0] = $_SESSION['nowG'][0] + 1;
    }
    $_SESSION['nowG'][1] = $NUMBG[$_SESSION['nowG'][0]];
}
// ОТЕЛЬ

if (isset($_POST['back'])){
    $_SESSION['nowN'] = null;
    $_SESSION['nowG'] = null;
    $_SESSION['idRoom'] = null;
    header("Location: chooseHotel.php");
}
?>

<form method="POST">
    <button type='submit' class='galB' name='back'>
        Обратно </button>
</form>

<!-- КОМНАТА -->
<table class="gal">
    <tr>
        <td colspan="3" style="text-align: left;">Фото комнаты</td>
    </tr>
    <tr>
        <form method="POST">
            <td width=10%>
                <button type='submit' class='galB' name='left'>
                    < </button>
            </td>
            <td style='border: 1px solid black;'>
                <img width=640px height=320px src=<?php echo $_SESSION['nowN'][1] ?>>
            <td>
            <td width=10%>
                <button type='submit' class='galB' name='right'>></button>
            </td>
        </form>
    </tr>
</table>
<!-- КОМНАТА -->

<!-- ОТЕЛЬ -->
<table class="gal">
    <tr>
        <td colspan="3" style="text-align: left;">Фото гостиницы</td>
    </tr>
    <tr>
        <form method="POST">
            <td width=10%>
                <button type='submit' class='galB' name='leftG'>
                    < </button>
            </td>
            <td style='border: 1px solid black;'>
                <img width=640px height=320px src=<?php echo $_SESSION['nowG'][1] ?>>
            <td>
            <td width=10%>
                <button type='submit' class='galB' name='rightG'>></button>
            </td>
        </form>
    </tr>
</table>
<!-- ОТЕЛЬ -->