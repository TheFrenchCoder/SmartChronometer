<?php

$data = file_get_contents ("config.json");
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($data, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

echo '<pre>' . print_r($data, true) . '</pre>';
echo "<br/><br/>";

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        echo "$key:<br/>";
    } else {
        echo "$key => $val<br/>";
    }
}
