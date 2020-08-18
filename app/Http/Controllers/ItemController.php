<?php

namespace App\Http\Controllers;

use App\Item;
use App\Action;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\FundsRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Config;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user=Auth::user();
        $items=Item::where('user_id',$user->id)->get();
        $logs = Action::all();
        $details = $this->getDetails('USD');
        return view('dashboard')->with('items',$items)->with('logs',$logs)->with('details',$details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStoreRequest $request)
    {
        $request->validated();

        $item=new Item();
        $item->name=$request->name;
        $item->description=$request->description;
        $item->type=$request->type;
        $item->cost=$request->cost;
        $item->currency=$request->currency;
        $item->user_id=Auth::user()->id;

        $item->save();

        $this->createLog("New Saving: ".$item->name." created")->save();

        return redirect('/item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $item = Item::where('id',$id)->first();
        return view('item.show')->with('item',$item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::where('id',$id)->first();
        return view('item.edit')->with('item',$item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemStoreRequest $request,$id)
    {
        $request->validated();

        $item = Item::find($id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->cost = $request->cost;
        $item->currency = $request->currency;
        $item->type = $request->type;

        $item->save();
        
        $log = new Action();
        $log = $this->createLog("Updated Saving: ".$item->name);
        $log->save();    
        
        return redirect('/item');
    }
    
    public function updateSaved(FundsRequest $request,$id)
    {
        $request->validated();

        $item = Item::find($id);
        if($item->cost<$request->saved){
            $item->saved = $item->cost;
        }
        else{
            $item->saved = $request->saved;
        }
        $item->save();
        $log = new Action();
        $log = $this->createLog("Changed Funds to Saving: ".$item->name." to ".$item->saved);
        $log->save();        
        
        return redirect('/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //first get the item model to be deleted
        $item = Item::where('id',$id)->first();
        // delete the logs associated with the Item
              
        $this->createLog("Item deleted: ".$item->name);
        $item->delete();        
        return redirect('/item');

    }

    //pass in the model you want to create a log for and  a log string
    public function createLog(String $str){

        $log = new Action();
        $log->user_id=Auth::user()->id;
        $log->log_text=$str;
        $log->save();
        return $log;
    }
    //Details for the items
    public function getDetails($details_currency){
        $items = Item::all();
        $details = new \stdClass;
        $details->total_items = count($items);
        $totalCost = 0;
        $totalSaved = 0;
        $adjusted_items = $items;
        foreach($adjusted_items as $item){
            $ratio = $this->converter($item->currency,$details_currency);
            $item->cost = $item->cost*$ratio;
            $item->saved = $item->saved*$ratio;
            $totalCost = $totalCost + $item->cost;
            $totalSaved = $totalSaved + $item->saved*$ratio;
            
        }

    /*Changing all items to same currency
        foreach ($adjusted_items as $item) {
            $ratio = $this->converter($item->currency,$details_currency);
            $totalCost = $totalCost + $item->cost*$ratio;
            $totalSaved = $totalSaved + $item->saved*$ratio;

        }*/

    //Adjusting decimals and filling $details
        $details->adjusted_items = $adjusted_items;
        $details->total_cost = number_format($totalCost,2);
        $details->total_saved = number_format($totalSaved,2);
        $details->total_left = number_format($totalCost - $totalSaved,2);
        return $details;


    }

    //function for converting currencies using indexes with finnhub API / example:converter('USD','EUR') will return how much EUR equals to 1 USD
    public function converter(String $currency1,String $currency2){
        $config = \Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token',config('app.finnhub_api_key'));
        $client = new \Finnhub\Api\DefaultApi(
            new \GuzzleHttp\Client(),
            $config
        );
        $json_Currency = $client->forexRates($currency1);
        $decoded_Currency = json_decode($json_Currency,true);
        error_log($decoded_Currency["quote"][$currency2]);
        return $decoded_Currency["quote"][$currency2];
        
    }
}
