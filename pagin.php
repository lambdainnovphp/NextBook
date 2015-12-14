<?php
error_reporting(0);
$query1=mysql_connect("localhost","root","");
mysql_select_db("jewellery",$query1);

$start=0;
$limit=10;

if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}

$query=mysql_query("select * from tb_product LIMIT $start, $limit");
echo "<ul>";
while($query2=mysql_fetch_array($query))
{
echo "<li>".$query2['title']."</li>";
}
echo "</ul>";

$rows=mysql_num_rows(mysql_query("select * from tb_product"));
$total=ceil($rows/$limit);

if($id>1)
{
echo "<a href='?id=".($id-1)."' class='button'>PREVIOUS</a>";
}


echo "<ul class='page'>";
for($i=1;$i<=$total;$i++)
{
if($i==$id) { echo "<li class='current'>".$i."</li>"; }

else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
}
echo "</ul>";

if($id!=$total)
{
echo "<a href='?id=".($id+1)."' class='button'>NEXT</a>";
}
?>