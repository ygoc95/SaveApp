@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-4">
            <!-- Upper Part Item -->
            <div class="row ">
                <div class="col">
                    <h1>{{$item->name}}</h1>
                </div>
                <div class="col-text-right">
                    <a href="/item/edit/{{$item->id}}" class="btn btn-primary mr-2">Edit</a>
                    <a href="/item/destroy/{{$item->id}}" class="btn btn-primary mr-4">Delete</a>
                </div>         
            </div>
             <!-- Details Part Item -->
                <div class="show-body mt-4">
                    <p class="h2"> Type: {{$item->type}}</p>
                    <p class="h2 mt-3"> Description: {{$item->description}}</p>
                    <p class="h2 mt-3"> Amount: {{$item->cost}} {{$item->currency}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection