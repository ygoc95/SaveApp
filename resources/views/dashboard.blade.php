@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/chartist.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-4">
                <div class="bg-main p-4 rounded">
                    <!-- Upper Part Savelist -->
                    <div class="row ">
                        <div class="col">
                            <h2>Saving List</h2>
                        </div>
                        <div class="col-text-right">
                            <a href="/item/create" class="btn btn-primary mr-4">Create Saving</a> 
                        </div>         
                    </div>
                    <!-- Savings Table -->
                    <div class="table-responsive-md mt-4">
                    
                        <table class="table">
                            <thead class="thead-dashboard">
                                <tr>
                                    <th scope="col">Item&nbspName</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Saved</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col">Created&nbspAt</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-dashboard">
                            @isset($items)
                                @foreach ($items as $item)
                                    <tr >
                                        <th class="align-middle"><a href="/item/show/{{$item->id}}">{{$item->name}}</a></th>
                                        <th class="align-middle">{{$item->type}}</th>
                                        <th class="align-middle">{{$item->saved}}</th>
                                        <th class="align-middle">{{$item->cost}}</th>
                                        <th class="align-middle">{{$item->currency}}</th>
                                        <th class="align-middle">{{$item->created_at->format('m/d/Y')}}</th>
                                        <!-- Dropdown Action Button -->
                                        <th class="align-middle"><div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a type="button" data-id="{{$item->id}}" class="btn btn-primary dropdown-item addFundsModalButton" data-toggle="modal" data-target="#addFundsModalid">Add Funds</a>
                                                <a class="dropdown-item" href="/item/edit/{{$item->id}}">Edit Saving</a>
                                                <a type="button" data-id="{{$item->id}}" class="btn btn-primary dropdown-item deleteModalButton" data-toggle="modal" data-target="#deleteModalid">Delete Saving</a>
                                            </div>
                                        </div>
                                        </th>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Savings Details -->
                <div class=" mt-5 bg-main p-4 rounded m-0">
                    <h2>Details</h2>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">By Item</a>
                        </li>
                        </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="mt-4 row">
                            <div class="col-md-5">
                                @isset($details)
                                <p class="lead">Total Items: {{$details->total_items}}</p>
                                <p class="lead">Total Cost: {{$details->total_cost}}$</p>
                                <p class="lead">Total Saved: {{$details->total_saved}}$</p>
                                <p class="lead">Amount left: {{$details->total_left}}$</p>
                                @endisset
                            </div>
                            <div class="col-md-5">
                                <div id="pie-chart" class="ct-chart ct-perfect-fourth"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @foreach ($items as $item)
                        <div class="row mt-2">
                                <div class="col-md-5 mt-3 ml-3">                            
                                    <p class="lead">Item name: {{$item->name}} </p>
                                    <p class="lead">Item Saved: {{$item->saved}} {{$item->currency}}</p>
                                    <p class="lead">Item Cost: {{$item->cost}} {{$item->currency}}</p>
                                </div>
                                <div class="col-md-5">                            
                                    <div id='graph{{$item->id}}' class="ct-chart ct-perfect-fourth"></div>
                                </div>                            
                        </div>
                        <hr class="my-4"> 
                        @endforeach
                    </div>
                </div>
                <p class="small"> Conversions provided by Finnhub API</p>   
                </div>
                 <!-- Log Details -->
                <div class="mt-5 bg-main p-4 rounded">              
                    <div class="col-md-10">
                        <h2>Last Actions</h2>
                        <ul>
                            @isset($logs)
                                @foreach ($logs as $log)
                                    <li><p>{{$log->created_at}}: {{$log->log_text}}</p></li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                </div>
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModalid" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                            Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                @isset($item)
                                    <form id="deleteForm" >
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Funds Modal -->
                <div class="modal fade addfundsmodal" id="addFundsModalid" tabindex="-1" role="dialog" aria-labelledby="addFundsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                @isset($items)
                                    <form id="addFundsForm" method="POST" >
                                        @csrf
                                        <label for="addFunds" id="addFundsLabel">How much saved?</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" value=0 name="saved" id="addFunds"/>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-money"></i> Add</button>
                                    </form>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="js/chartist.min.js"></script>
   <script type="text/javascript">
        
        var general_items = {!! json_encode($details->adjusted_items->toArray()) !!};
        var cost_details = {!! json_encode($details->total_cost) !!};
        console.log(cost_details);
        cost_details = cost_details.split(',').join("");
        console.log(cost_details);
        var float_cost_details =  parseFloat(cost_details);
        console.log(float_cost_details);
        var label = [];
        var serie = [];
        general_items.forEach(item => {
            label.push(item.name +' '+(item.cost*100/float_cost_details).toFixed(2) + '%' );
            serie.push(item.cost);
        });
        var data = {
            labels: label,
            series: serie
        };
        var options = {
            width: '400px',
            height: '400px'
        };

        console.log(general_items);
        new Chartist.Pie('#pie-chart', data);
        console.log('beginning')
        general_items.forEach(item=>{
            var general_data= {};
            if(item.saved == 0){
                console.log("iteration1");
                general_data = {
                    labels: ["No","saving yet"],
                    series: [item.saved,item.cost-item.saved]
                };
            }
            else{
                var percentage = item.saved*100/item.cost;
                console.log("iteration2 "+item.saved+" "+item.cost);
                general_data = {
                    labels: ['Saved \n'+percentage.toFixed(2)+'%','Remaining '+(100-percentage).toFixed(2)+'%'],
                    series: [item.saved,item.cost-item.saved]
                };
            }
            new Chartist.Pie('#graph'+item.id,general_data);
        });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $(e.currentTarget.hash).find('.ct-chart').each(function(el, tab) {
            tab.__chartist__.update();
            });
        });

        $('.deleteModalButton').click(function(){
            var id = $(this).attr('data-id');
            console.log("HERE")
            console.log(id);
            document.getElementById('deleteForm').action='/item/destroy/'+id;
        });

        
        $('.addFundsModalButton').click(function(){
            var id = $(this).attr('data-id');
            console.log("ADD HERE")
            console.log(id);
            document.getElementById('addFundsForm').action='/item/update/funds/'+id;
        });


    </script>
@endsection