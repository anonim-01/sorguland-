<?php

error_reporting(0);

session_start();

include '../../server/database.php';

include '../../server/rolecontrol.php';

$sql = "SELECT * FROM messages ORDER BY time DESC LIMIT 5";
$stmt = $db->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {

?>
<div style="padding: 5px;">
<img src="<?= $row['image']; ?>" style="border-radius: 50%;" width=25 height=25>
&nbsp;
<?php

if ($row['admin'] == 1 && $row['premium'] == 1)
{
  echo '<span style="color: #FF0032;text-shadow: 0px 0px 20px #FF0032;">'.$row['username'].' [ADMIN]</span>';
} 
else if ($row['admin'] == 1 && $row['premium'] == 0)
{
  echo '<span style="color: #FF0032;text-shadow: 0px 0px 20px #FF0032;">'.$row['username'].' [ADMIN]</span>';
}
else if ($row['admin'] == 0 && $row['premium'] == 1)
{
  echo '<span style="color: gold;text-shadow: 0px 0px 20px gold;">'.$row['username'].' [VIP]</span>';
}
else
{
  echo '<span>'.$row['username'].'</span>';
}

?>
&nbsp;
<?= $row['message']; ?>
<span style="float: right;"><?= substr($row['time'], 10,10) ?></span></div>
<?php
}
?>