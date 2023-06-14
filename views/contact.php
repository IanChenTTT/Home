<?php include  $_SERVER['DOCUMENT_ROOT']."/Home/includes/checkLogin.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Asset/contact.css">
</head>

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
<body>
    <div class="container d-flex align-items-center justify-content-center position-relative flex-wrap">
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
                <img src='https://cdn.discordapp.com/attachments/856871306325393419/1118238154441359481/S__622076086.jpg'>
            </div>
            <div class="content">
                <h2>陳主祥</h2>
                <p>元智資傳-中正資管
                    已經考上研究所了，拜託老師讓我過，並且可以讓我畢業，感謝各位組員努力打code.做出這麼讚的網站。</p>
            </div>
        </div>
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
                <img src='https://cdn.discordapp.com/attachments/856871306325393419/1118238154806276106/31978.jpg'>
            </div>
            <div class="content">
                <h2>林成翰</h2>
                <p>好想放假。</p>
            </div>
        </div>
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
                <img src='https://avatars.githubusercontent.com/u/30679661?v=4'>
            </div>
            <div class="content">
                <h2>陳衍易</h2>
                <p>元智大學資訊傳播，興趣在於網頁開發，os，網路概論。現在在精進全端開發</p>
            </div>
        </div>
        <div class="card d-flex position-relative flex-column">
            <div class='imgContainer'>
                <img src='https://cdn.discordapp.com/attachments/856871306325393419/1118240782973931642/DSC_0035.jpg'>
            </div>
            <div class="content">
                <h2>張倫榕</h2>
                <p>我是只會figma的小廢物</p>
            </div>
        </div>
    </div>
    <div class="container cardlist">
        <div class="text">
            Contact us Form
        </div>
        <form action="#">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" required>
                    <div class="underline"></div>
                    <label for="">Name</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" required>
                    <div class="underline"></div>
                    <label for="">Email Address</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" required></textarea>
                    <br />
                    <div class="underline"></div>
                    <label for="">Write your message</label>
                    <br />
                </div>
            </div>
            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" value="submit">
                </div>
            </div>
        </form>
    </div>
</body>

</html>