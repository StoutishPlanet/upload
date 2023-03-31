<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Lista de cotizaciones</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
      }
      
      #container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      }
      
      h1 {
        margin-top: 0;
        font-size: 28px;
      }
      
      label {
        display: block;
        margin-bottom: 5px;
      }
      
      input[type="text"],
      textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
      }
      
      textarea {
        height: 150px;
      }
      
      input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
      }
      
      input[type="submit"]:hover {
        background-color: #3e8e41;
      }
      
      a {
        display: inline-block;
        background-color: #fff;
        color: #4CAF50;
        border: 2px solid #4CAF50;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 20px;
      }
      
      a:hover {
        background-color: #4CAF50;
        color: #fff;
		
      }
	  table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #ddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
    </style>
</head>
<body>
  <?php
    // Conectarse a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "FiLe020594";
    $dbname = "cotizaciones";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    // Obtener los datos de la tabla
    $sql = "SELECT * FROM cotizaciones";
    $result = $conn->query($sql);
    
    // Mostrar los datos en una tabla
    if ($result->num_rows > 0) {
      echo "<table><tr><th>Destino</th><th>Comentarios</th><th>Disponibilidad</th><th></th></tr>";
      
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["destino"]."</td><td>".$row["comentarios"]."</td><td>".$row["disponibilidad"]."</td><td><form action='update.php?id=".$row["id"]."' method='post'><input type='hidden' name='id' value='".$row["id"]."'><a href ='update.php?id=".$row["id"]."'>Modificar</href></form></td>   <td> <form method='post' enctype='multipart/form-data' action='upload.php?id=".$row["id"]."'>
        <label>Selecciona un archivo:</label><br>
        <input type='file' name='archivo'><br>
        <input type='submit' value='Subir archivo'>
    </form></td>";


// Obtener la ruta de todas las imágenes con un ID específico
$id = 2;
$sql = "SELECT ruta FROM archivos WHERE id = $id";
$resultado = mysqli_query($conn, $sql);
// Mostrar las imágenes en el navegador
while ($fila = mysqli_fetch_array($resultado)) {
    $ruta = $fila['ruta'];
	echo "<td>";
    echo "<a href='$ruta'><img src='$ruta' width='100' height='100'></a>";
	echo"</td></tr>";
}


      }
      
      echo "</table>";
    } else {
      echo "No se encontraron cotizaciones.";
    }
    
    $conn->close();
  ?>
</body>
</html>
