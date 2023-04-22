
@extends('app.main')
@section('content')
<div class="w-full p-2 flex flex-col text-xs space-y-1">
    <div class="w-full p-2 flex justify-between">
        <h3 class=" text-sm font-semibold my-auto">Funds</h3>
        <a href="/setting/fund/create" class="p-2 bg-blue-500 text-white rounded-md w-24 text-center my-auto"> + Funds</a>
    </div>
    <div class="w-full p-2 flex justify-between bg-gray-400  text-white rounded-md">
        <p class=" my-auto flex-1">Fund Name</p>
        <p class=" my-auto w-16">Currency</p>
        <p class=" my-auto flex-1">Assigned To</p>
        {{-- <p class=" my-auto flex-1">Current Balance</p> --}}
        <p class=" my-auto ">Status</p>
    </div>
    <div class="w-full p-2 flex justify-between bg-gray-200 rounded-md">
        <p class=" my-auto flex-1">BML</p>
        <p class=" my-auto w-16">MVR</p>
        <p class=" my-auto flex-1">Mohamed Naeem</p>
        {{-- <p class=" my-auto flex-1">233,233.33</p> --}}
        <p class=" my-auto  text-green-700">Active</p>
    </div>

</div>
@endsection
