<?php
//  echo '<pre>'; var_dump($_POST); echo '</pre>';   
if (isset($_POST["submit"])) {
    // get POST data
    $uid = $_POST["uid"];
    $passwrord = $_POST["password"];
    // initiate class include ORDER MATTER
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login_class =
        new LoginContr($uid, $passwrord);
    $login_class->loginUser();
    // SEND TO NODE SERVER
    $url = "http://localhost:3000/Login/";
    $proxy = "localhost";
    $time = time();
    $sessid = session_id();
    $message = "$time" . "_" . "$_SESSION[userid]" . "_" . "$_SESSION[useruid]" . "_IDIS_$sessid";
    $password = "AES-256-CBC";
    $encrypted = encrypt($message, $password);
    $payload = (array($encrypted));
    // NEW POST METHOD
    FETCH_API($payload[0]);
    
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // // curl_setopt($ch, CURLOPT_PROXY, $proxy);
    // // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    // curl_setopt($ch, CURLOPT_POST, 1);                //0 for a get request
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
    // $headers = array(
    //     "Content-Type: application/json"
    // );
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // // $userAgent = $_SERVER['HTTP_USER_AGENT'];
    // // curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    // // curl_setopt($ch, CURLOPT_HEADER, true);
    // // curl_setopt($ch, CURLOPT_COOKIEFILE, "");
    // // curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    // // curl_setopt($ch, CURLOPT_COOKIEJAR, 'NODEID');
    // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    // // curl_setopt($ch, CURLOPT_TIMEOUT, 1.1);

    // // DEBUG
    // $response = curl_exec($ch);

    // curl_close($ch);
    // sleep(1);
    // header("location: http://localhost/Loby/");
    die();
}
function encrypt($value, string $passphrase)
{
    $salt = openssl_random_pseudo_bytes(8);
    $salted = '';
    $dx = '';
    while (strlen($salted) < 48) {
        $dx = md5($dx . $passphrase . $salt, true);
        $salted .= $dx;
    }
    $key = substr($salted, 0, 32);
    $iv = substr($salted, 32, 16);
    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
    $data = ["ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt)];
    return json_encode($data);
}
function FETCH_API($payload){
    // echo $payload;
?>
<script>
fetch("http://localhost/Loby/Login", {
  method: "POST",
  body: JSON.stringify({
    data:
    <?php 
   echo $payload;
    ?>
  }),
  headers: {
    "Content-type": "application/json; charset=UTF-8",
    "Cookie": "NODEID",
  }
}).then((res)=>
{ 
    res.json()
}).then((json)=>{
    // RESPOND FROM NODE SERVER
    // echo json
    window.location.replace("http://localhost/Loby");
}
);
</script>
<?php 
}
?>