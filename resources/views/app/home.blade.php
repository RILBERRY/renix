
@extends('app.main')
@section('content')
{{-- <div class="w-full flex">
    <div class="w-full h-32 flex mt-5 flex-col">
        <label  class="w-[90%] mx-auto ">Recent Sales</label>
        <div class="w-[90%] mx-auto overflow-x-scroll scrollbar-hide">
            <div class= " space-x-2 flex ">
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div href="" class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>

            </div>
        </div>

    </div>
</div>
<div class="w-full h-32 flex">
    <div class="w-full flex flex-col">
        <label  class="w-[90%] mx-auto ">Best Salling</label>
        <div class="w-[90%] mx-auto overflow-x-scroll scrollbar-hide">
            <div class= " space-x-2 flex ">
                <div class="w-52 flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                    <div href="" class="w-20 h-20 flex-shrink-0">
                        <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                    </div>
                    <div class="flex flex-col text-[10px] px-3 ">
                        <p>Full Name</p>
                        <p>Type</p>
                        <p>Color</p>
                        <p>InStock</p>
                        <p>MVR 299.99</p>
                    </div>
                </div>
                <div class="w-52 flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                    <div href="" class="w-20 h-20 flex-shrink-0">
                        <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                    </div>
                    <div class="flex flex-col text-[10px] px-3 ">
                        <p>Full Name</p>
                        <p>Type</p>
                        <p>Color</p>
                        <p>InStock</p>
                        <p>MVR 299.99</p>
                    </div>
                </div>
                <div class="w-52 flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                    <div href="" class="w-20 h-20 flex-shrink-0">
                        <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                    </div>
                    <div class="flex flex-col text-[10px] px-3 ">
                        <p>Full Name</p>
                        <p>Type</p>
                        <p>Color</p>
                        <p>InStock</p>
                        <p>MVR 299.99</p>
                    </div>
                </div>
                <div class="w-52 flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                    <div href="" class="w-20 h-20 flex-shrink-0">
                        <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                    </div>
                    <div class="flex flex-col text-[10px] px-3 ">
                        <p>Full Name</p>
                        <p>Type</p>
                        <p>Color</p>
                        <p>InStock</p>
                        <p>MVR 299.99</p>
                    </div>
                </div>
                <div class="w-52 flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                    <div href="" class="w-20 h-20 flex-shrink-0">
                        <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                    </div>
                    <div class="flex flex-col text-[10px] px-3 ">
                        <p>Full Name</p>
                        <p>Type</p>
                        <p>Color</p>
                        <p>InStock</p>
                        <p>MVR 299.99</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> --}}

<div class="w-full flex">
    <div class="w-full flex flex-col">
        <div class="w-full p-5 flex flex-col space-y-2 justify-between font-semibold">
            <label  class="">Products</label>
            {{-- <input type="search" wire:model="search" class="w-full p-2 rounded-md bg-gray-200"> --}}
            {{-- <input wire:model.debounce.500ms="search" type="search" class="w-full p-2 rounded-md bg-gray-200" placeholder="Search Items by title..."> --}}
        </div>
        <div class="w-[90%] h-[75vh] mx-auto overflow-y-scroll scrollbar-hide">
            <div class= "space-y-2 h-full flex flex-col">
                @foreach ($products as $product)
                <div class="w-full flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                    <div  class="w-20 h-20 flex-shrink-0">
                        <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                    </div>
                    <div class="flex flex-col w-full text-[10px] px-3 ">
                        <p>{{$product->title}}</p>
                        <p>{{$product->description}} {{$product->type}}</p>
                        <p>{{$product->color}}</p>
                        <p>InStock {{$product->stock->qty_in - $product->stock->qty_out}}</p>
                        <p class=" text-right font-semibold text-green-800">Price {{ number_format($product->price->unit_price,2)}}</p>
                    </div>
                </div>
                @endforeach
              


            </div>
        </div>

    </div>
</div>
@endsection
