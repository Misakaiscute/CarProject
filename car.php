<?php
function getCsvData($fileName)
{
    if (!file_exists("$fileName")){
        echo "File nem található!";
        return false;
    }

    $file = fopen("$fileName", "r");
    $header = fgetcsv($file);
    $car = [];
    while (($data = fgetcsv($file)) !== false) {
        $car[] = $data;
    }
    fclose($file);

    return [$car, $header];
}

$data = getCsvData("car-db.csv")[0];
$header = getCsvData("car-db.csv")[1];

$brandKey = array_search('make', $header);
$modelKey = array_search('model', $header);

$car = [];
if (!empty($data)){
    $maker = '';
    $model = '';
    foreach ($data as $id => $line){
        if($maker != $line[$brandKey]){
            $maker = $line[$brandKey];
        }
        if($model != $line[$modelKey]){
            $model = $line[$modelKey];
            $car[$maker][] = $model;
        }
    }
}
