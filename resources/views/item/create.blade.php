@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-10 bg-main p-4 rounded">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="/item/store">
                @csrf
                <div class="form-group">
                    <label for="nameInput">Title of Saving</label>
                    <input type="text" class="form-control" name="name" id="nameInput"/>
                </div>
                <div class="form-group">
                    <label for="decriptionInput">Description (Optional)</label>
                    <textarea class="form-control" name="description" style="resize:none;" rows="3" maxlength="200" id="descriptionInput"></textarea>       
                </div>
                <div class="form-group">
                    <label for="typeInput" class="form-label">Type</label>
                    <x-type_list/>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="costInput">Cost</label>
                        <input type="number" min=0 class="form-control" name="cost" id="costInput"/>
                    </div>
                    <div class="col">
                        <label for="currencyInput" >Currency</label>
                        <x-currency_list/>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mt-3" type="submit">Save</button>
                </div>            
            </form>
        </div>
    </div>
    </div>
@endsection