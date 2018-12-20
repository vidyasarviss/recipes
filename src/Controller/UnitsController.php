<?php

namespace App\Controller;


use App\Controller\AppController;
use Cake\ORM\TableRegistry;



/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 *
 * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $units = $this->paginate($this->Units);

        $this->set(compact('units'));
         
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => ['Ingredients']
        ]);
        foreach($unit->ingredients as $ingredient)
        {        
        	                 
        	
            $items = TableRegistry::get('Items');      
	    	$ingredient->unit_id=$unit->id;
	    	$ingredient->item_name = $items->get($ingredient->item_id)->item_name;
	    	
	    	$units= TableRegistry::get('Units');      
	    	$ingredient->unit_id=$unit->id;
	    	$ingredient->unit_name=$units->get($ingredient->unit_id)->name;
	   	}

        $this->set('unit', $unit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $unit = $this->Units->get($id);
        try {
            $this->Units->delete($unit);
        }
        catch (\PDOException $e) {
            $error = 'The item you are trying to delete is associated with other records';
            // The exact error message is $e->getMessage();
            $this->set('error', $e);
            $this->Flash->error(__('The item you are trying to delete is associated with other records.'));
        }
//         if ($this->Units->delete($unit)) {
//             $this->Flash->success(__('The unit has been deleted.'));
//         } else {
//             $this->Flash->error(__('The unit could not be deleted. Please, try again.'));
//         }

        return $this->redirect(['action' => 'index']);
    }
}
