<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Order;

class OwnerController extends Controller
{
    protected function userId() {
        return Auth::user()->id;
    } 
    
    protected function orders() {
        $products = Order::where('in_cart', 0)->with('product')->get();
        
        $orders = [];

        foreach ($products as $val) {
            if($val->product->owner_id == $this->userId()) {
                array_push($orders, $val);
            }
        }

        return view('owner.orders', compact('orders'));
    }

    protected function products() {
        $products = Product::where('owner_id', $this->userId())->get();
        $count = Product::where('owner_id', $this->userId())->count();
        return view('owner.products', compact('products', 'count'));
    }

    protected function store(Request $request) {    
        if(is_null($request->photo)) {        
            Product::where('id', $request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'link' => $request->link,
                'description' => $request->description,
            ]);
            toast('Berhasil mengedit produk', 'success');
        } else {
            $id = $request->id;
            $ownerId = $this->userId();
            $file = $request->file('photo'); // menyimpan data file yang diupload ke variabel $file
            $photo = $ownerId.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/images/products/', $photo);

            if($id) {
                File::delete(public_path() . Product::find($id)->photo);
            }

            Product::updateOrCreate(
                ['id' => $request->id],
                [
                    'owner_id' => $ownerId,
                    'name' => $request->name,
                    'link' => $request->link,
                    'price' => $request->price,
                    'description' => $request->description,
                    'photo' => '/images/products/'.$photo
                ]
            );

            toast('Data berhasil disimpan', 'success');
        }
        return redirect('/products');
    }

    protected function destroy($id) {
        $product = Product::find($id);
        File::delete(public_path() . $product->photo);
        $product->delete();
        toast('Berhasil menghapus produk', 'success');

        return redirect('/products');
    }

}
