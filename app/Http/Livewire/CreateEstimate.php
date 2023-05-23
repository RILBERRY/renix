<?php

namespace App\Http\Livewire;

use App\Models\Customers;
use App\Models\Items;
use App\Models\Orders;
use App\Models\Estimate;
use Carbon\Carbon;
use Livewire\Component;


class CreateEstimate extends Component
{
    public $customerInfo = true;
    public $itemsInfo = false;
    public $receipt = false;
    public $payment = false;
    public $receiptSavedStatus = false;
    public $customer;
    public $estimate;
    public $ourProducts;
    public $order;
    public $myOrders;
    public $estomateTotal;

    public function mount()
    {
        $this->customer = new Customers();
        $this->order = new Orders();
        if(!session()->has('isEditing')){
            session()->forget('customer');
            session()->forget('estimate');
        }
        if(session()->has('estimate')){
            $this->estimate = session()->get('estimate');
            $this->customer = session()->get('customer');
            $this->receiptSavedStatus = $this->estimate->status == "COMPLETED"?true:false;
            $this->load('receipt');
        }elseif(Estimate::where('status','PENDING')->exists()){
            $this->estimate = Estimate::with('customer')->where('status','PENDING')->first();
            $this->customer = $this->estimate->customer;
            session()->put('estimate', $this->estimate);
            session()->put('customer', $this->customer);
            $this->receiptSavedStatus = $this->estimate->status == "COMPLETED"?true:false;
            $this->load('receipt');
        }
    }
    public function resetEstimate()
    {
        session()->forget('customer');
        return redirect()->to(route('create-estimate'));
    }

    public function setActiveStep($step)
    {
        if($step == "receipt"){
            $this->order = new Orders();
        }
        $this->customerInfo = 'customerInfo' == $step ? true : false;
        $this->itemsInfo = 'itemsInfo' == $step ? true : false;
        $this->receipt = 'receipt' == $step ? true : false;
        // $this->payment = 'payment' == $step ? true : false;
    }

    protected $rules = [
        'customer.code' => 'nullable',
        'customer.name' => 'nullable',
        'customer.contact' => 'nullable',
        'customer.tin' => 'nullable',
        'customer.address' => 'nullable',

        'order.title' => 'nullable',
        'order.description' => 'nullable',
        'order.qty' => 'nullable',
        'order.price' => 'nullable',
    ];
    protected $customerRules = [
        'customer.code' => 'nullable',
        'customer.name' => 'required',
        'customer.contact' => 'required',
        'customer.tin' => 'nullable',
        'customer.address' => 'nullable',
    ];
    protected $orderRules = [
        'order.title' => 'required',
        'order.description' => 'nullable',
        'order.qty' => 'nullable',
        'order.price' => 'nullable',
    ];

    public function load($step)
    {
        $this->myOrders = Orders::where('estimate_id',$this->estimate->id)->get();
        $this->estomateTotal = $this->estimate->getEstimateTotal($this->estimate->id);
        $this->setActiveStep($step);
        if($step == "itemsInfo"){
            // $this->ourProducts = $this->getProducts();
        }
        $this->setActiveStep($step);
    }

    public function getCustomer()
    {
        if(Customers::where('contact',$this->customer->contact)->exists()){
            $this->customer = Customers::where('contact', $this->customer->contact)->first();
            session()->put('customer',$this->customer);
        }
    }


    public function saveCustomer()
    {
        $this->validate($this->customerRules);
        $this->customer->code = $this->customer->code?:$this->createCustomerCode();
        $this->customer->save();
        if(!session()->has('estimate')){
            $this->estimate = Estimate::create([
                'estimate_no' => $this->generateEstimateNo() ,
                'valid_till' => Carbon::now()->addDays(14)->toDateString() ,
                'customer_id' => $this->customer->id ,
                'status' => 'PENDING',
            ]);
            $this->estimate->save();
            session()->put('estimate',$this->estimate);
        }

        session()->put('customer',$this->customer);
        $this->load('itemsInfo');
    }

    public function createCustomerCode()
    {
        $lastCustomer = Customers::orderByDesc('code')->first();
        $lastCodeNumber = 0;
        
        if ($lastCustomer) {
            $lastCodeNumber = (int)substr($lastCustomer->code, -6);
        }
        
        $newCodeNumber = $lastCodeNumber + 1;
        $newCode = 'RNX' . str_pad($newCodeNumber, 6, '0', STR_PAD_LEFT);
        
        return $newCode;
    }
    public function generateEstimateNo()
    {
        $lastEstimate = Estimate::orderByDesc('estimate_no')->first();
        $lastCodeNumber = 0;
        
        if ($lastEstimate) {
            $lastCodeNumber = (int)substr($lastEstimate->estimate_no, -6);
        }
        
        $newCodeNumber = $lastCodeNumber + 1;
        $newCode = 'RNX-ET-' . str_pad($newCodeNumber, 6, '0', STR_PAD_LEFT);
        
        return $newCode;
    }

    public function addtoCart()
    {
        $this->validate($this->orderRules);

        if($this->order->price){
            $this->order->price = $this->order->price *100;
            $this->order->status = 'PENDING' ;
            $this->order->estimate_id = $this->estimate->id ;
            $this->order->save();
        }

        $this->order = new Orders();
        $this->load('receipt');
    }

    public function editOrder($order_id)
    {
        $this->order = Orders::find($order_id);
        $this->order->price = $this->order->price /100;
        $this->load('itemsInfo');

    }
    public function removeFromCart($order_id)
    {
        $this->order->delete();
        $this->order = new Orders();

     
    }

    public function saveEstimate()
    {
        if($this->estimate){
            $this->receiptSavedStatus = true;
            $this->estimate->update([ 'status' => 'COMPLETED' ]); 
        }
        

    }

    public function render()
    {
        return view('livewire.create-estimate');
    }
}
