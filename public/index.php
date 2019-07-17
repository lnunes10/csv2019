
<!-- call for HTML bootstrap style -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CSV file to HTML table</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title>1</title>
    <!-- Bootstrap CSS and other repositories -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.csheros" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- https://www.phpclasses.org/browse/file/116204.html used this website for the jumbotron code underneath -->
    <style>
        .jumbotron{margin:5px auto;padding:5px 5px; width:1200px;
    </style>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
    <h3>CSV file to HTML table</h3>
    <br/>

<?php
main::start("SacramentocrimeJanuary2006.csv");
class main  {
    static public function start($filename) {
        $records = csv::getRecords($filename);
         html::generateTable($records);
    }
}
class html {
    public static function generateTable($records) {
        $count = 0;
        foreach ($records as $record) {
            if($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);
                print_r($fields);
                print_r($values);
            } else {
                $array = $record->returnArray();
                $values = array_values($array);
                print_r($values);
            }
            $count++;
        }
    }
}
class csv {
    static public function getRecords($filename) {
        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file))
        {
            $record = fgetcsv($file);
            if($count == 0) {
                $fieldNames = $record;
            } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }
        fclose($file);
        return $records;
    }
}
class record {
    public function __construct(Array $fieldNames = null, $values = null )
    {
        $record = array_combine($fieldNames, $values);
        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }
    }
    public function returnArray() {

        $array = (array) $this;
        return $array;
    }
    public function createProperty($name = 'cdatetime', $value = 'address') {
        $this->{$name} = $value;
    }
}
class recordFactory {
    public static function create(Array $fieldNames = null, Array $values = null) {
        $record = new record($fieldNames, $values);
        return $record;
    }
}
