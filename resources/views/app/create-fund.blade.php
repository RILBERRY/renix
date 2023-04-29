
@extends('app.main')
@section('content')

<form action="{{Route('store-fund')}}" method="post" class="w-full p-2 flex flex-col text-xs space-y-1">
    @csrf
    <div class="w-full p-2 flex justify-between ">
        <h3 class=" text-sm font-semibold my-auto">Create New Fund</h3>
        <a href="/setting" class="p-2 bg-gray-500 text-white rounded-md w-24 text-center my-auto"> Back</a>
    </div>
    <div class=" w-full mt-5 p-2 rounded-lg bg-gray-200 ">
        <div class="p-1 flex flex-col">
            <label for="name">Fund Name:</label>
            <input type="text" name="name" id="name" class="rounded-md p-2">
        </div>
    
        <div class="p-1 flex flex-col">
            <label for="currency">Currency Type:</label>
            <select  name="currency" id="currency" class="rounded-md p-2">
              <option value="MVR">MVR</option>
              <option value="USD">USD</option>
            </select>
        </div>

        <div class="p-1 flex flex-col">
            <label for="assign_to">Assign To:</label>
            <select name="assign_to" id="assign_to" class="rounded-md p-2">
              <option value="">Select User</option>
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              
            </select>
        </div>
    
    
        <div class="p-1 flex flex-col">
            <label for="status">Status:</label>
            <select name="status" id="status" class="rounded-md p-2">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
        </div>
    
        <div class="p-1 flex flex-col">
            <label for="balance">Balance:</label>
            <input type="text" name="balance" id="balance" class="rounded-md p-2">
        </div>

        <div class="mt-2 p-1 flex flex-col">
            <button class="flex-1 bg-green-800/90 text-white rounded-lg p-2">Save</button>
        </div>
    </div>


</div>

@endsection
