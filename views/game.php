<?php include  $_SERVER['DOCUMENT_ROOT'] . "/Home/includes/checkLogin.inc.php"; ?>
<?php // 讀取 URL 參數
$gameid = isset($_GET['gameid']) ? $_GET['gameid'] : '/';
$gameid = rtrim($gameid, '/');

$db_link = @new mysqli("localhost", "root", "", "game");
if ($db_link) {
    //echo "Success <br>";
} else {
    die("Falied");
    //echo "Falied";
}
$sql_query = "SELECT * FROM `$gameid`";
$result = $db_link->query($sql_query);
if ($result) {
} else {
    // 查詢失敗
    echo "Query failed.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>歷史紀錄</title>
    <link href="test.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <nav>
        <img src="../image/BoardIcon.svg" alt="logo">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="./custom/index.php">custom</a></li>
            <li>
                <a href="./data.php">record</a>
            </li>
            <li>
                <a href="./contact.php">contact</a>
            </li>
            <?php
            if (!isset($_SESSION["userid"])) {
            ?>
                <li>
                    登入
                </li>
                <li>
                    建立
                </li>
            <?php
            } else {
            ?>
                <li>
                    <?php echo $_SESSION["useruid"]; ?>
                    <img src="../image/user.svg" alt="">
                </li>
                <li>
                    <a href="includes/logout.inc.php">Logout</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <table>
        <?php
        while ($row_result = $result->fetch_assoc()) {
            echo
            "<tr class='game'><td>" . $row_result['a'] . "</td>
            <td>" . $row_result['b'] . "</td>
            <td>" . $row_result['c'] . "</td>
            <td>" . $row_result['d'] . "</td>
            <td>" . $row_result['e'] . "</td></tr>";
        }
        ?>

    </table>
</body>