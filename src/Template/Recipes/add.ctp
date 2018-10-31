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
     
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items)); ?></td>
    <td><?php echo $this->Form->control('quantity');; ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units)); ?></td>
    </tr>
    
    
    <input type="button" onclick="add_row()" value="Add row">  
     
    
    </table>
    <script>
     function add_row()
	{
	var item=document.getElementById('recipeTable').add_row(0);
	var quantity = item.AddCell(0);
	var unit = item.AddCell(1);
	quantity.innerHTML="New Cell1";
	unit.innerHTML="New Cell2";
	}
	</script>
    
  
    
    
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
