<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

use App\Form\PurchaseOrdersReportForm;
class PurchaseOrdersReportController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
    }
    
    public function index()
    {
       
//      debug($data);die();
        $po_table=TableRegistry::get('Purchase_orders');
        $poi_table=TableRegistry::get('PurchaseOrderItems');

        $def_date = date("Y-m-d");
        //debug($def_date);die();
        $items_table = TableRegistry::get('Items');
        $item=$items_table->find('list');
        $this->set('items',$item);
        
        
        $warehouse_table = TableRegistry::get('Warehouses');
        $warehouse=$warehouse_table->find('list');
        $this->set('warehouses',$warehouse);
        
        
        $data = $this->request->query();
        
        
        $pos = $poi_table->find('all', array('fields' => array('po.id','po.transaction_date','po.required_date', 'warehouse_id', 'item_id', 'quantity', 'rate', 'Items.item_name', 'Warehouses.name')))
        ->join([
            'po' => [
                'table' => 'purchase_orders',
                'type' => 'INNER',
                'conditions' => 'PurchaseOrderItems.purchase_order_id = po.id'
            ]])->contain(['Items', 'Units', 'Warehouses']);
           // debug($pos->first());die();
        if(!empty($data))
        {
            $conditions = array();
            if(isset($data['item_id']) && !is_null($data['item_id']))
            {
               array_push($conditions,array('item_id'=>$data['item_id']));
            }
            
           if(isset($data['warehouse_id']) && !is_null($data['warehouse_id']))
            {
                array_push($conditions,array('warehouse_id'=>$data['warehouse_id']));
            }
          
            if(isset($data['transaction_date']) && !is_null($data['transaction_date']))
            {
                array_push($conditions,array('transaction_date >=' =>$data['transaction_date']));
            }
            
            if(isset($data['required_date']) && !is_null($data['required_date']))
            {
                array_push($conditions,array('required_date <=' =>$data['required_date']));
            }
          
            if(!empty($conditions)){
               
                $pos = $pos->where($conditions);
               
               // debug($conditions);die();
            }
            //else{
                
               // $pos = $po_table->find('all')->contain(['PurchaseOrderItems', 'PurchaseOrderItems.Items', 'PurchaseOrderItems.Units', 'PurchaseOrderItems.Warehouses']);
                
             // ]])->contain(['Items', 'Units', 'Warehouses'])->where($conditions);
          
     //debug($pos->first());die();
        }
       
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->set('def_date', $def_date);
        //$this->set('pos', $pos);
        $results=array();
        $results["pos"]=$pos;
        $results["warehouses"]=$warehouse;
        $results["items"]=$item;
        $this->set('results', $results);
        $this->set('_serialize', ['results']);
        //$this->set('pois', $pois);
        
    }
    
   
}
