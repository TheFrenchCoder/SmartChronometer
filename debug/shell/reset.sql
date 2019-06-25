ALTER TABLE race1 'AUTO_INCREMENT' = '1'
TRUNCATE `dbchrono`.`race1`

ALTER TABLE penalty 'AUTO_INCREMENT' = '1'
TRUNCATE `dbchrono`.`penalty`

UPDATE `competitors` SET `IsOnStart`=1,`IsOnRun`=0,`IsFinish`=0,`IsHere`=1