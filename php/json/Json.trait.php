<?php

/**
 * 
 ** Source for the getError: www.geeksforgeeks.org/how-to-get-numeric-index-of-associative-array-in-php/
 */
trait Jsonable
{
    //Variables
        //General
            private $json;
            private $errors=[];
            private $infos=[];
        //__construct()
            private $pathUser;
            private $pathFull;
        //getError()
            private $output;
            private $style;

    //Functions
        //Public
            public function __construct(string $path = null, string $style = null) {
                //* Getting content of the json config file and save value for future extract.
                $this->pathUser = $path;
                $this->pathFull = $_SERVER["DOCUMENT_ROOT"]."/src/_". $this->pathUser .".json";
                $data = file_get_contents($this->pathFull);
                $this->json = json_decode($data, true);
                $retValData = ($this->json) ? $this->infos["Succes __construct"] ="" : $this->errors["Path Error"] = "Path Error";
            }

            public function getJson(){
                return (array) $this->json;
            }

            public function getPath(string $var = null) {
                return (string) $this->path;
            }

            public function getErrors(){   
                //Init variables
                $output ="";

                $output .= "<div class='JsonErrors'>";

                $errors['k'] = array_keys($this->errors);
                $errors['v'] = array_values($this->errors);
                $errors['s'] = sizeof($errors['k']);

                for ($errors['number'] = 0; $errors['number'] < $errors['s']; $errors['number']++) {
                    $output .= "Erreur n° ". ($errors['number']+1) ." :"."<br/>";

                    foreach ($errors['k'] as $errors['kk'] => $errors['kv']) {
                        if ($errors['kk'] === $errors['number']) {
                            switch (gettype($errors['kv'])) {
                                case 'integer':
                                    break;

                                case 'string':
                                    $output .= $errors['kv'] ." > ";
                                    break;
                                
                                default:
                                    return false;
                                    break;
                            }
                            
                        }
                    }


                    foreach ($errors['v'] as $errors['vk'] => $errors['vv']) {
                        if ($errors['vk'] === $errors['number']) {
                            $output .=  $errors['vv'];
                            if ($errors['number'] <> ($errors['s'])-1) {$output .= "<br/>";}
                        }
                    }

                    if ($errors['number'] <> ($errors['s'])-1) {$output .= "<br/>";}
                }
                $output .= "</div>";

                echo "$output";
                $this->output['errors'] = $output;
            }

            public function getInfos(){   
                //Init variables
                $output ="";

                $output .= "<div class='JsonInfos'>";

                $infos['k'] = array_keys($this->infos);
                $infos['v'] = array_values($this->infos);
                $infos['s'] = sizeof($infos['k']);

                for ($infos['number'] = 0; $infos['number'] < $infos['s']; $infos['number']++) {
                    $output .= "Erreur n° ". ($infos['number']+1) ." :"."<br/>";

                    foreach ($infos['k'] as $infos['kk'] => $infos['kv']) {
                        if ($infos['kk'] === $infos['number']) {
                            switch (gettype($infos['kv'])) {
                                case 'integer':
                                    break;

                                case 'string':
                                    $output .= $infos['kv'] ." > ";
                                    break;
                                
                                default:
                                    return false;
                                    break;
                            }
                            
                        }
                    }


                    foreach ($infos['v'] as $infos['vk'] => $infos['vv']) {
                        if ($infos['vk'] === $infos['number']) {
                            $output .=  $infos['vv'];
                            if ($infos['number'] <> ($infos['s'])-1) {$output .= "<br/>";}
                        }
                    }

                    if ($infos['number'] <> ($infos['s'])-1) {$output .= "<br/>";}
                }
                $output .= "</div>";

                echo "$output";
                $this->output['infos'] = $output;
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
