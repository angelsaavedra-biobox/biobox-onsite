<?php
$play = (!empty($_SERVER['play']))? true : false;
parse_str($_SERVER['QUERY_STRING'], $params);
$name = isset($params['name']) ? $params['name'] : 'output.wav';
if($params['nuevo']==1){
	unlink("$name.wav");
}
$content = file_get_contents('php://input');
$fh = fopen("$name.wav", 'a') or die("can't open file");
fwrite($fh, $content);
fclose($fh);
exec("./convierte.sh $name");
#system("su web -c 'convierte.sh $name'");
system("qwavheaderdump -F $name.wav; avconv -y -i $name.wav $name.mp3; oggenc $name.wav -o $name.ogg");


?>
