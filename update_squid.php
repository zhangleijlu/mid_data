<?php

$url = "http://127.0.0.1:8000/";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$ret = curl_exec($ch); var_dump($ret );
eval('$list = '. $ret.';');
$ori_cont = file_get_contents("/etc/squid/squid.conf");
$info = explode("$", $ori_cont);
$pre_fix = $info[0];
$new_content = $pre_fix." $ "."\n";
foreach($list as $v){

        $ip_conf_list = "cache_peer ".$v[0]." parent ".$v[1]." 0 no-query weighted-round-robin weight=1 connect-fail-limit=2 allow-miss max-conn=5 name=".md5($v[0].$v[1]);
        $new_content = $new_content.$ip_conf_list."\n";
        file_put_contents("/etc/squid/squid.conf.bak", $new_content);
}

?>
