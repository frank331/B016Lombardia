<html>
<head>
<title>Prova Lombardia</title>
</head>
<body>
<h2>Componenti per provincia</h2>
<?php
require_once 'connection.php';

//handling page limit
$limit = $_GET['limit'];
$limit = $limit == null ? 20 : $limit;
$page = $_GET['page'];
$page = $page == null ? 1 : $page;
$lowerLimit = $page > 1 ? ($page - 1) * $limit : 1; 
$upperLimit = $limit * $page;

//handling page navigation
$query = 'select count(*)
    from prova_lombardia.componente c
    where c.res_prov = \'' . $_GET['provincia'] . '\'';
$result = $connect->query($query);
$row = $result->fetch_row();
$numOfRecords = $row[0];
$numOfPages = ceil($numOfRecords / $limit);
//form for page navigation:
?>
<form action="/provincia.php" method="GET">
  <input type="hidden" name="provincia" id="provincia" value="<?php echo $_GET['provincia'] ?>">
  <input type="hidden" id="limit" name="limit" value="<?php echo $_GET['limit'] ?>">
  Pagina: <?php echo $page.' di '.$numOfPages ?> &ensp;-&ensp;Vai a:  
  <?php
  if ($page-1 >= 1)
    echo '<input type="submit" name = "page" value="'.($page-1).'">';
  if ($page+1 <= $numOfPages)
    echo '<input type="submit" name = "page" value="'.($page+1).'">';
  ?>
</form>
<?php

//query for actual result
$query = 'select *
    from (
      select row_number() OVER(ORDER BY c.pk_componente) AS rowNumber, c.* 
        from prova_lombardia.componente c
        where c.res_prov = \'' . $_GET['provincia'] . '\'
        ) t2
        where t2.rowNumber BETWEEN '.$lowerLimit.' and '.$upperLimit.';';
$result = $connect->query($query);
echo '<table style="border: 1px solid; border-collapse: collapse;">';
while ($row = $result->fetch_row()){
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