<?php
require_once('DBMaker.php');
header('Content-Type: application/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="makers.csv"');
$dbMaker = new DBMaker();
$makers = $dbMaker->getAll();
$csvfile = fopen('php://output', 'w');
fputcsv($csvfile, ['ID', 'Name']);
foreach ($makers as $maker){
    fputcsv($csvfile, $maker);
}
fclose($csvfile);