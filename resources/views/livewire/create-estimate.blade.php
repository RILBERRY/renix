<div class="w-full md:w-[767px] mx-auto flex flex-col text-sm">
    <div class="w-full p-5 flex justify-between  font-semibold">
        <label class="mt-auto">New Estimate</label>
        <button wire:click="resetEstimate" class="text-xs p-2 rounded-lg bg-red-800/70 px-5 text-white {{ $customerInfo ?: 'hidden' }}">
            Reset Estimate
        </button>
    </div>
    <div class="w-[90%]  mx-auto">
        <div class="flex justify-between">
            <div class="p-2" wire:click="setActiveStep('customerInfo')">Customer</div>
            <div class="p-2" wire:click="setActiveStep('itemsInfo')">Items</div>
            <div class="p-2" wire:click="setActiveStep('receipt')">Receipt</div>
            {{-- <div class="p-2" wire:click="setActiveStep('payment')">Payment</div> --}}
        </div>
        <div class="flex justify-between bg-gray-200 rounded-lg">
            <div class="p-1 bg-green-600  rounded-lg w-2/6 {{ $customerInfo ?: 'hidden' }}"></div>
            <div class="p-1 bg-green-600  rounded-lg w-4/6 {{ $itemsInfo ?: 'hidden' }}"></div>
            <div class="p-1 bg-green-600  rounded-lg w-full {{ $receipt ?: 'hidden' }}"></div>
            {{-- <div class="p-1 bg-green-600  rounded-lg w-full {{  $payment ?: 'hidden'  }}"></div> --}}
        </div>

        <!-- //Customer -->
        <form wire:submit.prevent="saveCustomer" class="w-full mt-5 p-2 rounded-lg bg-gray-200 {{ $customerInfo ?: 'hidden' }}">
            <div class="p-1 flex flex-col">
                <label class="p-1">Contact No</label>
                <input class=" rounded-md p-2" type="number" wire:model="customer.contact" wire:blur="getCustomer" placeholder="Customer Number">
            </div>
            <div class="p-1 flex flex-col">
                <label class="p-1">Full Name</label>
                <input class=" rounded-md p-2" type="text" wire:model="customer.name" placeholder="Customer Name">
            </div>
            <div class="p-1 flex flex-col">
                <label class="p-1">TIN</label>
                <input class=" rounded-md p-2" type="text" wire:model="customer.tin" placeholder="TIN">
            </div>
            <div class="p-1 flex flex-col">
                <label class="p-1">Address</label>
                <input class=" rounded-md p-2" type="text" wire:model="customer.address" placeholder="Address">
            </div>
            <div class="mt-2 p-1 flex flex-col">
                <button class="flex-1 bg-green-800/90 text-white rounded-lg p-2" type="submit">Save</button>
            </div>
        </form>

        <!-- //Items -->
        <form wire:submit.prevent="addtoCart" class=" w-full mt-5 p-2 rounded-lg bg-gray-200 {{ $itemsInfo ?: 'hidden' }}">
            <div class="p-1 flex flex-col ">
                <label class="p-1">Title</label>
                <input class=" rounded-md p-2" type="text" wire:model="order.title" placeholder="Title">
            </div>
            <div class="p-1 flex flex-col ">
                <label class="p-1">Description</label>
                <textarea class=" rounded-md p-2" type="text" wire:model="order.description" placeholder="Description"></textarea>
            </div>
            <div class="p-1 flex flex-col">
                <label class="p-1">QTY</label>
                <input class=" rounded-md p-2" type="number" wire:model="order.qty" placeholder="QTY">
            </div>
            <div class="p-1 flex flex-col">
                <label class="p-1">Price</label>
                <input class=" rounded-md p-2" type="number" wire:model="order.price" placeholder="Price">
            </div>
            <div class="mt-2 p-1 flex flex-col">
                <button class="flex-1 text-white rounded-lg p-2 bg-green-800/90 " type="text">{{$order->id?'Update':'Add'}}</button>
            </div>
            <div class="mt-2 p-1 flex flex-col {{$order->id?'':'hidden'}}">
                <button wire:click="removeFromCart({{$order->id}})" class="flex-1 text-white rounded-lg p-2 " type="text" >Delete</button>
            </div>
        </form>
    </div>

    <!-- //receipt -->
    <div class=" w-full mt-5 p-2 {{ $receipt ?: 'hidden' }}">
        <div class=" w-full p-2 rounded-lg bg-gray-200">
            <div class="p-1 flex flex-col ">
                <h3 class="text-md text-center text-gray-500 font-bold">Customer Info</h3>
                <label class="p-1 text-gray-500 text-xs">Customer Name: <span 
                    class="text-gray-900 font-semibold">{{$customer?->name}}</span> </label>
                <label class="p-1 text-gray-500 text-xs">Customer Number: <span
                        class="text-gray-900 font-semibold">{{$customer?->contact}}</span> </label>
                <label class="p-1 text-gray-500 text-xs">Tin: <span 
                    class="text-gray-900 font-semibold">{{$customer?->tin}}</span>
                </label>
                <label class="p-1 text-gray-500 text-xs">Address: <span 
                    class="text-gray-900 font-semibold">{{$customer?->address}}</span> </label>
            </div>
        </div>
        <div class="p-1 flex flex-col text-center">
            <label class="p-1 text-gray-500 text-md">Estimate Total: <span
                    class="text-gray-900 font-semibold"> MVR {{ number_format($estomateTotal,2)}}</span> </label>
        </div>

        <div class="p-1 flex flex-col h-[37vh] overflow-auto">
            @if ($myOrders)
            @foreach ($myOrders as $entry)  
            <div wire:click="editOrder({{$entry->id}})" class="w-full flex my-1 p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                <div class="flex flex-col w-full">
                    <div class="flex w-full">
                        <p>{{$entry->title}}</p>
                    </div>
                    <div class="flex w-full">
                        <div class="w-20 h-20 flex-shrink-0 my-auto">
                            <img src="/logo/rinex_logo.png" class=" w-full rounded-lg" alt=""
                            srcset="">
                        </div>
                        <div class="flex flex-col flex-1 justify-between text-[10px] p-3 ">
                            <p class=" font-semibold text-gray-500">Description</p>
                            <p>{{$entry->description}}</p>
                        </div>
                        <div class="flex flex-col flex-auto justify-between text-[10px] p-3 ">
                            <div class="flex">
                                <div class=" text-gray-500">
                                    <p>QTY</p>
                                    <p>Unit Price</p>
                                </div>
                                <div class="text-right flex-1">
                                    <p>{{$entry->qty}}</p>
                                    <p>{{number_format(($entry->price/100), 2)}}</p>
                                </div>
                            </div>
                            <p class="font-bold text-sm text-right">MVR {{number_format($entry->qty * ($entry->price/100),2)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <div class="p-3 mt-2 space-x-3 flex w-full justify-center text-white">
            <button class="w-32 p-1 bg-green-800/90 mx-auto rounded-lg {{ $receiptSavedStatus ? 'hidden' : '' }}"
                wire:click="saveEstimate">Save</button>
            <a href="/sales/estimate/{{$estimate?->id}}/download" class="p-2 bg-blue-800/90 flex-1 rounded-lg text-center {{ $receiptSavedStatus ?: 'hidden' }}">Print
                Estimate</a>
            @if (!$myOrders->isEmpty())
                <a href="{{ $myOrders[0]->invoice_id ? 
                '/sales/invoice/'.$myOrders[0]->invoice_id.'/edit' 
                : '/sales/invoice/'.$estimate?->id}}.'/create'; }}" 
                class="p-2 bg-green-800/90 flex-1 rounded-lg text-center  {{ $receiptSavedStatus ?: 'hidden' }}">
                    Create Invoice</a>
            @endif
        </div>
    </div>

    <!-- //payment -->
    <div class=" w-full mt-5 p-2 rounded-lg bg-gray-200 {{ $payment ?: 'hidden' }}">
        <div class="p-1 flex flex-col text-center text-gray-500 text-xs ">
            <label class="p-1 ">Invoice Total: <span class="text-gray-900 font-semibold">2,339.99</span>
            </label>
            <label class="p-1">Discount: <span class="text-gray-900 font-semibold">10.99</span> </label>
            <label class="p-1">Invoice Balance: <span class="text-gray-900 font-semibold">2,333.00</span>
            </label>
        </div>

        <div class="p-1 flex flex-col ">
            <label class="p-1">Amount Received</label>
            <input class=" rounded-md" type="text" placeholder="Amount Received">
        </div>
        <div class="p-1 flex flex-col">
            <label class="p-1">Payment Type</label>
            <input class=" rounded-md" type="number" placeholder="Payment Type">
        </div>
        <div class="p-1 flex flex-col">
            <label class="p-1">Fund</label>
            <input class=" rounded-md" type="number" placeholder="Fund">
        </div>
        <div class="p-1 flex flex-col">
            <label class="p-1">Refrence number</label>
            <input class=" rounded-md" type="number" placeholder="Refrence number">
        </div>
        <div class="mt-2 p-1 flex flex-col">
            <button class="flex-1 bg-green-800/90 text-white rounded-lg p-2"
                @click="setActiveStep('link3')">Save</button>
        </div>
    </div>

</div>
</div>
