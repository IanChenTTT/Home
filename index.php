<?php include("./includes/checkLogin.inc.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
  <script src="Style.js" defer></script>
</head>

<body>
  <div id="wrapper">
    <nav>
      <img src="./image/BoardIcon.svg" alt="logo">
      <ul>
        <li>歷程記錄</li>
        <li>歷程記錄</li>
        <?php
        // echo $url;
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
            <img src="./image/user.svg" alt="">
          </li>
          <li>
            <a href="includes/logout.inc.php">Logout</a>
          </li>
        <?php
        }
        ?>
      </ul>
    </nav>
    <div id="main_wrapper">
      <section id="section1">
        <h3>登入</h3>
      </section>
      <main>
        <div id="Front"></div>
        <div id="Back"></div>
      </main>
      <section id="section2">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title">線上西洋棋對戰</h2>
            <p class="card-body">歡迎來到線上西洋棋對戰!!!<br> 請登入遊戲或是創建帳號 </p>
            <button class="button log">login</button>
            <button class="button create">Create</button>

          </div>
      </section>
    </div>
    <footer></footer>
    <!-- form wrapper -->
    <div id="form_wrapper">
      <form action="includes/login.inc.php" method="post" id="login_form">
        <div class="Form_Sec">
          <label for="username">Username</label>
          <input type="text" name="uid" id="uid" placeholder="Account" required>
        </div>
        <div class="Form_Sec">
          <label for="password">password</label>
          <input type="password" name="password" placeholder="password" required>
        </div>
        <button type="submit" class="btn" name="submit">login</button>
      </form>
    </div>
    <div id="form_wrapper">
      <form action="includes/signin.inc.php" method="post" id="create_form">
        <div class="Form_Sec">
          <label for="username">Username</label>
          <input type="text" name="uid" id="uid" placeholder="Account" required>
        </div>
        <div class="Form_Sec">
          <label for="password">password</label>
          <input type="password" name="password" placeholder="password" required>
          <input type="password" name="password_repeat" placeholder="password_repeat" required>
        </div>
        <div class="Form_Sec">
          <label for="email">email</label>
          <input type="email" name="email" placeholder="email" required>
        </div>
        <button type="submit" class="btn" name="submit">Create Account</button>
      </form>
    </div>
    <!-- wrapper end -->
  </div>

</body>

<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const error = urlParams.get("error");
  console.log(error);
  if (error !== "none" && error !== null)
    alert(error);
  const loginBTN = document.querySelector(".log");
  const createBTN = document.querySelector(".create");
  const formwrapper1 = document.querySelectorAll("#form_wrapper")[0];
  const formwrapper2 = document.querySelectorAll("#form_wrapper")[1];
  const loginForm = document.querySelector("#login_form")
  const create_form = document.querySelector("#create_form")
  const input = document.querySelectorAll("input");
  console.log(input)
  let Leavelogin1 = false;
  let Leavecreate2 = false;
  loginBTN.addEventListener("click", () => {
    console.log(Leavelogin1);
    formwrapper1.style.display = "flex";
    loginForm.style.display = "flex";

  })
  createBTN.addEventListener("click", () => {
    console.log(Leavecreate2);
    formwrapper2.style.display = "flex";
    create_form.style.display = "flex";
  })
  loginForm.addEventListener("mouseleave", function() {
    Leavelogin1 = true;
  })
  loginForm.addEventListener("mouseenter", function() {
    Leavelogin1 = false;
  })

  create_form.addEventListener("mouseleave", function() {
    Leavecreate2 = true;
  })
  create_form.addEventListener("mouseenter", function() {
    Leavecreate2 = false;
  })
  formwrapper1.addEventListener("click", function() {
    console.log("click")
    if (Leavelogin1 === true) {
      loginForm.style.display = "none";
      formwrapper1.style.display = "none";
      input.forEach(element => element.value = "")
      Leavelogin1 = false;
    }
  })
  formwrapper2.addEventListener("click", function() {
    console.log("click")
    if (Leavecreate2 === true) {
      create_form.style.display = "none";
      formwrapper2.style.display = "none";

      input.forEach(element => element.value = "")
      Leavecreate2 = false;
    }
  })
</script>

</html>