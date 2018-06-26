<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Budgets Controller
 *
 * @property \App\Model\Table\BudgetsTable $Budgets
 *
 * @method \App\Model\Entity\Budget[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BudgetsController extends AppController
{

    /**
     * Index method
     * This method is used to show the budgets for all the fiscal years, it also 
     * does an aggregation on each year to compute the total sum of budget which 
     * was used in each year. 
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $budgets = $this->paginate($this->Budgets);
        $budgets = $this->paginate($this->Budgets);
        $this->set(compact('budgets'));
        $this->loadModel('requests');
        $connection = ConnectionManager::get('default');
        $results=$connection->execute('SELECT B.id AS id, ROUND(SUM( R.amount_requested ),2) AS sum_amtreqt
                                        FROM requests R, budgets B
                                        WHERE R.inquiry_date >= B.budget_date_begin
                                        AND R.inquiry_date <= budget_date_end
                                        GROUP BY B.id')->fetchAll('assoc');
        $this->set('results',$results);
        $this->set(compact('budgets'));
    }

    /**
     * View method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $budget = $this->Budgets->get($id, [
            'contain' => []
        ]);

        $this->set('budget', $budget);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $budget = $this->Budgets->newEntity();
        if ($this->request->is('post')) {
            $budget = $this->Budgets->patchEntity($budget, $this->request->getData());
            if ($this->Budgets->save($budget)) {
                $this->Flash->success(__('The budget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The budget could not be saved. Please, try again.'));
        }
        $this->set(compact('budget'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $budget = $this->Budgets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $budget = $this->Budgets->patchEntity($budget, $this->request->getData());
            if ($this->Budgets->save($budget)) {
                $this->Flash->success(__('The budget has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The budget could not be saved. Please, try again.'));
        }
        $this->set(compact('budget'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Budget id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $budget = $this->Budgets->get($id);
        if ($this->Budgets->delete($budget)) {
            $this->Flash->success(__('The budget has been deleted.'));
        } else {
            $this->Flash->error(__('The budget could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
