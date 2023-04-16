<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateEstimate extends Component
{
    public $customerInfo = false;
    public $itemsInfo = false;
    public $receipt = true;
    public $payment = false;
    public $receiptSavedStatus = false;



    public function setActiveStep($step)
    {
        $this->customerInfo = 'customerInfo' == $step ? true : false;
        $this->itemsInfo = 'itemsInfo' == $step ? true : false;
        $this->receipt = 'receipt' == $step ? true : false;
        $this->payment = 'payment' == $step ? true : false;
    }
    public function saveEstimate()
    {
        $this->receiptSavedStatus = true;
    }
    public function render()
    {
        return view('livewire.create-estimate');
    }
}
