<html>
<head>
<title>Prova Lombardia</title>
</head>
<body>
<h1>Prova Lombardia</h1>

<h3>Cerca nome o cognome</h3>
<form action="/searchNameLastName.php" method="GET">
  <label for="nome">Nome:</label><br>
  <input type="text" id="nome" name="nome" value="Daniela"><br>
  <label for="cognome">Cognome:</label><br>
  <input type="text" id="cognome" name="cognome" value="Moneta"><br><br>
  <input type="submit" value="Cerca">
</form>

<br>
<h3>Cerca gli appartenenti alla seguente provincia</h3>
<form action="/provincia.php" method="GET">
  <label for="provincia">Scegli provincia:</label>
  <select name="provincia" id="provincia">
    <?php
      require_once 'connection.php';
      $query = 'select res_prov from prova_lombardia.componente group by res_prov order by res_prov';
      $result = mysqli_query($connect, $query);
      while ($row = mysqli_fetch_array($result)){
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
      }
    ?>
  </select><br>

  <label for="limit">Record per pagina:</label>
  <input type="text" id="limit" name="limit" value="20" style="width:3em"><br>
  <input type="hidden" id="page" name="page" value="1"><br>
  <input type="submit" value="Cerca">
</form>
</body>
</html>