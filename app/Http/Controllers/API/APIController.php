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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Quotation;
use App\Models\Contract;
use Illuminate\Foundation\Auth\Authenticatable;
use App\Jobs\UserProfileEmail;
use App\Jobs\SendInvoiceEmail;
use Illuminate\Support\Str;
use App\Models\Invoice;
use App\Models\Template;
use App\Models\Comment;
use App\Models\Transectional;
use App\Mail\InvoiceEmail;
use Symfony\Component\Mime\Address;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Location;
use App\Models\Service;
use App\Models\Currency;


class APIController extends Controller
{

    protected $userStatus;
    protected $status;
    protected $temp_status;


    public function __construct()
    {
        $this->userStatus = config('constants.USER_STATUS');
        $this->status = config('constants.QUOTE_STATUS');
        $this->temp_status = config('constants.TEMP_STATUS');
    }

    public function index()
    {
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

            $drivers = User::where(['role' => 'Driver'])->orderBy('id', 'desc')->get();

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

                    if (isset($user->role) && $user->role == user_roles('3')) {

                        $admin = User::where(['role' => user_roles('2'), 'id' => $user->client_id])->first();
                        if ($admin) {
                            if (!in_array($admin->status, auth_users())) {
                                return response()->json(['status' => 'Deactive', 'message' => 'You are Unauthorized to Login, Contact to the admin']);
                            }
                        } else {
                            return response()->json(['status' => 'Deactive', 'message' => 'You are not assigned  to any admin']);
                        }
                    }

                    if (Auth::attempt($credentials)) {

                        $token = $user->createToken('MyApp')->plainTextToken;
                        session(['user_details' => $user]);
                        return response()->json(['status' => 'success', 'message' => 'User successfully logged in', 'token' => $token]);
                    } else {
                        return response()->json(['status' => 'invalid', 'message' => 'Invalid Credentails or Contact to Admin']);
                    }
                } else if ($user->status == 4) {
                    return response()->json(['status' => 'Unverfied', 'message' => 'User is unverified, Please Check Your Email']);
                } else {
                    return response()->json(['status' => 'Deactive', 'message' => 'You are Unauthorized to Login']);
                }
            } else {

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
            if ($user->manager_id) {
                $user->manager_id      = $user->manager_id;
            } else {
                $user->manager_id      = Auth::id();
            }
            $user->admin_id          = $request->admin_id;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            } else {
                if (!$isExistingUser) {
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

            if ($save) {
                if ($request->password) {
                } else {

                    if (!$isExistingUser) {
                        $emailData = [
                            'password' => $randomPassword,
                            'name'  => $request->name,
                            'email' => $request->email,
                            'body'  => "Congratulations! You profile has been created successfully on this Email.",
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

            if ($isExistingUser) {

                $status = $this->userStatus;
                $message  = 'Some thing went wrong';
                $deleted_role = NULL;

                if ($user->role == user_roles(1)) {
                    $user->status = $status['Deleted'];
                    $user->updated_by = $request->deleted_by;
                    $save = $user->save();
                    $message = $save ? 'Super Admin Deleted successfully' : 'Super Admin can not deleted';
                    if ($save) {
                        $deleted_role = 1;
                        if ($request->deleted_by == $user->id) {
                            session()->flush();
                            return response()->json(['status' => 'success', 'message' => 'Your Account has been deleted!', 'role' => $deleted_role, 'logout' => 'yes']);
                        }
                    }
                } else if ($user->role == user_roles(2)) {
                    $user->status = $status['Deleted'];
                    $user->updated_by = $request->deleted_by;
                    $save = $user->save();
                    $message = $save ? 'Admin Deleted successfully' : 'Admin can not deleted';

                    if ($request->delete_all_user) {
                        User::where(['role' => user_roles('3'), 'client_id' => $request->id])->update(['status' => $status['Deleted'], 'updated_by' => $request->deleted_by]);
                        $message .= "\nAll Users deleted successfully";
                    }

                    if ($save) {
                        $deleted_role = 2;
                        if ($request->deleted_by == $user->id) {
                            session()->flush();
                            return response()->json(['status' => 'success', 'message' => 'Your Account has been deleted!', 'role' => $deleted_role, 'logout' => 'yes']);
                        }
                    }
                } else if ($user->role == user_roles(3)) {
                    $user->status = $status['Deleted'];
                    $user->updated_by = $request->deleted_by;
                    $save = $user->save();
                    $message = $save ? 'User Deleted successfully' : 'User can not deleted';

                    if ($save) {
                        $deleted_role = 3;
                        if ($request->deleted_by == $user->id) {
                            session()->flush();
                            return response()->json(['status' => 'success', 'message' => 'Your Account has been deleted!', 'role' => 'driver', 'role' => $deleted_role, 'logout' => 'yes']);
                        }
                    }
                }
            }


            return response()->json(['status' => 'success', 'message' => $message, 'role' => $deleted_role, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    public function quotation_store(Request $request): JsonResponse
    {

        try {
            $quotation = ($request->id) ? Quotation::find($request->id) : new Quotation();

            $isExistQuotation = $quotation->exists;

            $combinedArray = [];

            $serviceIds = $request->service_id;
            $sAmounts = $request->s_amount;

            for ($i = 0; $i < count($serviceIds); $i++) {
                $combinedArray[] = [
                    'service_id' => $serviceIds[$i],
                    's_amount'   => $sAmounts[$i],
                ];
            }

            $quotation->date          = $request->date;
            $quotation->sadmin_id     = $request->sadmin_id;
            $quotation->admin_id      = $request->admin_id;
            $quotation->user_id       = $request->user_id;
            $quotation->currency_id   = $request->currency_id;
            $quotation->location_id   = $request->location_id;
            $quotation->service_data  = !empty($combinedArray) ? json_encode($combinedArray, JSON_FORCE_OBJECT) : null;
            $quotation->desc          = $request->desc;
            $quotation->client_name   = $request->client_name;
            $quotation->amount        = $request->amount;

            if ($request->hasFile('file')) {
                $storageDirectory = public_path('storage/q_files');
                if (!File::exists($storageDirectory)) {
                    File::makeDirectory($storageDirectory, 0777, true, true);
                }
                if ($request->id) {
                    $fileToDelete = public_path($quotation->file);
                    if (file_exists($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                }
                $ifile = $request->file('file');
                $filename = uniqid() . '_' . $ifile->getClientOriginalName();
                $ifile->move(public_path('storage/q_files'), $filename);
                $quotation->file = 'storage/q_files/' . $filename;
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
            $quotations = Quotation::with(['location:id,name,code', 'currency:id,code,name'])
                ->join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'u.user_pic as user_pic', 'admins.name as admin_name', 'admins.user_pic as admin_pic')
                ->where('quotations.id', $request->id)
                ->orderBy('quotations.id', 'desc')
                ->first();
            return response()->json(['status' => 'success', 'message' => 'Quotation details are fetched', 'data' => $quotations]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    // contracts module started here ...
    public function contract_store(Request $request): JsonResponse
    {
        try {
            $contract = ($request->id) ? Contract::find($request->id) : new Contract();

            $isExistContract = $contract->exists;

            $contract->start_date    = $request->start_date;
            $contract->end_date      = $request->end_date;
            $contract->sadmin_id     = $request->sadmin_id;
            $contract->admin_id      = $request->admin_id;
            $contract->user_id       = $request->user_id;
            $contract->currency_id   = $request->currency_id;
            $contract->location_id   = $request->location_id;
            $contract->service_id    = $request->service_id;
            $contract->desc          = $request->desc;
            $contract->client_name   = $request->client_name;
            $contract->amount        = $request->amount;

            if ($request->hasFile('file')) {
                $storageDirectory = public_path('storage/c_files');
                if (!File::exists($storageDirectory)) {
                    File::makeDirectory($storageDirectory, 0777, true, true);
                }
                if ($request->id) {
                    $fileToDelete = public_path($contract->file);
                    if (file_exists($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                }
                $ifile = $request->file('file');
                $filename = uniqid() . '_' . $ifile->getClientOriginalName();
                $ifile->move(public_path('storage/c_files'), $filename);
                $contract->file = 'storage/c_files/' . $filename;
            }

            $contract->created_by  = Auth::id();
            $save = $contract->save();

            $message = $isExistContract ? 'Contract updated successfully' : 'Contract saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Contract', 'error' => $e->getMessage()], 500);
        }
    }

    public function update_contract_status(Request $request): JsonResponse
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
                $qoute = Contract::where('id', $request->id)->update(['status' => $request->status]);
                $message = 'Status Changed successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => $qoute]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }

    public function contract_detail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        try {
            $contracts = Contract::with(['location:id,name,code', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'u.user_pic as user_pic', 'admins.name as admin_name', 'admins.user_pic as admin_pic')
                ->where('contracts.id', $request->id)
                ->orderBy('contracts.id', 'desc')
                ->first();

            return response()->json(['status' => 'success', 'message' => 'Quotation details are fetched', 'data' => $contracts]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    // invoice module started here ...
    public function invoice_store(Request $request): JsonResponse
    {
        try {
            $invoices = ($request->id) ? Invoice::find($request->id) : new Invoice();

            $isExistInvoice = $invoices->exists;

            $invoices->date          = $request->date;
            $invoices->sadmin_id     = $request->sadmin_id;
            $invoices->admin_id      = $request->admin_id;
            $invoices->user_id       = $request->user_id;
            $invoices->currency_id   = $request->currency_id;
            $invoices->location_id   = $request->location_id;
            $invoices->service_id    = $request->service_id;
            $invoices->desc          = $request->desc;
            $invoices->client_name   = $request->client_name;
            $invoices->client_mail   = $request->client_mail;
            $invoices->amount        = $request->amount;

            if ($request->hasFile('file')) {
                $storageDirectory = public_path('storage/in_files');
                if (!File::exists($storageDirectory)) {
                    File::makeDirectory($storageDirectory, 0777, true, true);
                }

                if ($request->id) {
                    $fileToDelete = public_path($invoices->file);
                    if (file_exists($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                }

                $ifile = $request->file('file');
                $filename = uniqid() . '_' . $ifile->getClientOriginalName();
                $ifile->move(public_path('storage/in_files'), $filename);
                $invoices->file = 'storage/in_files/' . $filename;
            }

            $invoices->created_by  = Auth::id();
            $save = $invoices->save();

            $message = $isExistInvoice ? 'Invoice updated successfully' : 'Invoice saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Invoice', 'error' => $e->getMessage()], 500);
        }
    }

    public function update_invoice_status(Request $request): JsonResponse
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
                $invoice = Invoice::where('id', $request->id)->update(['status' => $request->status]);
                $message = 'Invoice status updated successfully';
                return response()->json(['status' => 'success', 'message' => $message, 'data' => $invoice]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating status ', 'error' => $e->getMessage()], 500);
        }
    }

    public function invoice_detail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        try {
            $invoices = Invoice::with(['location:id,name,code', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'u.user_pic as user_pic', 'admins.name as admin_name', 'admins.user_pic as admin_pic')
                ->where('invoices.id', $request->id)
                ->orderBy('invoices.id', 'desc')
                ->first();

            return response()->json(['status' => 'success', 'message' => 'Invoice details are fetched', 'data' => $invoices]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'warning', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    public function dashboardCharts(Request $request): JsonResponse
    {
        try {

            $id = $request->input('id');
            $user = User::where('id', $id)->first();
            $selected_date  = $request->input('selected_date');

            if ($user) {
                // User roles: 1 for admin, 2 for client, 3 for driver
                if (isset($user->role) && $user->role == user_roles('1')) {

                    $totalQT   = Quotation::whereDate('date', $selected_date)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->count();
                    $QTsent   = Quotation::whereDate('date', $selected_date)->whereIn('status', [$this->status['In Progress']])->count();
                    $data['sentQuote_percent'] = $totalQT > 0 ? round(($QTsent / $totalQT) * 100, 1) : 0;

                    $totalCT  = Contract::whereDate('end_date', $selected_date)->whereIn('status', [$this->status['Pending'], $this->status['In Progress'], $this->status['Completed']])->count();
                    $CTcomp   = Contract::whereDate('end_date', $selected_date)->whereIn('status', [$this->status['Completed']])->count();
                    $data['compCT_percent'] = $totalCT > 0 ? round(($CTcomp  / $totalCT) * 100, 1) : 0;

                    $totalINV   = Invoice::whereDate('date', $selected_date)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->count();
                    $INVcomp    = Invoice::whereDate('date', $selected_date)->whereIn('status', [$this->status['In Progress']])->count();
                    $data['compINV_percent'] = $totalINV > 0 ? round(($INVcomp  / $totalINV) * 100, 1) : 0;
                } else if (isset($user->role) && $user->role == user_roles('2')) {

                    $totalQT   = Quotation::whereDate('date', $selected_date)->where('admin_id', $user->id)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->count();
                    $QTsent   = Quotation::whereDate('date', $selected_date)->where('admin_id', $user->id)->whereIn('status', [$this->status['In Progress']])->count();
                    $data['sentQuote_percent'] = $totalQT > 0 ? round(($QTsent / $totalQT) * 100, 1) : 0;

                    $totalCT  = Contract::whereDate('end_date', $selected_date)->where('admin_id', $user->id)->whereIn('status', [$this->status['Pending'], $this->status['In Progress'], $this->status['Completed']])->count();
                    $CTcomp   = Contract::whereDate('end_date', $selected_date)->where('admin_id', $user->id)->whereIn('status', [$this->status['Completed']])->count();
                    $data['compCT_percent'] = $totalCT > 0 ? round(($CTcomp  / $totalCT) * 100, 1) : 0;

                    $totalINV   = Invoice::whereDate('date', $selected_date)->where('admin_id', $user->id)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->count();
                    $INVcomp    = Invoice::whereDate('date', $selected_date)->where('admin_id', $user->id)->whereIn('status', [$this->status['In Progress']])->count();
                    $data['compINV_percent'] = $totalINV > 0 ? round(($INVcomp  / $totalINV) * 100, 1) : 0;
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

    public function template_store(Request $request): JsonResponse
    {

        try {
            $template = ($request->id) ? Template::find($request->id) : new Template();

            $isExistTemplate = $template->exists;

            $template->user_id        = $request->user_id;
            $template->template_for   = $request->template_for;
            $template->save_as        = $request->save_as;
            $template->template_body  = base64_encode($request->template_body);
            $template->status         = $this->temp_status['Active'];
            $template->created_by     = Auth::id();
            $template->updated_by     = Auth::id();
            $save = $template->save();

            $message = $isExistTemplate ? 'Template updated successfully' : 'Template saved successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Quotation', 'error' => $e->getMessage()], 500);
        }
    }

    public function sendMail_invoice(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'email_subject' => 'required',
            'email_body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        try {

            $transectional = Transectional::find($request->id);
            if ($transectional) {
                if ($request->proccess == 'draft' || $request->proccess == 'mail&draft') {

                    $transectional->reply_email     = $request->reply_email ?? NULL;
                    $transectional->cc_email        = $request->cc_email ?? NULL;
                    $transectional->bcc_email       = $request->bcc_email ?? NULL;
                    $transectional->email_subject   = $request->email_subject;
                    $transectional->email_body      = $request->email_body ?? NULL;
                    $transectional->created_by      = auth()->user()->id;
                    $transectional->save();

                    $message = ($request->proccess == 'mail&draft') ? 'Transection user mailed &  draft  successfully' : 'transectional data saved as draft.';
                }

                if ($request->proccess == 'mail' || $request->proccess == 'mail&draft') {

                    $invoices = Invoice::find($request->row_id);

                    if ($invoices) {
                        $transport_factory = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;
                        $transport = $transport_factory->create(new \Symfony\Component\Mailer\Transport\Dsn(
                            'smtp',
                            $transectional->host,
                            $transectional->email,
                            $transectional->password,
                            $transectional->port,
                        ));

                        $mailer = new \Symfony\Component\Mailer\Mailer($transport);

                        $email = (new \Symfony\Component\Mime\Email())
                            ->from($transectional->email)
                            ->to($invoices->client_mail)
                            ->subject($request->email_subject)
                            ->html($request->email_body)
                            ->attachFromPath(public_path('storage/' . $invoices->file));
                        if ($request->cc_email) {
                            $email->cc($request->cc_email);
                        }
                        if ($request->bcc_email) {
                            $email->bcc($request->bcc_email);
                        }
                        if ($request->reply_email) {
                            $email->replyTo(new Address($request->reply_email, 'Reply'));
                        }
                        // ->text('Plain Text Content')
                        $mailer->send($email);

                        $invoices->send_email  = 'Resend';
                        $invoices->created_by  = Auth::id();
                        $save = $invoices->save();
                    }

                    $message = ($request->proccess == 'mail&draft') ? 'Transection user mailed &  draft  successfully' : 'Transection user mail successfully';
                }

                return response()->json(['status' => 'success', 'message' => $message]);
            } else {
                return response()->json(['status' => 'warning', 'message' => 'Transetional credentional is not assigned.']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Invoice', 'error' => $e->getMessage()], 500);
        }
    }

    // comments
    public function comments(Request $request): JsonResponse
    {
        try {

            $data = Comment::where(['comment_for' => $request->comment_for, 'comment_for_id' => $request->comment_for_id])->get()->toArray();
            $message = 'Comments retirved  successfully';

            return response()->json(['status' => 'success', 'message' => $message, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error geting comments', 'error' => $e->getMessage()], 500);
        }
    }

    public function comment_store(Request $request): JsonResponse
    {
        try {
            $comment = new Comment();
            $comment->comment_for    = 'Invoice';
            $comment->comment_for_id = $request->comment_for_id;
            $comment->user_name  = Auth::user()->name;
            $comment->user_pic   = Auth::user()->user_pic ?? NULL;
            $comment->comment    = $request->comment;
            $comment->created_by = Auth::id();;
            $save = $comment->save();

            $message = 'Comment added successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Invoice', 'error' => $e->getMessage()], 500);
        }
    }

    // transetional store ....
    public function transectional_store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'port' => 'required',
            'password' => 'required',
            'host' => 'required',
            'password' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('transectionals')->ignore($request->id),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        try {
            $transectional = ($request->id) ? Transectional::find($request->id) : new Transectional();

            $isExistingTrans = $transectional->exists;

            $transectional->user_id        = $request->user_id;
            $transectional->email           = $request->email;
            $transectional->password        = $request->password;
            $transectional->port            = $request->port;
            $transectional->host            = $request->host;
            $transectional->mail_encryption = $request->mail_encryption;
            $transectional->reply_email     = $request->reply_email ?? NULL;
            $transectional->cc_email        = $request->cc_email ?? NULL;
            $transectional->bcc_email       = $request->bcc_email ?? NULL;
            $transectional->email_subject   = $request->email_subject ?? NULL;
            $transectional->email_body      = $request->email_body ?? NULL;
            $transectional->created_by      = auth()->user()->id;

            $save = $transectional->save();

            if ($save) {
                $emailData = [
                    'password' => '',
                    'name'  => $request->name,
                    'email' => $request->email,
                    'body'  => "Congratulations! You transetional mail  has been added successfully on this Email." . $request->email,
                ];
                UserProfileEmail::dispatch($emailData)->onQueue('emails');
            }

            $message = $isExistingTrans ? 'Transection user updated successfully' : 'Transection user added successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Transection', 'error' => $e->getMessage()], 500);
        }
    }

    // transetional retrived ....
    public function transectionals(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), ['user_id' => 'required']);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        try {
            $transectional = Transectional::where(['user_id' => $request->user_id, 'status' => $this->userStatus['Active']])->latest('id')->first();
            $message = 'Transection user retrived successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $transectional]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Transection', 'error' => $e->getMessage()], 500);
        }
    }

    // saving basic settings...
    public function basic_settings(Request $request): JsonResponse
    {
        try {
            $user_id = Auth::id();
            if ($request->services) {
                $selectedServices = Service::whereIn('id', $request->services)->get();

                foreach ($selectedServices as $service) {
                    Service::create([
                        'title' => $service->title,
                        'type'  => $service->type,
                        'sadmin_id'  => $user_id,
                        'created_by' => $user_id,
                    ]);
                }
            }

            if ($request->currencies) {
                $selectedCurrencies = Currency::whereIn('id', $request->currencies)->get();
                foreach ($selectedCurrencies as $currencies) {
                    Currency::create(                [
                        'name' => ucwords($currencies->name),
                        'code' => strtoupper($currencies->code),
                        'type' => $currencies->type,
                        'sadmin_id' => $user_id,
                        'created_by' => $user_id,
                    ]);
                }
            }

            if ($request->loactions) {
                $selectedLoactions = Location::whereIn('id', $request->loactions)->get();
                foreach ($selectedLoactions as $loactions) {
                    Location::create([
                        'name' => ucwords($loactions->name),
                        'code' => strtoupper($loactions->code),
                        'type' => $loactions->type,
                        'sadmin_id' => $user_id,
                        'created_by' => $user_id,
                    ]);
                }
            }

            $message = "Setting's Updated successfully";
            return response()->json(['status' => 'success', 'message' => $message, 'data' => NULL]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing Setting', 'error' => $e->getMessage()], 500);
        }
    }
}
