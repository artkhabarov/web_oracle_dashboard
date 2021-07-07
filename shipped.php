<!DOCTYPE html>
<html> 
<head>
<meta charset="UTF-8" />
<meta http-equiv="Refresh" content="3" />
<title>Отгружено ТЭП-50</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="orders_shipped">
<?php 
$conn1 = odbc_connect ("WMSDB_TEST", "wms_test", "password");
$sql_shipped = "select o.ID, o.DATE_SHIPPED, s.EXT_NAME, loc.NAME, o.COMMENTS2
from orders o 
left join STATUS s on (s.name=o.status)
left join LOCATION loc on (loc.id=o.dock)
where o.status='+' AND o.CREATED > SYSDATE-1";
$rs_shipped = odbc_exec($conn1,$sql_shipped);
$date_shipped = odbc_result($rs_shipped,2);
$status_shipped = odbc_result($rs_shipped,3);
$status_utf_shipped = iconv('Windows-1251','UTF-8', $status_shipped);
?>

 <table>
 <h3>Заказы отгружены:</h3>
 <tr><th>№ Заказа</th>
	 <th>Дата отгрузки</th>
	 <th>Статус</th>
	 <th>Док</th>
	 <th>Комментарий</th>
 </tr>
 <tr>
 <td><?php echo "".odbc_result($rs_shipped,1);?></td>
 <td><?php date('d.m.Y H:i:s', $date_shipped); ?></td>
 <td><?php echo "".$status_utf_shipped;?></td>
 <td><?php echo "".odbc_result($rs_shipped,4);?></td>
 <td><?php echo "".odbc_result($rs_shipped,5);?></td>
 </tr>
 </table>
 </div>
 <?php odbc_close($conn); ?>
</body>
 </html>
