<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller{
    public function __construct(){
        $this->middleware('auth:owners');
        $this->middleware(function($request,$next){
            $id = $request->route()->parameter('shop');
            if(!is_null($id)){
            $shopOwenrId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopOwnerId;
                $ownerId = Auth::id();
                if($shopId !== $ownerId){
                    abort(404);
                }
            }
            return $next($request);
        });

    }

    public function index(){
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id',$ownerId)->get();//idを使ってShopモデルでowner_idを検索
        return view('owner.shops.index',compact('shops'));                                                      //取得したshopsをowner.shops.indexに渡す
    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }
}
