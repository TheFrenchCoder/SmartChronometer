# SmartChronometer

//Reset le dossard  n° 1
UPDATE `competitors` SET `IsOnStart`='1',`IsOnRun`='0',`IsFinish`='0',`IsHere`= '1' WHERE `number`= '1'
//Reset l'auto-increment d'une table
ALTER TABLE tablename 'AUTO_INCREMENT' = '1'
//Reset all dossard
UPDATE `competitors` SET `IsOnStart`=1,`IsOnRun`=0,`IsFinish`=0,`IsHere`=1