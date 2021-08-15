<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\AdminLog;
use App\Models\AdminLogsPermission;
use App\Models\UserPackage;
use App\Models\ReportAccount;
use App\Models\Product;
use App\Models\Complaint;
use App\Models\Review;
use App\Models\UserFollowerFollowing;
use App\Models\NotificationsSetting;
use App\Models\Booking;
use App\Models\Order;
use Hash;
use Validator;
use Redirect;
use Auth;
use Storage;
use Illuminate\Http\File;
use DB;
use URL;
use Route;

class UserController extends Controller
{
    // list all users
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->where('user_type', 1)->where('is_deleted', 0)->paginate(10);
        $countries = Country::all();
        return view('admin.users.list', ['users' => $users, 'title' => 'Users', 'countries' => $countries]);
    }

    public function deleteIndex()
    {
        $users = User::orderBy('id', 'DESC')->where('user_type', 1)->where('is_deleted', 1)->paginate(10);
        $countries = Country::all();
        return view('admin.users.deleteList', ['users' => $users, 'title' => 'Users', 'countries' => $countries]);

    }

    // show create user page
    public function create()
    {
        $countries = Country::all();
        $states = State::where('status', 1)->get();
        return view('admin.users.create', ['countries' => $countries, 'states' => $states]);
    }

    // store user
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $rules = [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:150|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'contact_no' => 'required|unique:users',
            'gender' => 'required|string|max:10',
            'status' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ];

        if (!empty($request->get('dob'))) {
            $rules['dob'] = 'required|date';
        }

        if (!empty($request->get('about_info'))) {
            $rules['about_info'] = 'required|string|max:5000';
        }

        if (!empty($request->get('address_line_1'))) {
            $rules['address_line_1'] = 'required|string|max:191';
        }

        if (!empty($request->get('address_line_2'))) {
            $rules['address_line_2'] = 'required|string|max:191';
        }

        if (!empty($request->get('zip_code'))) {
            $rules['zip_code'] = 'required|numeric';
        }

        if ($request->hasFile('image_url')) {
            $rules['image_url'] = 'image|mimes:jpeg,png,jpg';
        }

        if ($request->hasFile('cover_photo_url')) {
            $rules['cover_photo_url'] = 'image|mimes:jpeg,png,jpg';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $states = State::select('id', 'name')->where('country_id', $request->country)->where('status', 1)->get();
            $cities = City::select('id', 'name')->where('country_id', $request->country)->where('state_id', $request->state)->where('status', 1)->get();
            $data = [];
            $data['states'] = $states;
            $data['cities'] = $cities;

            return redirect()->back()->with('data', $data)->withErrors($validator)->withInput();
        }

        $country = Country::find($request->country);
        $state = State::find($request->state);
        $city = City::find($request->city);

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_no' => $request->contact_no,
            'gender' => $request->gender,
            'country_id' => $country->id,
            'country_name' => $country->name,
            'state_id' => $state->id,
            'state_name' => $state->name,
            'city_id' => $city->id,
            'city_name' => $city->name,
            'status' => $request->status,
            'user_type' => 1,
            'is_approved' => 1,
        ];

        if (!empty($request->get('dob'))) {
            $userData['dob'] = date('Y-m-d', strtotime($request->dob));

        }

        if (!empty($request->get('about_info'))) {
            $userData['about_info'] = $request->about_info;
        }

        if (!empty($request->get('address_line_1'))) {
            $userData['address_line_1'] = $request->address_line_1;
        }

        if (!empty($request->get('address_line_2'))) {
            $userData['address_line_2'] = $request->address_line_2;
        }

        if (!empty($request->get('zip_code'))) {
            $userData['zip_code'] = $request->zip_code;
        }

        $user = User::create($userData);

        if ($request->hasFile('image_url')) {
            $userProfileImageDirectory = 'userProfileImages';

            if (!Storage::exists($userProfileImageDirectory)) {
                Storage::makeDirectory($userProfileImageDirectory);
            }

            $userProfileImageUrl = Storage::putFile($userProfileImageDirectory, new File($request->file('image_url')));
            $user->update(['image_url' => $userProfileImageUrl]);
        }

        if ($request->hasFile('cover_photo_url')) {
            $userCoverPhotoDirectory = 'userCoverPhotos';

            if (!Storage::exists($userCoverPhotoDirectory)) {
                Storage::makeDirectory($userCoverPhotoDirectory);
            }

            $userCoverPhotoUrl = Storage::putFile($userCoverPhotoDirectory, new File($request->file('cover_photo_url')));
            $user->update(['cover_photo_url' => $userCoverPhotoUrl]);
        }

        $notificationCreate = NotificationsSetting::create([
            'user_id' => $user->id,
        ]);
        $adminLogsPermission = AdminLogsPermission::where('admin_id', $admin->id)->where('module_id', 17)->count();

        if ($adminLogsPermission == 1) {
            AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Created > ' . $admin->name . ' has created a user with email ' . $user->email . ' having id ' . $user->id]);
        }

        return redirect()->route('listUsers')->with('success', 'User Created Successfully.');
    }

    // show edit user page
    public function edit($id)
    {
        $user = User::where('id', $id)->where('user_type', 1)->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'Invalid user id.');
        }
        $countries = Country::all();
        $states = State::where('country_id', $user->country_id)->where('status', 1)->get();
        $cities = City::where('state_id', $user->state_id)->where('status', 1)->get();

        return view('admin.users.edit', ['user' => $user, 'countries' => $countries, 'states' => $states, 'cities' => $cities]);
    }

    // update user
    public function update(Request $request)
    {

        $user = User::find($request->user_id);

        $rules = [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'gender' => 'required|string|max:10',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ];

        if (!empty($request->password) && !empty($request->password_confirmation)) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        if ($request->contact_no == $user->contact_no) {
            $rules['contact_no'] = 'required';
        } else {
            $rules['contact_no'] = 'required|unique:users';
        }

        if (!empty($request->get('dob'))) {
            $rules['dob'] = 'required|date';
        }

        if (!empty($request->get('about_info'))) {
            $rules['about_info'] = 'required|string|max:5000';
        }

        if (!empty($request->get('address_line_1'))) {
            $rules['address_line_1'] = 'required|string|max:191';
        }

        if (!empty($request->get('address_line_2'))) {
            $rules['address_line_2'] = 'required|string|max:191';
        }

        if (!empty($request->get('zip_code'))) {
            $rules['zip_code'] = 'required|numeric';
        }

        if ($request->hasFile('image_url')) {
            $rules['image_url'] = 'image|mimes:jpeg,png,jpg';
        }

        if ($request->hasFile('cover_photo_url')) {
            $rules['cover_photo_url'] = 'image|mimes:jpeg,png,jpg';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $states = State::select('id', 'name')->where('country_id', $request->country)->where('status', 1)->get();
            $cities = City::select('id', 'name')->where('country_id', $request->country)->where('state_id', $request->state)->where('status', 1)->get();
            $data = [];
            $data['states'] = $states;
            $data['cities'] = $cities;

            return Redirect::back()->with('data', $data)->withErrors($validator)->withInput($request->all());
        }
        $admin = Auth::guard('admin')->user();
        $activity = 'User Updated > ' . $admin->name . ' has updated the user with email ' . $user->email . ' having id ' . $user->id;
        $userData = [];

        if (isset($request->first_name) && ($request->first_name != $user->first_name)) {
            $userData['first_name'] = $request->first_name;
            $activity = $activity . ' first name from "' . $user->first_name . '" => "' . $request->first_name . '" ';
        }

        if (isset($request->last_name) && ($request->last_name != $user->last_name)) {
            $userData['last_name'] = $request->last_name;
            $activity = $activity . ' last name from "' . $user->last_name . '" => "' . $request->last_name . '" ';
        }

        if (!empty($request->password) && !empty($request->password_confirmation)) {
            $userData['password'] = Hash::make($request->password);
        }

        if (isset($request->contact_no) && ($request->contact_no != $user->contact_no)) {
            $userData['contact_no'] = $request->contact_no;
            $activity = $activity . ' contact no from "' . $user->contact_no . '" => "' . $request->contact_no . '" ';
        }

        if (isset($request->gender) && ($request->gender != $user->gender)) {
            $userData['gender'] = $request->gender;
            $activity = $activity . ' gender from "' . $user->gender . '" => "' . $request->gender . '" ';
        }

        if (isset($request->dob)) {
            $requestDOB = date('Y-m-d', strtotime($request->dob));
        } else {
            $requestDOB = null;
        }

        if (isset($user->dob)) {
            $userDOB = date('Y-m-d', strtotime($user->dob));
        } else {

            $userDOB = null;
        }

        if (isset($requestDOB) && ($requestDOB != $userDOB)) {
            $userData['dob'] = $requestDOB;
            $activity = $activity . ' date of birth from "' . $userDOB . '" => "' . $requestDOB . '" ';
        } elseif (!isset($request->dob)) {
            $userData['dob'] = null;
            if (isset($userDOB)) {
                $activity = $activity . ' date of birth from "' . $userDOB . '" => "' . $requestDOB . '" ';
            }
        }

        if (isset($request->status) && ($request->status != $user->status)) {
            $userData['status'] = $request->status;
            $oldStatus = ($user->status == 1) ? 'active' : 'suspended';
            $newStatus = ($request->status == 1) ? 'active' : 'suspended';
            $activity = $activity . ' account status from "' . $oldStatus . '" => "' . $newStatus . '" ';
        }

        if (isset($request->country) && ($user->country_id != $request->country)) {
            $country = Country::find($request->country);

            $userData ['country_id'] = $country->id;
            $userData ['country_name'] = $country->name;
            $activity = $activity . ' country from "' . $user->country_name . '" => "' . $country->name . '" ';
        }

        if (isset($request->state) && ($user->state_id != $request->state)) {
            $state = State::find($request->state);

            $userData ['state_id'] = $state->id;
            $userData ['state_name'] = $state->name;
            $activity = $activity . ' state from "' . $user->state_name . '" => "' . $state->name . '" ';
        }

        if (isset($request->city) && ($user->city_id != $request->city)) {
            $city = City::find($request->city);

            $userData ['city_id'] = $city->id;
            $userData ['city_name'] = $city->name;
            $activity = $activity . ' city from "' . $user->city_name . '" => "' . $city->name . '" ';
        }

        if (isset($request->zip_code) && ($request->zip_code != $user->zip_code)) {
            $userData['zip_code'] = $request->zip_code;
            $activity = $activity . ' zip code from "' . $user->zip_code . '" => "' . $request->zip_code . '" ';
        } elseif (!isset($request->zip_code)) {
            $userData['zip_code'] = null;
            if (isset($user->zip_code)) {
                $activity = $activity . ' zip code from "' . $user->zip_code . '" => "' . $request->zip_code . '" ';
            }
        }

        if (isset($request->address_line_1) && ($request->address_line_1 != $user->address_line_1)) {
            $userData['address_line_1'] = $request->address_line_1;
            $activity = $activity . ' address line 1 from "' . $user->address_line_1 . '" => "' . $request->address_line_1 . '" ';
        } elseif (!isset($request->address_line_1)) {
            $userData['address_line_1'] = null;
            if (isset($user->address_line_1)) {
                $activity = $activity . ' address line 1 from "' . $user->address_line_1 . '" => "' . $request->address_line_1 . '" ';
            }
        }

        if (isset($request->address_line_2) && ($request->address_line_2 != $user->address_line_2)) {
            $userData['address_line_2'] = $request->address_line_2;
            $activity = $activity . ' address line 2 from "' . $user->address_line_2 . '" => "' . $request->address_line_2 . '" ';
        } elseif (!isset($request->address_line_2)) {
            $userData['address_line_2'] = null;
            if (isset($user->address_line_2)) {
                $activity = $activity . ' address line 2 from "' . $user->address_line_2 . '" => "' . $request->address_line_2 . '" ';
            }
        }

        if (isset($request->about_info) && ($request->about_info != $user->about_info)) {
            $userData['about_info'] = $request->about_info;
            $activity = $activity . ' bio / description from "' . $user->about_info . '" => "' . $request->about_info . '" ';
        } elseif (!isset($request->about_info)) {
            $userData['about_info'] = null;
            if (isset($user->about_info)) {
                $activity = $activity . ' bio / description from "' . $user->about_info . '" => "' . $request->about_info . '" ';
            }
        }

        if ($request->hasFile('image_url')) {
            $userProfileImageDirectory = 'userProfileImages';

            if (!Storage::exists($userProfileImageDirectory)) {
                Storage::makeDirectory($userProfileImageDirectory);
            }

            if (isset($user->image_url)) {
                Storage::delete('/' . $user->image_url);
            }

            $userProfileImageUrl = Storage::putFile($userProfileImageDirectory, new File($request->file('image_url')));
            $activity = $activity . ' profile image from "' . $user->image_url . '" => "' . $userProfileImageUrl . '" ';
            $user->update(['image_url' => $userProfileImageUrl]);
        }

        if ($request->hasFile('cover_photo_url')) {
            $userCoverPhotoDirectory = 'userCoverPhotos';

            if (!Storage::exists($userCoverPhotoDirectory)) {
                Storage::makeDirectory($userCoverPhotoDirectory);
            }

            if (isset($user->cover_photo_url)) {
                Storage::delete('/' . $user->cover_photo_url);
            }

            $userCoverPhotoUrl = Storage::putFile($userCoverPhotoDirectory, new File($request->file('cover_photo_url')));
            $activity = $activity . ' cover photo from "' . $user->cover_photo_url . '" => "' . $userCoverPhotoUrl . '" ';
            $user->update(['cover_photo_url' => $userCoverPhotoUrl]);
        }


        $user->update($userData);

        $supportUser = User::where('email', 'support@luxup.com')->first();

        if($supportUser == null) {
            $supportUser = User::create([
                'email' => 'support@luxup.com',
                'first_name' => 'Support',
                'last_name' => 'Luxup',
                'type' => 1,
            ]);
        }

        $fire = new FirebaseService();
        $updateInbox = $fire->updateUserNameImage($user,$supportUser);

        $adminLogsPermission = AdminLogsPermission::where('admin_id', $admin->id)->where('module_id', 17)->count();

        if ($adminLogsPermission == 1) {
            AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => $activity]);
        }

        return redirect()->route('listUsers')->with('success', 'User Updated Successfully.');
    }

    // show user detail page
    public function detail($id)
    {
        $user = User::where('id', $id)->where('user_type', 1)->first();
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        return view('admin.users.detail', ['user' => $user]);
    }

    // get pagination of users with filters
    public function fetchUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('user_type', 1);
            $userIds = [];

            if ($request->has('keyword') && !empty($request->get('keyword'))) {
                $userIds = User::select('id')->where('first_name', 'like', '%' . $request->keyword . '%')->where('last_name', 'like', '%' . $request->keyword . '%')->pluck('id')->toArray();
                $users = $users->whereIn('id', $userIds);
            }

            if ($request->has('country') && $request->get('country') !== null) {
                $users = $users->where('country_id', $request->country);
            }

            if ($request->has('state') && $request->get('state') !== null) {
                $users = $users->where('state_id', $request->state);
            }

            if ($request->has('city') && $request->get('city') !== null) {
                $users = $users->where('city_id', $request->city);
            }

            if ($request->has('verified') && $request->get('verified') !== null) {
                $users = $users->where('status', $request->verified);
            }

            if ($request->has('is_approved') && $request->get('is_approved') !== null) {
                $users = $users->where('is_approved', $request->is_approved);
            }

            if ($request->has('last_login') && $request->last_login == "0") {
                $users = $users->where('last_login', Null);
            }

            if ($request->has('last_sign_in') && $request->get('last_sign_in') !== null) {
                $orgDate = $request->last_sign_in;
                $newDate = date("Y-m-d", strtotime($orgDate));
                $users = $users->whereDate('last_login', '=', $newDate);
            }

            if($request->urlChunk == "delete"){
                $users = $users->where('is_deleted', 1)->orderBy('id', 'DESC')->paginate(10)->appends(request()->query());
                return view('admin.users.deleteTable', ['users' => $users])->render();
            }else{
                $users = $users->where('is_deleted', 0)->orderBy('id', 'DESC')->paginate(10)->appends(request()->query());
                return view('admin.users.table', ['users' => $users])->render();
            }

        }
    }

    // Change User Activate / Suspend
    public function suspendUser(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $user = User::where('id', $request->user_id)->where('is_deleted', 0)->first();
        if ($user == null) {
            return response()->json(['status' => 0, 'message' => 'No Record Found.']);
        }

        $user->update(['status' => $request->status]);

        $adminLogsPermission = AdminLogsPermission::where('admin_id', $admin->id)->where('module_id', 17)->count();

        if ($adminLogsPermission == 1) {
            if ($request->status == 0) {
                AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Suspended > ' . $admin->name . ' has suspended account of a user with email ' . $user->email . ' having id ' . $user->id]);

            } else {
                AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Activated > ' . $admin->name . ' has activated account of a user with email ' . $user->email . ' having id ' . $user->id]);
            }
        }

        return response()->json(['status' => 1, 'message' => 'User Status Updated Successfully.']);
    }

    // Change User Approve / Disapprove
    public function changeUserApprove(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $user = User::where('id', $request->user_id)->first();
        if ($user == null) {
            return response()->json(['status' => 0, 'message' => 'No Record Found.']);
        }

        $user->update(['is_approved' => $request->is_approved]);

        $adminLogsPermission = AdminLogsPermission::where('admin_id', $admin->id)->where('module_id', 17)->count();

        if ($adminLogsPermission == 1) {
            if ($request->is_approved == 0) {
                AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Disapproved > ' . $admin->name . ' has disapproved account of a user with email ' . $user->email . ' having id ' . $user->id]);

            } else {
                AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Approved > ' . $admin->name . ' has approved account of a user with email ' . $user->email . ' having id ' . $user->id]);
            }
        }

        return response()->json(['status' => 1, 'message' => 'Status updated successfully.']);
    }

    // User Soft Delete
    public function deleteUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->where('is_deleted', 0)->first();
        if ($user == null) {
            return response()->json(['status' => 0, 'message' => 'No Record Found.']);
        }

        $user->update(['is_deleted' => 1]);
        $admin = Auth::guard('admin')->user();

        $adminLogsPermission = AdminLogsPermission::where('admin_id', $admin->id)->where('module_id', 17)->count();

        if ($adminLogsPermission == 1) {
            AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Deleted > ' . $admin->name . ' has deleted a user with email ' . $user->email . ' having id ' . $user->id]);
        }

        return response()->json(['status' => 1, 'message' => 'User Deleted Successfully.']);
    }

    public function restoreUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->where('is_deleted', 1)->first();
        if ($user == null) {
            return response()->json(['status' => 0, 'message' => 'No Record Found.']);

        }

        $user->update(['is_deleted' => 0]);
        $admin = Auth::guard('admin')->user();

        $adminLogsPermission = AdminLogsPermission::where('admin_id', $admin->id)->where('module_id', 17)->count();

        if ($adminLogsPermission == 1) {
            AdminLog::create(['admin_id' => $admin->id, 'type' => 'Registered Users', 'activity' => 'User Deleted > ' . $admin->name . ' has deleted a user with email ' . $user->email . ' having id ' . $user->id]);
        }

        return response()->json(['status' => 1, 'message' => 'User Restore Successfully.']);
    }

    // list all reports of against a user
    public function reportUserAccount($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $reportAccounts = ReportAccount::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10);
        $supportAccount = User::where('email', 'support@luxup.com')->first();
        return view('admin.users.reportAccount', ['reportAccounts' => $reportAccounts, 'title' => 'Report Account', 'supportAccount' => $supportAccount]);
    }

    // list all packages against a user
    public function userPackagesList($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $userPackages = UserPackage::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.listPackages', ['userPackages' => $userPackages, 'title' => 'User Packages']);
    }

    // list products against a user
    public function userProductsList($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $userProducts = Product::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.listProducts', ['userProducts' => $userProducts, 'title' => 'User Products']);
    }

    // list booking against a user
    public function userBookingsList($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $productIds = Order::select('product_id')->where('rentee_id', $user->id)->pluck('product_id')->toArray();
        // $productIds = Booking::select('product_id')->where('rentee_id', $user->id)->pluck('product_id')->toArray();
        $userProducts = Product::whereIn('id', $productIds)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.listBookingProducts', ['userProducts' => $userProducts, 'title' => 'User Products']);
    }

    // list complaints against a user
    public function userComplaintsList($id)
    {
        // $user = User::find($id);
        // if ($user == null) {
        //     return redirect()->back()->with('error', 'No Record Found.');
        // }

        // $userComplaints = Complaint::where('complaint_for', $user->id)->orderBy('id', 'DESC')->paginate(10);
        // return view('admin.users.listComplaints', ['userComplaints' => $userComplaints, 'title' => 'User Complaints']);

        if (Auth::guard('admin')->user()->email == 'admin@luxup.com') {
            $complaints = Complaint::select('id', 'ticket_id', 'complaint_by', 'complaint_for', 'reason', 'product_id', 'booking_id', 'assigned_to', 'assigned_by', 'status', 'status_by_user', 'created_at')->where('is_deleted', 0)->orderBy('id', 'DESC')->with('complaintImages')->paginate(10);
        } else {
            $complaints = Complaint::select('id', 'ticket_id', 'complaint_by', 'complaint_for', 'reason', 'product_id', 'booking_id', 'assigned_to', 'assigned_by', 'status', 'status_by_user', 'created_at')->where('assigned_to', Auth::guard('admin')->user()->id)->where('is_deleted', 0)->orderBy('id', 'DESC')->with('complaintImages')->paginate(10);
        }

        return view('admin.complaint.list', ['complaints' => $complaints, 'title' => 'User Complaints']);
    }

    // list reviews against a user
    public function userReviewsList($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $userReviews = Review::where('renter_id', $user->id)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.listReviews', ['userReviews' => $userReviews, 'title' => 'User Reviews']);
    }

    // list followers of a user
    public function userFollowersList($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $userFollowers = UserFollowerFollowing::where('following_id', $user->id)->whereNotNull('follower_id')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.listFollowers', ['userFollowers' => $userFollowers, 'title' => 'User Followers']);
    }

    // list followings of a user
    public function userFollowingsList($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $userFollowings = UserFollowerFollowing::where('follower_id', $user->id)->whereNotNull('following_id')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.listFollowings', ['userFollowings' => $userFollowings, 'title' => 'User Followings']);
    }

    // get pagination of users with filters
    public function userFilters(Request $request)
    {
        if ($request->ajax()) {

            switch ($request->filter) {
                case 'hlproduct':
                    $users = User::select(DB::raw('users.*, count(products.id) as products_count'))
                        ->join('products', 'users.id', 'products.user_id')
                        ->groupBy('products.user_id')
                        ->orderBy('products_count', 'DESC')
                        ->paginate(10);

                    return view('admin.users.table', ['users' => $users])->render();

                    break;

                case 'lhproduct':
                    $users = User::select(DB::raw('users.*, count(products.id) as products_count'))
                        ->join('products', 'users.id', 'products.user_id')
                        ->groupBy('products.user_id')
                        ->orderBy('products_count', 'ASC')
                        ->paginate(10);

                    return view('admin.users.table', ['users' => $users])->render();
                    break;

                case 'hlrevenue':
                    $users = User::select(DB::raw('users.*, sum(payments.revenue) as user_revenue'))
                        ->join('payments', 'users.id', 'payments.user_id')
                        ->groupBy('payments.user_id')
                        ->orderBy('user_revenue', 'DESC')
                        ->paginate(10);

                    return view('admin.users.table', ['users' => $users])->render();

                case 'lhrevenue':
                    $users = User::select(DB::raw('users.*, sum(payments.revenue) as user_revenue'))
                        ->join('payments', 'users.id', 'payments.user_id')
                        ->groupBy('payments.user_id')
                        ->orderBy('user_revenue', 'ASC')
                        ->paginate(10);

                    return view('admin.users.table', ['users' => $users])->render();

                case 'hlcommission':
                    $users = User::select(DB::raw('users.*, sum(payments.commission) as user_commission'))
                        ->join('payments', 'users.id', 'payments.user_id')
                        ->groupBy('payments.user_id')
                        ->orderBy('user_commission', 'DESC')
                        ->paginate(10);

                    return view('admin.users.table', ['users' => $users])->render();

                case 'lhcommission':
                    $users = User::select(DB::raw('users.*, sum(payments.commission) as user_commission'))
                        ->join('payments', 'users.id', 'payments.user_id')
                        ->groupBy('payments.user_id')
                        ->orderBy('user_commission', 'ASC')
                        ->paginate(10);

                    return view('admin.users.table', ['users' => $users])->render();
                default:
                    # code...
                    break;
            }
            if ($request->has('keyword') && !empty($request->get('keyword'))) {
                $userIds = User::select('id')->where('name', 'like', '%' . $request->keyword . '%')->pluck('id')->toArray();
                $users = $users->whereIn('id', $userIds);
            }

            if ($request->has('country') && $request->get('country') !== null) {
                $users = $users->where('country_id', $request->country);
            }

            if ($request->has('state') && $request->get('state') !== null) {
                $users = $users->where('state_id', $request->state);
            }

            if ($request->has('city') && $request->get('city') !== null) {
                $users = $users->where('city_id', $request->city);
            }

            if ($request->has('verified') && $request->get('verified') !== null) {
                $users = $users->where('status', $request->verified);
            }

            if ($request->has('is_approved') && $request->get('is_approved') !== null) {
                $users = $users->where('is_approved', $request->is_approved);
            }

            if ($request->has('last_login') && $request->last_login == "0") {
                $users = $users->where('last_login', Null);
            }

            if ($request->has('last_sign_in') && $request->get('last_sign_in') !== null) {
                $orgDate = $request->last_sign_in;
                $newDate = date("Y-m-d", strtotime($orgDate));
                $users = $users->whereDate('last_login', '=', $newDate);
            }


            $users = $users->where('is_deleted', 0)->orderBy('id', 'DESC')->paginate(10)->appends(request()->query());

            return view('admin.users.table', ['users' => $users])->render();
        }
    }
}
