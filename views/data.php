<?php include  $_SERVER['DOCUMENT_ROOT']."/Home/includes/checkLogin.inc.php"; ?>
<?php
// include 'connectSQL.php';
$db_link = @new mysqli("localhost", "root", "", "chess_log");
if ($db_link) {
    //echo "Success <br>";
} else {
    die("Falied");
    //echo "Falied";
}
$num_pages = 1;
$pageRow_records = 10;
if (!empty($_GET['pagenum'])) {
    $pageRow_records = $_GET['pagenum'];
}
if (!empty($_GET['page'])) {
    $num_pages = $_GET['page'];
}
$startRow_records = ($num_pages - 1) * $pageRow_records;
$sql_query = "SELECT * FROM game";
$sql_query_limit = $sql_query . " LIMIT {$startRow_records}, {$pageRow_records}";
$all_result = $db_link->query($sql_query);
$result = $db_link->query($sql_query_limit);
$total = $result->num_rows;
$total_records = $all_result->num_rows;

$total_pages = ceil($total_records / $pageRow_records);

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
        <li><a href="./index.php">Home</a></li>
        <li><a href="./views/custom/index.php">custom</a></li>
        <li>
          <a href="./views/data.php">record</a>
        </li>
        <li>
          <a href="./views/contact.php">contact</a>
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
            <a href="../includes/logout.inc.php">Logout</a>
          </li>
        <?php
        }
        ?>
      </ul>
    </nav>
<h1>歷史紀錄</h1>
<form action="" method="GET">
    <select id="pagenum" name="pagenum" onchange="submit();">
        <?php
        for ($i = 10; $i <= 20; $i = $i + 5) {
            echo "<option value=" . $i . ">" . $i . "</option>";
        }
        ?>
    </select>
</form>
<table>
    <tr>
        <th>日期</th>
        <th>game id</th>
        <th>player1 id</th>
        <th>player2 id</th>
        <th>win_mode</th>
        <th>timer_mode</th>
    </tr>
    <?php
    while ($row_result = $result->fetch_assoc()) {
        echo "<tr class='game' onclick=\"javascript:location.href='./game.php?gameid=".$row_result['game_id']."'\"><td>" . $row_result['date_time'] . "</td>
            <td>" . $row_result['game_id'] . "</td>
            <td>" . $row_result['player1_id'] . "</td>
            <td>" . $row_result['player2_id'] . "</td>
            <td>" . $row_result['win_mode'] . "</td>
            <td>" . $row_result['timer_mode'] . "</td></tr>";
        // echo "<td><a href='update.php?id=" . $row_result['csgoID'] . "'>修改</a>";
        // echo "<a href='delete.php?id=" . $row_result['csgoID'] . "'>刪除</a></td>
        // </tr>";
    }
    ?>
    <tr>
        <td>
            <?php echo $num_pages ?>
        </td>
        <?php if ($num_pages > 1) { ?>
            <td><a href="data.php?page=1">第一頁</a></td>
            <td><a href="data.php?page=<?php echo $num_pages - 1 ?>">上一頁</a></td>

        <?php } ?>

        <td>
            <?php for ($j = 1; $j < $total_pages; $j++) { ?>
                <a href="data.php?page=<?php echo $j ?>"> <?php echo $j ?></a>
            <?php } ?>
        </td>

        <?php if ($num_pages < $total_pages) { ?>
            <td><a href="data.php?page=<?php echo $num_pages + 1 ?>">下一頁</a></td>
            <td><a href="data.php?page=<?php echo $total_pages ?>">最末頁</a></td>
        <?php } ?>
    </tr>
</table>
</body>