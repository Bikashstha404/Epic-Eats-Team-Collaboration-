<?php
 
 namespace App\Http\Controllers\Admin;
 
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth; 
 use App\Models\Product;
 use Illuminate\Support\Facades\Session; 
 use App\Models\Coupon;
 use App\Models\Order;
 use App\Models\OrderItem;
 use Carbon\Carbon;
 
 class ManageOrderController extends Controller
 {
     public function PendingOrder(){
         $allData = Order::where('status','Pending')->orderBy('id','desc')->get();
         return view('admin.backend.order.pending_order',compact('allData'));
     }
     //End Method 
     public function ConfirmOrder(){
        $allData = Order::where('status','confirm')->orderBy('id','desc')->get();
        return view('admin.backend.order.confirm_order',compact('allData'));
    }
    //End Method 
    public function ProcessingOrder(){
        $allData = Order::where('status','processing')->orderBy('id','desc')->get();
        return view('admin.backend.order.processing_order',compact('allData'));
    }
    //End Method 
    public function DeliveredOrder(){
        $allData = Order::where('status','delivered')->orderBy('id','desc')->get();
        return view('admin.backend.order.delivered_order',compact('allData'));
    }
    //End Method 

    public function AdminOrderDetails($id){
        $order = Order::with('user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();

        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }

        return view('admin.backend.order.admin_order_details',compact('order','orderItem','totalPrice'));

    } //End Method 
    
    public function PendingToConfirm($id){
        Order::find($id)->update(['status' => 'confirm']);
        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('confirm.order')->with($notification);
    }
    //End Method 

    public function ConfirmToProcessing($id){
        Order::find($id)->update(['status' => 'processing']);
        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('processing.order')->with($notification);
    }
    //End Method 

    public function ProcessingToDelivered($id){
        Order::find($id)->update(['status' => 'delivered']);
        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('delivered.order')->with($notification);
    }
    //End Method 

    public function AllClientOrders(){
        $clientId = Auth::guard('client')->id();

        $orderItemGroupData = OrderItem::with(['product','order'])->where('client_id',$clientId)
        ->orderBy('order_id','desc')
        ->get()
        ->groupBy('order_id');
        return view('client.backend.order.all_orders',compact('orderItemGroupData'));
    }
      //End Method 

      public function ClientOrderDetails($id){
        $cid = Auth::guard('client')->id();
        $order = Order::with('user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->where('client_id',$cid)->orderBy('id','desc')->get();

        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }

        return view('client.backend.order.client_order_details',compact('order','orderItem','totalPrice'));

    }
     //End Method 

      public function UserOrderList(){
         $userId = Auth::user()->id;
         $allUserOrder = Order::where('user_id',$userId)->orderBy('id','desc')->get();
         return view('frontend.dashboard.order.order_list',compact('allUserOrder'));
     }

       //End Method 
       public function UserOrderDetails($id){
        $order = Order::with('user')->where('id',$id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();

        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }

        return view('frontend.dashboard.order.order_details',compact('order','orderItem','totalPrice'));
    }
     //End Method 

     public function ClientPendingToConfirm($id){
        $clientId = Auth::guard('client')->id();
        $orderItem = OrderItem::where('order_id', $id)->where('client_id', $clientId)->first();
    
        if (!$orderItem) abort(403, 'Unauthorized action.');
    
        Order::find($id)->update(['status' => 'confirm']);
    
        return redirect()->back()->with([
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        ]);
    }
    
    public function ClientConfirmToProcessing($id){
        $clientId = Auth::guard('client')->id();
        $orderItem = OrderItem::where('order_id', $id)->where('client_id', $clientId)->first();
    
        if (!$orderItem) abort(403, 'Unauthorized action.');
    
        Order::find($id)->update(['status' => 'processing']);
    
        return redirect()->back()->with([
            'message' => 'Order Moved to Processing',
            'alert-type' => 'success'
        ]);
    }
    
    public function ClientProcessingToDelivered($id){
        $clientId = Auth::guard('client')->id();
        $orderItem = OrderItem::where('order_id', $id)->where('client_id', $clientId)->first();
    
        if (!$orderItem) abort(403, 'Unauthorized action.');
    
        Order::find($id)->update(['status' => 'delivered']);
    
        return redirect()->back()->with([
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        ]);
    }
    




} 
