<?php

/**
 * 
 ** Source for the getError: www.geeksforgeeks.org/how-to-get-numeric-index-of-associative-array-in-php/
 */
trait Json
{
    //Variables
        //General
            private $json;
            private $error=[];
        //__construct()
            private $pathUser;
            private $pathFull;
        //getError()
            private $output;

    //Functions
        //Public
            public function __construct(string $path = null, string $style = null) {
                //* Getting content of the json config file and save value for future extract.
                $this->pathUser = $path;
                $this->pathFull = $_SERVER["DOCUMENT_ROOT"]."src/_". $this->pathUser .".json";
                $data = file_get_contents($this->pathFull);
                $retValData = ($data) ? $this->json = json_decode($data, true) : $this->error["Path Error"] = "Path Error";

                $this->error["Path Error"] = "Path Error";
            }

            public function getJson(){
                return (string) $this->json;
            }

            public function getPath(string $var = null) {
                return (string) $this->path;
            }

            public function getError(){   
                //Init variables
                $output ="";

                $output .= "<div class='JsonErrors'>";

                $error['k'] = array_keys($this->error);
                $error['v'] = array_values($this->error);
                $error['s'] = sizeof($error['k']);

                for ($error['number'] = 0; $error['number'] < $error['s']; $error['number']++) {
                    $output .= "Erreur n° ". ($error['number']+1) ." :"."<br/>";

                    foreach ($error['k'] as $error['kk'] => $error['kv']) {
                        if ($error['kk'] === $error['number']) {
                            switch (gettype($error['kv'])) {
                                case 'integer':
                                    break;

                                case 'string':
                                    $output .= $error['kv'] ." > ";
                                    break;
                                
                                default:
                                    return false;
                                    break;
                            }
                            
                        }
                    }


                    foreach ($error['v'] as $error['vk'] => $error['vv']) {
                        if ($error['vk'] === $error['number']) {
                            $output .=  $error['vv'];
                            if ($error['number'] <> ($error['s'])-1) {$output .= "<br/>";}
                        }
                    }

                    if ($error['number'] <> ($error['s'])-1) {$output .= "<br/>";}
                }
                $output .= "</div>";

                echo "$output";
                $this->output = $output;
            }

            public function getStyle()
            {
                # code...
            }

            public function setStyle(array $var = null)
            {
                # code...
            }
            
}
