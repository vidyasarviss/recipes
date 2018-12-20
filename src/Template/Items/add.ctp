<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Ingredients'), ['controller' => 'Ingredients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ingredient'), ['controller' => 'Ingredients', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create($item, array('id' => 'myForm')) ?>
    <fieldset>
        <legend><?= __('Add Item') ?></legend>
        <?php
            echo $this->Form->control('item_name');
	        echo $this->Form->input('purchase_unit',array('type'=>'select','options'=>$units));
	        echo $this->Form->input('sell_unit_qty',array('type'=>'number','min'=>'0.1000','max'=>'9999999999.99','step'=>'0.001'));
	        echo $this->Form->input('sell_unit',array('type'=>'select','options'=>$units));
	        echo $this->Form->input('usage_unit_qty',array('type'=>'number','min'=>'0.1000','max'=>'9999999999.99','step'=>'0.001'));	        
	        echo $this->Form->input('usage_unit',array('type'=>'select','options'=>$units));
	       
	        
	       ?>
    </fieldset>
    <?php ?>
    <input id="btnsubmit" name="btnsubmit" type="button" value="Submit" onclick="validate();"/>
    
   
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
 <script>
 
function validate()
	{
		var pu= document.getElementById("purchase-unit");
		var su= document.getElementById("sell-unit");
		var usg_u= document.getElementById("usage-unit");
		
		if (pu.value == usg_u.value)
			{
	        window.alert("purchase unit cannot be equal to usage unit");
	        return false ;
	        }
		if (su.value == usg_u.value)
			{
			window.alert("sell unit cannot be equal to usage unit");
	        return false ;
			}    
			document.getElementById("myForm").submit();
			
	 
   }
	
	
	
	
</script>