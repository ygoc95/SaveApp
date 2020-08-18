@extends('layouts.app')
@section('head')
    
@endsection
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="col-md-10 mt-4">
                <div class="bg-main p-4 rounded row">
                    <div class="col-md-2">
                        
                            <i class="fa fa-user fa-5x" aria-hidden="true"></i>
                        
                    </div>
                    <div class="col-md-8">
                        <p>Username: {{ Auth::user()->name }}</p>
                        <p>Email: {{ Auth::user()->email }}</p>
                        <p>User since: {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection