<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /* Register api */
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'userName' => 'required', 
            'email' => 'required', 
            'password' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $pswrd = $input['password'];
        $input['password'] = bcrypt($input['password']); 
        $tkn = md5(rand(1,999999));
		$input['userToken'] = $tkn;
		$input['name'] = $input['userName'];
		
		if(isset($input["profilePicture"])){
			$imagePath = $input["profilePicture"];
			$filename = rand(0000,9999).$imagePath->getClientOriginalName();
			$extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
			$filename = rand(0000,9999)."userpic.".$extension;
			$upload_dir_path = public_path()."/uploads/userProfile";
			$imagePath->move($upload_dir_path, $filename );
			$input['profilePicture'] = $filename;
		}
		//-------------------Message------------------------------
		
			$msg1 = "User Registered Successfully";
			$msg2 = "User not Registered Successfully";
			$msg3 = "User already Registered with this email";
        
        //-------------------Message------------------------------	
        
		$user_email = User::query()
						->select('email')
						->where('email',$input['email'])
						->get();

		if(count($user_email) <= 0)
		{
			$user = User::create($input); 
			// $success['token'] =  $user->createToken('MyApp')-> accessToken;
			
			$date = date_create($user->created_at);
			$sDate =  date_format($date,"Y-m-d H:i:s");
			
			$success['userid'] =  $user->id;
			$success['userName'] =  $user->name;
			$success['email'] =  $user->email;
			$success['userToken'] =  $user->userToken;
			
			if($user->id > 0){
				return response()->json(['status'=>1,'message'=>$msg1,'result'=>$success]); 
			}
			else{
				return response()->json(['status'=>0,'message'=>$msg2]); 
			}
        }
		else
		{
			return response()->json(['status'=>0,'message'=>$msg3]);
		}
	}
	
	/* Register api */
    public function registerWithFacebook(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'userName' => 'required', 
            'email' => 'required', 
            'fb_id' => 'required',
            'fb_token' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();  
        $tkn = md5(rand(1,999999));
		$input['userToken'] = $tkn;
		$input['name'] = $input['userName'];
		
		if(isset($input["profilePicture"])){
			$imagePath = $input["profilePicture"];
			$filename = rand(0000,9999).$imagePath->getClientOriginalName();
			$extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
			$filename = rand(0000,9999)."userpic.".$extension;
			$upload_dir_path = public_path()."/uploads/userProfile";
			$imagePath->move($upload_dir_path, $filename );
			$input['profilePicture'] = $filename;
		}
		//-------------------Message------------------------------
		
			$msg1 = "User Registered Successfully";
			$msg2 = "User not Registered Successfully";
			$msg3 = "User login Successfully";
        
        //-------------------Message------------------------------	
        
		$user_email = User::query()
						->where('fb_id',$input['fb_id'])
						->get();

		if(count($user_email) <= 0)
		{
			$user = User::create($input); 
			// $success['token'] =  $user->createToken('MyApp')-> accessToken;
			
			$date = date_create($user->created_at);
			$sDate =  date_format($date,"Y-m-d H:i:s");
			
			$success['userid'] =  $user->id;
			$success['userName'] =  $user->name;
			$success['email'] =  $user->email;
			$success['userToken'] =  $user->userToken;
			
			if($user->id > 0){
				return response()->json(['status'=>1,'message'=>$msg1,'result'=>$success]); 
			}
			else{
				return response()->json(['status'=>0,'message'=>$msg2]); 
			}
        }
		else
		{
			$tkn = md5(rand(1,999999));
			$update['userToken'] = $tkn;
			$user = User::where('id', '=', $user_email[0]->id)->update($update);

			return response()->json(['status'=>1,'message'=>$msg3,'userToken'=>$tkn]);
		}
	}

	/* Register api */
    public function registerWithGoogle(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'userName' => 'required', 
            'email' => 'required', 
            'google_id' => 'required',
            'google_token' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all();  
        $tkn = md5(rand(1,999999));
		$input['userToken'] = $tkn;
		$input['name'] = $input['userName'];
		
		if(isset($input["profilePicture"])){
			$imagePath = $input["profilePicture"];
			$filename = rand(0000,9999).$imagePath->getClientOriginalName();
			$extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
			$filename = rand(0000,9999)."userpic.".$extension;
			$upload_dir_path = public_path()."/uploads/userProfile";
			$imagePath->move($upload_dir_path, $filename );
			$input['profilePicture'] = $filename;
		}
		//-------------------Message------------------------------
		
			$msg1 = "User Registered Successfully";
			$msg2 = "User not Registered Successfully";
			$msg3 = "User login Successfully";
        
        //-------------------Message------------------------------	
        
		$user_email = User::query()
						->where('google_id',$input['google_id'])
						->get();

		if(count($user_email) <= 0)
		{
			$user = User::create($input); 
			// $success['token'] =  $user->createToken('MyApp')-> accessToken;
			
			$date = date_create($user->created_at);
			$sDate =  date_format($date,"Y-m-d H:i:s");
			
			$success['userid'] =  $user->id;
			$success['userName'] =  $user->name;
			$success['email'] =  $user->email;
			$success['userToken'] =  $user->userToken;
			
			if($user->id > 0){
				return response()->json(['status'=>1,'message'=>$msg1,'result'=>$success]); 
			}
			else{
				return response()->json(['status'=>0,'message'=>$msg2]); 
			}
        }
		else
		{
			$tkn = md5(rand(1,999999));
			$update['userToken'] = $tkn;
			$user = User::where('id', '=', $user_email[0]->id)->update($update);

			return response()->json(['status'=>1,'message'=>$msg3,'userToken'=>$tkn]);
		}
	}

	/* login api */
    public function login(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'userEmail' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
		$userEmail = $input['userEmail'];        
		$password = $input['password']; 
		
		//-------------------Message------------------------------
		$msg1 = "Login Successfully";
		$msg2 = "Email or Password is incorrect";
		//-------------------Message------------------------------	

		//if (Auth::guard('web')->attempt(['email' => $userEmail, 'password' => $password], false)) {
		$userLogin = User::query()
							->select('*')
							//->where('id',Auth::user()->id)
							->where('email',$userEmail)
							->get();  
		if(count($userLogin)>0)		
		{	
			if(count($userLogin)>0)		
			{
				$tkn = md5(rand(1,999999));
				$update['userToken'] = $tkn;
				$user = User::where('id', '=', $userLogin[0]->id)->update($update);

				$userData['userid'] =  $userLogin[0]->id;
				$userData['userName'] =  $userLogin[0]->name;
				$userData['email'] =  $userLogin[0]->email;
				$userData['userToken'] =  $tkn;
			
				return response()->json(['status'=>1,'message'=>$msg1,'result'=>$userData]); 
			}
		}
		else{
			return response()->json(['status'=>0,'message'=>$msg2]); 
		}
	}
	
	/* Forgot Password api */
    public function forgotPassword(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            'userEmail' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
		$email = $input['userEmail'];
		
		//-------------------Message------------------------------
		$msg1 = "Mail sent Successfully";
		$msg2 = "Mail not Found";
		$msg3 = "You are not authorized please login again";
		//-------------------Message------------------------------	
       
		$user = User::query()->where('email', '=', $email)->get();
		if(count($user) > 0)
		{
			$new_password = rand(100000,999999);
			$to = $email;
            $from = "keshavtest8@gmail.com";
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
			
			return response()->json(['status'=>1,'message'=>$msg1]); 
		}
		else
		{
			return response()->json(['status'=>0,'message'=>$msg2]); 
		}
	}
}
