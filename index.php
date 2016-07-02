<?php
ob_start();
define('API_KEY','TOKEN'); //bot api
function httpt($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
// Fetching UPDATE
$update = json_decode(file_get_contents('php://input'));

if($update->message->text == '/start'){
  var_dump(httpt('sendMessage',[
    'chat_id'=>$update->message->chat->id,
    'text'=>"Hi Welcome <b>Taylor Team</b> bot\n/contact\nsend developer contact",
    'parse_mode'=>'HTML',
    'reply_markup'=>json_encode([
        'inline_keyboard'=>[
          [
            ['text'=>'Developer😛',url=>'https://telegram.me/negative']
          ],
          [
            ['text'=>'Channel',url=>'https://telegram.me/taylor_team']
          ],
          [
            ['text'=>'Github',url=>'github.com/taylor-team']
          ]
      ]
  ])
 ]));
}
if($update->message->text == '/contact'){
  var_dump(httpt('sendContact',[
    'chat_id'=>$update->message->chat->id,
    'phone_number'=>'+98 937 909 7344',
    'first_name'=>'Neagtive'
  ]));
}

file_put_contents('log',ob_get_clean());
