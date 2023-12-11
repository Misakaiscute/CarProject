<html>
<head>
    <meta charset="utf-8">
    <title>Autók</title>

    <script src="js/jquery-3.7.1.js" type="text/javascript"></script>
    <script src="js/cars.js" type="text/javascript"></script>

    <link rel="stylesheet" href="fontawesome/css" type="text/css">
    <link rel="stylesheet" href="css/cars.css" type="text/css">
</head>
<body>
    <nav>
        <a href="index.php"><i class="fa fa-home" title="Kezdőlap"></i></a>
        <a href="makers.php"><button>Gyártók</button></a>
        <a href="models.php"><button>Modellek</button></a>
    </nav>
    <h1>Gyártók</h1>
    <?php
        require_once 'DBMaker.php';
        $DBMaker = new DBMaker();
        $abc = $DBMaker->getABC();
        echo "<div style='display: flex'>";
        foreach ($abc as $char) {
            echo
            "
                <form method='post' action='makers.php'>
                    <input type='hidden' name='ch' value='{$char['ch']}'>
                    <button type='submit'>{$char['ch']}</button>
                </form>
            ";
        }
        echo "</div><br>";

    if (isset($_POST['ch'])){
        $ch = $_POST['ch'];
        $makers = $DBMaker->getByFirstCh($ch);
        echo "
            <table>
                <thead><tr><th>#</th><th>Megnevezés</th><th>Művelet</th></tr>
                    <tr colspan='3'><input type='search' name='needle'><button></button></tr>
                    <tr id='editor' style='display: none'>
                        <input type='hidden' name='id' id='id'>
                        <th colspan='3'>
                            <input type='search' id='edit-box' name='name'>
                            <button id='btn-save' title='Ment'><i class='fa fa-save'></i></button>
                            <button id='btn-cancel' title='Mégse'><i class='fa fa-cancel'></i></button>
                        </th>
                    </tr>
                </thead>
            <tbody>";
        foreach ($makers as $maker){
            $id = $maker['id'];
            $name = $maker['name'];
            echo "<tr>
                <td>$id</td>
                <td>$name</td>
                <td>Mod / Del</td>
            </tr>";
        }
        echo "</tbody></table>";
    }
    ?>
</body>
</html>