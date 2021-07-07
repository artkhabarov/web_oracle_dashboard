<h1>Статистика отборов</h1>
 <h4>Период: <?php echo date("d.m.Y 00:00:00 - "); ?><?php echo date("d.m.Y H:i:s"); ?></h4>
 
<div id="worker_move">
<h3>Количество перемещений груза:</h3>
	<?php 
		$conn = odbc_connect ("WMSDB", "wms", "oracle");
		$sql_work = "select al.OP_TYPE_NAME, al.OPERATOR, count(*)operator, w.NAME, w.FIO
					from ACTIVITY_LOG al, worker w
					where al.OP_TIME > (select to_date(sysdate) from dual) AND al.WMS_WHS_ID=0 AND al.op_type_name='mls_move_load'
					AND w.name=al.operator
					group by al.OPERATOR, al.OP_TYPE_NAME, w.NAME, w.FIO
					order by w.FIO;";
		$rs_work = odbc_exec($conn,$sql_work);
		if($sql_work) 
		{
			echo '<table class="work">';
			echo "<tr><th>ФИО</th><th>Перемещений</th></tr>";
			while(odbc_fetch_array($rs_work))
			{
				echo '<tr class="work1"><td>'.iconv('Windows-1251','UTF-8', odbc_result($rs_work,5))."</td>
										
										<td>".odbc_result($rs_work,3)."</td>

				</tr>";
			}
			echo "</table>";			
		}
		else
		{
			echo "<p><b>Ошибка выполнения запроса</b><p>";
			exit();
		}
	?>
</div>

<div id="worker_pick">
<h3>Количество отборов груза:</h3>
	<?php 
		$sql_work = "select al.OP_TYPE_NAME, al.OPERATOR, count(*)operator, w.NAME, w.FIO
					from ACTIVITY_LOG al, worker w
					where al.OP_TIME > (select to_date(sysdate) from dual) AND al.WMS_WHS_ID=0 AND al.op_type_name='mls_picked_load'
					AND w.name=al.operator
					group by al.OPERATOR, al.OP_TYPE_NAME, w.NAME, w.FIO
					order by w.FIO;";
		$rs_work = odbc_exec($conn,$sql_work);
		if($sql_work) 
		{
			echo '<table class="work">';
			echo "<tr><th>ФИО</th><th>Отобрано</th></tr>";
			while(odbc_fetch_array($rs_work))
			{
				echo '<tr class="work1"><td>'.iconv('Windows-1251','UTF-8', odbc_result($rs_work,5))."</td>

										<td>".odbc_result($rs_work,3)."</td>

				</tr>";
			}
			echo "</table>";			
		}
		else
		{
			echo "<p><b>Ошибка выполнения запроса</b><p>";
			exit();
		}
	?>
</div>

<div id="worker_receive">
<h3>Количество принятых грузов:</h3>
	<?php 
		$sql_work = "select al.OP_TYPE_NAME, al.OPERATOR, count(*)operator, w.NAME, w.FIO
					from ACTIVITY_LOG al, worker w
					where al.OP_TIME > (select to_date(sysdate) from dual) AND al.WMS_WHS_ID=0 AND al.op_type_name='mls_receive_pallet'
					AND w.name=al.operator
					group by al.OPERATOR, al.OP_TYPE_NAME, w.NAME, w.FIO
					order by w.FIO;";
		$rs_work = odbc_exec($conn,$sql_work);
		if($sql_work) 
		{
			echo '<table class="work">';
			echo "<tr><th>ФИО</th><th>Принято</th></tr>";
			while(odbc_fetch_array($rs_work))
			{
				echo '<tr class="work1"><td>'.iconv('Windows-1251','UTF-8', odbc_result($rs_work,5))."</td>									
										<td>".odbc_result($rs_work,3)."</td>

				</tr>";
			}
			echo "</table>";			
		}
		else
		{
			echo "<p><b>Ошибка выполнения запроса</b><p>";
			exit();
		}
	?>
</div>

<div id="worker_receive">
<h3>Отказы от работы:</h3>
	<?php 
		$sql_work = "select al.OP_TYPE_NAME, al.OPERATOR, count(*)operator, w.NAME, w.FIO
					from ACTIVITY_LOG al, worker w
					where al.OP_TIME > (select to_date(sysdate) from dual) AND al.WMS_WHS_ID=0 AND al.op_type_name='mls_worker_work_refuse'
					AND w.name=al.operator
					group by al.OPERATOR, al.OP_TYPE_NAME, w.NAME, w.FIO
					order by w.FIO;";
		$rs_work = odbc_exec($conn,$sql_work);
		if($sql_work) 
		{
			echo '<table class="work">';
			echo "<tr><th>ФИО</th><th>Отказов</th></tr>";
			while(odbc_fetch_array($rs_work))
			{
				echo '<tr class="work1"><td>'.iconv('Windows-1251','UTF-8', odbc_result($rs_work,5))."</td>
										<td>".odbc_result($rs_work,3)."</td>

				</tr>";
			}
			echo "</table>";			
		}
		else
		{
			echo "<p><b>Ошибка выполнения запроса</b><p>";
			exit();
		}
	?>
</div>

<?php odbc_close($conn); ?>