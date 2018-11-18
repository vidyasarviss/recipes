<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrder $purchaseOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchaseOrder->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrder->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Order Items'), ['controller' => 'PurchaseOrderItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Order Item'), ['controller' => 'PurchaseOrderItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseOrder) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Order') ?></legend>
        <?php
            echo $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => true]);
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('required_date');
            
        ?>
    </fieldset>
    <table id="purchase_ordersTable">
    <?php
    foreach ($purchaseOrder->purchase_order_items as $purchaseOrderItem)
    {
    ?>
    <tr>
    <td><?php echo $this->Form->control('checkbox',array('type'=>'checkbox','name'=>'chk[]','id'=>$puchase_order_item->id));?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items,'default'=>$puchase_order_item->item_id, 'name'=>'items[]','onchange'=>'change(this)'));?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'default'=>$puchase_order_item->item_id,'name'=>'units[]')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('name'=>'qty[]','default'=>$puchase_order_item->quantity)); ?></td>
    <td><?php echo $this->Form->control('rate'); ?></td>
    <td><?php echo $this->Form->control('warehouse_id',array('type'=>'select','options'=>$warehouses, 'name'=>'warehouses[]')); ?></td>
    <td><?php echo $this->Form->control('amount'); ?></td>
    </tr>
    
    <?php
    }
    ?>
    <input type="button" onclick="add_row()" value="Add Row" >
    <input type="button" id="delrtbutton" value="Delete row" onclick="check()"> 
    
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
   
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
 <script>
 
        var item_select_box=document.getElementById('item-id');
        window.onload=change(item_select_box);
        
 	function add_row()
 	{
 	var units = <?php echo json_encode($units)?>;
	var unit_options = "";
	for(var k in units)
	{
	unit_options+= "<option value=' "+ k +" '>" +units[k]+ "</option>";
	}
	
	
	var items = <?php echo json_encode($items) ?>;
	var item_options = "";
	for(var k in items)
	{
	item_options+= "<option value=' "+ k +" '>" +items[k]+ "</option>";
	}
	var table = document.getElementById("purchase_ordersTable");
    var no_of_rows=$('#recipeTable tr').length;
    var row = table.insertRow().innerHTML = '<tr>\
    <td><select name="items[]" onchange="change(this)" id=item-id'+(no_of_rows)+'>'+item_options+'</select></td>\
    <td><select name="units[]" id=unit-id'+(no_of_rows)+'>'+unit_options+'</select></td>\
    <td><?php echo $this->Form->control('', array('name'=>'qty[]')); ?></td>\
    <td><?php echo $this->Form->control(''); ?></td>\
    <td><?php echo $this->Form->control('',array('type'=>'select','options'=>$warehouses, 'name'=>'warehouses[]')); ?></td>\
    <td><?php echo $this->Form->control(''); ?></td>\
    </tr>';
    }
    
function change(element) 
	{
	//console.log("bbb");
	var item_select_box=document.getElementById(element.id);
	
	//this will give the selected dropdown value,tht is item id
	
	var selected_value=item_select_box.options[item_select_box.selectedIndex].value;
	console.log(selected_value);
	current_row=element.id[element.id.length -1];
	
	console.log(current_row);
	
	if(current_row =="d"){
	var unit=$('#unit-id');
	 unit.empty();
	}
	else{
	var unit_select_box=$('#unit-id'+current_row);
	unit_select_box.empty();
	}
	
	$.ajax({
			type: 'get',
			url: '/purchase-orders/getunits',
		 	data: { 
		    itemid: selected_value
		  	},
			beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
		success: function(response) {
			if (response.error) {
				alert(response.error);
				console.log(response.error);
			}
			if(response){
			if(current_row=="d"){
				for(var k in response){
					$("#unit-id").append("<option value=' "+ k +" '>" +response[k]+ "</option>");
			      	}
			  	}
			else{
				for(var k in response)
				{
			   	$("#unit-id"+current_row).append("<option value=' "+ k +" '>" +response[k]+ "</option>");
			  	}
				}
		}
		}
		
	});	
  
	}
	
	</script>