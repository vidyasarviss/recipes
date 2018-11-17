<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrder Entity
 *
 * @property int $id
 * @property int $item_id
 * @property int $units
 * @property int $quantity
 * @property int $rate
 * @property int $warehouses
 * @property int $amount
 *
 * @property \App\Model\Entity\Item $item
 */
class PurchaseOrder extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'item_id' => true,
        'units' => true,
        'quantity' => true,
        'rate' => true,
        'warehouses' => true,
        'amount' => true,
        'item' => true
    ];
}
