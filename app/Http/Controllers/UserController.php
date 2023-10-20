<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use App\Models\User;
use App\Mail\otpVerifcation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Notification;
use Illuminate\Foundation\Auth\Authenticatable;
use Carbon\Carbon;
use App\Jobs\SendEmailVerificationJob;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Quotation;
use App\Models\Contract;
use App\Models\Invoice;
use App\Models\Currency;
use App\Models\Template;
use App\Models\Comment;
use App;

class UserController extends Controller
{

    public $api;
    private $user;
    protected $quoteStatus;
    protected $currencies;
    protected $status;
    protected $userStatus;
    protected $curFormatDate;
    protected $currencyTypes;
    protected $template_for;
    protected $temp_saveAs;
    protected $temp_status;
    protected $temp_status_as;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->api = new APIController();
        $this->quoteStatus = config('constants.QUOTE_STATUS');
        $this->status = config('constants.QUOTE_STATUS');
        $this->currencies = config('constants.CURRENCIES');
        $this->userStatus = config('constants.USER_STATUS');
        $this->curFormatDate = Carbon::now()->format('Y-m-d');
        $this->currencyTypes = config('constants.CURRENCY_TYPES');
        $this->template_for = config('constants.TEMPLATE_FOR');
        $this->temp_saveAs = config('constants.TEMP_SAVE_AS');
        $this->temp_status = config('constants.TEMP_STATUS');
        $this->temp_status_as = config('constants.TEMP_SAVE_AS_NAME');
    }

    public function lang_change(Request $request)
    {

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            session(['user_details' => $user]);
            $now = Carbon::now('Asia/Karachi');
            $current_date = $now->format('Y-m-d H:i:s');
            $currentDate = Carbon::now();
            // User roles: 1 for Super Admin, 2 for Admin, 3 for User
            if (isset($user->role) && $user->role == user_roles('2')) {

                $data['user']         = $user;
                $data['users']      = User::where(['role' => user_roles('3'), 'client_id' => $user->id, 'status' => $this->userStatus['Active']])->select('id', 'name', 'user_pic')->get()->toArray();
                $data['usersCount'] = count($data['users'] ?? []);
                $data['user_quote_percentage'] = 0;
                $data['totalQuotion']     = Quotation::where('admin_id', $user->id)->count();
                $data['totalInvoice']     = Invoice::where('admin_id', $user->id)->count();
                $data['totalContract']    = Contract::where('admin_id', $user->id)->count();

                $data['totalTodayQT']   = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->where('admin_id', $user->id)->count();
                $data['TodayQTsent']    = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->where('admin_id', $user->id)->count();
                $data['sentQuote_percent'] = $data['totalTodayQT'] > 0 ? round(($data['TodayQTsent'] / $data['totalTodayQT']) * 100, 1) : 0;

                $data['totalTodayCT']   = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress'], $this->status['Completed']])->where('admin_id', $user->id)->count();
                $data['TodayCTcomp']    = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Completed']])->where('admin_id', $user->id)->count();
                $data['compCT_percent'] = $data['totalTodayCT'] > 0 ? round(($data['TodayCTcomp'] / $data['totalTodayQT']) * 100, 1) : 0;

                $data['totalTodayINV']   = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->where('admin_id', $user->id)->count();
                $data['TodayINVcomp']    = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->where('admin_id', $user->id)->count();
                $data['compINV_percent'] = $data['totalTodayINV'] > 0 ? round(($data['totalTodayINV'] / $data['totalTodayINV']) * 100, 1) : 0;

                $data['activeQuotes']   = Quotation::with(['admins:id,name', 'users:id,name'])
                    ->whereDate('date', $this->curFormatDate)
                    ->where(['status' => $this->status['In Progress'], 'admin_id' => $user->id])
                    ->get(['id', 'desc', 'client_name', 'date', 'user_id', 'admin_id', 'status'])
                    ->toArray();

                return view('admin_dashboard', $data);
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                $admin = User::where(['role' => user_roles('2'), 'id' => $user->client_id])->first();
                if ($admin) {

                    $data['user']           = $user;
                    $data['totalQuotion']   = Quotation::where('user_id', $user->id)->count();
                    $data['totalInvoice']   = Invoice::where('user_id', $user->id)->count();
                    $data['totalContract']  = Contract::where('user_id', $user->id)->count();
                    $data['completedCOT_detail']  = Contract::where([['status', $this->status['Completed']], ['user_id', $user->id]])->get()->toArray();
                    $data['completedTrips'] = count($data['completedTrips_detail'] ?? []);
                    $data['activeQuotes']   = Quotation::with(['admins:id,name', 'users:id,name'])
                        ->whereDate('date', $this->curFormatDate)
                        ->where(['status' => $this->status['In Progress'], 'user_id' => $user->id])
                        ->get(['id', 'desc', 'client_name', 'date', 'user_id', 'admin_id', 'status'])
                        ->toArray();

                    return view('user_dashboard', $data);
                } else {
                    return redirect('/login');
                }
            } else {
                $data['user']           = $user;
                $data['sadminsCount']    = User::where('role', user_roles('1'))->count();
                $data['adminsCount']   = User::where('role', user_roles('2'))->count();
                $data['usersCount']   = User::where('role', user_roles('3'))->count();

                $data['revenue']  = Invoice::join('currencies as c','invoices.currency_code','=','c.code')
                    ->where('invoices.status', $this->status['Completed'])
                    ->where('c.type', $this->currencyTypes[1])
                    ->groupBy('invoices.currency_code','c.name')
                    ->select('invoices.currency_code', 'c.name', DB::raw('SUM(amount) as total_amount'))
                    ->get()
                    ->toArray(); 

                $data['totalQuotion']         = Quotation::count();
                $data['totalInvoice']         = Invoice::count();
                $data['completedContract']    = Contract::where('status', $this->status['Completed'])->count();

                $data['totalTodayQT']   = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->count();
                $data['TodayQTsent']    = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->count();
                $data['sentQuote_percent'] = $data['totalTodayQT'] > 0 ? round(($data['TodayQTsent'] / $data['totalTodayQT']) * 100, 1) : 0;

                $data['totalTodayCT']   = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress'], $this->status['Completed']])->count();
                $data['TodayCTcomp']    = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Completed']])->count();
                $data['compCT_percent'] = $data['totalTodayCT'] > 0 ? round(($data['TodayCTcomp'] / $data['totalTodayCT']) * 100, 1) : 0;

                $data['totalTodayINV']   = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->count();
                $data['TodayINVcomp']    = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->count();
                $data['compINV_percent'] = $data['totalTodayINV'] > 0 ? round(($data['TodayINVcomp'] / $data['totalTodayINV']) * 100, 1) : 0;

                $data['activeQuotes']   = Quotation::with('admins:id,name')->whereDate('date', $this->curFormatDate)->where('status', $this->status['In Progress'])->get(['id', 'desc', 'client_name', 'date', 'user_id', 'admin_id', 'status'])->toArray();

                return view('superAdmin_dashboard', $data);
            }
        } else {
            return view('login');
        }
    }

    public function admins()
    {
        $user = auth()->user();
        $page_name = 'admins';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $clients = User::where(['role' => user_roles('2')])->orderBy('id', 'desc')->get()->toArray();
        return view('admins', ['data' => $clients, 'user' => $user, 'add_as_user' => user_roles('2')]);
    }

    public function users()
    {
        $user = auth()->user();
        $page_name = 'users';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        if (isset($user->role) && $user->role == user_roles('1')) {

            $users = User::join('users as c', 'users.client_id', '=', 'c.id')
                ->where('users.role', user_roles('3'))
                ->select('users.*', 'c.name as client_name', 'c.user_pic as client_pic', 'c.email as client_email')
                ->orderBy('users.id', 'desc')
                ->get()
                ->toArray();
            $admins_list = User::where(['role' => user_roles('2')])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();

            return view('users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3'), 'admins_list' => $admins_list]);
        } else {

            $users = User::where(['role' => user_roles('3'), 'client_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            return view('users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3')]);
        }
    }
// quotations managment module....
    public function quotations()
    {
        $user = auth()->user();
        $page_name = 'quotations';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        if (isset($user->role) && $user->role == user_roles('1')) {
            $quotations = Quotation::join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'admins.name as admin_name')
                ->orderBy('quotations.id', 'desc')
                ->get()
                ->toArray();
        } else if (isset($user->role) && $user->role == user_roles('2')) {
            $quotations = Quotation::join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('quotations.admin_id', $user->id)
                ->orderBy('quotations.id', 'desc')
                ->get()
                ->toArray();
        } else {
            $quotations = Quotation::join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('quotations.user_id', $user->id)
                ->orderBy('quotations.id', 'desc')
                ->get()
                ->toArray();
        }

        return view('quotations', ['data' => $quotations, 'user' => $user]);
    }

    public function add_quotation(Request $request)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $page_name = 'add_quotation';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $data['duplicate_trip'] = NULL;
        $data['currencies'] = Currency::select('code', 'name')->pluck('name','code')->toArray();

        if ($request->has('id')) {
            $data['duplicate_trip'] = $request->duplicate_trip ?? NULL;

            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $quotation = Quotation::find($request->id);
                $data['data'] = $quotation->toArray();
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users()])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $quotation->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['data'] = Quotation::find($request->id)->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else {
                $data['data'] = Quotation::find($request->id)->toArray();
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['users_list'] = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users()])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            }
        }

        return view('add_quotation', $data);
    }

    public function create_quotation(Request $request)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $page_name = 'create_quotation';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
 
        $data['draft_template'] = Template::where('save_as',$this->temp_status_as['Draft'])->orderBy('id','DESC')->first();
        $data['template_for'] = $this->template_for['1'];
        $data['save_as'] = $this->temp_saveAs;
        return view('create_quotation', $data);
    }

// contracts managment module....
    public function contracts()
    {
        $user = auth()->user();
        $page_name = 'contracts';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        if (isset($user->role) && $user->role == user_roles('1')) {
            $contracts = Contract::join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'admins.name as admin_name')
                ->orderBy('contracts.id', 'desc')
                ->get()
                ->toArray();
        } else if (isset($user->role) && $user->role == user_roles('2')) {
            $contracts = Contract::join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('contracts.admin_id', $user->id)
                ->orderBy('contracts.id', 'desc')
                ->get()
                ->toArray();
        } else {
            $contracts = Contract::join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('contracts.user_id', $user->id)
                ->orderBy('contracts.id', 'desc')
                ->get()
                ->toArray();
        }

        return view('contracts', ['data' => $contracts, 'user' => $user]);
    }

    public function add_contract(Request $request)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $page_name = 'add_contract';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $data['duplicate_trip'] = NULL;
        $data['currencies'] = Currency::select('code', 'name')->pluck('name','code')->toArray();

        if ($request->has('id')) {

            $data['duplicate_trip'] = $request->duplicate_trip ?? NULL;

            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $contract = Contract::find($request->id);
                $data['data'] = $contract->toArray();
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users()])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $contract->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['data'] = Contract::find($request->id)->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else {
                $data['data'] = Contract::find($request->id)->toArray();
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['users_list'] = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users()])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            }
        }

        return view('add_contract', $data);
    }

// invoces managment module....
    public function invoices()
    {
        $user = auth()->user();
        $page_name = 'invoices';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        if (isset($user->role) && $user->role == user_roles('1')) {
            $invoices = Invoice::join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'admins.name as admin_name')
                ->orderBy('invoices.id', 'desc')
                ->get()
                ->toArray();
        } else if (isset($user->role) && $user->role == user_roles('2')) {
            $invoices = Invoice::join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('invoices.admin_id', $user->id)
                ->orderBy('invoices.id', 'desc')
                ->get()
                ->toArray();
        } else {
            $invoices = Invoice::join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('invoices.user_id', $user->id)
                ->orderBy('invoices.id', 'desc')
                ->get()
                ->toArray();
        }

        return view('invoices', ['data' => $invoices, 'user' => $user]);
    }

    public function add_invoice(Request $request)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $page_name = 'add_invoice';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $data['duplicate_trip'] = NULL;
        $data['currencies'] = Currency::select('code', 'name')->pluck('name','code')->toArray();

        if ($request->has('id')) {

            $data['duplicate_trip'] = $request->duplicate_trip ?? NULL;

            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $invoices = Invoice::find($request->id);
                $data['data'] = $invoices->toArray();
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users()])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $invoices->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['data'] = Invoice::find($request->id)->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else {
                $data['data'] = Invoice::find($request->id)->toArray();
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['users_list'] = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users()])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'client_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            }
        }

        return view('add_invoice', $data);
    }

    public function get_users(Request $request)
    {
        $users_list = User::where(['role' => user_roles('3'), 'client_id' => $request->id, 'status' => active_users()])
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return response()->json($users_list);
    }

    public function superAdmins()
    {
        $user = auth()->user();
        $page_name = 'super_admins';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $users = User::where(['role' => user_roles(1)])->orderBy('id', 'desc')->get()->toArray();
        return view('superAdmins', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('1')]);
    }

    public function settings()
    {
        $user = auth()->user();
        $page_name = 'settings';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $user = auth()->user();
        return view('settings', ['user' => $user]);
    }

    public function user_store(REQUEST $request)
    {
        ($request->id) ? $user = User::find($request->id) : $user = new User();
        $user->name     = $request->client_name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->com_name = $request->company_name;
        $user->com_pic  = $request->company_logo;
        $user->address  = $request->address;
        $user->role     = $request->role;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $save = $user->save();

        return redirect()->back();
    }

    public function user_edit($id)
    {
        $user = User::where(['id' => $id])->get()->toArray();
        return json_encode($user);
    }

    public function user_register(REQUEST $request)
    {
        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($request->id),
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $verificationToken = Str::random(20);

            $user =  new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->phone    = $request->phone;
            $user->com_name = $request->company_name;
            $user->com_pic  = $request->company_logo;
            $user->address  = $request->address;
            $user->role     = $request->role;
            $user->status   = 4;
            $user->remember_token   = $verificationToken;
            $user->password = Hash::make($request->password);
            $save = $user->save();
            if ($save) {
                $notification =  new Notification();

                $notification->title      = 'New User Regisration';
                $notification->user_id    = $user->id;
                $notification->desc       = 'New User Mr/Mis. ' . $user->name . ' Regisration is created Now. With Email: ' . $user->email;
                $notification->status     = 'nseen';
                $notification->created_by = $user->id;
                $save = $notification->save();

                $emailData = [
                    'hash'  => $verificationToken,
                    'email' => $request->email,
                    'name'  => $request->name,
                    'body'  => 'Congratulations! You have successfully subscribed to our package.',
                ];

                SendEmailVerificationJob::dispatch($emailData)->onQueue('emails');

                return redirect('/register')->with('success', 'Please Check your Email for Verification');
            }
        } else {
            return view('register');
        }
    }

    public function user_login(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            if ($request->all()) {
                $login = $this->api->user_login($request);
                $responseData = json_decode($login->getContent(), true);

                if ($responseData['status'] == "success") {
                    session(['user' => $responseData['token']]);
                    session(['lang' => 'en']);
                }

                echo $login->getContent();
            } else {
                return view('login');
            }
        } else {
            return redirect('/');
        }
    }

    public function logout(REQUEST $request)
    {
        session()->forget('lang');
        session()->flush();
        return redirect('/login');
    }

    public function forgot_password(REQUEST $request)
    {

        $req = $request->all();
        if (isset($req['no1']) || isset($req['no2']) || isset($req['no3']) || isset($req['no4']) || isset($req['no5'])) {
            $array = [$req["no1"], $req["no2"], $req["no3"], $req["no4"], $req["no5"]];
            $otp = implode('', $array);

            $user = User::where(['email' => $req['email'], 'otp' => $otp])->first();
            if ($user) {
                Session::flash('email_temp', $user->email);
                return redirect('/set_password');
            } else {

                Session::flash('invalid', "OTP is not Correct");
                Session::flash('email', $req['email']);

                return view('forgotPassword', ['email' => $req['email'], 'no' => $array]);
            }
        } else {

            if (isset($req['email']) && !empty($req['email'])) {

                $user = User::where('email', $req['email'])->first();
                if ($user) {
                    $otp = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
                    $emailData = [
                        'otp' => $otp,
                        'name' => $user->name,
                        'body' => 'Thank you for choosing our services. We are pleased to provide you with the OTP verification.',
                    ];
                    $mail = new otpVerifcation($emailData);



                    try {
                        $user->reset_pswd_attempt = $user->reset_pswd_attempt ? ++$user->reset_pswd_attempt : 1;

                        if ($user->reset_pswd_attempt > 3) {
                            $resetTime = $user->reset_pswd_time ? Carbon::parse($user->reset_pswd_time) : null;
                            $currentTime = Carbon::now();

                            if (!$resetTime || $resetTime->addMinutes(5)->isPast()) {
                                $user->reset_pswd_attempt = 1;
                                $user->reset_pswd_time = $currentTime;
                            } else {
                                Session::forget(['status', 'message', 'otp']);
                                $remainingTime = $resetTime->diffInSeconds($currentTime);
                                return view('forgotPassword', ['email' => $req['email'], 'forgot_pass' => 'You have exceeded the maximum password reset attempts. Please try again after ', 'remainingTime' => $remainingTime]);
                            }
                        }

                        Mail::to($user->email)->send($mail);

                        $user->otp = $otp;
                        $user->reset_pswd_time = Carbon::now();
                        $user->save();

                        Session::flash('otp', "Email sent successfully!");
                        Session::flash('email', $user->email);

                        return view('forgotPassword', ['email' => $req['email']]);
                    } catch (\Exception $e) {
                        echo "Failed to send email: " . $e->getMessage();
                    }
                } else {

                    Session::flash('status', 'invalid');
                    Session::flash('message', 'this email is invalid');
                    Session::flash('email', $req['email']);


                    return view('forgotPassword', ['email' => $req['email']]);
                }
            } else {
                return view('forgotPassword');
            }
        }
    }

    public function set_password(Request $request)
    {
        $req['email'] = ($request->email) ? $request->email : session('email_temp');
        if ($req['email']) {
            if ($request->has('password')) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                    'email' => 'required'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $user = User::where('email', $req['email'])->first();
                $user->password = Hash::make($request->password);
                $save = $user->save();

                if ($save) {
                    return redirect('/login')->with('password_changed', "Password is successfully changed");;
                }
            } else {
                return view('setPassword', ['email' => $req['email']]);
            }
        } else {
            return view('setPassword', ['email' => $req['email']]);
        }
    }

    public function change_status(REQUEST $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($request->status == 1) {
            $user->status     = $request->status;
            $save = $user->save();
            if ($save) {
                $emailData = [
                    'otp' => 'Account Activation',
                    'name' => $user->name,
                    'body' => 'Dear You Account has been activated successfully :',
                ];
                $mail = new otpVerifcation($emailData);

                try {
                    Mail::to($user->email)->send($mail);
                    echo $save;
                } catch (\Exception $e) {
                    echo "Failed to send email: " . $e->getMessage();
                }
            }
        } else {
            $user->status     = $request->status;
            $save = $user->save();
            echo $save;
        }
    }

    public function verify(Request $request, $hash)
    {
        $user = User::where('remember_token', $hash)->first();

        if ($user) {
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                $user->status = 1;
                $user->save();

                return redirect('/login')->with('success', 'Email verified successfully. Please log in.');
            } else {
                return redirect('/login')->with('success', 'Email already verified.');
            }
        } else {
            return redirect('/login')->with('error', 'Invalid verification link.');
        }
    }

    public function currencies(REQUEST $request){
        $user = auth()->user();
        $page_name = 'currencies';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $currency = NULL;
        $message  = NULL;
        Session::forget('msg');

        if($request->action == 'edit'){
            $currency = Currency::findOrFail($request->id)->toArray();
        }
        else if($request->action == 'save'){
            $saved = Currency::updateOrCreate(
                ['id' => $request->id ?? NULL], 
                [
                    'name' => ucwords($request->name),
                    'code' => strtoupper($request->code),
                    'type' => $request->type,
                    'created_by' => $user->id,
                ] 
            );
            $message = "Currency " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        }
        else if($request->action == 'dell'){
            $deleted = Currency::find($request->id)->delete();
            $message = "Currency has been deleted Successfully";
            Session::flash('msg', $message);
        }

         $currencies = Currency::all()->toArray();
        return view('currencies', ['user' => $user, 'currency'=>$currency,'data'=>$currencies ,'types' => $this->currencyTypes]);
    }

    public function revenue(REQUEST $request){
        $user = auth()->user();
        $page_name = 'revenue';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data  = Invoice::join('currencies as c','invoices.currency_code','=','c.code')
        ->where('invoices.status', $this->status['Completed'])
        ->groupBy('invoices.currency_code','c.name')
        ->select('invoices.currency_code', 'c.name', DB::raw('SUM(amount) as total_amount'))
        ->get()
        ->toArray();   
        return view('revenue', ['user' => $user, 'data'=>$data]);
    }
}
