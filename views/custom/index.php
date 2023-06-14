<?php include  $_SERVER['DOCUMENT_ROOT']."/Home/includes/checkLogin.inc.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <h1 style="text-align: center;">線上西洋棋遊戲 自訂頁面 <button>回首頁</button></h1>
    <script src="../_js/jquery.min.js"></script>
    <script src="../_js/jquery-ui.min.js"></script>
    <script src="../_js/site.js"></script>



    <script>
      $(document).ready(function(){
     });
    </script>
    <script type="text/javascript">
      function AllowDrop(event){
        event.preventDefault();
      }
      function Drag(event){
        event.dataTransfer.setData("text",event.currentTarget.id);
      }
      function Drop(event){
        event.preventDefault();
        var data=event.dataTransfer.getData("text");
        event.currentTarget.appendChild(document.getElementById(data));
      }
    </script>

<style>
  .container {
    display: flex;
  }
  
  #Box1 {
  flex: 3;
  border: 3px solid black;
  border-radius: 3px;
  height: 550px;
  padding: 20px;
  clear: both;
}

.recte {
  flex: 3;
  height: 550px;
  padding: 20px;
  border: 3px solid black;
  background-color: antiquewhite;
}

#Box4 {
  flex: 4;
  background-image: url("assests/chess.png");
  opacity: 0.7;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  clear: both;
}

#Box2 {
  height: 100px;
  width: 300px;
  clear: both;
  text-align: center;
}
</style>
</head>
<body>
  <div class="container">
    <div id="Box1" ondrop="Drop(event)" ondragover="AllowDrop(event)">
      <h2>嘗試拖曳下方旗子至最右邊棋盤格吧!!!</h2>
    <div id="Box2"> <img id="Img2" src="assests/國王.png" draggable="true" ondragstart="Drag(event)" style="width: 200px;height: 180px;margin-top: 20px;"></div>
    <div id="Box2"> <img id="Img2" src="assests/皇后.png" draggable="true" ondragstart="Drag(event)" style="width: 200px;height: 180px;margin-top: 20px;"></div>
    <div id="Box2"> <img id="Img2" src="assests/不知名.png" draggable="true" ondragstart="Drag(event)" style="width: 200px;height: 180px;margin-top: 20px;"></div>
  </div>

    <div class = "recte"><h3 style="text-align: center;">西洋棋介紹:</h3>
        <img src="assests/1200px-KnightsTemplarPlayingChess1283-1024x606.jpg" style="height: 250px;text-align: center;">
        <p>再論西洋棋，其實國際象棋在三種象棋之中最接近印度原產之「恰蘭圖卡」。「恰蘭圖卡」由印度經阿拉伯人帶入伊斯蘭世界，隨著伊斯蘭教在公元七、八世紀的全球大擴張，國際象棋由中東傳入北非，再由北非經直布羅陀海峽帶到西班牙，大約在十一、二世紀傳入英格蘭及歐洲。


            歐洲人沒有像中東人一樣大規模改動原來的棋盤、棋子和走法，只是稍微改了些規則和改了棋子的名稱和形狀。
            
            
            除了加入「主教」一類名稱和把棋子中伊斯蘭色彩濃厚的名稱去除掉之外，歐洲人並未在原有基礎上作重大改變，某程度上顯示歐洲人和中東人在戰略思維上的相似之處。
            </p>
    </div>

  <div id="Box4" ondrop="Drop(event)" ondragover="AllowDrop(event)">
  </div>


</body>
</html>