<<?php
    class Ministry{
        public $code;
        private $name;
        public function __construct($code, $name)
        {
            $this->code = $code;
            $this->name = $name;
        }
        public function getCode(){
            return $this->code;
        }
        public function getName(){
            return $this->name;
        }  
    }
    $ministry = new Ministry(330,"Ministry of Information");
    echo "The name of the ministry 1 is ".$ministry->getName();
    echo "</br>";
    echo "The code of the first ministry is ".$ministry->getCode();
    $ministry2 = new Ministry(220,"Ministry of Finance");

?>