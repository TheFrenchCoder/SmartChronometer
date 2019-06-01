<?php
//* Getting content of the json config file and save value.
$data = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/src/_config.json");
$json = json_decode($data, true); 

//* GETTER 
$appEnvironment = $json['environment'];
$Json_roleAllowToStart = $json['role']["allowTo"]["start"];
$Json_roleAllowToFinish = $json['role']["allowTo"]["finish"];
$Json_roleAllowToAdmin = $json['role']["allowTo"]["admin"];
$Json_roleAllowToJudge = $json['role']["allowTo"]["judge"];
$Json_JudgeDisplayPenaltyChoice = $json['judge']["displayPenaltyChoice"];