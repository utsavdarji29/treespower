<?php

namespace App\Http\Controllers\managerpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Manager;
use Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('managerpanel.login');
    }

    public function submitlogin(Request $request) {
    	try
		{
            $validator = Validator::make( $request->all(), $this->getRules('Add', $request->all()), $this->messages());
            if ($validator->fails())
			{
                return redirect()->back()->withInput()->withErrors($validator->messages());
            }
            if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
			{
				$data = Manager::query()->where('email',$request->email)->first();

				if($data)
				{
	                return redirect()->route('managerpanel.dashboard');
				}
				else
				{
					Auth::logout();
					//return redirect()->route('managerpanel.login');
					return redirect()->back()->withInput()->withErrors(['Invalid Manager']);
				}
            }

            return redirect()->back()->withInput()->withErrors(['Invalid email or password.']);
        } catch (RuntimeException $ex) {
            return redirect()->back()->withInput()->withErrors([$ex->getMessage()]);
        }
    }

    public function forgotpassword(Request $request) 
    {
        $input = $request->all();
        
        /*$validator = Validator::make( $input, $this->getRules('Add', $input), $this->messages());
        if ($validator->fails()) { 
            $data = array('type'=>'add', 'input'=>$input, 'agenc_id'=>Auth::id(), 'error'=>$validator->messages());
            return view('agencypanel.addagent', compact('data'));
            exit();            
        }*/

        $email = $input['forgotEmail'];
        $new_password = rand(100000,999999);
        $change_pass['password'] = bcrypt($new_password); 

        $checkMail = Manager::where('email', '=', $email)->get();

        if (count($checkMail) > 0) 
        {
            $change = Manager::where('email', '=', $email)->update($change_pass);

            $to = $email;
            $from = "enquiry@amgmarketingnow.com";
            $line1 = "You forgot your password ?";
            $line2 = "No problem, use this temporary Password : ".$new_password;
            $subject = "Forgot password";

            $headers = "From: $from";
            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: ". $from . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
            $body .= "<table style='width: 100%;'>";
            $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
            $body .= "</td></tr></thead><tbody>";
            $body .= "<tr><td style='border:none;' align = 'center'>{$line1}</td></tr>";
            $body .= "<tr><td></td></tr>";
            $body .= "<tr><td style='border:none;'> </td></tr>";
            $body .= "<tr><td></td></tr>";
            $body .= "<tr><td colspan='2' style='border:none;' align = 'center'>{$line2}</td></tr>";
            $body .= "</tbody></table>";
            $body .= "</body></html>";

            mail($to, $subject, $body, $headers);
        
            return redirect()->back()->withInput()->withErrors(['Password Sent to mail successfully.']);
            //return redirect()->route('managerpanel.login')->with('success', 'Password Sent to mail successfully.');
        }
        else
        {
            return redirect()->back()->withInput()->withErrors(['Email not found in our System.']);
            //return redirect()->route('managerpanel.login')->with('success', 'Email not found in our System.');
        }
    }

    public function logout() {
    	Auth::logout();
    	return redirect()->route('managerpanel.login');
    }

    private function getRules($type, $input) {
        $return = array();
        $return['email'] = 'required|max:50';
        $return['password'] = 'required|max:20';
        return $return;
    }

    private function messages() {
        return [
            // 'question.required'  => 'The question field is required.'
        ];
    }
}
