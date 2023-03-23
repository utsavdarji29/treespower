<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Admin;
use App\Models\Tree;
use App\Models\Manager;
use Validator;
use Session;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function __construct()
    {
        if(!session()->has('backUrl'))
        {
            Session()->put('backUrl', URL::previous());
        }
        
    }
    public function login()
    {
        if(Auth::guard('admin')->check()){

            if(!session()->has('backUrl')){
                return redirect()->route('adminpanel.dashboard');
            }
            else
            {   
                $redirecturl = session('url')['intended'];
                $url =  env('APP_URL');
                $new_url = str_replace($url, $url.'/adminpanel', $redirecturl);
               
                return redirect($new_url);
            }
            
        }
        elseif(Auth::guard('manager')->check())
        {
            if(!session()->has('backUrl')){
                return redirect()->route('managerpanel.dashboard');
            }
            else
            {   
                $redirecturl = session('url')['intended'];
                $url =  env('APP_URL');
                $new_url = str_replace($url, $url.'/managerpanel', $redirecturl);
               
                return redirect($new_url);
            }
            //return redirect()->route('managerpanel.dashboard');
        }
        else
        {
        return view('front.login');
        }
    }
    
    public function submitlogin(Request $request,$id=null) {

        try {
           
            $validator = Validator::make( $request->all(), $this->getRules('Add', $request->all()), $this->messages());
            if ($validator->fails()) {
                
                return redirect()->back()->withInput()->withErrors($validator->messages());
            }

            
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
            {
                if(!session()->has('backUrl')){

                    return redirect()->route('adminpanel.dashboard');
                }
                else
                {   
                    $redirecturl = session('url')['intended'];
                    $url =  env('APP_URL');
                    $new_url = str_replace($url, $url.'/adminpanel', $redirecturl);
                   
                    return redirect($new_url);
                }
               
            }
            
            if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
            { 

                if(session()->has('backUrl'))
                {
                    $redirecturl = session('url')['intended'];
                    $url =  env('APP_URL');
                    $new_url = str_replace($url, $url.'/managerpanel', $redirecturl);
                   
                    return redirect($new_url);
                    //return redirect(session('url')['intended']);
                }
                else
                {
                    return redirect()->route('managerpanel.dashboard');
                }
            }
            return redirect()->back()->withInput()->withErrors(['Invalid email or password.']);
        } catch (RuntimeException $ex) {

            return redirect()->back()->withInput()->withErrors([$ex->getMessage()]);
        }
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
        return redirect()->route('adminpanel.login');
    }

    private function getRules($type, $input) {
        $return = array();
        $return['email'] = 'required';
        $return['password'] = 'required|max:20';
        return $return;
    }

    private function messages() {
        return [
            // 'question.required'  => 'The question field is required.'
        ];
    }
}
