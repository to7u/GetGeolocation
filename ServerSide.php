<?php
header("Content-type: text/plain; charset=UTF-8");

// POST変数を取得
$date = $_POST['date'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];
$alt = $_POST['alt'];
$posacc = $_POST['posacc'];
$altacc = $_POST['altacc'];
$head = $_POST['head'];
$speed = $_POST['speed'];

/**
 * TODO nmcliコマンド
 * ファイル保存順序 
 * geolocation -> nmcli -> /n
 */
//  nmcli -t -f BSSID,SSID,CHAN,RATE,SIGNAL,SECURITY dev wifi >> nmcli_result.txt
$cmd = "nmcli -t -f BSSID,SSID,CHAN,RATE,SIGNAL,SECURITY dev wifi >> position.csv";

// csv保存
$file = fopen("position.csv", "a");
fwrite($file, "$date,$lat,$lon,$alt,$posacc,$altacc,$head,$speed");
fwrite($file, "\n");
fclose($file);
exec($cmd);

// TODO 返却内容/方法について要検討
// フロントサイドへ返却
echo "OK! $date,$lat,$lon,$alt,$posacc,$altacc,$head,$speed";
?>
