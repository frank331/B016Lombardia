<?php
require_once 'connection.php';
$query = 'select * from prova_lombardia.componente where res_prov = \'' . $_GET['provincia'] . '\'';
$result = mysqli_query($connect, $query);
echo '<table style="border: 1px solid; border-collapse: collapse;">';
while ($row = mysqli_fetch_array($result)){
    echo '<tr>';
    for ($i = 0; $i < max(array_keys($row)); $i++){
        echo '<td style="border: 1px solid;">' . $row[$i] . '</td>';
    }
    echo '</tr>';
}
echo '</table>';
?>