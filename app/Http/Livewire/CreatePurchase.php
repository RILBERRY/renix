<?php

namespace App\Http\Livewire;

use App\Models\Funds;
use App\Models\Items;
use App\Models\Payables;
use App\Models\Prices;
use App\Models\Purchases;
use App\Models\Stock;
use Carbon\Carbon;
use Livewire\Component;

class CreatePurchase extends Component
{
    public $supplyerInfo = true;
    public $itemsInfo = false;
    public $receipt = false;
    public $payment = false;
    public $receiptSavedStatus = false;
    public $supplyer;
    public $billTotal;
    public $itemInfo = [];
    public $itemPrice = [];
    Public $purchase;
    public $item;
    public $items;
    public $price;
    public $stock;
    public $funds;
    public $payable;
    
    public function mount()
    {
        $this->item = new  Items();
        $this->price = new  Prices();
        $this->stock = new  Stock();
        $this->payable = new  Payables();
        $this->funds = Funds::all();
        
        if(!session()->has('isEditing')){
            session()->forget('purchases');
        }
        if(session()->has('purchases')){
            $this->purchase = session()->get('purchases');
            if($this->purchase->payable_id){
                $this->receiptSavedStatus = true ;
                $this->payable = Payables::where('id', $this->purchase->payable_id)->first();
            }
            $this->supplyer = $this->purchase-> supplyer_name;
            $this->load('receipt');
        }elseif(Purchases::where('status','PENDING')->exists()){
            $this->purchase = Purchases::where('status','PENDING')->first();
            session()->put('purchases', $this->purchase);
            $this->supplyer = $this->purchase-> supplyer_name;
            $this->load('supplyerInfo');
        }
        
        
    }

    public function setActiveStep($step)
    {
        $this->supplyerInfo = 'supplyerInfo' == $step ? true : false;
        $this->itemsInfo = 'itemsInfo' == $step ? true : false;
        $this->receipt = 'receipt' == $step ? true : false;
        $this->payment = 'payment' == $step ? true : false;
    }
    protected $rules = [
        'item.title' => 'nullable',
        'item.description' => 'nullable',
        'item.color' => 'nullable',
        'item.type' => 'nullable',
        'item.image' => 'nullable',
    
        'price.purchase_id' => 'nullable',
        'price.item_id' => 'nullable',
        'price.qty' => 'nullable',
        'price.cost_price' => 'nullable',
        'price.fright' => 'nullable',
        'price.clearance' => 'nullable',
        'price.max_discount' => 'nullable',
        'price.price_before_tax' => 'nullable',
        'price.is_taxable' => 'nullable',
        'price.unit_price' => 'nullable',

        'stock.item_id' => 'nullable',
        'stock.qty_in' => 'nullable',
        'stock.qty_out' => 'nullable',
    
        'payable.description' => 'nullable',
        'payable.amount' => 'nullable',
        'payable.status' => 'nullable',
        'payable.fund_id' => 'nullable',
        'payable.ref_number' => 'nullable',
        'payable.approved_by' => 'nullable',
    ];

    protected $itemRules = [
        'item.title' => 'required',
        'item.description' => 'nullable',
        'item.color' => 'nullable',
        'item.type' => 'nullable',
        'item.image' => 'nullable',
    ];
    protected $priceRules = [
        'price.purchase_id' => 'nullable',
        'price.item_id' => 'nullable',
        'price.qty' => 'required',
        'price.cost_price' => 'nullable',
        'price.fright' => 'nullable',
        'price.clearance' => 'nullable',
        'price.max_discount' => 'nullable',
        'price.price_before_tax' => 'nullable',
        'price.is_taxable' => 'nullable',
        'price.unit_price' => 'required',
    ];

    protected $payableRules = [    
        'payable.description' => 'nullable',
        'payable.amount' => 'nullable',
        'payable.status' => 'required',
        'payable.fund_id' => 'required',
        'payable.ref_number' => 'nullable',
        'payable.approved_by' => 'nullable',
    ];

    public function save(){
        if(!session()->has('purchases')){
            $this->createPurchases();
        }
        $this->load('receipt');
        $this->setActiveStep('itemsInfo');
    }

    public function AddItems()
    {
        $this->validate($this->itemRules);
        $this->validate($this->priceRules);
        $this->item->save();
        $this->price->purchase_id = $this->purchase->id;
        $this->price->item_id = $this->item->id;
        $this->price->save();
        if(Stock::where('item_id',$this->item->id)->exists()){
            $this->stock = Stock::where('item_id',$this->item->id)->first();
            $this->stock->qty_in = $this->price->qty;

        }else{
            $this->stock->item_id = $this->item->id;
            $this->stock->qty_in = $this->price->qty;
            $this->stock->qty_out = 0;
        }
        $this->stock?->save();

        $this->stock = new  Stock();
        $this->item = new  Items();
        $this->price = new  Prices();
        $this->load('receipt');
    }

    public function editItem($item_id)
    {
        if(Items::where('id',$item_id)->exists()){
            $this->item = Items::where('id',$item_id)->first();
            $this->price = Prices::where('item_id',$item_id)->first();
            $this->setActiveStep('itemsInfo');
        }

    }
    
    public function load($step)
    {
        $this->items = Prices::with('item')->where('purchase_id',$this->purchase->id)->get();
        $this->billTotal = Prices::where('purchase_id',$this->purchase->id)->selectRaw('SUM(qty * cost_price) as total')->first()->total;
        $this->setActiveStep($step);
    }

    public function createPurchases(){
        $Thisyear = date('Y');
        $nextPv = 'SL-PV-'.$Thisyear.'-0001';
        $lastPv = Purchases::orderBy('id', 'desc')->first();
        if($lastPv){
            $lastPvNo = $lastPv->pv_no;
            $pattern = "#SL-PV-{$Thisyear}-#i";
            $lastNo = preg_replace($pattern, "", $lastPvNo);
            $nextNo = (int)$lastNo + 1;
            if($nextNo < 10){
                $nextPv = "SL-PV-".$Thisyear."-000".$nextNo;
            }elseif($nextNo < 100){
                $nextPv = "SL-PV-".$Thisyear."-00".$nextNo;
            }elseif($nextNo < 1000){
                $nextPv = "SL-PV-".$Thisyear."-0".$nextNo;
            }elseif($nextNo < 10000){
                $nextPv = "SL-PV-".$Thisyear."-".$nextNo;
            }
        }
        $this->purchase = Purchases::create([
            'pv_no' => $nextPv,
            'supplyer_name' => $this->supplyer,
            'payable_id' => NULL,
            'status' => 'PENDING',
        ]);
        session()->put('purchases', $this->purchase);
    }
    public function savePurchases()
    {
        $this->payable->description = $this->purchase->pv_no.' - '.$this->purchase->supplyer_name;
        $this->payable->amount = $this->billTotal;
        $this->payable->status = 'PENDING';
        // dd($this->payable);
        $this->setActiveStep('payment');

        // $this->receiptSavedStatus = true;
    }
    public function savePayable()
    {
        $this->validate($this->payableRules);
        $this->payable->save();
        $this->purchase->update([
            'status' => "COMPELETED",
            'payable_id' => $this->payable->id,
        ]);
        session()->forget('purchases');
        return redirect()->to(route('purchases.list'));

    }


    public function render()
    {
        return view('livewire.create-purchase');
    }
}
