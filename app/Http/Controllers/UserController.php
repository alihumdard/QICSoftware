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
use App\Models\Location;
use App\Models\Service;
use App\Models\Comment;
use App\Models\Transectional;

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
    protected $sev_status;
    protected $sev_type;
    protected $locationType;

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
        $this->sev_status = config('constants.STATUS');
        $this->sev_type = config('constants.SERVICE_TYPES');
        $this->locationType = config('constants.LOCATION_TYPES');
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
            $data['user']       = $user;
            $data['services']   = Service::select('id', 'title')->where(['type' => $this->sev_type[1]])->pluck('title', 'id')->toArray();

            // User roles: 1 for Super Admin, 2 for Admin, 3 for User, 4 Manager
            if (isset($user->role) && $user->role == user_roles('1')) {
                if ($user->sub_exp_date) {
                    $expirationDate = Carbon::createFromFormat('Y-m-d', $user->sub_exp_date);
                    if ($currentDate->gt($expirationDate)) {
                        return view('subscription_expired', ['user' => $user]);
                    } else {

                        $data['services']   = Service::where('sadmin_id', $user->id)->latest('id')->get()->toArray();
                        $data['locations']  = Location::where('sadmin_id', $user->id)->latest('id')->get()->toArray();
                        $data['currencies'] = Currency::where('sadmin_id', $user->id)->latest('id')->get()->toArray();
                        if ($data['services'] == Null && $data['locations'] == Null && $data['currencies'] == Null) {
                            $data['def_serv_q'] = Service::where(['created_by' => 'Default', 'sadmin_id' => NULL, 'type' => $this->sev_type[1]])->get()->toArray();
                            $data['def_serv_c'] = Service::where(['created_by' => 'Default', 'sadmin_id' => NULL, 'type' => $this->sev_type[2]])->get()->toArray();
                            $data['def_serv_i'] = Service::where(['created_by' => 'Default', 'sadmin_id' => NULL, 'type' => $this->sev_type[3]])->get()->toArray();
                            $data['def_loca']   = Location::where(['created_by' => 'Default', 'sadmin_id' => NULL])->latest('id')->get()->toArray();
                            $data['def_curn']   = Currency::where(['created_by' => 'Default', 'sadmin_id' => NULL])->latest('id')->get()->toArray();
                            // dd($data['def_curn']);
                        }

                        $data['adminsCount']  = User::where(['role' => user_roles('2'), 'sadmin_id' => $user->id])->count();
                        $data['usersCount']   = User::where(['role' => user_roles('3'), 'sadmin_id' => $user->id])->count();

                        $data['revenue'] = Invoice::join('currencies as cur', 'invoices.currency_id', '=', 'cur.id')
                            ->where('invoices.status', $this->status['Completed'])
                            ->where('cur.type', 'Default')
                            ->where('cur.sadmin_id', $user->id)
                            ->groupBy('cur.id', 'cur.code')
                            ->select(
                                DB::raw('SUM(invoices.amount) as total_amount'),
                                'cur.code',
                                DB::raw('cur.id as currency_id')
                            )
                            ->get()
                            ->toArray();

                        $data['totalQuotion']      = Quotation::where('sadmin_id', $user->id)->count();
                        $data['totalInvoice']      = Invoice::where('sadmin_id', $user->id)->count();
                        $data['completedContract'] = Contract::where(['status' => $this->status['Completed'], 'sadmin_id' => $user->id])->count();

                        $data['totalTodayQT']      = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->where('sadmin_id', $user->id)->count();
                        $data['TodayQTsent']       = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->where('sadmin_id', $user->id)->count();
                        $data['sentQuote_percent'] = $data['totalTodayQT'] > 0 ? round(($data['TodayQTsent'] / $data['totalTodayQT']) * 100, 1) : 0;

                        $data['totalTodayCT']   = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress'], $this->status['Completed']])->where('sadmin_id', $user->id)->count();
                        $data['TodayCTcomp']    = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Completed']])->where('sadmin_id', $user->id)->count();
                        $data['compCT_percent'] = $data['totalTodayCT'] > 0 ? round(($data['TodayCTcomp'] / $data['totalTodayCT']) * 100, 1) : 0;

                        $data['totalTodayINV']   = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->where('sadmin_id', $user->id)->count();
                        $data['TodayINVcomp']    = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->where('sadmin_id', $user->id)->count();
                        $data['compINV_percent'] = $data['totalTodayINV'] > 0 ? round(($data['TodayINVcomp'] / $data['totalTodayINV']) * 100, 1) : 0;
                        $data['activeQuotes']    = Quotation::with('admins:id,name')->whereDate('date', $this->curFormatDate)->where('status', $this->status['In Progress'])->where('sadmin_id', $user->id)->get(['id', 'desc', 'client_name', 'date', 'user_id', 'admin_id', 'status'])->toArray();

                        return view('superAdmin_dashboard', $data);
                    }
                } else {
                    return view('subscription_expired', ['user' => $user]);
                }
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $sadmin = User::where(['role' => user_roles('1'), 'id' => $user->sadmin_id])->first();
                if ($sadmin) {
                    if ($sadmin->sub_exp_date) {
                        $expirationDate = Carbon::createFromFormat('Y-m-d', $sadmin->sub_exp_date);
                        if ($currentDate->gt($expirationDate)) {
                            return view('sub_expired_admin', ['user' => $user]);
                        } else {
                            $data['users']      = User::where(['role' => user_roles('3'), 'admin_id' => $user->id, 'status' => $this->userStatus['Active']])->select('id', 'name', 'user_pic')->get()->toArray();
                            $data['usersCount'] = count($data['users'] ?? []);
                            $data['user_quote_percentage'] = 0;

                            $data['totalQuotion']   = Quotation::where('admin_id', $user->id)->count();
                            $data['totalInvoice']   = Invoice::where('admin_id', $user->id)->count();
                            $data['totalContract']  = Contract::where('admin_id', $user->id)->count();

                            $data['totalTodayQT']   = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->where('admin_id', $user->id)->count();
                            $data['TodayQTsent']    = Quotation::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->where('admin_id', $user->id)->count();
                            $data['sentQuote_percent'] = $data['totalTodayQT'] > 0 ? round(($data['TodayQTsent'] / $data['totalTodayQT']) * 100, 1) : 0;

                            $data['totalTodayCT']   = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress'], $this->status['Completed']])->where('admin_id', $user->id)->count();
                            $data['TodayCTcomp']    = Contract::whereDate('end_date', $this->curFormatDate)->whereIn('status', [$this->status['Completed']])->where('admin_id', $user->id)->count();
                            $data['compCT_percent'] = $data['totalTodayCT'] > 0 ? round(($data['TodayCTcomp'] / $data['totalTodayCT']) * 100, 1) : 0;

                            $data['totalTodayINV']   = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['Pending'], $this->status['In Progress']])->where('admin_id', $user->id)->count();
                            $data['TodayINVcomp']    = Invoice::whereDate('date', $this->curFormatDate)->whereIn('status', [$this->status['In Progress']])->where('admin_id', $user->id)->count();
                            $data['compINV_percent'] = $data['totalTodayINV'] > 0 ? round(($data['totalTodayINV'] / $data['totalTodayINV']) * 100, 1) : 0;

                            $data['activeQuotes']   = Quotation::with(['admins:id,name', 'users:id,name'])
                                ->whereDate('date', $this->curFormatDate)
                                ->where(['status' => $this->status['In Progress'], 'admin_id' => $user->id])
                                ->get(['id', 'desc', 'client_name', 'date', 'user_id', 'admin_id', 'status'])
                                ->toArray();

                            return view('admin_dashboard', $data);
                        }
                    } else {
                        return view('sub_expired_admin', ['user' => $user]);
                    }
                } else {
                    return redirect('/logout');
                }
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                $sadmin = User::where(['role' => user_roles('1'), 'id' => $user->sadmin_id])->first();
                if ($sadmin) {
                    if ($sadmin->sub_exp_date) {
                        $expirationDate = Carbon::createFromFormat('Y-m-d', $sadmin->sub_exp_date);
                        if ($currentDate->gt($expirationDate)) {
                            return view('sub_expired_admin', ['user' => $user]);
                        } else {
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
                        }
                    } else {
                        return view('sub_expired_admin', ['user' => $user]);
                    }
                } else {
                    return redirect('/logout');
                }
            } else if (isset($user->role) && $user->role == user_roles('4')) {
                $data['sadminsCount']    = User::where('role', user_roles('1'))->count();
                $data['sadminsActive']   = User::where(['role' => user_roles('1'), 'status' => $this->userStatus['Active']])->count();
                $data['sadminsPending']  = User::where(['role' => user_roles('1'), 'status' => $this->userStatus['Pending']])->count();
                $data['sadminsInactive'] = User::where(['role' => user_roles('1')])->where('status', '!=', $this->userStatus['Active'])->where('status', '!=', $this->userStatus['Pending'])->count();
                $data['sadminActivePer'] = $data['sadminsCount'] > 0 ? round(($data['sadminsActive']  / $data['sadminsCount']) * 100, 1) : 0;
                $data['sadminInactivePer'] = $data['sadminsCount'] > 0 ? round(($data['sadminsInactive']  / $data['sadminsCount']) * 100, 1) : 0;

                $data['adminsCount']     = User::where('role', user_roles('2'))->count();
                $data['adminsActive']    = User::where('role', user_roles('2'))->where('status', '=', $this->userStatus['Active'])->count();
                $data['adminsInactive']  = User::where('role', user_roles('2'))->where('status', '!=', $this->userStatus['Active'])->where('status', '!=', $this->userStatus['Pending'])->count();
                $data['adminActivePer']  = $data['adminsCount'] > 0 ? round(($data['adminsActive']  / $data['adminsCount']) * 100, 1) : 0;
                $data['adminInactivePer']  = $data['adminsCount'] > 0 ? round(($data['adminsInactive']  / $data['adminsCount']) * 100, 1) : 0;

                $data['usersCount']      = User::where('role', user_roles('3'))->count();
                $data['usersActive']     = User::where('role', user_roles('3'))->where('status', '=', $this->userStatus['Active'])->count();
                $data['usersInactive']   = User::where('role', user_roles('3'))->where('status', '!=', $this->userStatus['Active'])->where('status', '!=', $this->userStatus['Pending'])->count();
                $data['userActivePer']   = $data['usersCount'] > 0 ? round(($data['usersActive']  / $data['usersCount']) * 100, 1) : 0;
                $data['userInactivePer'] = $data['usersCount'] > 0 ? round(($data['usersInactive']  / $data['usersCount']) * 100, 1) : 0;

                $data['totalQuotion']    = Quotation::count() ?? 0;
                $data['totalInvoice']    = Invoice::count() ?? 0;
                $data['totalContract']   = Contract::count() ?? 0;

                return view('manager_dashboard', $data);
            }
        } else {
            return view('login');
        }
    }

    public function superAdmins()
    {
        $user = auth()->user();
        $page_name = 'super_admins';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data['user'] = auth()->user();
        $data['add_as_user'] = user_roles('1');

        if (isset($user->role) && $user->role == user_roles('4')) {
            $data['superAdmins'] = User::where(['role' => user_roles('1'), 'manager_id' => $user->id])->latest('id')->get()->toArray();
        }
        return view('superAdmins', $data);
    }


    public function admins()
    {
        $user = auth()->user();
        $page_name = 'admins';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data['user'] = auth()->user();
        $data['add_as_user'] = user_roles('2');

        if (isset($user->role) && $user->role == user_roles('1')) {
            $data['admins'] = User::where(['role' => user_roles('2'), 'sadmin_id' => $user->id])->latest('id')->get()->toArray();
        }

        return view('admins', $data);
    }

    public function users()
    {
        $user = auth()->user();
        $page_name = 'users';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        if (isset($user->role) && $user->role == user_roles('1')) {

            $users = User::join('users as admin', 'users.admin_id', '=', 'admin.id')
                ->where(['users.role' => user_roles('3'), 'users.sadmin_id' => $user->id])
                ->select('users.*', 'admin.name as admin_name', 'admin.user_pic as admin_pic', 'admin.email as admin_email')
                ->orderBy('users.id', 'desc')
                ->get()
                ->toArray();
            $admins_list = User::where(['role' => user_roles('2'), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();

            return view('users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3'), 'admins_list' => $admins_list]);
        } else {

            $users = User::where(['role' => user_roles('3'), 'admin_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
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

        $data['user'] = $user;
        $data['services']   = Service::select('id', 'title')->where(['type' => $this->sev_type[1]])->latest('id')->pluck('title', 'id')->toArray();
        $data['location']   = Location::select('id', 'name')->pluck('name', 'id')->toArray();

        if (isset($user->role) && $user->role == user_roles('1')) {
            $data['quotations'] = Quotation::with(['location:id,name,code', 'currency:id,code,name'])
                ->join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'admins.name as admin_name')
                ->orderBy('quotations.id', 'desc')
                ->where('quotations.sadmin_id', $user->id)
                ->get()
                ->toArray();
        } else if (isset($user->role) && $user->role == user_roles('2')) {
            $data['quotations'] = Quotation::with(['location:id,name,code', 'currency:id,code,name'])
                ->join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('quotations.admin_id', $user->id)
                ->orderBy('quotations.id', 'desc')
                ->get()
                ->toArray();
        } else {
            $data['quotations'] = Quotation::with(['location:id,name,code', 'currency:id,code,name'])
                ->join('users as u', 'u.id', '=', 'quotations.user_id')
                ->join('users as admins', 'admins.id', '=', 'quotations.admin_id')
                ->select('quotations.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('quotations.user_id', $user->id)
                ->orderBy('quotations.id', 'desc')
                ->get()
                ->toArray();
        }

        return view('quotations', $data);
    }

    public function add_quotation(Request $request)
    {
        $user = auth()->user();
        $page_name = 'add_quotation';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data['user'] = $user;
        $data['duplicate_qoute'] = NULL;
        $data += $this->getCLS(1);

        if ($request->has('id')) {
            $data['duplicate_qoute'] = $request->duplicate_qoute ?? NULL;
            $quotation = Quotation::find($request->id);
            $data['data'] = $quotation->toArray();

            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $data['sadmin_id']   = $user->id;
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list']  = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $quotation->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['sadmin_id']   = $user->id;
                $data['users_list']  = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list']  = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
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
        $data += $this->getCLS(1);
        $data['draft_template'] = Template::where('save_as', $this->temp_status_as['Draft'])->orderBy('id', 'DESC')->first();
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

        $data['user'] = $user;
        $data['location']   = Location::select('id', 'name')->pluck('name', 'id')->toArray();

        if (isset($user->role) && $user->role == user_roles('1')) {
            $data['contracts'] = Contract::with(['location:id,code,name', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'admins.name as admin_name')
                ->orderBy('contracts.id', 'desc')
                ->where('contracts.sadmin_id', $user->id)
                ->get()
                ->toArray();
        } else if (isset($user->role) && $user->role == user_roles('2')) {
            $data['contracts'] = Contract::with(['location:id,name,code', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('contracts.admin_id', $user->id)
                ->orderBy('contracts.id', 'desc')
                ->get()
                ->toArray();
        } else {
            $data['contracts'] = Contract::with(['location:id,name,code', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'contracts.user_id')
                ->join('users as admins', 'admins.id', '=', 'contracts.admin_id')
                ->select('contracts.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('contracts.user_id', $user->id)
                ->orderBy('contracts.id', 'desc')
                ->get()
                ->toArray();
        }
        return view('contracts', $data);
    }

    public function add_contract(Request $request)
    {
        $user = auth()->user();
        $page_name = 'add_contract';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data['user'] = $user;
        $data['duplicate_contract'] = NULL;
        $data += $this->getCLS(2);

        if ($request->has('id')) {

            $data['duplicate_contract'] = $request->duplicate_contract ?? NULL;
            $contract = Contract::find($request->id);
            $data['data'] = $contract->toArray();

            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $data['sadmin_id']   = $user->id;
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $contract->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['sadmin_id']   = $user->id;
                $data['users_list'] = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
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

        $data['user']       = $user;
        $data['location']   = Location::select('id', 'name')->pluck('name', 'id')->toArray();
        $data['transData']  = Transectional::with(['user:id,name'])->where(['user_id' => $user->id, 'status' => $this->userStatus['Active']])->latest('id')->first();
        $data['transAdmins'] = [];

        if (isset($user->role) && $user->role == user_roles('1')) {
            $data['transAdmins'] = User::select('users.id', 'users.name')->join('transectionals as t', 't.user_id', '=', 'users.id')->where(['users.role' => user_roles('2'), 'users.sadmin_id' => $user->id, 'users.status' => $this->userStatus['Active']])->latest('id')->pluck('users.name', 'users.id')->toArray();

            $data['invoices'] = Invoice::with(['location:id,name,code', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('invoices.sadmin_id', $user->id)
                ->orderBy('invoices.id', 'desc')
                ->get()
                ->toArray();
        } else if (isset($user->role) && $user->role == user_roles('2')) {
            $data['invoices'] = Invoice::with(['location:id,name,code', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('invoices.admin_id', $user->id)
                ->orderBy('invoices.id', 'desc')
                ->get()
                ->toArray();
        } else {
            $data['invoices'] = Invoice::with(['location:id,name,code', 'currency:id,code,name', 'service:id,title as service_title'])
                ->join('users as u', 'u.id', '=', 'invoices.user_id')
                ->join('users as admins', 'admins.id', '=', 'invoices.admin_id')
                ->select('invoices.*', 'u.name as user_name', 'admins.name as admin_name')
                ->where('invoices.user_id', $user->id)
                ->orderBy('invoices.id', 'desc')
                ->get()
                ->toArray();
        }

        return view('invoices', $data);
    }

    public function add_invoice(Request $request)
    {
        $user = auth()->user();
        $page_name = 'add_invoice';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data['user'] = $user;
        $data += $this->getCLS(3);

        if ($request->has('id')) {
            $invoices = Invoice::find($request->id);
            $data['data'] = $invoices->toArray();
            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $data['sadmin_id']   = $user->id;
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $invoices->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                $data['sadmin_id']   = $user->sadmin_id;
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['sadmin_id']   = $user->id;
                $data['users_list']  = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                $data['sadmin_id']   = $user->sadmin_id;
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
            }
        }

        return view('add_invoice', $data);
    }

    public function get_users(Request $request)
    {
        $users_list = User::where(['role' => user_roles('3'), 'admin_id' => $request->id, 'status' => active_users()])
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return response()->json($users_list);
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
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'email' => 'required|email',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $credentials = $request->only('email', 'password');
                $user = User::where('email', $credentials['email'])->first();

                if ($user) {
                    if (in_array($user->status, auth_users())) {
                        if (isset($user->role) && $user->role == user_roles('3')) {
                            $admin = User::where(['role' => user_roles('2'), 'id' => $user->admin_id])->first();
                            if ($admin) {
                                if (!in_array($admin->status, auth_users())) {
                                    return redirect()->back()->with('error', 'You are Unauthorized to Login, Contact the admin');
                                }
                            } else {
                                return redirect()->back()->with('error', 'You are not assigned to any admin');
                            }
                        }

                        if (Auth::attempt($credentials)) {
                            auth()->login($user);  // Ensure the user is logged in
                            session(['user_details' => $user]);

                            // Create an access token
                            $token = $user->createToken('auth_token')->plainTextToken;
                            session(['access_token' => $token]); // Store the token in the session

                            return redirect()->intended('/');
                        } else {
                            return redirect()->back()->with('error', 'Invalid Credentials or Contact Admin');
                        }
                    } else if ($user->status == 4) {
                        return redirect()->back()->with('error', 'User is unverified, Please Check Your Email');
                    } else {
                        return redirect()->back()->with('error', 'You are Unauthorized to Login');
                    }
                } else {
                    return redirect()->back()->with('error', 'User does not exist');
                }
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
        try {
            $user = User::where('id', $request->id)->first();
            if ($request->status == 1) {
                $user->status    = $request->status;
                $save            = $user->save();
                if ($save) {
                    $emailData = [
                        'otp' => 'Account Activation',
                        'name' => $user->name,
                        'body' => 'Dear You Account has been activated successfully. Login and Enjoy Our Services',
                    ];
                    $mail = new otpVerifcation($emailData);

                    Mail::to($user->email)->send($mail);
                    echo 'changed';
                }
            } else {
                $user->status     = $request->status;
                $save = $user->save();
                echo 'changed';
            }
        } catch (\Exception $e) {
            // echo $e->getMessage();
            echo "Error Occur: Invalid User Email Or Id.";
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

    public function currencies(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'currencies';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $currency = NULL;
        $message  = NULL;
        Session::forget('msg');

        if ($request->action == 'edit') {
            $currency = Currency::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Currency::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name' => ucwords($request->name),
                    'code' => strtoupper($request->code),
                    'type' => $request->type,
                    'created_by' => $user->id,
                    'sadmin_id' => $user->id,
                ]
            );
            $message = "Currency " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            Currency::where('id', $request->id)->update(['status' => $this->sev_status['Deleted']]);
            $message = "Currency has been deleted Successfully";
            Session::flash('msg', $message);
        }

        $currencies = Currency::where(['sadmin_id' => $user->id, 'status' => $this->sev_status['Active']])->latest('id')->get()->toArray();
        return view('currencies', ['user' => $user, 'currency' => $currency, 'data' => $currencies, 'types' => $this->currencyTypes]);
    }

    public function locations(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'locations';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $location = NULL;
        $message  = NULL;
        Session::forget('msg');

        if ($request->action == 'edit') {
            $location = Location::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Location::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name' => ucwords($request->name),
                    'code' => strtoupper($request->code),
                    'type' => $request->type,
                    'sadmin_id' => $user->id,
                    'created_by' => $user->id,
                ]
            );
            $message = "Location " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            $deleted = Location::where('id', $request->id)->update(['status' => $this->sev_status['Deleted']]);
            $message = "Location has been deleted Successfully";
            Session::flash('msg', $message);
        }

        $locations = Location::where(['sadmin_id' => $user->id, 'status' => $this->sev_status['Active']])->latest('id')->get()->toArray();
        $data = ['user' => $user, 'location' => $location, 'data' => $locations, 'types' => $this->locationType];
        return view('locations', $data);
    }
    public function services(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'services';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $service = NULL;
        $message  = NULL;
        Session::forget('msg');

        if ($request->action == 'edit') {
            $service = Service::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Service::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'title' => ucwords($request->title),
                    'type' => $request->type,
                    'sadmin_id' => $user->id,
                    'created_by' => $user->id,
                ]
            );
            $message = "Service " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            $deleted = Service::where('id', $request->id)->update(['status' => $this->sev_status['Deleted']]);
            $message = "Service has been deleted Successfully";
            Session::flash('msg', $message);
        }

        $services = Service::where(['sadmin_id' => $user->id, 'status' => $this->sev_status['Active']])->latest('id')->get()->toArray();
        $data = ['user' => $user, 'service' => $service, 'data' => $services, 'types' => $this->sev_type];
        return view('services', $data);
    }

    public function revenue(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'revenue';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $data = Invoice::join('currencies as cur', 'invoices.currency_id', '=', 'cur.id')
            ->where('invoices.status', $this->status['Completed'])
            ->where('cur.sadmin_id', $user->id)
            ->groupBy('cur.id', 'cur.code', 'cur.name', 'cur.type')
            ->select(
                DB::raw('SUM(invoices.amount) as total_amount'),
                'cur.id',
                'cur.name',
                'cur.code',
                'cur.type'
            )
            ->get()
            ->toArray();
        return view('revenue', ['user' => $user, 'data' => $data]);
    }

    public function transactionals(REQUEST $request)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $page_name = 'transactional';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        Session::forget('msg');
        $data['transectional'] = NULL;
        $message  = NULL;

        if ($user->role == user_roles('1')) {

            if ($request->action == 'edit' && $request->id) {
                $data['transectional'] = Transectional::where(['id' => $request->id])->first();
            } else if ($request->action == 'dell') {
                Transectional::where('id', $request->id)->update(['status' => $this->sev_status['Deleted']]);
                $message = "Transectional has been deleted Successfully";
                Session::flash('msg', $message);
            }


            $data['admins'] = User::select('id', 'name')->where(['role' => user_roles('2'), 'sadmin_id' => $user->id, 'status' => $this->userStatus['Active']])->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
            $data['data']   = Transectional::with(['user:id,name'])->where(['created_by' => $user->id, 'status' => $this->sev_status['Active']])->latest('id')->get()->toArray();
        }
        return view('transactional', $data);
    }

    public function demomail(REQUEST $request)
    {

        try {
            $transport_factory = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransportFactory;
            $transport = $transport_factory->create(new \Symfony\Component\Mailer\Transport\Dsn(
                'smtp',
                'mail.tspsolution.com',
                'support@tspsolution.com',
                'wy)w]Qj,PfOH',
                '465',
            ));
            $mailer = new \Symfony\Component\Mailer\Mailer($transport);
            $email = (new \Symfony\Component\Mime\Email())
                ->from('support@tspsolution.com')
                ->to('alihumdard125@gmail.com')
                ->subject('Test Email')
                ->text("Email Test was Successful")
                ->html("<h1> testing working </h1>");
            $mailer->send($email);
        } catch (\Symfony\Component\Mailer\Exception\TransportException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function getCLS($type)
    {
        $user = auth()->user();
        $id = ($user->role == user_roles('1')) ? $user->id : $user->sadmin_id;
        $data['currencies'] = Currency::select('id', 'name')->where(['status' => $this->sev_status['Active'], 'sadmin_id' => $id])->pluck('name', 'id')->toArray();
        $data['location']   = Location::select('id', 'name')->where(['status' => $this->sev_status['Active'], 'sadmin_id' => $id])->pluck('name', 'id')->toArray();
        $data['services']   = Service::select('id', 'title')->where(['status' => $this->sev_status['Active'], 'type' => $this->sev_type[$type], 'sadmin_id' => $id])->pluck('title', 'id')->toArray();
        return $data;
    }

    public function re_subscription(REQUEST $request)
    {

        $user = auth()->user();
        $page_name = 're-subscription';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), ['id' => 'required']);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $user =  User::find($request->id);
        $user->sub_exp_date   = Carbon::now()->addDays(30);
        $save = $user->save();

        if ($save) {
            return redirect()->back();
        }
    }
}
