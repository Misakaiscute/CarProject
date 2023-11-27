<?php
ini_set('memory_limit', '-1');
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

$carsData = getCsvData("car-db.csv")[0];
$header = getCsvData("car-db.csv")[1];

$brandKey = array_search('make', $header);
$modelKey = array_search('model', $header);

function getData($carsData, $brandKey, $modelKey){
    $result = [];
    foreach ($carsData as $oneLine){
        $maker = $oneLine[$brandKey];
        $model = $oneLine[$modelKey];
        $result[$maker] = $model;
    }
    return[$result];
}
getCsvData('car-db.csv');
$result = getData($carsData, $brandKey, $modelKey);



