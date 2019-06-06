<html>
<head>
<title>CitiBike Project</title>
  <style type="text/css">
    body {
    font-family: "Lora";
    color: 11111;
    background-color: #add8e6; 
    }
    #wrapper {
    width: 100%;
    border: 4px solid 11111;
    overflow: hidden; 
    }
    .boxOne {
    width: 40%;
    height: 1300px;
    border-left:3px dotted 11111;
    float: left;
    padding-left: 1em;
    padding-right: 1em;
    }
    .boxTwo {
    width: 40%;
    height: 1235px;
    border-left:3px dotted 11111;
    padding-top: 4em;
    padding-left: 1em;
    padding-right: 1em;
    float: left;
    }
  </style>
</head>
<body>
<?php
//Credentials
$dbhost = 'blue.cs.sonoma.edu';
$dbuser = 'fvaldeca';
$dbpass = 'va0641';
$dbname = 'fvaldeca';
//Create a database connection
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$query = $_POST["message_body"];
$word = "";
$count = 0;
while ($query[$count] != ' ' && $query[$count] != NULL){
    $word .= $query[$count];
    $count++;
}
if(strtolower($word) != 'drop'){
    $result = mysqli_query($link,$query);
}
?>
<div class="boxOne">
<form action="" method="POST">
      <h1>CitiBike Project</h1>
      <h2>By: Conrad, Biraj, Nicky</h2>
      <h3>Enter your SQL query:</h3>
      <textarea rows="8" cols="30" name="message_body"></textarea>
      <p></p>
      <input type="submit" name="submit" value="Submit" />
      <p>Errors: 
      <?php
      if (strtolower($word) == "drop"){
            printf("Unable to use drop statements");
        }
      if (!$result){
            echo mysqli_error($link);
        }
      ?>
      </p>
</form>
</div>

<div class="boxTwo">
<h2>Results:</h2>
<p>
<?php
//if($result){
    if(strtolower($word) == "select"){
        printf("Rows Retrieved: %d", mysqli_affected_rows($link));
        echo "<br>";
        $table=mysqli_fetch_field($result);
        printf("Table Name: %s\n", $table->table);
        echo "<br>";
        while ($fieldinfo=mysqli_fetch_field($result)){
            printf("%s\n",$fieldinfo->name);
        }
        echo "<br>";
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            for ($i = 0; $i < sizeof($row); $i++)
            {
              echo "<td>" . $row[$i] . "</td>";
            }
            echo "</tr>";
        }
    }
    if(strtolower($word) == "create"){
        printf("Table Created");
    }
    if(strtolower($word) == "update"){
        printf("Table Updated");
    }
    if(strtolower($word) == "insert"){
        printf("Row Inserted");
    }
    if(strtolower($word) == "delete"){
        printf("Number of Rows deleted: %d", mysqli_affected_rows($link));
    }
    mysqli_free_result($result);
    mysqli_close($link);
//}
?>
</p>
<br>
</div>
</div>
</body>
</html>

