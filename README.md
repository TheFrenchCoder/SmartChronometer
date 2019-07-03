# SmartChronometer

# Introduction
It allows to manage kayak races in different disciplines: Sprint and Slalom
(management of: start/finish, results, users, visitors and racers).
It replaces paper and countless Excel spreadsheets.
It takes the form of a web application.
## Version:
 - Slalom
 - Sprint
 - Go next, dude

# About me

# Users
## Requierements
## Installation
## How to use ?
### Solo:
 1. Setting up the web server on your operation computer
 J'entend par là, un ordinateur portable ou un Raspberry Pi (=> 3)
 Qui serra sur le lieu de la compétition en plus caniard
 2. Télécharger
### With EventManger by me:

# Devellopers
**Reset de l'application**
``` sql
USE dbchrono;
UPDATE `competitors` SET `IsOnStart`=1,`IsOnRun`=0,`IsFinish`=0,`IsHere`=1;
UPDATE `users` SET `IsConnected`=0;
TRUNCATE TABLE race1;
TRUNCATE TABLE penalty;
```

//BEST var_dump ==>
var_dump(highlight_string("<?\n". var_export($data, true)))
