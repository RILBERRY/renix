<div>
    <div class="w-full p-5 flex flex-col space-y-2 justify-between font-semibold">
        <label  class="">All In Inventory</label>
        {{-- <input type="search" wire:model="search" class="w-full p-2 rounded-md bg-gray-200"> --}}
        <input wire:model.debounce.500ms="search" type="search" class="w-full p-2 rounded-md bg-gray-200" placeholder="Search Items by title...">
    </div>

    <div class="w-[90%] h-[68vh] mx-auto overflow-y-scroll scrollbar-hide">
        <div class= "space-y-2 h-full flex flex-col">
            @foreach ($stockItems as $entry)
            <div class="w-full flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                <div class="flex flex-col w-full">
                    <div class="flex w-full">
                        <p>{{$entry->title}}</p>
                    </div>
                    <div class="flex w-full">
                        <div  class="w-20 h-20 flex-shrink-0">
                            <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                        </div>
                        <div class="flex flex-col flex-1 justify-between text-[10px] ">
                            <p>{{$entry->description}} {{$entry->type}}</p>
                            <p>{{$entry->color}}</p>
                            <p>Cost price <br> <span class="text-blue-800"> MVR {{$entry->price->cost_price}}</span></p>
                            <p>Salse price <br> <span class=" text-green-800"> MVR {{$entry->price->unit_price}}</span></p>
                        </div>
                        <div class="flex flex-col flex-1 justify-between text-[10px]">
                            <p>{{$entry->price->purchase->pv_no}}</p>
                            <p>Total QTY: {{$entry->stock->qty_in}}</p>
                            <p>Sold QTY: {{$entry->stock->qty_out?$entry->stock->qty_out:0;}}</p>
                            <p class=" font-bold ">QTY left: {{$entry->stock->qty_out?$entry->stock->qty_in-$entry->stock->qty_out:$entry->stock->qty_in;}} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
