
<html>
<head>
</head>
<body>
<h1>Website with data from archived and links provided </h1>
</body>
</html>

<?php

// dependent on Text.txt file in the server created 
//from running the archived text data fetching code

$file = file_get_contents('./TEXT.txt', true); // contents from twxt file
echo $file;

// links from database
$con = new mysqli("localhost", "root", "12345", "links");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM link");

echo "<table border='1'>
<tr>
<th>links</th>

</tr>";
$i=0;
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['link'] . "</td>";
  $link_array[$i]=$row['link'];
  $i++;
  //echo "<td>" . $row['LastName'] . "</td>";
  echo "</tr>";
  }
//echo "</table>";

mysqli_close($con);

for ($j=0;$j<$i;$j++)
{
	//echo $link_array[$j];
	Echo "<a href=$link_array[$j]>$link_array[$j]</a>" ;
	//echo $j;
}

?>