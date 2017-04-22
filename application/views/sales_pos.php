<?php echo form_open('sales/pos',array('id'=>'frmPos','method'=>'post')); ?>
<div id="outer" style="position:relative">
	<div id="inner1" style="position: relative;
			width: 100%;
			height: 15px;
			font-family: Arial; 
			font-size: 10pt;
			border-style: solid;
			border-color: #D4E6F4;
			">
		 
		<?php 
			echo "User: ";
			echo ucfirst($_SESSION['user_name']);
			echo "&nbsp &nbsp &nbsp";
			//echo '<time datetime="'.date('c').'">'.date('Y - m - d').'</time>';
			echo "&nbsp &nbsp &nbsp";
			echo "Session start time: ";
			//echo "&nbsp &nbsp &nbsp";
			//echo "<br />";
			echo date('l jS \of F Y h:i:s A');
			//date('l jS \of F Y h:i:s A');
		
		?><br />
	</div>
	<div id="inner2">
		<input type="submit" name="submit" value="Complete Sale" />
		
	</div>
	<div id="inner3"
		align="left"
		style="position: absolute;
			top: 43px;
			left: 0;
			width: 260px;
			height: 54px;
			border-style: solid;
			border-color: #D4E6F4;
			overflow-x:auto;
			overflow-y:auto;
			">
		<?php 
			echo 'Trans. No.: ';
			echo $trans_no;
		?>
		<input type="hidden" name="transNumber" id="transNumber" value="<?php $trans_no; ?>">
		<input type="text" name="bar_code" id="bar_code" value="bar code" size="34" />
	</div>		
			
	<div id="inner4"
		align="right"
		style="position: absolute;
			top: 43px;
			left: 241px;
			width: 289px;
			height: 54px;
			border-style: solid;
			border-color: #D4E6F4;
			overflow-x:auto;
			overflow-y:auto;
			">
		<table>
			<tr>
				<th width="90px" align="right"> Subtotal </th>
				
				<th width="60px" align="right"> Tax </th>
				
				<th width="90px" align="right"> Total </th>
			</tr>
			<tr>
				<td align="right">
					<?php
						echo $subtotal;
					?>	
				</td>
				
				<td align="right">
					<?php
						echo $total_taxes;
					?>	
				</td>
				
				<td align="right">
					<?php
						echo $total;
					?>	
				</td>
			</tr>
		</table>
	</div>

	<div id="inner5"	
		style="position: absolute;
			top: 99px;
			left: 0;
			width: 550px;
			height: 300px;
			border-style: solid;
			border-color: #D4E6F4;
			overflow-x:auto;
			overflow-y:auto;
			">
		<table>
			<tr>
				<th width="40px" align="left">Action</th>
				<th width="300px" align="left">Item</th>
				<th width="30px" align="right">Price</th>
				<th width="30px" align="right">Units</th>
				<th width="30px" align="right">Taxes</th>
				<th width="60px" align="right">Value</th>
			</tr>
			
			
			<?php
/*			
			foreach ($pos_qry_result->result() as $pos) {
				$table_row = NULL;
				$table_row[] = '<nobr>' . 
				anchor('pos/edit/' . $pos->id, 'edit') . ' | ' .
				anchor('pos/delete/' . $pos->id, 'delete',
					"onClick=\" return confirm('Are you sure you want to '
					+ 'delete the record for $pos->item?')\"") .
					'</nobr>';
				// replaced above :: $table_row[] = anchor('admin/edit/' . $admin->id, 'edit');
				$table_row[] = $pos->item;
				$table_row[] = $pos->price;
				$table_row[] = $pos->qty;
				$table_row[] = $pos->tax;
				$table_row[] = $pos->value;
      
				$this->table->add_row($table_row);
			}
*/			
			?>
		</table>
	</div>
	
</div>