<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recipe $recipe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Recipes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="recipes form large-9 medium-8 columns content">
    <?= $this->Form->create($recipe) ?>
    <fieldset>
        <legend><?= __('Add Recipe') ?></legend>
        <?php
            echo $this->Form->control('recipes_name');
            echo $this->Form->control('category',array('type'=>'select','options'=>$category)); 
            echo $this->Form->control('preparation_method');
        ?>
        
        
       
    </fieldset>
    
    <table id="recipeTable">
    <tr>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]','onchange'=>'change()')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('name'=>'qty[]')); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]','onchange'=>'change()')); ?></td>
    </tr>
    <input type="button" onclick="myFunction()" value="Add row" > 
    
    
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
   
    var row = table.insertRow(0).innerHTML = '<tr> \
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]')); ?></td> \
    <td><?php echo $this->Form->control('quantity', array('name'=>'qty[]')); ?></td> \
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]')); ?></td> \
    </tr>';
    }
  function change() 
	{
	//console.log("bbb");
	var item_select_box=document.getElementById('item-id');
	var unit_select_box=$('#unit-id');
	
	unit_select_box.empty();
	
	var myobject = {
	ValueA : 'carton',
	ValueB : 'kg',
	ValueC : 'grams'
	};
	
	console.log(myobject);
	for(index in myobject)
		{
			console.log(index);
		
			unit_select_box.append("<option value=" + index + ">" + myobject[index] + "</option>");
			
		}
	}
	
	
	
	</script>