<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OwnerController extends Controller
{
    protected function orders() {
        return view('orders');
    }

    protected function products() {
        $products = Product::where('owner_id', Auth::user()->id)->get();
        $count = Product::count();
        return view('products', compact('products', 'count'));
    }

    protected function store(Request $request) {    
        if(is_null($request->photo)) {        
            Product::where('id', $request->id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            toast('Berhasil mengedit produk', 'success');
        } else {
            $id = $request->id;
            $ownerId = Auth::user()->id;
            $file = $request->file('photo'); // menyimpan data file yang diupload ke variabel $file
            $photo = $ownerId.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/images/products/', $photo);

            Product::updateOrCreate(
                ['id' => $request->id],
                [
                    'owner_id' => $ownerId,
                    'name' => $request->name,
                    'description' => $request->description,
                    'photo' => '/images/products/'.$photo
                ]
            );

            if($id) {
                File::delete(public_path() . Product::find($id)->photo);
                toast('Berhasil mengedit produk', 'success');
            } else {
                toast('Berhasil menambahkan produk', 'success');
            }
        }
        return redirect('/products');
    }

    protected function show($id) {
        return response()->json(Product::find($id));
    }

    protected function destroy($id) {
        $product = Product::find($id);
        File::delete(public_path() . $product->photo);
        $product->delete();
        toast('Berhasil menghapus produk', 'success');

        return redirect('/products');
    }

}
