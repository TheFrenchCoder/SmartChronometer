<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/php/json/Json.Trait.php";
class DataBase
{
   use Jsonable;

//Variables
   /*List of all name of function's parameters:
      * The prefix are: [Db(Database), Stm(Query)]
      * 
      * DbName
      * DbLogin
      * DbPassword
   */

   //Construct
   /*private $constructStructureParams = 
            [ 
            "login" => ["username", "password"],
            "host" => ["motor", "host", "dbname", "charset"]
            ];
      private $constructDefaultParams = 
         [ 
         "login" => ["root", "espace21"],
         "dnsVariables" => ["motor" => "mysql", "adresse" => "localhost", "dbName" => "dbchrono", "charset" => "utf8"],
         "dns" => "mysql:host=localhost;dbname=;charset=utf8"
         ];*/
      private $constructListParams = [];
      private $constructUserParams = [];
      //private $constructStructureParam, $value1, $key, $value2;

   //Database general
   private $isConnected;
   private $PDO;
   //Setup
   private $isExist;
   private $exeption = array();

//Functions
   //Public

   public function __construct($userParams = []) {

      echo getJson("database")['_comment_database'];

      foreach ($this->constructStructureParams as $constructStructureParam => $value1) {
         if (gettype($value1) ===  "array") {
            foreach ($value1 as $key => $value2) {
               $this->constructListParams[] = $value2;
            }
         }
         $this->constructListParams[] = $value1;
      }
      var_dump($constructStructureParams);
      var_dump($this->constructListParams);

      // Variables processing...
      $retValDbName = ($DbName == null) ?: $this->database['dbname'] = $DbName;
      $retValLogin = ($Login == null) ?: $this->database['login'] = $Login;
      $retValPassword = ($Password == null) ?: $this->database['password'] = $Password;
      $this->database['host'] = 'mysql:host=localhost;dbname=' .$DbName. ';charset=utf8';

      $this->isConnected = TRUE;
      $this->instance = new PDO($this->database['host'], $this->database['login'], $this->database['password']);
      $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->instance->exec('USE `'.$this->dbname.'`');
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
      return (object) $this->instance;
   }

   public function isConnected($oBDD)
   {
      return (bool) $this->isExist;
   }

//Private function
   private function _IsExist($DbName, $DbObject){
      try {
         $instance->exec('use '.$database);
         $isExist = TRUE;
      } catch(PDOException $e){
         $exeption['message'] = $e->getMessage();
         $isExist = FALSE;
         die();
      }
   }
}