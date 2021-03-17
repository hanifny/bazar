<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected function userId() {
        return Auth::user()->id;
    }

    protected function approve($id) {
        try {
            User::find($id)->assignRole('owner');
            toast('Status berhasil diubah', 'success');
        } catch (\Throwable $th) {
            toast('Status gagal diubah', 'error');    
        }

        return redirect('/dashboard');
    }

    protected function dashboard() {
        $needApprovalUsers = User::doesntHave('roles')->get();
        return view('admin.dashboard', compact('needApprovalUsers'));
    }

    protected function information() {
        $posts = Post::all();
        return view('admin.information', compact('posts'));
    }

    protected function storeInfo(Request $request) {    
        $adminId = $this->userId();
        if(is_null($request->photo)) {        
            Post::where('id', $request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'author_id' => $adminId,
            ]);
            toast('Berhasil memperbarui informasi', 'success');
        } else {
            $id = $request->id;
            $file = $request->file('photo'); // menyimpan data file yang diupload ke variabel $file
            $photo = $adminId.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/images/information/', $photo);

            if($id) {
                File::delete(public_path() . Post::find($id)->photo);
            }

            Post::updateOrCreate(
                ['id' => $request->id],
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'author_id' => $adminId,
                    'photo' => '/images/information/'.$photo
                ]
            );

            toast('Data berhasil disimpan', 'success');
        }
        return redirect('/information-adm');
    }

    protected function getInfo($id) {
        return response()->json(Post::find($id));
    }

    protected function indexInfo() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('info', compact('posts'));
    }

    protected function showInfo($id) {
        $info = Post::find($id);
        return view('detail-info', compact('info'));
    }

    protected function destroyInfo($id) {
        $product = Post::find($id);
        File::delete(public_path() . $product->photo);
        $product->delete();
        toast('Berhasil menghapus informasi ini', 'success');

        return redirect('/information-adm');
    }
}
