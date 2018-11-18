<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * PurchaseOrders Controller
 *
 * @property \App\Model\Table\PurchaseOrdersTable $PurchaseOrders
 *
 * @method \App\Model\Entity\PurchaseOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchaseOrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Suppliers']
        ];
        $purchaseOrders = $this->paginate($this->PurchaseOrders);

        $this->set(compact('purchaseOrders'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['Suppliers', 'PurchaseOrderItems']
        ]);

        $this->set('purchaseOrder', $purchaseOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();
        $purchaseOrder = $this->PurchaseOrders->newEntity();
        if ($this->request->is('post')) {
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->getData());
            if ($this->PurchaseOrders->save($purchaseOrder)) {
            $po_table=TableRegistry::get('Purchase_order_items'); 
                $i = 0;
                //debug($data);die();    
                foreach($data['items'] as $item)
                {
	                $purchase_order_item=$po_table->newEntity();
                    $purchase_order_item->item_id= $item;
                    $purchase_order_item->purchase_order_id=$purchaseOrder->id;
                    $purchase_order_item->unit_id= $data['units'][$i];	 
                    $purchase_order_item->quantity= $data['qty'][$i];
                    $purchase_order_item->rate= $data['rate'][$i];
                    $purchase_order_item->amount= $data['amount'][$i];
                    $purchase_order_item->warehouse_id= $data['warehouses'][$i];
	                $po_table->save($purchase_order_item);
	                $i++;                         
	                           	                        	
	         	}	              	                  
            
            
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            
            $units = TableRegistry::get('Units');
            $this->set('units',$units->find('list'));
            
             $items = TableRegistry::get('Items');
            $this->set('items',$items->find('list'));
            
            $warehouses = TableRegistry::get('Warehouses');
            $this->set('warehouses',$warehouses->find('list'));
           
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }
        else if($this->request->is('get')){
            $units = TableRegistry::get('Units');
            
            $this->set('units',$units->find('list'));
            $items = TableRegistry::get('Items');
            $this->set('items',$items->find('list'));
            
            $warehouses = TableRegistry::get('Warehouses');
            $this->set('warehouses',$warehouses->find('list'));
           
            }
        $suppliers = $this->PurchaseOrders->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrder', 'suppliers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->getData());
            if ($this->PurchaseOrders->save($purchaseOrder)) {
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }
        $suppliers = $this->PurchaseOrders->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrder', 'suppliers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrder = $this->PurchaseOrders->get($id);
        if ($this->PurchaseOrders->delete($purchaseOrder)) {
            $this->Flash->success(__('The purchase order has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
 public function getunits()
  {
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');
    $this->autoRender = false ;      
      
    $itemid = $this->request->query();
    $items_table = TableRegistry::get('Items');
    $item = $items_table ->get($itemid['itemid']);
    $units_table = TableRegistry::get('Units');
   
    $units=$units_table->find('list')->where(['id IN '=>[$item->purchase_unit,$item->sell_unit,$item->usage_unit]]);
    
    $this->RequestHandler->renderAs($this, 'json');

    $resultJ=json_encode($units);
    $this->response->type('json');
    $this->response->body($resultJ);
    return $this->response;
    
  }
 public function getitems()
  {
  $this->RequestHandler->respondAs('json');
  $this->response->type('application/json');
  $this->autoRender = false ;
  $array=$this->request->data();
  //debug($array);die();
  $pid=$array;
  $this->set('pid',$pid);
  $Purchase_order_items_table = TableRegistry::get('Purchase_order_items');
  foreach($pid['purchase_order_itemid'] as $id)
  {
      $pstatus = $Purchase_order_items->get($id);
      $Purchase_order_items_table->delete($pstatus);
  
  }
  
  $this->RequestHandler->renderAs($this,'json');
  
  $resultJ=json_encode($pstatus);
  $this->response->type('json');
  $this->response->body($resultJ);
  return $this->response;
 }
}
