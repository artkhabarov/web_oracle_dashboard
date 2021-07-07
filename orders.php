<h1>Отгрузка продукции</h1>
<h4>Дата: <?php echo date("d.m.Y H:i:s"); ?></h4>
 
<div id="orders_work">
<h3>Заказы в работе:</h3>
	<?php 
		$conn = odbc_connect ("WMSDB", "wms", "oracle");
		$sql_work = "select o.ID, cl.NAME, o.DATE_TO_SHIP, s.EXT_NAME, loc.NAME, o.COMPLETE, o.COMMENTS2, o.DATE_STARTED
		from orders o 
		left join STATUS s on (s.name=o.status)
		left join LOCATION loc on (loc.id=o.dock)
		left join CLIENT cl on (cl.id=o.client_id)
		where (o.STATUS='P' OR o.STATUS='D');";
		$rs_work = odbc_exec($conn,$sql_work);
		if($sql_work) 
		{
			echo '<table class="work">';
			echo "<tr><th>№ Заказа</th><th>Получатель</th><th>Планируемая отгрузка</th><th>Док</th><th>Комментарий</th><th>Запущен</th><th>Статус</th><th>Собран %</th></tr>";
			while(odbc_fetch_array($rs_work))
			{
				echo '<tr class="work1"><td>'.odbc_result($rs_work,1)."</td>
										<td>".iconv('Windows-1251','UTF-8', odbc_result($rs_work,2))."</td>
										<td>" .date('d.m.Y H:i:s', odbc_result($rs_work,3))."</td>
										<td>".iconv('Windows-1251','UTF-8', odbc_result($rs_work,5))."</td>
										<td>".iconv('Windows-1251','UTF-8', odbc_result($rs_work,7))."</td>
										<td>".date('d.m.Y H:i:s', odbc_result($rs_work,8))."</td>
										<td>".iconv('Windows-1251','UTF-8', odbc_result($rs_work,4))."</td>			
										<td>".odbc_result($rs_work,6)."</td>
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
<div id="orders_shipped">
<h3>Отгруженные заказы:</h3>	
	<?php 
		$sql_shipped = "select o.ID, o.DATE_SHIPPED, s.EXT_NAME, loc.NAME, o.COMMENTS2, cl.NAME, o.DATE_TO_SHIP
						from orders o 
						left join STATUS s on (s.name=o.status)
						left join LOCATION loc on (loc.id=o.dock)
						left join CLIENT cl on (cl.id=o.client_id)
						where o.status='+' AND o.DATE_STATUS_CHANGE > SYSDATE-1;";
		$rs_shipped = odbc_exec($conn,$sql_shipped);
		if($sql_shipped)
		{
			echo '<table class="shipped">';
			echo "<tr><th>№ Заказа</th><th>Получатель</th><th>Планируемая отгрузка</th><th>Отгружен</th><th>Док</th><th>Комментарий</th><th>Статус</th></tr>";
			while(odbc_fetch_array($rs_shipped))
			{
				echo "<tr><td>".odbc_result($rs_shipped,1)."</td>
						  <td>".iconv('Windows-1251','UTF-8', odbc_result($rs_shipped,6))."</td>
						  <td>" .date('d.m.Y H:i:s', odbc_result($rs_shipped,7))."</td>
						  <td>" .date('d.m.Y H:i:s', odbc_result($rs_shipped,2))."</td>
						  <td>".iconv('Windows-1251','UTF-8', odbc_result($rs_shipped,4))."</td>
						  <td>".iconv('Windows-1251','UTF-8', odbc_result($rs_shipped,5))."</td>
						  <td>".iconv('Windows-1251','UTF-8', odbc_result($rs_shipped,3))."</td>				  
					  </tr>";
			}
		}
		else
		{
			echo "<p><b>Ошибка выполнения запроса</b><p>";
			exit();
		}
		?>
</div>
<?php odbc_close($conn); ?>