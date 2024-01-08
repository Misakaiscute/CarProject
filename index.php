
    <?php
        session_start();

        require_once 'DBMaker.php';
        require_once 'Page.php';

        include 'html-head.php';

        $DBMaker = new DBMaker();
        $isDBEmpty = $DBMaker->getCount() == 0;

    echo "<body>";
        include "html-nav.php";
        echo "<h1>Gyártók</h1>";
        Page::showExportImportButtons($isDBEmpty);

        if (isset($_POST['ch'])){
            $ch = $_POST['ch'];
            $makers = $DBMaker->getByFirstCh($ch);
            $_SESSION['ch'] = $ch;
        }

        if (!$isDBEmpty) {
            Page::showSearchBar();
            $abc = $DBMaker->getABC();
            Page::showAbcButtons($abc);
        }

        if (isset($_POST['btn-truncate'])){
            $DBMaker->truncate();
            $_SESSION['ch'] = '';
            $makers = [];
            header("Refresh:0");
        }

        if (isset($_POST['btn-del'])){
            $DBMaker->delete($_POST['btn-del']);
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
            $makers = getMakers($csvData);
            $errors = [];
            foreach ($makers as $maker){
                $result = $DBMaker->create(['name' => $maker]);
                if(!$result){
                    $errors[] = $maker;
                }
            }
            header("Refresh:0");
        }

        if (!empty($_SESSION['ch'])) {
            $ch = $_SESSION['ch'];
            $makers = $DBMaker->getByFirstCh($ch);

            Page::showMakersTable($makers);
        }
    echo "</body>";

    include 'html-footer.php';