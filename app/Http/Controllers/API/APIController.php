<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\otpVerifcation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Quotation;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Trip;
use App\Models\Package;
use App\Models\Address;
use Illuminate\Foundation\Auth\Authenticatable;
use App\Jobs\UserProfileEmail;
use Illuminate\Support\Str;
use App\Models\Event;

class APIController extends Controller
{
    
    protected $tripStatus;
    protected $userStatus;

    public function __construct(){
        $this->tripStatus = config('constants.TRIP_STATUS');
        $this->userStatus = config('constants.USER_STATUS');
    }

    public function index(){

    }
    
    public function clients(): JsonResponse
    {
        try {
        
            $clients = User::where('role', 'Client')->orderBy('id', 'desc')->get();
    
            if ($clients->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No clients found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'All clients for Admin', 'data' => $clients]);
        
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving clients', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function drivers(): JsonResponse
    {
        
        try {

            $drivers = User::where(['role'=>'Driver'])->orderBy('id', 'desc')->get();
            
            if ($drivers->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No drivers found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'All drivers for Admin', 'data' => $drivers]);
        
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving drivers', 'error' => $e->getMessage()], 500);
        }
    }

    public function users(Request $request): JsonResponse
    {
        try {
            $role = $request->input('role');
            $userAddedId = $request->input('added_user_id');
            $clientId = $request->input('client_id');
            $id = $request->input('id');
    
            $query = User::orderBy('id', 'desc');
    
            if ($role) {
                $query->where('role', $role);
            }
    
            if ($userAddedId) {
                $query->where('added_user_id', $userAddedId);
            }
    
            if ($clientId) {
                $query->where('client_id', $clientId);
            }

            if ($id) {
                $query->where('id', $id);
            }
            
            $users = $query->get();
    
            if ($users->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No users found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Users retrieved successfully', 'data' => $users]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving users', 'error' => $e->getMessage()], 500);
        }
    }
    

    public function user_login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        try {

            $credentials = $request->only('email', 'password');
            $user = User::where('email', $credentials['email'])->first();

            if ($user) {

                if (in_array($user->status, auth_users())) {

                    if(isset($user->role) && $user->role == user_roles('3')){

                        $client = User::where(['role' => 'Client', 'id' => $user->client_id])->first();
                        
                        if($client){
                            
                            if(!in_array($client->status, auth_users())){
                                return response()->json(['status' => 'Deactive', 'message' => 'You are Unauthorized to Login, Contact to the Owner']);
                            }
                        }
                        else{
                            return response()->json(['status' => 'Deactive', 'message' => 'You are assigned  to any client']);
                        }
                    }
                    
                    if (Auth::attempt($credentials)) {

                        $token = $user->createToken('MyApp')->plainTextToken;
                        session(['user_details' => $user]);
                        return response()->json(['status' => 'success', 'message' => 'User successfully logged in', 'token' => $token]);
                    }else{
                        return response()->json(['status' => 'invalid', 'message' => 'Invalid Credentails or Contact to Admin']); 
                    }
                } 
                else if ($user->status == 4) {
                    return response()->json(['status' => 'Unverfied', 'message' => 'User is unverified, Please Check Your Email']);
                } 
                else {
                    return response()->json(['status' => 'Deactive', 'message' => 'You are Unauthorized to Login']);
                }
            }else{

                 return response()->json(['status' => 'invalid', 'message' => 'User does not exist'], 401);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving users',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    public function user_store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'com_pic' => 'image|max:1024',
            'user_pic' => 'image|max:1024',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id),
            ],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);

        }
    
        try {
            $user = ($request->id) ? User::find($request->id) : new User(); 
             
            $isExistingUser = $user->exists;

            $user->name               = $request->name;
            $user->email              = $request->email;
            $user->phone              = $request->phone;
            $user->com_name           = $request->com_name;
            $user->address            = $request->address;
            $user->role               = $request->role;
            $user->country            = $request->country;
            $user->zip_code           = $request->zip_code;
            $user->city               = $request->city;
            $user->state              = $request->state;
            $user->reset_pswd_attempt = $request->reset_pswd_attempt;
            $user->reset_pswd_time    = $request->reset_pswd_time;
            if($user->added_user_id ){
                $user->added_user_id      = $user->added_user_id;
            }else{
                $user->added_user_id      = Auth::id();
            }
            $user->client_id          = $request->client_id;
            
            if ($request->password) {
                $user->password = Hash::make($request->password);
            } else {
                if(!$isExistingUser){
                $randomPassword = Str::random(8);
                $user->password = Hash::make($randomPassword);
                }
            }
            

            $oldComPicPath = $user->com_pic;
            $oldUserPicPath = $user->user_pic;
    
            if ($request->hasFile('com_pic')) {
                if ($request->id && $oldComPicPath) {
                    Storage::disk('public')->delete($oldComPicPath);
                }
    
                $comPic = $request->file('com_pic');
                $comPicPath = $comPic->store('com_pics', 'public');
                $user->com_pic = $comPicPath;
            }
            
            if ($request->hasFile('user_pic')) {
                if ($request->id && $oldUserPicPath) {
                    Storage::disk('public')->delete($oldUserPicPath);
                }
    
                $userPic = $request->file('user_pic');
                $userPicPath = $userPic->store('user_pics', 'public');
                $user->user_pic = $userPicPath;
            }

            $save = $user->save();
    
            if($save){
                if ($request->password) {

                }else{

                    if(!$isExistingUser){
                        $emailData = [
                            'password' => $randomPassword,
                            'name' => $request->name,
                            'email' => $request->email,
                            'body' => "Congratulations! You profile has been created successfully on this Email.",
                        ];
    
                        UserProfileEmail::dispatch($emailData)->onQueue('emails');
                    }
                }
            }
            $message = $isExistingUser ? 'User updated successfully' : 'User added successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'com_pic' => 'image',
            'user_pic' => 'image',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id),
            ],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
    
        try {
            $user = ($request->id) ? User::find($request->id) : new User(); 
             
            $isExistingUser = $user->exists;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->com_name = $request->com_name;
            $user->address = $request->address;
            $user->role = 'Client';
            
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
    

            $oldComPicPath = $user->com_pic;
            $oldUserPicPath = $user->user_pic;
    
            if ($request->hasFile('com_pic')) {
                if ($request->id && $oldComPicPath) {
                    Storage::disk('public')->delete($oldComPicPath);
                }
    
                $comPic = $request->file('com_pic');
                $comPicPath = $comPic->store('com_pics', 'public');
                $user->com_pic = $comPicPath;
            }
            
            if ($request->hasFile('user_pic')) {
                if ($request->id && $oldUserPicPath) {
                    Storage::disk('public')->delete($oldUserPicPath);
                }
    
                $userPic = $request->file('user_pic');
                $userPicPath = $userPic->store('user_pics', 'public');
                $user->user_pic = $userPicPath;
            }

            $save = $user->save();
    
            $message = $isExistingUser ? 'User updated successfully' : 'User Register successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    public function announcements(Request $request): JsonResponse
    {
        try {
            $type = $request->input('type');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $id = $request->input('id');
            $current_date  = $request->input('current_date');
    
            $query = Announcement::orderBy('id', 'desc');
    
            if ($type) {
                $query->where('type', $type);
            }
    
            if ($start_date) {
                $query->where('start_date', $start_date);
            }
    
            if ($end_date) {
                $query->where('end_date', $end_date);
            }

            if ($id) {
                $query->where('id', $id);
            }
            if($current_date){
                $query->where('status','on')->where('start_date', '<=', $current_date)->where('end_date', '>=', $current_date);
            }
            
            $announcement = $query->get();
    
            if ($announcement->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No Announcement found']);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Announcement retrieved successfully', 'data' => $announcement]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving announcement', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function announcement_store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
    
        try {
            $announcement = ($request->id) ? Announcement::find($request->id) : new Announcement(); 
             
            $isExistAnnouncement = $announcement->exists;

            $announcement->title        = $request->title;
            $announcement->desc         = $request->desc;
            $announcement->type         = $request->type;
            $announcement->start_date   = $request->start_date;
            $announcement->end_date     = $request->end_date;
            $announcement->created_by   = Auth::id();
            $save = $announcement->save();
    
            $message = $isExistAnnouncement ? 'Announcement updated successfully' : 'Announcement saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Announcement', 'error' => $e->getMessage()], 500);
        }
    }

    public function notifications(Request $request): JsonResponse
    {
        try {
            $title   = $request->input('title');
            $user_id = $request->input('user_id');
            $status  = $request->input('status');
            $id      = $request->input('id');
    
            $query = Notification::orderBy('id', 'desc');
    
            if ($status) {
                $query->where('status', $status);
            }
    
            if ($user_id) {
                $query->where('user_id', $user_id);
            }
    
            if ($title) {
                $query->where('title', $title);
            }

            if ($id) {
                $query->where('id', $id);
            }
            
            $notification = $query->get();
    
            if ($notification->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No Notification found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Notification retrieved successfully', 'data' => $notification]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving notification', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function notification_store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'user_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
    
        try {
            $notification = ($request->id) ? Notification::find($request->id) : new Notification(); 
             
            $isExistNotification = $notification->exists;

            $notification->title      = $request->title;
            $notification->user_id    = $request->user_id;
            $notification->desc       = $request->desc;
            $notification->status     = $request->status ? $request->status : 'nseen' ;
            $notification->created_by = Auth::id();
            $save = $notification->save();
    
            $message = $isExistNotification ? 'Notification updated successfully' : 'Notification saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Notification', 'error' => $e->getMessage()], 500);
        }
    }

    public function trip_store(Request $request): JsonResponse
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'desc' => 'required',
        //     'start_point' => 'required',
        //     'end_point' => 'required',
        //     'trip_date' => 'required|date',
        //     'driver_id' => 'required|integer',
        //     'created_by' => 'required|integer',
        //     'addresses.*.id' => 'integer',
        //     'addresses.*.title' => 'required',
        //     'addresses.*.desc' => 'required',
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        // }
    
        try {

            $trip = ($request->trip_detail['id']) ? Trip::find($request->trip_detail['id']) : new Trip();
    
            $isExistingTrip = $trip->exists;
    
            $trip->title = $request->trip_detail['title'];
            $trip->desc = $request->trip_detail['desc'];
            $trip->start_point = $request->trip_detail['start_point'];
            $trip->end_point = $request->trip_detail['end_point'];
            $trip->trip_date = $request->trip_detail['trip_date'];
            $trip->driver_id = $request->trip_detail['driver_id'];

            if(isset($request->trip_detail['client_id']) && !empty($request->trip_detail['client_id'])){
                $trip->client_id = $request->trip_detail['client_id'];
                $noftify_client_id = $trip->client_id;
            }
            else{
                $trip->client_id =  Auth::id();
            }

            $trip->created_by = Auth::id();
    
            $save = $trip->save();

            // Save associated addresses
            if ($request->has('address')) {

                $addresses = $request->address;
                $existingAddressIds = [];

                foreach ($addresses as $index => $addressData) {
                    
                    if (isset($addressData['id']) && !empty($addressData['id'])) {

                        $address = Address::find($addressData['id']);
                        
                        if ($address) {

                            $address->title = $addressData['title'];
                            $address->desc = $addressData['desc'];
                            $address->status = $addressData['status'];
                            $address->trip_pic = $addressData['trip_pic'];
                            $address->trip_signature = $addressData['trip_signature'];
                            $address->trip_note = $addressData['trip_note'];
                            $address->trip_id = $trip->id;
                            $address->order_no = $index +1 ;
                            $address->created_by = Auth::id();
                            $address->save();

                            $existingAddressIds[] = $address->id;

                        }

                    } 
                  
                    else {

                        $address = new Address();
                        $address->title = $addressData['title'];
                        $address->desc = $addressData['desc'];
                        $address->status = $addressData['status'];
                        $address->trip_pic = $addressData['trip_pic'];
                        $address->trip_signature = $addressData['trip_signature'];
                        $address->trip_note = $addressData['trip_note'];
                        $address->trip_id = $trip->id;
                        $address->order_no = $index +1;
                        $address->created_by = Auth::id();
                        $address->save();
        
                        $existingAddressIds[] = $address->id;

                        // if ($noftify_client_id) {
                        //     $notification_ids = [Auth::id(), $noftify_client_id, $trip->driver_id];
                        //     $notification_desc = ["Trip created successfully", "New Trip created against you", "New Trip created against Your Client and you"];
                        
                        //     foreach ($notification_ids as $key => $value) {
                        //         $request = [
                        //             'title' => 'Trip Created',
                        //             'user_id' => $value,
                        //             'desc' => $notification_desc[$key],
                        //         ];
                        
                        //         $test = $this->notification_store($request);
                        //     }
                        // }
                        
                    }
                }

                Address::where('trip_id', $trip->id)
                    ->whereNotIn('id', $existingAddressIds)
                    ->delete();
                
                $message = ($request->trip_detail['duplicate_trip'] ?? 0 == 1) ? 'Trip Duplicate successfully': ($isExistingTrip ? 'Trip updated successfully' : 'Trip added successfully'); 
                if($request->trip_detail['duplicate_trip'] ?? 0 == 1){
                    return response()->json(['status' => 'success', 'message' => $message, 'data' =>'duplicate']);
                }else{
                    return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
                }
            
            }

            else{
                return response()->json(['status' => 'error', 'message' => 'trip is not save no address']);
            }
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing trip', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function packages(Request $request): JsonResponse
    {
        try {
            $type = $request->input('type');
            $title = $request->input('title');
            $price = $request->input('price');
            $id = $request->input('id');
    
            $query = Package::orderBy('id', 'ASC');
    
            if ($type) {
                $query->where('type', $type);
            }
    
            if ($title) {
                $query->where('title', 'LIKE', '%' . $title . '%');
            }
    
            if ($price) {
                $query->where('price', $price);
            }

            if ($id) {
                $query->where('id', $id);
            }
            
            $announcement = $query->get();
    
            if ($announcement->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No Package found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Package retrieved successfully', 'data' => $announcement]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving package', 'error' => $e->getMessage()], 500);
        }
    }

    public function package_store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'type' => 'required',
            'price' => 'required',
            'users' => 'required',
            'drivers' => 'required',
            'map_api_call' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
    
        try {
            $package = ($request->id) ? Package::find($request->id) : new Package(); 
             
            $isExistPackage = $package->exists;

            $package->title        = $request->title;
            $package->desc         = $request->desc;
            $package->type         = $request->type;
            $package->map_api_call = $request->map_api_call;
            $package->price        = $request->price;
            $package->users        = $request->users;
            $package->drivers      = $request->drivers;
            $package->created_by   = Auth::id();
            $save = $package->save();
    
            $message = $isExistPackage ? 'Package updated successfully' : 'Package saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Package', 'error' => $e->getMessage()], 500);
        }
    }

    public function update_trip_status(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
    
        try {

            $addressToUpdate = NULL;
            $activeAddress = NULL;
            $endTrip = 'no';
            $tripStarted = 'no';

            if ($request->has('address_id')) {

                $address = Address::find($request->address_id);     
                $isExistingAddress= $address->exists;
                $activeAddress = $address->address_status == 1 ? 'yes' : 'no'; 
                        
                if ($address) {
                    $address->skiped_address_desc = $request->skiped_address_desc;
                    $address->address_status = $request->status;
                    $address->updated_by = Auth::id();
                    $save = $address->save();
                }

                // $trip = Trip::with(['addresses' => function ($query) {
                //     $query->orderBy('order_no', 'ASC');
                // }])->find($request->id);
                // $tripData = $trip->toArray();

                // if($tripData['status'] == 1){
                //     foreach($tripData['addresses'] as $value){
                //         if($value['address_status'] == 2){
                //                 $addressToUpdateModel = Address::find($value['id']);
                //                 $addressToUpdateModel->address_status = 1;
                //                 $addressToUpdateModel->save();
                //                 $addressToUpdate = $addressToUpdateModel;
    
                //             break;
                //         }
                //     }   
                // } 


                $message = $isExistingAddress ? 'Address status updated successfully' : 'Address status saved successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => ['waypoint'=>$address , 'ongoing'=> $addressToUpdate,'activeAddress'=>$activeAddress ]]);
            
            }
            elseif ($request->has('next_waypoint')){

                $trip = Trip::with(['addresses' => function ($query) {
                    $query->orderBy('order_no', 'ASC');
                }])->find($request->id);
                $tripData = $trip->toArray();

                if($tripData['status'] == 1){
                    foreach($tripData['addresses'] as $value){
                        if($addressToUpdate){
                            if($value['address_status'] == 1){
                                $addressToUpdateModel = Address::find($value['id']);
                                $addressToUpdateModel->address_status = 2;
                                $addressToUpdateModel->save();
                            }

                        }
                        else{
                            if($value['address_status'] == 2){
                                $addressToUpdateModel = Address::find($value['id']);
                                $addressToUpdateModel->address_status = 1;
                                $addressToUpdateModel->save();
                                $addressToUpdate = $addressToUpdateModel;
                            }
                        }

                    }   
                } 

                if(empty($addressToUpdate)){
                    $endTrip = 'yes';
                }

                $message = 'Trip status updated successfully' ;
                return response()->json(['status' => 'success', 'message' => $message, 'data' => ['waypoint'=>$addressToUpdate ,'ongoing'=> $addressToUpdate , 'endTrip'=>$endTrip]]);
            
            }
            else {
                
                $trip = Trip::find($request->id);
                $isExistingTrip = $trip->exists;
        
                $trip->status = $request->status;
                $trip->updated_by = Auth::id();
                $save = $trip->save();
                if($save){
                    $tripStarted = 'yes';
                }

                $trip = Trip::with(['addresses' => function ($query) {
                    $query->orderBy('order_no', 'ASC');
                }])->find($request->id);
                $tripData = $trip->toArray();

                if($tripData['status'] == 1){
                    $addressToUpdate= NULL;

                    foreach($tripData['addresses'] as $value){
                        
                        if($addressToUpdate){
                            if($value['address_status'] == 1){
                                $addressToUpdateModel = Address::find($value['id']);
                                $addressToUpdateModel->address_status = 2;
                                $addressToUpdateModel->save();
                            }

                        }
                        else{
                            if($value['address_status'] == 2){
                                $addressToUpdateModel = Address::find($value['id']);
                                $addressToUpdateModel->address_status = 1;
                                $addressToUpdateModel->save();
                                $addressToUpdate = $addressToUpdateModel;
                            }
                        }

                    }   
                } 


                $message = $isExistingTrip ? 'Trip status updated successfully' : 'Trip status saved successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => ['waypoint'=>$addressToUpdate ,'ongoing'=> $addressToUpdate,'tripStarted' => $tripStarted  ]]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }

    public function complete_waypoint(Request $request): JsonResponse
    {
        try {

            if ($request->has('address_id')) {

                $address = Address::find($request->address_id);     
                $isExistingAddress= $address->exists;
                $addressToUpdate = NULL;

                if ($address) {

                    if ($request->hasFile('address_pic')) {
                        $address_pic = $request->file('address_pic');
                        $addresPicPath = $address_pic->store('addres_pics', 'public');
                        $address->driv_trip_pic = $addresPicPath;
                    }
                    
                    if ($request->driv_signature) {     
                        $address->driv_trip_signature = $request->driv_signature;
                    }

                    if($request->address_note){
                        $address->driv_trip_note = $request->address_note;
                    }
                    
                    $address->updated_by = Auth::id();
                    $save = $address->save();
                }

                $message = $isExistingAddress ? 'Address status updated successfully' : 'Address status saved successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => ['waypoint'=>$address, 'ongoing'=>$addressToUpdate]]);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function complete_address(Request $request): JsonResponse
    {
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        //     'status' => 'required',
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        // }
    
        try {

            if ($request->has('address_id')) {

                $address = Address::find($request->address_id);     
                $isExistingAddress= $address->exists;
                        
                if ($address) {

                    if ($request->hasFile('address_pic')) {
                        $address_pic = $request->file('address_pic');
                        $addresPicPath = $address_pic->store('addres_pics', 'public');
                        $address->driv_trip_pic = $addresPicPath;
                    }
                    
                    if ($request->driv_signature) {     
                        $address->driv_trip_signature = $request->driv_signature;
                    }

                    if($request->address_note){
                        $address->driv_trip_note = $request->address_note;
                    }
                    $address->address_status = $request->status;
                    $address->updated_by = Auth::id();
                    $save = $address->save();

                    $trip = Trip::with(['addresses' => function ($query) {
                        $query->orderBy('order_no', 'ASC');
                    }])->find($address->trip_id);
                    
                    $tripaddress = $trip->addresses;
    
                    $addressToUpdate = NULL;
    
                    foreach($tripaddress as $val){
                                                
                        if($addressToUpdate){
                            if($value['address_status'] == 1){
                                $addressToUpdateModel = Address::find($value['id']);
                                $addressToUpdateModel->address_status = 2;
                                $addressToUpdateModel->save();
                            }

                        }
                        else{
                            if($value['address_status'] == 2){
                                $addressToUpdateModel = Address::find($value['id']);
                                $addressToUpdateModel->address_status = 1;
                                $addressToUpdateModel->save();
                                $addressToUpdate = $addressToUpdateModel;
                            }
                        }
                    }
                }

                $message = $isExistingAddress ? 'Address status updated successfully' : 'Address status saved successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => ['complete'=>$address, 'ongoing'=>$addressToUpdate]]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }

    public function update_address_order(Request $request): JsonResponse
    {
    
        try {     
                $tripaddress =   $request->all();
                $updatedAddresses = [];
                foreach($tripaddress as $val){
                    $address = Address::find($val['id']);     
                    if ($address) {
                        $address->order_no = $val['order_no'];
                        $address->save();
                        if($address->address_status == 1 || $address->address_status == 2){
                            $updatedAddresses[] = $address->title;
                        }
                    }
                } 

            $message = 'Addresses Order updated successfully' ;
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $updatedAddresses]);
        } 
        catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }

    public function storeEvent(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'trip_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        try {
            
            $trip = Trip::find($request->id);
    
            $isExistingTrip = $trip->exists;
    
            $trip->trip_date = $request->trip_date;
            $trip->updated_by = Auth::id();
            $save = $trip->save();
    
            $message = $isExistingTrip ? 'Trip date updated successfully' : 'Trip date saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating date ', 'error' => $e->getMessage()], 500);
        }
    }

    public function tripCharts(Request $request): JsonResponse
    {
        try {
            
            $id = $request->input('id');    
            $user = User::where('id', $id)->first();
            $selected_date  = $request->input('selected_date');

            if($user){
                // User roles: 1 for admin, 2 for client, 3 for driver
                if(isset($user->role) && $user->role == user_roles('1')){
                    $data['totalRoutes']    = Trip::count();
                    $data['totalTodayRout'] = Trip::whereDate('trip_date', $selected_date)->count();
                    $data['completedTrips'] = Trip::where('status', $this->tripStatus['Completed'])->whereDate('trip_date', $selected_date)->count();
                    $data['activeTrips']    = Trip::where('status', $this->tripStatus['In Progress'])->whereDate('trip_date', $selected_date)->count();
                    $data['PendingTrips']   = Trip::where('status', $this->tripStatus['Pending'])->whereDate('trip_date', $selected_date)->count();
                    
                    $data['compTrp_percentage'] = $data['totalTodayRout'] > 0 ? round(($data['completedTrips'] / $data['totalTodayRout']) * 100, 1) : 0;
                    $data['actvTrp_percentage'] = $data['totalTodayRout'] > 0 ? round(($data['activeTrips'] / $data['totalTodayRout']) * 100, 1) : 0;
                    $data['pendTrp_percentage'] = $data['totalTodayRout'] > 0 ? round(($data['PendingTrips'] / $data['totalTodayRout']) * 100, 1) : 0;
                }
                else if(isset($user->role) && $user->role == user_roles('2')){   
                    $data['totalRoutes']     = Trip::where('client_id', $user->id)->count();
                    $data['totalAct_Routes'] = Trip::whereIn('status', [$this->tripStatus['Pending'], $this->tripStatus['In Progress']])->where('client_id', $user->id)->count();
                    $data['totalTodayRout']  = Trip::whereDate('trip_date', $selected_date)->where('client_id', $user->id)->count();
                    $data['completedTrips']  = Trip::whereDate('trip_date', $selected_date)->where([['status', $this->tripStatus['Completed']], ['client_id', $user->id]])->count();
                    $data['activeTrips']     = Trip::whereDate('trip_date', $selected_date)->where([['status', $this->tripStatus['In Progress']], ['client_id', $user->id]])->count();
                    $data['PendingTrips']    = Trip::whereDate('trip_date', $selected_date)->where([['status', $this->tripStatus['Pending']], ['client_id', $user->id]])->count();

                    $data['compTrp_percentage'] = $data['totalTodayRout'] > 0 ? round(($data['completedTrips'] / $data['totalTodayRout']) * 100, 1) : 0;
                    $data['actvTrp_percentage'] = $data['totalTodayRout'] > 0 ? round(($data['activeTrips'] / $data['totalTodayRout']) * 100, 1) : 0;
                    $data['pendTrp_percentage'] = $data['totalTodayRout'] > 0 ? round(($data['PendingTrips'] / $data['totalTodayRout']) * 100, 1) : 0;       
                }   
              
            }
            
            if (empty($data)) {
                return response()->json(['status' => 'empty', 'message' => 'No data found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error retrieving data', 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteUsers(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
    
        try {

            $user = ($request->id) ? User::find($request->id) : ''; 
            $isExistingUser = $user->exists;

            if($isExistingUser){
                
                $status = $this->userStatus;
                $tripStatus = $this->tripStatus ;
                $admin =  user_roles(1);
                $client =  user_roles(2);
                $driver =  user_roles(3);
                $userDeleted = NULL;
                $tripDeleted = NULL;
                $announcementDeleted = NULL;
                $packageDeleted = NULL;

                $message  = 'Some thing went wrong';
                $deleted_role = NULL;

                if($request->trip_id){  
                    $deleted = Trip::where(['id' => $request->trip_id])->update(['status' => $tripStatus['Deleted']]);
                    $message = "Trip deleted successfully";
                    $tripDeleted = 'yes';
                    return response()->json(['status' => 'success', 'message' => $message,'tripDleted'=> $tripDeleted, 'data' => $deleted]);

                }

                else if($request->annoucement_id){  
                    $deleted = Announcement::where(['id' => $request->annoucement_id])->update(['status' => 'off']);
                    $message = "Announcement deleted successfully";
                    $announcementDeleted = 'yes';
                    return response()->json(['status' => 'success', 'message' => $message,'announcementDeleted'=> $announcementDeleted, 'data' => $deleted]);

                }

                else if($request->package_id){  
                    $deleted = Package::where(['id' => $request->package_id])->update(['status' => 'off']);
                    $message = "Package deleted successfully";
                    ($deleted ) ? $packageDeleted = 'yes' : $packageDeleted = 'no';
                    return response()->json(['status' => 'success', 'message' => $message,'packageDeleted'=> $packageDeleted, 'data' => $deleted]);

                }

               else if($user->role == $admin){
                    $user->status = $status['Deleted'];
                    $user->updated_by = $request->deleted_by;
                    $save = $user->save();
                    $message = $save ? 'User Deleted successfully' : 'User can not deleted';
                    if($save){
                        $deleted_role = 1;
                        if($request->deleted_by == $user->id){
                            session()->flush();
                            return response()->json(['status' => 'success', 'message' => 'Your Account has been deleted!', 'role'=> $deleted_role, 'logout'=>'yes']);
                        }
                    }
                    
                }

                else if($user->role == $client){
                    $user->status = $status['Deleted'];
                    $user->updated_by = $request->deleted_by;
                    $save = $user->save();
                    $message = $save ? 'Cleint Deleted successfully' : 'Client can not deleted';
                    
                    if($request->delete_all_drivers){
                        User::where(['role' => user_roles('3'), 'client_id' => $request->id])->update(['status' => $status['Deleted'], 'updated_by' => $request->deleted_by]);
                        $message .= "\nAll Drivers deleted successfully";
                    }

                    if($request->choose_options){
                        if($request->choose_options == 'assigned'){
                            Trip::where(['client_id' => $request->id, 'status' => $tripStatus['In Progress']])->update(['status' => $tripStatus['Deleted']]);
                            $message .= "\nAll Assigned Trips deleted successfully";
                        }
                        else{
                            Trip::where(['client_id' => $request->id, 'status' => $tripStatus['Completed']])->update(['status' => $tripStatus['Deleted']]);
                            $message .= "\nAll Completed Trips deleted successfully";
                        }
                    }

                    if($save){
                        $deleted_role = 2;
                        if($request->deleted_by == $user->id){
                            session()->flush();
                            return response()->json(['status' => 'success', 'message' => 'Your Account has been deleted!','role'=> $deleted_role, 'logout' =>'yes']);
                        }
                    }
                }

                else if($user->role == $driver){
                    $user->status = $status['Deleted'];
                    $user->updated_by = $request->deleted_by;
                    $save = $user->save();
                    $message = $save ? 'Driver Deleted successfully' : 'Driver can not deleted';

                    if($request->assigned){
                        Trip::where(['driver_id' => $request->id, 'status' => $tripStatus['In Progress']])->update(['status' => $tripStatus['Deleted']]);
                        $message .= "\nAll Assigned Trips of Driver deleted successfully";
                    }
                    if($request->completed){
                        Trip::where(['driver_id' => $request->id, 'status' => $tripStatus['Completed']])->update(['status' => $tripStatus['Deleted']]);
                        $message .= "\nAll Completed Trips of Driver deleted successfully";
                    }

                    if($save){
                        $deleted_role = 3;
                        if($request->deleted_by == $user->id){
                            session()->flush();
                            return response()->json(['status' => 'success', 'message' => 'Your Account has been deleted!','role'=>'driver','role'=> $deleted_role,'logout' =>'yes']);
                        }
                    }
                }
            }

            
            return response()->json(['status' => 'success', 'message' => $message,'role'=> $deleted_role, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

// working pending till ... and stated....
    public function events(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        try {
            
            $user = User::where('id', $id)->get();
            
            if(isset($user->role) && $user->role == user_roles('1')){

                $trips = Trip::join('users as drivers', 'drivers.id', '=', 'trips.driver_id')
                ->join('users as clients', 'clients.id', '=', 'trips.client_id')
                ->select('trips.id', 'trips.trip_date', 'trips.status', 'drivers.id as driver_id', 'drivers.name as driver_name','clients.name as client_name')
                ->orderBy('trips.trip_date', 'ASC')
                ->get()
                ->toArray();
            } 

            else if(isset($user->role) && $user->role == user_roles('2')){
                $trips = Trip::join('users', 'users.id', '=', 'trips.driver_id')
                ->where('trips.client_id', $user->id)
                ->select('trips.*', 'users.id as driver_id', 'users.name as driver_name', 'users.user_pic  as driver_pic')
                ->orderBy('trips.id', 'desc')
                ->get()
                ->toArray();
                return view('routes', ['data' => $trips,'user'=>$user]);
            }
            
            else {
                $trips = Trip::join('users', 'users.id', '=', 'trips.client_id')
                ->where('trips.driver_id', $user->id)
                ->select('trips.*', 'users.id as client_id', 'users.name as client_name', 'users.user_pic  as client_pic')
                ->orderBy('trips.id', 'desc')
                ->get()
                ->toArray();
                return view('routes', ['data' => $trips,'user'=>$user]);
            } 
        
            if ($trips->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'No Trip found'], 404);
            }
    
            return response()->json(['status' => 'success', 'message' => 'Trips retrieved successfully', 'data' => $trips]);
        
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Error retrieving Trip', 'error' => $e->getMessage()], 500);
            }
    }

    public function tripDetail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
    
        try {
                
                $status = $this->userStatus;
                $tripStatus = $this->tripStatus ;

                $trip = Trip::with(['addresses' => function ($query) {
                    $query->orderBy('order_no', 'ASC');
                }])->find($request->id);

                $data['client'] = $trip->user->name;
                $data['driver'] = $trip->driver->name;
                $data = $trip->toArray();
                $data['addresses'] = $trip->addresses->toArray();

            
            return response()->json(['status' => 'success', 'message' => 'trip details are fetched', 'data' => $data]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    public function quotation_store(Request $request): JsonResponse
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'desc' => 'required',
        //     'type' => 'required',
        //     'price' => 'required',
        //     'users' => 'required',
        //     'drivers' => 'required',
        //     'map_api_call' => 'required'
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        // }
    
        try {
            $quotation = ($request->id) ? Quotation::find($request->id) : new Quotation(); 
             
            $isExistQuotation = $quotation->exists;

            $quotation->date          = $request->date;
            $quotation->admin_id      = $request->admin_id;
            $quotation->user_id       = $request->user_id;
            $quotation->currency_code = $request->currency_code;
            $quotation->service_id    = $request->service_id;
            $quotation->desc          = $request->desc;
            $quotation->client_name   = $request->client_name;
            $quotation->amount        = $request->amount;
    
            if ($request->hasFile('file')) {
                if ($request->id) {
                    Storage::disk('public')->delete($quotation->file);
                }
    
                $qfile = $request->file('file');
                $qfilePath = $qfile->store('q_files', 'public');
                $quotation->file = $qfilePath;
            }

            $quotation->created_by  = Auth::id();
            $save = $quotation->save();
    
            $message = $isExistQuotation ? 'Quotation updated successfully' : 'Quotation saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Quotation', 'error' => $e->getMessage()], 500);
        }
    }

    public function update_qoute_status(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
    
        try {

            if ($request->has('id')) {
                $qoute = Quotation::where('id', $request->id)->update(['status' => $request->status]);
                $message = 'Qoute status updated successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => $qoute]);
            
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }

    public function quote_detail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }
    
        try {
            if (isset($request->role) && $request->role == user_roles('1')) {

                $quotations = Quotation::join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*','u.name as user_name', 'u.user_pic as user_pic', 'admins.name as admin_name','admins.user_pic as admin_pic')
                ->where('quotations.id',$request->id)
                ->orderBy('quotations.id', 'desc')
                ->first();    
            }

            return response()->json(['status' => 'success', 'message' => 'Quotation details are fetched', 'data' => $quotations]);
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }
}
