<div class="w-full md:w-[767px] mx-auto flex flex-col text-sm">
    <div class="w-full p-5 flex justify-between  font-semibold">
        <label class="mt-auto">Purchases</label>
        <a href="/purchases/reset" class="text-xs p-2 rounded-lg bg-red-800/70 px-5 text-white {{ $supplyerInfo ?: 'hidden' }}">
            Reset Purchases
        </a>
    </div>
    <div class="w-[90%]  mx-auto">
        <div class="flex justify-between">
            <div class="p-2" wire:click="setActiveStep('supplyerInfo')">Supplyer</div>
            <div class="p-2" wire:click="setActiveStep('itemsInfo')">Items</div>
            <div class="p-2" wire:click="setActiveStep('receipt')">Receipt</div>
            <div class="p-2" wire:click="setActiveStep('payment')">Payment</div>
        </div>
        <div class="flex justify-between bg-gray-200 rounded-lg">
            <div class="p-1 bg-green-600  rounded-lg w-1/4 {{ $supplyerInfo ?: 'hidden' }}"></div>
            <div class="p-1 bg-green-600  rounded-lg w-2/4 {{ $itemsInfo ?: 'hidden' }}"></div>
            <div class="p-1 bg-green-600  rounded-lg w-3/4 {{ $receipt ?: 'hidden' }}"></div>
            <div class="p-1 bg-green-600  rounded-lg w-full {{  $payment ?: 'hidden'  }}"></div>
        </div>

        <!-- //Customer -->
        <div class="w-full mt-5 p-2 rounded-lg bg-gray-200 {{ $supplyerInfo ?: 'hidden' }}">
            <div class="p-1 flex flex-col">
                <label class="p-1">Supplyer Name</label>
                <input class=" rounded-md p-2" type="text" wire:model="supplyer" placeholder="Customer Name">
            </div>

            <div class="mt-2 p-1 flex flex-col">
                <button class="flex-1 bg-green-800/90 text-white rounded-lg p-2" wire:click="save('supplyer')">Save</button>
            </div>
        </div>

        <!-- //Items -->
        <form wire:submit.prevent="AddItems" class=" w-full mt-5 p-2 rounded-lg bg-gray-200 mb-16 {{ $itemsInfo ?: 'hidden' }}">
            <div class="p-1 flex flex-col ">
                <label class="p-1">Title</label>
                <input class=" rounded-md p-2" type="text" wire:model="item.title" placeholder="Title">
            </div>
            
            <div class="p-1 flex flex-col ">
                <label class="p-1">Description</label>
                <textarea class=" rounded-md p-2" type="text" wire:model="item.description" placeholder="Description"></textarea>
            </div>
            
            <div class="p-1 flex flex-col ">
                <label class="p-1">Type</label>
                <input class=" rounded-md p-2" type="text" wire:model="item.type" placeholder="Type">
            </div>
            
            <div class="p-1 flex flex-col ">
                <label class="p-1">Color</label>
                <input class=" rounded-md p-2" type="text" wire:model="item.color" placeholder="Color">
            </div>

            <div class="p-1 flex flex-col ">
                <label class="p-1">QTY</label>
                <input class=" rounded-md p-2" type="number" wire:model="price.qty" placeholder="QTY">
            </div>
            <div class="p-1 flex flex-col ">
                <label class="p-1">Cost Price</label>
                <input class=" rounded-md p-2" type="number" wire:model="price.cost_price" placeholder="Cost Price">
            </div>
            
            <div class="p-1 flex flex-col ">
                <label class="p-1">Unit Price</label>
                <input class=" rounded-md p-2" type="number" wire:model="price.unit_price" placeholder="Unit Price">
            </div>
            
            <div class="p-1 flex flex-col ">
                <label class="p-1">Image <span class="text-[8px] text-gray-600">image Should be Square (1 : 1)</span></label>
                <input class="rounded-md p-2 border-2 border-white" type="file" wire:model="item.image" placeholder="Unit Price">
            </div>

            <div class="mt-2 p-1 flex flex-col">
                <button class="flex-1 bg-green-800/90 text-white rounded-lg p-2" type="submit">Add</button>
            </div>
        </form>
    </div>

    <!-- //receipt -->
    <div class=" w-full mt-5 p-2 mb-16 {{ $receipt ?: 'hidden' }}">
        <div class=" w-full p-2 rounded-lg bg-gray-200">
            <div class="p-1 flex flex-col ">
                <h3 class="text-md text-center text-gray-500 font-bold">Supplyer Info</h3>
                <label class="p-1 text-gray-500 text-xs">Supplyer Name: <span class="text-gray-900 font-semibold">{{$supplyer}}</span> </label>
                <label class="p-1 text-gray-500 text-xs">Purchase No: <span class="text-gray-900 font-semibold">{{$purchase?->pv_no}}</span> </label>
            </div>
        </div>

        <div class="p-1 flex flex-col text-center">
            <label class="p-1 text-gray-500 text-md">Purchases Total: <span class="text-gray-900 font-bold text-sm"> MVR {{ number_format($billTotal, 2) }}</span> </label>
        </div>
        <div class="p-1 flex flex-col max-h-[50vh] overflow-auto">
            @if ($items)
                @foreach ($items as $entry) 
                    <div wire:click="editItem({{$entry->id}})" class="w-full flex my-1 p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                        <div class="flex flex-col w-full">
                            <div class="flex w-full">
                                <p>{{$entry->item->title}}</p>
                            </div>
                            <div class="flex w-full">
                                <div class="w-20 h-20 flex-shrink-0 my-auto">
                                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt=""
                                    srcset="">
                                </div>
                                <div class="flex flex-col flex-1 justify-between text-[10px] p-3 ">
                                    <p class=" font-semibold">Description</p>
                                    <p>{{$entry->item->description}}  {{$entry->item->type}}</p>
                                    <p>{{$entry->item->color}}</p>
                                </div>
                                <div class="flex flex-col flex-auto justify-between text-[10px] p-3 ">
                                    <div class="flex">
                                        <div>
                                            <p>QTY</p>
                                            <p>Unit Price</p>
                                        </div>
                                        <div class="text-right flex-1">
                                            <p>{{$entry->qty}}</p>
                                            <p>{{ number_format($entry->cost_price, 2) }}</p>
                                        </div>
                                    </div>
                                    <p class="font-bold text-sm text-right">MVR {{ number_format($entry->qty * $entry->cost_price, 2) }} {{$entry->total}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="p-3 mt-2 space-x-3 flex w-full justify-center text-white">
            <button class="w-32 p-1 bg-green-800/90 mx-auto rounded-lg {{ $receiptSavedStatus ? 'hidden' : '' }}" wire:click="savePurchases">Payment</button>
            {{-- <button class="p-2 bg-blue-800/90 flex-1 rounded-lg {{ $receiptSavedStatus ?: 'hidden' }}">Print Purchases</button> --}}
        </div>
    </div>

    <!-- //payment -->
    <form  wire:submit.prevent="savePayable" class=" w-full mt-5 p-2 rounded-lg bg-gray-200 {{ $payment ?: 'hidden' }}">
        <div class="p-1 flex flex-col text-center text-gray-500 text-xs ">
            <label class="p-1 ">Purchases Total (MVR): <span class="text-gray-900 font-semibold">{{ number_format($billTotal, 2) }}</span></label>
            {{-- <label class="p-1">Discount: <span class="text-gray-900 font-semibold">10.99</span> </label>
            <label class="p-1">Invoice Balance: <span class="text-gray-900 font-semibold">2,333.00</span> --}}
            </label>
        </div>

        <div class="p-1 flex flex-col ">
            <label class="p-1">Paid Amount</label>
            <input class=" rounded-md p-2" type="text" wire:model="payable.amount" placeholder="Amount Received">
        </div>

        <div class="p-1 flex flex-col ">
            <label class="p-1">Payment Description</label>
            <textarea class=" rounded-md p-2" type="text" wire:model="payable.description" placeholder="Payment Description"></textarea>
        </div>

        <div class="p-1 flex flex-col">
            <label class="p-1">Fund</label>
            <select wire:model="payable.fund_id" id="fund" class="rounded-md p-2">
                <option value="">Select a Fund</option>
                @foreach ($funds as $fund)
                    <option value="{{$fund->id}}">{{$fund->name}}</option>
                @endforeach
            </select>
        </div>
        
        {{-- <div class="p-1 flex flex-col">
            <label class="p-1">Request for Approval</label>
            <select wire:model="payable.fund" id="fund" class="rounded-md p-2">
                <option value="">Select a User</option>
                <option value="1">User 1</option>
                <option value="2">Fund 2</option>
                <option value="3">Fund 3</option>
            </select>
        </div> --}}

        <div class="p-1 flex flex-col">
            <label class="p-1">Refrence number</label>
            <input class=" rounded-md p-2" type="text" wire:model="payable.ref_number" placeholder="Refrence number">
        </div>
        <div class="mt-2 p-1 flex flex-col">
            <button class="flex-1 bg-green-800/90 text-white rounded-lg p-2" type="submit">{{$purchase?->id?'Update':'Save'}}</button>
        </div>
    </form>

</div>
</div>
