<?php
class DataBase
{

//Variables
   //Database general
   private $isConnected;
   private $instance = null;
   private $database = array(
         "host" => "mysql:host=localhost;dbname=dbchrono;charset=utf8",
         "dbname" => "dbchrono",
         "charset" => "utf8",
         "login" => "root",
         "password" => "espace21"
      );
   //Setup
   private $isExist;
   private $exeption = array();

//Public function

   public function __construct($DbName = null, $Login = null, $Password = null) {
      // Variables processing...
      $retValDbName = ($DbName == null) ?: $this->database['dbname'] = $DbName;
      $retValLogin = ($Login == null) ?: $this->database['login'] = $Login;
      $retValPassword = ($Password == null) ?: $this->database['password'] = $Password;
      $this->database['host'] = 'mysql:host=localhost;dbname=' .$DbName. ';charset=utf8';

      $this->isConnected = TRUE;
      $this->instance = new PDO($this->database['host'], $this->database['login'], $this->database['password']);
      $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public function Main(){

      DataBase::IsExist();

   }

   public function Connection()
   {
      $this->instance = new PDO('mysql:host='. $database_identifier['host'] .';dbname='. $database_identifier['dbname'] .";charset=". $database_identifier['charset'],
      $database_identifier['login'], $database_identifier['password']);
      $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public function Disconnection() {
      $this->instance = NULL;
      $this->isConnected = 0;
   }

   public function getInstance() {
      return $this->instance;
   }

   public function isConnected($oBDD)
   {
      return $this->isExist;
   }

//Private function
   private static function _IsExist(){
      /*If it's possible to use the specified db, the db is already created, put the bool at TRUE
      //If it's impossible, the db must be creaed by the script, put the bool at FALSE
      */
      try {
         $instance->exec('use '.$database);
         $isExist = TRUE;
      } catch(PDOException $e){
         $exeption['message'] = $e->getMessage();
         $isExist = FALSE;
         die();
      }
   }

   private function _Setup(){

      try {
         $sql = $_SERVER["DOCUMENT_ROOT"]."/src/dbchrono.sql";
         $instance->exec(file_get_contents($sql));
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