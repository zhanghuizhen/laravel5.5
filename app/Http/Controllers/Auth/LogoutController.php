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
            throw new \Exception('用户不存在');
        }

        $user->update([
            'logouted_at' => date('Y-m-d H:i:s'),
        ]);

        session(['logined_id' => null]);
        session(['logined_phone' => null]);

        return Response::json([
            'code' => 0,
            'msg' => 'id为' . $logined_id . '的用户注销成功',
        ]);
    }
}
