<?php

namespace App\Http\Controllers\Auth;

use App\Models\User as UserModel;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    //注销
    public function logout(){
        $logined_id = session('logined_id');

        $user = UserModel::where('id', $logined_id)
            ->first();

        if (! $user) {
            return '用户不存在';
        }

        $user->update([
            'logouted_at' => date('Y-m-d H:i:s'),
        ]);

        session(['logined_id' => null]);
        session(['logined_phone' => null]);

        return view('welcome');
    }
}
