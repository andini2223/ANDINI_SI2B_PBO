<?php
class Test
{
    public function __construct()
    {
        //Your logic for constructor
    }
    public function __call($Method_name , $parameter)
    {
        if($Method_name == "Function")
        {
            $count = count($parameter);
            switch($count)
            {
                case "1":
                    echo "You are passing 1 argument";
                    break;
                case "2": //Incase of 2 parameter
                    echo "You are passing 2 parameter";
                    break;
                default:
                    throw new exception("Bad argument");
            }
        }
        else
        {
            throw new exception("Function $Method_name does not exists ");
        }
    }
}
$a = new Test();
$a->Function("ankur");
$a->Function("techflirt", "ankur");
?>