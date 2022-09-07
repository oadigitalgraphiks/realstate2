<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Seller;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Session;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::groupBy("tracking_number")->get();
        return view("inventory.index",compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        $warehouses = Warehouse::where('status',1)->get();
        $sellers = Seller::whereIn('user_id', function ($query) {
            $query->select('id')
                ->from(with(new User)->getTable());
        })->orderBy('created_at', 'desc')->get();
        return view('inventory.create',compact('warehouses','sellers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'tracking_number' => 'required|unique:inventories|max:255',
        ]);
        $all = $request->all();
        $sno = 0;
        $final_products = collect();
        foreach ($all as $key => $al) {
            if ($key != "_token" && $key != "seller_id" && $key != "warehouse_id" && $key != "estimate_arrival" && $key != "tracking_number" && $key != "shipping_carrire" && $key != "reference_number" && $key != "tags" ) {
                $sno++;
                $list = explode("_", $key);
                if ($list != null) {
                    $prod_id = $list[2];
                    $stock_id = $list[4];
                    $final_qty = "p_qty_".$prod_id."_s_".$stock_id;
                    $final_price = "product_id_".$prod_id."_s_".$stock_id."_price";
                    $pro = $prod_id;
                    $stock = $stock_id;
                    $qty = $_POST[$final_qty];
                    $price = $_POST[$final_price];
                    $product_stock = ProductStock::where('id',$stock)->first();
                    $final_products->push(["product_id" => $pro, "stock_id" => $stock,"quantity" => $qty,'price' => $price,'variant' => $product_stock->variant,"sku" => $product_stock->sku ]);
                }
            }
        }

        foreach ($final_products->unique() as $key => $product) {

            $invetory = new Inventory;
            $invetory->seller_id = $request->seller_id;
            $invetory->warehouse_id = $request->warehouse_id;
            $invetory->product_id = $product['product_id'];
            $invetory->stock_id = $product['stock_id'];
            $invetory->variant = $product['variant'];
            $invetory->sku = $product['sku'];
            $invetory->total_quantity = $product['quantity'];
            $invetory->purchase_price = $product['price'];
            $invetory->estimate_arrival = $request->estimate_arrival;
            $invetory->tracking_number = $request->tracking_number;
            $invetory->shipping_carrire = $request->shipping_carrire;
            $invetory->reference_number = $request->reference_number;
            $invetory->save();
        }
        return redirect()->route('inventory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $warehouses = Warehouse::where('status',1)->get();
        $sellers = Seller::whereIn('user_id', function ($query) {
            $query->select('id')
                ->from(with(new User)->getTable());
        })->orderBy('created_at', 'desc')->get();
        $products = Inventory::where("tracking_number",$id)->groupBy("product_id")->pluck("product_id");
        $variant_selected = Inventory::where("tracking_number",$id)->pluck("stock_id");
        $product_stocks = ProductStock::whereIn('id',$variant_selected)->pluck('id');
        $inventory = Inventory::where("tracking_number",$id)->get();
        return view('inventory.edit',compact('warehouses','sellers','inventory','products',"product_stocks"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::where("tracking_number",$request->tracking_number_current)->get();

        foreach ($inventory as $key => $inven) {
            $inven->tracking_number = $request->tracking_number;
            $inven->estimate_arrival = $request->estimate_arrival;
            $inven->shipping_carrire = $request->shipping_carrire;
            $inven->reference_number = $request->reference_number;
            $inven->save();
        }
        return redirect()->route('inventory.edit',["id" => $request->tracking_number]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function receive($id)
    {
        $warehouses = Warehouse::where('status',1)->get();
        $sellers = Seller::whereIn('user_id', function ($query) {
            $query->select('id')
                ->from(with(new User)->getTable());
        })->orderBy('created_at', 'desc')->get();
        $products = Inventory::where("tracking_number",$id)->pluck("product_id");
        $variant_selected = Inventory::where("tracking_number",$id)->pluck("stock_id");
        $product_stocks = ProductStock::whereIn('id',$variant_selected)->pluck('id');
        $inventory = Inventory::where("tracking_number",$id)->get();
        return view('inventory.receive',compact('warehouses','sellers','inventory','products',"product_stocks"));
    }

    public function receive_update(Request $request)
    {
        // $inventory = Inventory::whereIn($request->inventory_id);
        $all = $request->all();
        $sno = 0;
        $final_inventories = collect();
        // invent_1_receive_qty
        // invent_1_total_qty
        // "invent_1_reject_qty"
        // stock_id_13_qty
        // stock_id_13_qty
        // invent_1_reject_qty_stock_44
        // dd($request->all());
        foreach ($all as $key => $al) {
            if ($key != "_token") {
                $list = explode("_", $key);
                $receive_qty = $list[1];
                $total_qty = $list[1];
                $stock_id = $list[5];
                $final_inventory_id = $list[1];
                $final_receive_qty = "invent_".$receive_qty."_receive_qty_stock_".$stock_id;
                $final_total_qty_price = "invent_".$total_qty."_reject_qty_stock_".$stock_id;
                $final_stock_id = "invent_".$receive_qty."_receive_qty_stockid_".$stock_id;
                $qty = $_POST[$final_receive_qty];
                $reject_qty = $_POST[$final_total_qty_price];
                $stock_qty_id = $stock_id;
                $stock_current = $_POST[$final_stock_id];
                $final_inventories->push(["inventory_id" => $final_inventory_id,"receive_qty" => $qty,"reject_qty" => $reject_qty,"stock_qty_id" => $stock_qty_id,'stock_current' => $stock_current]);
            }
        }
        foreach ($final_inventories->unique() as $key => $final_inventory) {
            $inventory = Inventory::find($final_inventory["inventory_id"]);
            $inventory->receive_qty = $final_inventory["receive_qty"];
            $inventory->return_qty = $final_inventory["reject_qty"];
            $inventory->save();
            $product_stock = ProductStock::where("id",$final_inventory["stock_qty_id"])->first();
            $product_stock->qty = $final_inventory["stock_current"] + $final_inventory["receive_qty"];
            $product_stock->save();
        }
        return redirect()->back();
    }

    public function search(Request $request)
    {
        if(isset($request->q)){
            $products = Product::where('published', 1)->where('name', 'like', '%'.$request->q.'%')->paginate(2);
        }else{
            $products = Product::where('published', 1)->paginate(10);
        }
        return [
            'total_count' => $products->count(),
            'items' => $products->map(function($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'thumbnail_img' => uploaded_asset($data->thumbnail_img),
                    'stocks' => $data->stocks,
                ];
            })
        ];
    }

    public function product_list(Request $request){
        $product_ids = collect($request->product_ids);
        return view('inventory.product_list', compact('product_ids'));
    }

    public function product_all(){
        $products = Product::all();

        $variant_selected =  Session::get('stock_selected');
        $product_selected =  Session::get('product_selected');
        return view('inventory.all_product', compact('products','variant_selected','product_selected'));
    }

    public function transfer_products(Request $request)
    {

        $stock_selected = Session::put('stock_selected', $request->stock_id);
        $product_put = Session::put('product_selected', $request->product_id);

        $variant_selected =  Session::get('stock_selected');
        $product_selected =  Session::get('product_selected');

        $product_stocks = null;
        if ($variant_selected != null) {
            $product_stocks = ProductStock::whereIn('id',$variant_selected)->pluck('id');
        }

        $products = Product::whereIn('id',$product_selected)->get();
        return view('inventory.product_list', compact('products',"product_stocks","variant_selected","product_selected"));
    }

    public function history(Request $request)
    {
        if ($request->variant != null) {
            $histories = Inventory::where("product_id",$request->id)->where("variant",$request->variant)->get();
        }else{
            $histories = Inventory::where("product_id",$request->id)->get();
        }
        //dd($history,$request->id);
        return view("inventory.history",compact('histories'));
    }
}
