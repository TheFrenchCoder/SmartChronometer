@echo off

set /p password=enter the password:
echo Processing reset.sql file...

mysql -u user -p %password% -h HOST DATABASE < reset.sql > output_reset.txt

echo Done

pause>nul 