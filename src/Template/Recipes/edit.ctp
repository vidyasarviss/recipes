<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recipe $recipe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $recipe->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $recipe->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Recipes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="recipes form large-9 medium-8 columns content">
    <?= $this->Form->create($recipe) ?>
    <fieldset>
        <legend><?= __('Edit Recipe') ?></legend>
        <?php
            echo $this->Form->control('recipes_name');
            echo $this->Form->control('category',array('type'=>'select','options'=>$category));
            echo $this->Form->control('preparation_method');
            
            
        ?>
    </fieldset>
        <table id="recipeTable">
    <?php
    foreach($recipe->ingredients as $ingredient)
    {
    ?>
    <tr>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>$ingredient->item_id, 'name'=>'items[]','onchange'=>'change()')); ?></td>
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]','default'=>$ingredient->quantity)); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>$ingredient->unit_id, 'name'=>'units[]')); ?></td>
    <td><input type="checkbox" value="check"></td>
    </tr>
    
    <?php
    }
    ?>
    <input type="button" onclick="myFunction()" value="Add row" >
    <input type="button" id="delrtbutton" value="Delete row" onclick="deleteRow(this)"> 
    
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
 <script>
 	function myFunction() {
    var table = document.getElementById("recipeTable");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var row = table.insertRow(0).innerHTML = '<tr>\
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>$ingredient->item_id, 'name'=>'items[]','onchange'=>'change()')); ?></td>\
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]'));; ?></td>\
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>$ingredient->unit_id, 'name'=>'units[]')); ?></td>\
    <td><input type="checkbox" value="check"></td>\
    </tr>';
    }
    
    function deleteRow(row)
	{
  	var i=row.parentNode.parentNode.rowIndex;
    document.getElementById("recipeTable").deleteRow(i);  
    
   	}
  
    
    function change() 
	{
	//console.log("bbb");
	var item_select_box=document.getElementById('item-id');
	//console.log(unit-id);
	var unit_select_box=$('#unit-id');
	
	unit_select_box.empty();
	
	$.ajax({
		type: 'get',
		url: '/recipes/getunits',
		  data: { 
		    itemid: item_select_box.value
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
			for(var k in response)
			{
			   $("#unit-id").append("<option value=' "+ k +" '>" +response[k]+ "</option>");
				}
			}
		}
		
	});	
	}
	
	</script>