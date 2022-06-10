<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Modules\News\Http\Controllers\NewsController;


class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['message' => 'Success'], 200);
        }
        else
        {
            dd($validator->errors());
        }

    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('authToken')->accessToken;
            $success['name'] =  $user->name;
            return response()->json($success, 200);
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function userInfo()
    {

        $user = auth()->user();

        return response()->json(['user' => $user], 200);

    }


    public function newsBlog()
    {
        $newsModule = new NewsController();
        //$blog = $blogsModule->show(1);
        $news = $newsModule->index();

        if($news)
        {
            return response()->json(['status'=>1,'message'=>'Success', 'data'=>$news], 200);
        }
        else
        {
            return response()->json(['status'=>0, 'message'=>'something went wrong.'], 204);
        }



    }
}