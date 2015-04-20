<?php
$url = $_POST['url'];
unset($_POST['url']);
$api_key = $_POST['api_key'];
$curl = curl_init($url);


$r=array();
$r['Inputs'] = array();
$r['Inputs']['input1'] = array();
$r['Inputs']['input1']['ColumnNames'][] = 'Label';
$r['Inputs']['input1']['Values'] = array();
$r['Inputs']['input1']['Values'][0][] = '0';
$r['GlobalParameters'] = (object)array();

foreach($_POST as $k => $v){
  if($k !== "api_key" ){
    $r['Inputs']['input1']['ColumnNames'][] = $k."";
    $r['Inputs']['input1']['Values'][0][] = $v."";
  }
}
$data = json_encode($r);
$headers = array(
  "Content-Type: application/json",
  "Authorization: Bearer " . $api_key,
  "Content-Length:  ".strlen($data),
//  "Accept" => "application/json"
);
$options = array(
  CURLOPT_VERBOSE => true,
  CURLOPT_HTTPHEADER => $headers,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $data
);
//echo json_encode($options);
//exit;
curl_setopt_array($curl,$options);
// Azure MLに送信
if(! $result = curl_exec($curl)){
  trigger_error(url_error($ch));
  $decoded = json_decode($result);
  echo $decoded['Results']['output1']['value'][0][795];
}
// 結果から

