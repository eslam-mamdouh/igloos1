<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\review;
use App\space;
use App\space_img;
use App\reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\code;
class userController extends Controller
{

    public function send_code(){
        $user = User::where("email",'e.mamdouh3@gmail.com')->first();
        // return $user;
        // if(!$user){
        //     abort(419);
        // }
        $code = rand(100000 , 999999);
        $user->token = $code;
        $user->update();
        session(["code"=>$code]);
        $data = array('name'=>"Eslam");
        Mail::to($user->email)->send(new code);
        echo "HTML Email Sent. Check your inbox.";
     }

    public function logout(){
        Auth::logout();
        return view('login');
    }

    public function signup(Request $req){

        $this->validate($req,
            [
                'email'=>'required',
                'password'=>'required|min:8',
                'fname' =>'required|min:3',
                'lname' =>'required|min:3',
                'phone' =>'required|min:11|max:11',
            ]
            );

        $user = new User;
        $user->first_name = $req->fname;
        $user->last_name = $req->lname;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->role = "client";
        $user->password = $req->password;
        $user->save();
        Auth::login($user);

        return redirect("/");

    }

    public function login(Request $req){
        $this->validate($req,
            [
                'email'=>'required|exists:users',
                'password'=>'required|exists:users'
            ]
            );
        $email = $req->email;
        $pass = $req->password;
        $user = User::where("email" , $email)->where("password" , $pass)->get()->first();
        if($user){
            Auth::login($user);
            return redirect("/");
           
        }

    }

    public function addReservation(Request $req){
        $r = new reservation;
        $r->user_id    = $req->user_id;
        $r->space_id   = $req->space_id ;
        $r->people_num = $req->people_num;
        $r->date       = $req->date;
        $r->time       = $req->time;
        $r->save();
        return back();
        
    }

    public function get_all_users(){
     
        $users = User::all();
        return view('homePage' , ['users' => $users]);
    }

    public function userProfile($id){   
        $reviews=review::all();
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        return view('profile_settings' , ['user' => $user],compact('reviews'));
    }

    public function profileUpdate(Request $req , $id){
       
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        
        $user->first_name   = $req->first_name ;
        $user->last_name    = $req->last_name ;
        $user->email        = $req->email ;
        $user->password     = $req->password ;
        $user->phone        = $req->phone;
        $user->update();
       
        // return redirect('profile/');
        
        return view('profile_settings' , ['user'=>$user]);
    }

    public function review(Request $req){
        $comment  = $req->comment;
        $id       = $req->user_id;
        $space_id = $req->space_id;

        $review = new review;
        $review->comment = $comment;
        $review->user_id = $id;
        $review->space_id = $space_id;

        $review->save();
        return redirect("space");
 
    }

public function display_space($id){
    $reviews=review::where("space_id" , $id);
    $imgs=space_img::where("space_id" , $id);
    $space = space::find($id);
    return view('working_space',['reviews'=>$reviews , 'space'=>$space , 'imgs'=>$imgs]);
}

}