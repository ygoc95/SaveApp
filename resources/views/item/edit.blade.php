@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="bg-main p-4 rounded">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                 <form method="POST" action="/item/update/{{$item->id}}">
                @csrf
                <div class="form-group">
                    <label for="nameInput">Title of Saving</label>
                    <input type="text" class="form-control" name="name" value="{{$item->name}}" id="nameInput">
                </div>
                <div class="form-group">
                    <label for="decriptionInput">Description (Optional)</label>
                    @isset($item->description)
                        <textarea class="form-control" name="description" style="resize:none;" value={{$item->description}} rows="3" maxlength="200" id="descriptionInput">{{$item->description}}</textarea>       
                    @endisset
                    @empty($item->description)
                    <textarea class="form-control" name="description" style="resize:none;" rows="3" maxlength="200" id="descriptionInput"></textarea>       
                    @endempty
                
                </div>
                <div class="form-group">
                    <label for="typeInput" class="form-label">Type ( {{$item->type}} before)</label>
                <x-type_list :type="$item->type"/>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="costInput">Cost</label>
                        <input type="number" min=0 class="form-control" value={{$item->cost}} name="cost" id="costInput"/>
                    </div>
                    <div class="col">
                        <label for="currencyInput" >Currency</label>
                        <x-currency_list :currency="$item->currency" />
                    </div>
                </div>
                <div class="form-group row ml-0">
                    <button class="btn btn-primary mt-3" type="submit">Save</button>
                    <a href="/item" class="btn btn-primary mt-3 ml-2">Cancel</a>
                </div>            
            </form>
        </div>
        </div>
        </div>
    </div>
@endsection