<?php

class PaymentController extends \UserBaseController {

        
        /**
         *
         * @var Doctrine\ORM\EntityManager 
         */
        private $em;
                
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->content = View::make('payment.list');
	}
        
        public function getBill()
        {
            $payees = $this->user->getPayees();
            $from = array();
            foreach($this->user->getAccounts() as $account) {
                if($account->getType() == Account::CHECKING || $account->getType() == Account::SAVING) {
                    $from[$account->getId()] = $account->getAccountNo()."(".$account->getBalance().")";
                }
            }
            $to = array(0 => "Select An Payee");
            
            foreach($payees as $payee) {
                $to[$payee->getId()] = $payee->getBill()->getName()."(".$payee->getAccountNo().")";
            }
            View::share('to', $to);
            View::share('from', $from);
            $this->layout->content = View::make('payment.bill');
        }
        
        public function postBill()
        {
                // validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'account'       => 'required',
			'payee'      => 'required',
			'amount'        => 'required|numeric|min:2'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('payment/bill')
				->withErrors($validator);
		} else {
			// store
                        $fromAccount = Doctrine::getRepository("Account")->find(Input::get('account'));
			$payee = Doctrine::getRepository("Payee")->find(Input::get('payee'));
                        
                        $toAccount   = $payee->getBill()->getAccount();
                        
                        if($fromAccount->getBalance() < Input::get('amount')) {
                            return Redirect::to('payment/bill')
				->withErrors("You don't have enough balance");
                        }
                        
                        $transaction = new Transaction();
			$transaction->setAccount($fromAccount);
			$transaction->setAmount(Input::get('amount'));
                        $transaction->setDescription("Bill Payment To '".$payee->getBill()->getName()."'");
			$transaction->setType(Transaction::DEBIT);
                        Doctrine::persist($transaction);
                        
                        $transaction = new Transaction();
			$transaction->setAccount($toAccount);
			$transaction->setAmount(Input::get('amount'));
                        $transaction->setDescription("Bill Payment From A/C:".$fromAccount->getAccountNo());
			$transaction->setType(Transaction::CREDIT);
                        Doctrine::persist($transaction);
                        
                        Doctrine::flush();
                        
			// redirect
			Session::flash('message', 'Payment is completed successfully.');
			return Redirect::to('transfer');
		}
        }
}