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
    <table>
    <?php
    foreach($recipe->ingredients as $ingredient)
    {
    ?>
    <tr>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>$ingredient->item_id, 'name'=>'items[]')); ?></td>
    <td><?php echo $this->Form->control('quantity',  array('name'=>'qty[]'));; ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>$ingredient->item_id, 'name'=>'units[]')); ?></td>
    </tr>
    <?php
    }
    ?>
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
