<?php

namespace App\Http\Controllers\Company;

use App\Models\Job;
use App\Models\Order;
use App\Models\Company;
use App\Models\JobType;
use App\Models\Package;
use App\Models\JobGender;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\CompanyPhoto;
use App\Models\CompanySize; 
use App\Models\CompanyVideo;
use Illuminate\Http\Request;
use App\Models\JobExperience;
use App\Models\JobSalaryRange;
use App\Models\CompanyLocation;
use App\Models\CompanyIndustry; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule as ValidationRule;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('company.dashboard');
    }
    public function make_payment()
    {
        $current_plan = Order::with('Package')->where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $packages = Package::get();
        return view('company.make-payment', compact('current_plan','packages'));
    }

    public function orders()
    {
        $orders = Order::with('Package')->orderBy('id', 'desc')->where('company_id',Auth::guard('company')->user()->id)->get();
        return view('company.orders', compact('orders'));
    }

    public function edit_profile()
    {
        $company_locations = CompanyLocation::orderBy('name', 'asc')->get();
        $company_industries = CompanyIndustry::orderBy('name', 'asc')->get();
        $company_sizes = CompanySize::get();
        return view('company.edit-profile', compact('company_locations','company_industries','company_sizes'));
    }

    public function edit_profile_update(Request $request)
    {
        $obj = Company::where('id',Auth::guard('company')->user()->id)->first();
        $id = $obj->id;

        $request->validate([
            'company_name' => 'required',
            'person_name' => 'required',
            'username' => ['required','alpha_dash',ValidationRule::unique('companies')->ignore($id)],
            'email' => ['required','email',ValidationRule::unique('companies')->ignore($id)],
        ]);

        if($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            if(Auth::guard('company')->user()->logo != '') {
                unlink(public_path('uploads/'.$obj->logo));
            }

            $ext = $request->file('logo')->extension();
            $final_name = 'company_logo_'.time().'.'.$ext;

            $request->file('logo')->move(public_path('uploads/'),$final_name);

            $obj->logo = $final_name;
        }

        $obj->company_name = $request->company_name;
        $obj->person_name = $request->person_name;
        $obj->username = $request->username;
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->address = $request->address;
        $obj->company_location_id = $request->company_location_id;
        $obj->company_industry_id = $request->company_industry_id;
        $obj->company_size_id = $request->company_size_id;
        $obj->founded_on = $request->founded_on;
        $obj->website = $request->website;
        $obj->description = $request->description;
        $obj->oh_mon = $request->oh_mon;
        $obj->oh_tue = $request->oh_tue;
        $obj->oh_wed = $request->oh_wed;
        $obj->oh_thu = $request->oh_thu;
        $obj->oh_fri = $request->oh_fri;
        $obj->oh_sat = $request->oh_sat;
        $obj->oh_sun = $request->oh_sun;
        $obj->map_code = $request->map_code;
        $obj->facebook = $request->facebook;
        $obj->twitter = $request->twitter;
        $obj->linkedin = $request->linkedin;
        $obj->instagram = $request->instagram;
        $obj->update();

        return redirect()->back()->with('success', 'Profile is updated successfully.');

    }

    public function edit_password()
    {
        return view('company.edit-password');
    }

    public function edit_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ]);

        $obj = Company::where('id',Auth::guard('company')->user()->id)->first();
        $obj->password = Hash::make($request->password);
        $obj->update();

        return redirect()->back()->with('success', 'Password is updated successfully.');
    }

    public function paypal(Request $request)
    {
        $single_package_data = Package::where('id',$request->package_id)->first();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('company_paypal_success'),
                "cancel_url" => route('company_paypal_cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $single_package_data->package_price
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id']!=null) {
            foreach($response['links'] as $link) {
                if($link['rel'] === 'approve') {

                    session()->put('package_id', $single_package_data->id);
                    session()->put('package_price', $single_package_data->package_price);
                    session()->put('package_days', $single_package_data->package_days);

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('company_paypal_cancel');
        }
    }

    public function photos()
    {
        // Check if a person buy a package
        $order_data = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();

        if(!$order_data) {
            return redirect()->back()->with('error', 'You must have to buy a package first to access this page');
        }

        // Check if a person has access to this page under the current package
        $package_data = Package::where('id',$order_data->package_id)->first();

        if($package_data->total_allowed_photos == 0) {
            return redirect()->back()->with('error', 'Your current package does not allow to access the photo section');
        }

        $photos = CompanyPhoto::where('company_id',Auth::guard('company')->user()->id)->get();
        return view('company.photos', compact('photos'));
    }

    public function photos_submit(Request $request)
    {
        $order_data = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $package_data = Package::where('id',$order_data->package_id)->first();
        $existing_photo_number = CompanyPhoto::where('company_id',Auth::guard('company')->user()->id)->count();

        if($package_data->total_allowed_photos == $existing_photo_number) {
            return redirect()->back()->with('error', 'Maximum number of allowed photos are uploaded. So you have to upgrade your package if you want to add more photos.');
        }

        if(date('Y-m-d') > $order_data->expire_date) {
            return redirect()->back()->with('error', 'Your package is expired!');
        }

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $obj = new CompanyPhoto();

        $ext = $request->file('photo')->extension();
        $final_name = 'company_photo_'.time().'.'.$ext;
        $request->file('photo')->move(public_path('forntend/uploads/'),$final_name);

        $obj->photo = $final_name;
        $obj->company_id = Auth::guard('company')->user()->id;
        $obj->save();

        return redirect()->back()->with('success', 'Photo is uploaded successfully.');
    }

    public function photos_delete($id)
    {
        $single_data = CompanyPhoto::where('id',$id)->first();
        unlink(public_path('forntend/uploads/'.$single_data->photo));
        CompanyPhoto::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Photo is deleted successfully.');
    }


    public function videos()
    {
        // Check if a person buy a package
        $order_data = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();

        if(!$order_data) {
            return redirect()->back()->with('error', 'You must have to buy a package first to access this page');
        }

        // Check if a person has access to this page under the current package
        $package_data = Package::where('id',$order_data->package_id)->first();
        if($package_data->total_allowed_videos == 0) {
            return redirect()->back()->with('error', 'Your current package does not allow to access the video section');
        }

        $videos = CompanyVideo::where('company_id',Auth::guard('company')->user()->id)->get();
        return view('company.videos', compact('videos'));
    }

    public function videos_submit(Request $request)
    {
        $order_data = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $package_data = Package::where('id',$order_data->package_id)->first();
        $existing_video_number = CompanyVideo::where('company_id',Auth::guard('company')->user()->id)->count();

        if($package_data->total_allowed_videos == $existing_video_number) {
            return redirect()->back()->with('error', 'Maximum number of allowed videos are uploaded. So you have to upgrade your package if you want to add more videos.');
        }

        if(date('Y-m-d') > $order_data->expire_date) {
            return redirect()->back()->with('error', 'Your package is expired!');
        }

        $request->validate([
            'video_id' => 'required'
        ]);

        $obj = new CompanyVideo();
        $obj->company_id = Auth::guard('company')->user()->id;
        $obj->video_id = $request->video_id;
        $obj->save();

        return redirect()->back()->with('success', 'Video is uploaded successfully.');
    }

    public function videos_delete($id)
    {
        CompanyVideo::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Video is deleted successfully.');
    }

    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && $response['status'] == 'COMPLETED') {

            $data['currently_active'] = 0;
            Order::where('company_id', Auth::guard()->user()->id)->update($data);

            $obj = new Order();
            $obj->company_id = Auth::guard()->user()->id;
            $obj->package_id = session()->get('package_id');
            $obj->order_no = time();
            $obj->paid_amount = session()->get('package_price');
            $obj->payment_method = 'PayPal';
            $obj->start_date = date('Y-m-d');
            $days = session()->get('package_days');
            $obj->expire_date = date('Y-m-d', strtotime("+$days days"));
            $obj->currently_active = 1;
            $obj->save();

            session()->forget('package_id');
            session()->forget('package_price');
            session()->forget('package_days');

            return redirect()->route('company_make_payment')->with('success', 'Payment is successful!');
        } else {
            return redirect()->route('company_paypal_cancel');
        }
    }

    public function paypal_cancel()
    {
        return redirect()->route('company_make_payment')->with('error', 'Payment is cancelled!');
    }


    // Company Job Create 
    public function jobs_create()
    {
        // Check if a person buy a package
        $order_data = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        if(!$order_data) {
            return redirect()->back()->with('error', 'You must have to buy a package first to access this page');
        }
        if(date('Y-m-d') > $order_data->expire_date) {
            return redirect()->back()->with('error', 'Your package is expired!');
        }

        // Check if a person has access to this page under the current package
        $package_data = Package::where('id',$order_data->package_id)->first();
        if($package_data->total_allowed_jobs == 0) {
            return redirect()->back()->with('error', 'Your current package does not allow to access the job section');
        }

        // How many jobs this company posted
        $total_jobs_posted = Job::where('company_id',Auth::guard('company')->user()->id)->count();
        if($package_data->total_allowed_jobs == $total_jobs_posted) {
            return redirect()->back()->with('error', 'You already have posted the maximum number of allowed jobs');
        }

        $job_categories = JobCategory::orderBy('name','asc')->get();
        $job_locations = JobLocation::orderBy('name','asc')->get();
        $job_types = JobType::orderBy('name','asc')->get();
        $job_experiences = JobExperience::orderBy('id','asc')->get();
        $job_genders = JobGender::orderBy('id','asc')->get();
        $job_salary_ranges = JobSalaryRange::orderBy('id','asc')->get();
        return view('company.jobs-create', compact('job_categories','job_locations','job_types','job_experiences','job_genders','job_salary_ranges'));
    }

    // Compnay job create and submit
    public function jobs_create_submit(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'vacancy' => 'required'
        ]);

        $order_data = Order::where('company_id',Auth::guard('company')->user()->id)->where('currently_active',1)->first();
        $package_data = Package::where('id',$order_data->package_id)->first();

        $total_featured_jobs = Job::where('company_id',Auth::guard('company')->user()->id)->where('is_featured',1)->count();
        if($total_featured_jobs == $package_data->total_allowed_featured_jobs) {
            if($request->is_featured == 1) {
                return redirect()->back()->with('error', 'You already have added the total number of featured jobs');
            }
        }

        $obj = new Job();
        $obj->company_id = Auth::guard('company')->user()->id;
        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->responsibility = $request->responsibility;
        $obj->skill = $request->skill;
        $obj->education = $request->education;
        $obj->benefit = $request->benefit;
        $obj->deadline = $request->deadline;
        $obj->vacancy = $request->vacancy;
        $obj->job_category_id = $request->job_category_id;
        $obj->job_location_id = $request->job_location_id;
        $obj->job_type_id = $request->job_type_id;
        $obj->job_experience_id = $request->job_experience_id;
        $obj->job_gender_id = $request->job_gender_id;
        $obj->job_salary_range_id = $request->job_salary_range_id;
        $obj->map_code = $request->map_code;
        $obj->is_featured = $request->is_featured;
        $obj->is_urgent = $request->is_urgent;
        $obj->save();

        return redirect()->back()->with('success', 'Job is posted successfully!');
    }

    // Data reterive and pass to the view
    public function jobs()
    {
        $jobs = Job::with('JobCategory')->where('company_id',Auth::guard('company')->user()->id)->get();
        return view('company.jobs', compact('jobs'));
    }

    // Job edit methods
    public function jobs_edit($id)
    {
        $jobs_single = Job::where('id',$id)->first();
        $job_categories = JobCategory::orderBy('name','asc')->get();
        $job_locations = JobLocation::orderBy('name','asc')->get();
        $job_types = JobType::orderBy('name','asc')->get();
        $job_experiences = JobExperience::orderBy('id','asc')->get();
        $job_genders = JobGender::orderBy('id','asc')->get();
        $job_salary_ranges = JobSalaryRange::orderBy('id','asc')->get();
        
        return view('company.jobs-edit', compact('jobs_single','job_categories','job_locations','job_types','job_experiences','job_genders','job_salary_ranges'));
    }

    // Job edit and update methods
    public function jobs_update(Request $request,$id)
    {
        $obj = Job::where('id',$id)->first();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'vacancy' => 'required'
        ]);

        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->responsibility = $request->responsibility;
        $obj->skill = $request->skill;
        $obj->education = $request->education;
        $obj->benefit = $request->benefit;
        $obj->deadline = $request->deadline;
        $obj->vacancy = $request->vacancy;
        $obj->job_category_id = $request->job_category_id;
        $obj->job_location_id = $request->job_location_id;
        $obj->job_type_id = $request->job_type_id;
        $obj->job_experience_id = $request->job_experience_id;
        $obj->job_gender_id = $request->job_gender_id;
        $obj->job_salary_range_id = $request->job_salary_range_id;
        $obj->map_code = $request->map_code;
        $obj->is_featured = $request->is_featured;
        $obj->is_urgent = $request->is_urgent;
        $obj->update();

        return redirect()->back()->with('success', 'Job is updated successfully!');
    }

    // Job deleted methods
    public function jobs_delete($id)
    {
        Job::where('id',$id)->delete();
        return redirect()->route('company_jobs')->with('success', 'Job is deleted successfully.');
    }
}
