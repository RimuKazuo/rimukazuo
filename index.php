<?php

date_default_timezone_set("Asia/Jakarta");
// INIT CONFIG


function devicemanager($ua){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://nguyenthuwann.my.id/system/useragent/?ua=".urlencode($ua)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

function location($var){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://nguyenthuwann.my.id/system/flag/?ip=".$var); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}


$user = $_POST['user'];
$pesan = $_POST['pesan'];
$time = date('d-m-Y : h-i-s');
// FLAG
$info = location($ip);
$dev = devicemanager($ua);

$subjek = $info['flag'].' '.$info['code'].'REQUEST DARI '.$user;
$pesan = '
<center>
 <div style="background: url(https://i.ibb.co/Xx7RrKF/Rimuru-Tempest.png) no-repeat;border:2px solid pink;background-size: 100% 100%; width: 294; height: 101px; color: #000; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px;">
</div>
 <table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid pink; border-collapse:collapse;width:100%;background:#cf0485;">
    <tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>WA</b></th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$user.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>REQUEST</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$pesan.'</th> 
</tr>

</table>
 <center>
';
include 'email.php';
$sender = 'REQUEST';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= ''.$sender.'' . "\r\n";
// MENGIRIM DATA KE EMAIL
mail($email, $subjek, $pesan, $headers);
?>