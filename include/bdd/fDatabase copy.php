<?php
class DataBase
{

//Variables
   //Database general
   private $isConnected;
   private $database_identifier = array(
         "host" => "localhost",
         "dbname" => "dbchrono",
         "charset" => "utf8",
         "login" => "root",
         "password" => "espace21"
      );
   //Setup
   private $database = "dbchrono";
   private $isExist;
   private $exeption = array();

//Public function

   public function __construct() {
      $this->var = $var;
   }

   public static function Main(){

      DataBase::IsExist();

      switch ($isExist) {
         case TRUE:
            log("info", "Server", "Localhost",
            "The DataBase nammed '$database' already exist", 
            " \$isExist = $isExist ");
            break;

         case FALSE:
            log("info", "Server", "Localhost",
               "The DataBase nammed '$database' don't exist, database generation...", 
               " \$isExist = $isExist ");
               DataBase::Setup();
            break;
         
         default:
            log("error", "Server", "Localhost",
            __FILE__ ."/". __CLASS__, 
            " \$isExist = $isExist ");
            break;
      }
   }

   public function Connection()
   {
      $this->bdd = new PDO('mysql:host='. $database_identifier['host'] .';dbname='. $database_identifier['dbname'] .";charset=". $database_identifier['charset'],
      $database_identifier['login'], $database_identifier['password']);
      $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public function Disconnection() {
      $this->bdd = NULL;
      $this->isConnected = 0;
   }

   public function Bdd(){
      return $this->bdd;
   }
   public function isConnected($oBDD)
   {
      return $this->isExist;
   }

//Private function
   private static function IsExist(){
      /*If it's possible to use the specified db, the db is already created, put the bool at TRUE
      //If it's impossible, the db must be creaed by the script, put the bool at FALSE
      */
      try {
         $bdd->exec('use '.$database);
         $isExist = TRUE;
      } catch(PDOException $e){
         $exeption['message'] = $e->getMessage();
         $isExist = FALSE;
         die();
      }
   }

   private static function Setup(){

      try {
         $sql = $_SERVER["DOCUMENT_ROOT"]."/src/dbchrono.sql";
         $bdd->exec(file_get_contents($sql));
         log("info", "Server", "Localhost",
         "The DataBase nammed '$database' has been generated...", 
         "");
         return TRUE;
      } catch (PDOException $e) {
         log("error", "Server", "Localhost",
         __FILE__ ."/". __CLASS__, 
         " DB '$database' Setup failed ");
         return FALSE;
      }
   }

}
?>