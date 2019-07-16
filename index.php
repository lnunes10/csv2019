<?php
main::start("SacramentocrimeJanuary2006.csv");
class main
{
    static public function start ($filename){
        $records=csv::getRecords($filename);
        html:: generateTable($records);

    }
}

}
class html {
    public static function generateTable($records){
        foreach ($records as $record){
            $fields=get_object_vars($record);
            print_r($fields);

        }
    }
class csv{
    static public function getRecords($filename){
        $file =fopen($filename,"r");
        $fieldNames=Array();
        $count=0;

        while (!feof($file)) {
            $record = fgetcsv($file);
            if ($count == 0)
            {
                $fieldNames = $record;
            }
            else{
                $records[] = recordFactory::create($fieldNames,$record);

            }
            $count++;

        }


        fclose($file);
        return $records;


    }

}
class record{
    public function __construct(Array $fieldNames =null,$values=null)
    {

        $record=array_combine($fieldNames,$values);
        $record=(object) $record;
        foreach ($record as $property=>$value){
            $this->createProperty($property,$value);

        }


    }
    public function returnArray(){
        $array =(array) $this;
        return $array;
    }
    public function createProperty($name='cdatetime',$value='address'){
        $this->{$name}=$value;

    }
}
class recordFactory{
    public static function create (Array $fieldNames =null, Array $values=null){

        $record=new record ($fieldNames,$values);

        return $record;
    }
}