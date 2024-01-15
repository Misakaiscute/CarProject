<?php
function getCsvData($filename)
{
    if (!file_exists($filename)) {
        echo "$filename nem található";
        return false;
    }
    $csvFile = fopen($filename, 'r');
    $lines = [];
    while (!feof($csvFile)) {
        $line = fgetcsv($csvFile);
        $lines[] = $line;
    }
    fclose($csvFile);

    return $lines;
}

function getMakers($csvData): array
{
    $header = $csvData[0];
    $idxMaker = array_search('make', $header);

    $isHeader = true;

    $result = [];
    $maker = '';

    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }
        if ($maker != $data[$idxMaker]) {
            $maker = $data[$idxMaker];
            $result[] = $maker;
        }
    }
    return $result;
}
function getModels($csvData): array
{
    $header = $csvData[0];
    $idxModel = array_search('model', $header);
    $idxMaker = array_search('make', $header);

    $isHeader = true;

    $oneMakersModels = [];
    $result = [];
    $maker = '';
    $makerId = 1;

    foreach ($csvData as $data) {
        if (!is_array($data)) {
            continue;
        }
        if ($isHeader) {
            $isHeader = false;
            continue;
        }
        if ($maker != $data[$idxMaker] && !empty($oneMakersModels)){
            $result[$makerId] = $oneMakersModels;
            $makerId++;
        } else {
            $maker = $data[$idxMaker];
            $model = $data[$idxModel];
            $oneMakersModels[] = $model;
        }
    }
    return $result;
}
