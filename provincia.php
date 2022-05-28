<html>
<head>
<title>Prova Lombardia</title>
</head>
<body>
<h2>Componenti per provincia</h2>
<form action="/provincia.php" method="GET">
  <input type="hidden" name="provincia" id="provincia" value="<?php echo $_GET['provincia'] ?>">
  <input type="hidden" id="limit" name="limit" value="<?php echo $_GET['limit'] ?>">
  Pagina: <?php echo $_GET['page'] ?>&ensp;-&ensp;Vai a:  
  <?php
  if ($_GET['page']-1 >= 1)
    echo '<input type="submit" name = "page" value="'.($_GET['page']-1).'">';
    ?>
  <input type="submit" name = "page" value="<?php echo $_GET['page']+1 ?>">
</form>
<?php
require_once 'connection.php';
$limit = $_GET['limit'];
$limit = $limit == null ? 20 : $limit;
$page = $_GET['page'];
$page = $page == null ? 1 : $page;
$lowerLimit = $page > 1 ? ($page - 1) * $limit : 1; 
$upperLimit = $limit * $page;
$query = 'select *
from (
	select row_number() OVER(ORDER BY c.pk_componente) AS rowNumber, c.* 
    from prova_lombardia.componente c
    where c.res_prov = \'' . $_GET['provincia'] . '\'
    ) t2
    where t2.rowNumber BETWEEN '.$lowerLimit.' and '.$upperLimit.';';
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
</body>
</html>