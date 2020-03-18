<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\Order as MailOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* Эту задачу можно решить получив все заказы и рассортировав их, используя методы коллекции filter() и sortBy()  */

        $orders['past-due'] = Order::with('products')
            ->where('delivery_dt','<',Carbon::now())
            ->where('status','=','10')
            ->orderBy('delivery_dt','desc')
            ->limit(50)
            ->get();

        $orders['current'] = Order::with('products')
            ->where('delivery_dt','>',Carbon::now())
            ->where('delivery_dt','<',Carbon::now()->addHours(24))
            ->where('status','=','10')
            ->orderBy('delivery_dt','asc')
            ->get();

        $orders['new'] = Order::with('products')
            ->where('delivery_dt','>',Carbon::now())
            ->where('status','=','0')
            ->orderBy('delivery_dt','asc')
            ->limit(50)
            ->get();

        $orders['completed'] = Order::with('products')
            ->where('delivery_dt','>',Carbon::today())
            ->where('delivery_dt','<',Carbon::tomorrow())
            ->where('status','=','20')
            ->orderBy('delivery_dt','desc')
            ->limit(50)
            ->get();

        return view('order.list',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $partners = Partner::all();
        $statuses = config("statuses");
        $products = Product::all();
        return view("order.edit", compact("order", 'partners', 'statuses','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'client_email' => 'required|email',
            'status' => 'required|in:0,10,20',
            'partner_id'=>"required|exists:partners,id"
        ]);

        if ($validator->fails()) {

            return back()->with('fails', implode($validator->errors()->all()," "));

        }

        $order->client_email = $request->client_email;
        $order->status = $request->status;
        $order->partner_id = $request->partner_id;
        $order->save();

        try{

            if($order->status=="20")
            {

                if(!empty($order->partner) && !empty($order->partner->email)){

                    $partner = $order->partner->email;

                }else{

                    $partner = null;

                }

                $vendors = $order->products->map(function ($product){

                    if(!empty($product->vendor) && !empty($product->vendor->email)){

                        return $product->vendor->email;

                    }else{

                        return null;

                    }

                });

                $mails = $vendors->push($partner)->filter(function ($element){
                    //todo сделать валидацию адреса
                    return (!empty($element));

                });

                Mail::to($mails)->send(new MailOrder($order));
            }

        }catch (\Exception $exception){

            return back()->with('fails', 'Ошибка отправки почты');

        }

        return back()->with("success", "Заказ обновлён");
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

}
