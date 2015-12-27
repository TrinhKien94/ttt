<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Admin;
use Auth;
use App\Http\Model\User;
use Session;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\TestInterface;
class AdminUserController extends Controller{
    public function admin_users()
    {
        if(Auth::user()->role !== 1) return redirect('/');
        return Controller::myView('admin_user.admin_users');
    }
    //
    public function search_user(Request $request)
    {
        if(Auth::user()->role !== 1) return redirect('/');
        Session::forget('flash_message');
        $va = $request->input('search_text');
        $n = User::whereNotIN('id',[Auth::user()->id])
                    ->where('username', 'like', "%".$va."%")
                    ->count();
        if($n < 1) 
        {
            Session::flash('flash_message', 'Không tìm thấy kết quả nào!');
            return Controller::myView('admin_user.admin_users');
        }
        else
        {
            $users = User::where('username', 'like', "%".$va."%")
                        ->whereNotIN('id',[Auth::user()->id])
                        ->paginate(6);
            return Controller::myView('admin_user.users')->with('users', $users);
        }
    }
    //
    public function delete_user(Request $request)
    {
        if(Auth::user()->role !== 1) return redirect('/');
        $user = User::find((int)$request->input('user_id'));
        $user->delete();
    }

    public function upToAdmin(Request $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $user = User::find((int)$request->input('user_id'));
        $user->role = 1;
        $user->save();
    }
    public function downToUser(Request $request){
        if(Auth::user()->role !== 1) return redirect('/');
        $user = User::find((int)$request->input('user_id'));
        $user->role = 0;        
        $user->save();
    }
}