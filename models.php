<?php
session_start();

require_once 'DBModels.php';
require_once 'Page.php';

include 'html-head.php';

$DBModels = new DBModels();
$isDBEmpty = $DBModels->getCount() == 0;

echo "<body>";
include "html-nav.php";
echo "<h1>Modellek</h1>";
Page::showExportImportButtons($isDBEmpty);

if (isset($_POST['ch'])){
    $ch = $_POST['ch'];
    $models = $DBModels->getByFirstCh($ch);
    $_SESSION['ch'] = $ch;
}
if (!$isDBEmpty) {
    Page::showSearchBar();
    $abc = $DBModels->getABC();
    Page::showAbcButtons($abc);
}

if (isset($_POST['btn-truncate'])){
    $DBModels->truncate();
    $_SESSION['ch'] = '';
    $models = [];
    header("Refresh:0");
}

if (isset($_POST['btn-del'])){
    $DBModels->delete($_POST['btn-del']);
    header("Refresh:0");
}

if(isset($_POST['input-file'])){
    require_once("csv-tools.php");
    $fileName = $_POST['input-file'];
    $csvData = getCsvData($fileName);
    if(empty($csvData)){
        echo "Nem található adat a csv fájlban";
        return false;
    }
    $models = getModels($csvData);
    $errors = [];
    $result = $DBModels->createDB($models);
    if(!$result) {
        $errors[] = $models;
    }
    header("Refresh:0");
}
if (!empty($_SESSION['ch']) && !$isDBEmpty) {
    $ch = $_SESSION['ch'];
    $models = $DBModels->getByFirstCh($ch);

    Page::showModelsTable($models);
}
echo "</body>";

include 'html-footer.php';