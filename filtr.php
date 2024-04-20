<link rel="stylesheet" href="css.css">

<?php
session_start();
if ($_SESSION['countGostey'] == null){
    $_SESSION['countGostey'] = 1;
}
if ($_SESSION['countKrovat'] == null){
    $_SESSION['countKrovat'] = 1;
}

if (isset($_POST['lg'])){
    if ($_SESSION['countGostey'] != 1){
        $_SESSION['countGostey']--;
    }
}
if (isset($_POST['rg'])){
    $_SESSION['countGostey'] = $_SESSION['countGostey'] + 1;
}
if (isset($_POST['lk'])){
    if ($_SESSION['countKrovat'] != 1){
        $_SESSION['countKrovat']--;
    }
}
if (isset($_POST['rk'])){
    $_SESSION['countKrovat'] = $_SESSION['countKrovat'] + 1;
}
if (isset($_POST['filtr'])){
    $query = mysqli_query($mysqli, "SELECT * FROM view1 WHERE 
    Beds = $_SESSION[countKrovat] AND
    Persons = $_SESSION[countGostey] AND
    Adress LIKE '%$_POST[adr]%'");
}
if (isset($_POST['otmena'])){
    $query = mysqli_query($mysqli, "SELECT * FROM view1");
}
?>


<form method="POST">
<table class="filterTable">
    <tr>
        <td colspan="4">Фильтрация</td>
    </tr>
    <tr>
        <td>Гостей</td>
        <td width=10%>
            <button type='submit' class='galB' name='lg'>
                < </button>
        </td>
        <td><?php echo $_SESSION['countGostey']; ?></td>
        <td width=10%>
            <button type='submit' class='galB' name='rg'>
                > </button>
        </td>
    </tr>
    <tr>
        <td>Кроватей</td>
        <td width=10%>
            <button type='submit' class='galB' name='lk'>
                < </button>
        </td>
        <td><?php echo $_SESSION['countKrovat']; ?></td>
        <td width=10%>
            <button type='submit' class='galB' name='rk'>
                > </button>
        </td>
    </tr>


    <tr>
        <td>Адрес</td>
        <td colspan="3">
            <textarea cols=20 rows=1 name='adr'><?php echo $_POST['adr'] ?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <button type='submit' class='galB' name='filtr'> Отфильтровать </button>
        </td>
        <td colspan="2">
            <button type='submit' class='galB' name='otmena'> Отменить </button>
        </td>
    </tr>
</table>
</form>