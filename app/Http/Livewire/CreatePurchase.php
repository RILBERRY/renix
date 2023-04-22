<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreatePurchase extends Component
{
    public $supplyerInfo = false;
    public $itemsInfo = false;
    public $receipt = false;
    public $payment = true;
    public $receiptSavedStatus = false;



    public function setActiveStep($step)
    {
        $this->supplyerInfo = 'supplyerInfo' == $step ? true : false;
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
        return view('livewire.create-purchase');
    }
}
