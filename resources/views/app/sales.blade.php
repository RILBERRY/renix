
@extends('app.main')
@section('content')
<div class="w-full flex flex-col">
    <div class="w-full p-5 flex justify-between font-semibold">
        <label  class="">All Sales</label>
        <a href="/sales/estimate/create" class="text-xs p-2 rounded-lg bg-green-800/90 text-white">
            Make a Estimate
        </a>
        {{-- <a href="/sales/create" class="text-xs p-2 rounded-lg bg-green-800/90 text-white">
            Make a Sales
        </a> --}}
    </div>
    <div class="w-[90%] h-[70vh] mx-auto overflow-y-scroll scrollbar-hide">
        <div class= "space-y-2 h-full flex flex-col">
            @foreach($estimates as $estimate)
            <a href="/sales/estimate/{{$estimate->id}}/edit" class="w-full flex p-2 rounded-lg border-[.2px] border-gray-400/50 bg-gray-300/20 flex-shrink-0">
                <div  class="w-20 h-20 flex-shrink-0">
                    <img src="/logo/smart_lab_logo.png" class=" w-full rounded-lg" alt="" srcset="">
                </div>
                <div class="flex flex-col justify-between text-[10px] px-3 ">
                    <p>{{$estimate->estimate_no}}</p>
                    <p>{{$estimate->customer->name}}</p>
                        <p>MVR {{ number_format($estimate->total, 2)}}</p>
                    <p class="text-blue-400 ">Estimate: {{$estimate->status}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
