<p>
Notes on Point of Sales Program<br>
Date:  March 11, 2017<br><br>

Database name: Impacct/PosInventory<br>
Fields:<br>
	id: integer type; this is the record number<br>
	bar_code:  alphanumeric type; this is the item bar code<br>
	item_description: alphanumeric type;<br>
	qty_on_hand: integer type; this is the quantity on hand<br>
	cost: double type;  this is the cost of the item<br>
	price:  double type; this is the sales price of the item<br><br>

Database name: Impacct/PosSalesH – sales header<br>
Fields:<br>
	id: integer type; this is the record number<br>
	sales_date: date type (time stamp)<br>
	GSTtotal: double type;<br>
	GSTtotalTax: double type;<br>
	HSTtotal: double type; <br>
	HSTtotalTax: double type;<br>
	TaxExemptTotal: double type;<br><br>

Database name: Impacct/PosSalesD – sales detail<br>
Fields:	<br>
	id: integer type; this is the record number<br>
	sales_id: integer type; this is the id of the header<br>
	bar_code:  alphanumeric type; this is the item bar code<br>
	qty_sold: integer type; this is the quantity sold<br>
	sales_price: double type; this may be different from the price from inventory file but defaults to<br> 		it.<br>
</p>