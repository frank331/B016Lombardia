<html>

<body>
    <?php
    require_once 'connection.php';

    $test_query = "select * from $dbname.componente where nome like '%" . $_GET["nome"] . "%' and cognome like '%" . $_GET["cognome"] . "%'";
    $result = mysqli_query($connect, $test_query);

    if ($result == null || $result == false) {
        echo "Non sono stati trovati risultati per la seguente ricerca<br />";
    } else {
        echo "Sono stati trovati i seguenti risultati: <br />";

        $even = true;
        while ($tbl = mysqli_fetch_array($result)) {
            foreach($tbl as $col){
                if($even){
                    echo $col . "   |   ";
                    $even=false;
                } else{
                    $even=true;
                }
                
            }
            echo "<br />";
        }
    }
    mysqli_close($connect);
    ?>
</body>

</html>