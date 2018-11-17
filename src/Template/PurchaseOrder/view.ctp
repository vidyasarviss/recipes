<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchaseOrder $purchaseOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Order'), ['action' => 'edit', $purchaseOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Order'), ['action' => 'delete', $purchaseOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Order'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseOrder view large-9 medium-8 columns content">
    <h3><?= h($purchaseOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $purchaseOrder->has('item') ? $this->Html->link($purchaseOrder->item->item_name, ['controller' => 'Items', 'action' => 'view', $purchaseOrder->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseOrder->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Units') ?></th>
            <td><?= $this->Number->format($purchaseOrder->units) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($purchaseOrder->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($purchaseOrder->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Warehouses') ?></th>
            <td><?= $this->Number->format($purchaseOrder->warehouses) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($purchaseOrder->amount) ?></td>
        </tr>
    </table>
</div>

