<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminJobType;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AdminJobGender;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminJobLocation;
use App\Http\Controllers\Admin\FaqPageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Forntend\HomeController;
use App\Http\Controllers\Forntend\PostController;
use App\Http\Controllers\Admin\AdminJobExperience;
use App\Http\Controllers\Admin\BlogPageController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Forntend\TermsController;
use App\Http\Controllers\Admin\AdminJobSalaryRange;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OtherPageController;
use App\Http\Controllers\Admin\WhyChooseController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Companay\CompnayController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Forntend\ForntFaqController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Forntend\LoginPageController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Forntend\ForgetPageController;
use App\Http\Controllers\Forntend\SignupPageController;
use App\Http\Controllers\Forntend\PricingPageController;
use App\Http\Controllers\Forntend\PrivacyPageController;
use App\Http\Controllers\Admin\HomePageSettingController;
use App\Http\Controllers\Admin\AdminCompanySizeController;
use App\Http\Controllers\Admin\AdminPricingPageController;
use App\Http\Controllers\Forntend\ForntContactPageConroller;
use App\Http\Controllers\Forntend\ForntJobCategoryController;
use App\Http\Controllers\Admin\AdminCompanyIndustryController;
use App\Http\Controllers\Admin\AdminCompanyLocationController;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('terms-of-use', [TermsController::class, 'index'])->name('terms');
Route::get('privacy-policy', [PrivacyPageController::class, 'index'])->name('privacy');
Route::get('/job-categories',[ForntJobCategoryController::class, 'categories'])->name('job_categories');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('post/{slug}', [PostController::class, 'detail'])->name('post');
Route::get('faq', [ForntFaqController::class, 'index'])->name('faq');
Route::get('contact-page', [ForntContactPageConroller::class, 'index'])->name('contact');
Route::post('contact/submit', [ForntContactPageConroller::class, 'submit'])->name('contact_submit');
Route::get('pricing', [PricingPageController::class, 'index'])->name('pricing');

// login and signup page routes
Route::get('login', [LoginPageController::class, 'index'])->name('login');
Route::get('create-account', [SignupPageController::class, 'index'])->name('signup');
Route::get('forget-password', [ForgetPageController::class, 'index'])->name('forget_password');

/* Company */
Route::post('company_login_submit', [LoginPageController::class, 'company_login_submit'])->name('company_login_submit');
Route::post('company_signup_submit', [SignupPageController::class, 'company_signup_submit'])->name('company_signup_submit');
Route::get('company_signup_verify/{token}/{email}', [SignupPageController::class, 'company_signup_verify'])->name('company_signup_verify');
Route::get('/company/logout', [LoginPageController::class, 'company_logout'])->name('company_logout');
Route::get('forget-password/company', [ForgetPageController::class, 'company_forget_password'])->name('company_forget_password');
Route::post('forget-password/company/submit', [ForgetPageController::class, 'company_forget_password_submit'])->name('company_forget_password_submit');
Route::get('reset-password/company/{token}/{email}', [ForgetPageController::class, 'company_reset_password'])->name('company_reset_password');
Route::post('reset-password/company/submit', [ForgetPageController::class, 'company_reset_password_submit'])->name('company_reset_password_submit');

// Companay Milldleware Routes
Route::middleware(['company:company'])->group(function() {
    Route::get('/company/dashboard', [CompanyController::class, 'dashboard'])->name('company_dashboard');
    Route::get('/company/make-payment', [CompanyController::class, 'make_payment'])->name('company_make_payment');
    Route::get('/company/orders', [CompanyController::class, 'orders'])->name('company_orders');

    Route::get('/company/edit-profile', [CompanyController::class, 'edit_profile'])->name('company_edit_profile');
    Route::post('/company/edit-profile/update', [CompanyController::class, 'edit_profile_update'])->name('company_edit_profile_update');
    Route::get('/company/edit-password', [CompanyController::class, 'edit_password'])->name('company_edit_password');
    Route::post('/company/edit-password/update', [CompanyController::class, 'edit_password_update'])->name('company_edit_password_update');

    // Compnay Photos routes
    Route::get('/company/photos', [CompanyController::class, 'photos'])->name('company_photos');
    Route::post('/company/photos/submit', [CompanyController::class, 'photos_submit'])->name('company_photos_submit');
    Route::get('/company/photos/delete/{id}', [CompanyController::class, 'photos_delete'])->name('company_photos_delete');
    
    // Company Video Routes
    Route::get('/company/videos', [CompanyController::class, 'videos'])->name('company_videos');
    Route::post('/company/videos/submit', [CompanyController::class, 'videos_submit'])->name('company_videos_submit');
    Route::get('/company/videos/delete/{id}', [CompanyController::class, 'videos_delete'])->name('company_videos_delete');

    // Compnay Job Create Routes
    Route::get('/company/create-job', [CompanyController::class, 'jobs_create'])->name('company_jobs_create');
    Route::post('/company/create-job-submit', [CompanyController::class, 'jobs_create_submit'])->name('company_jobs_create_submit');

    Route::get('/company/jobs', [CompanyController::class, 'jobs'])->name('company_jobs');
    Route::get('/company/job-edit/{id}', [CompanyController::class, 'jobs_edit'])->name('company_jobs_edit');
    Route::post('/company/job-update/{id}', [CompanyController::class, 'jobs_update'])->name('company_jobs_update');
    Route::get('/company/job-delete/{id}', [CompanyController::class, 'jobs_delete'])->name('company_jobs_delete');

    Route::post('/company/paypal/payment', [CompanyController::class, 'paypal'])->name('company_paypal');
    Route::get('/company/paypal/success', [CompanyController::class, 'paypal_success'])->name('company_paypal_success');
    Route::get('/company/paypal/cancel', [CompanyController::class, 'paypal_cancel'])->name('company_paypal_cancel');
});
/* Candidate */
Route::post('candidate_login_submit', [LoginPageController::class, 'candidate_login_submit'])->name('candidate_login_submit');
Route::post('candidate_signup_submit', [SignupPageController::class, 'candidate_signup_submit'])->name('candidate_signup_submit');
Route::get('candidate_signup_verify/{token}/{email}', [SignupPageController::class, 'candidate_signup_verify'])->name('candidate_signup_verify');
Route::get('/candidate/logout', [LoginPageController::class, 'candidate_logout'])->name('candidate_logout');
Route::get('forget-password/candidate', [ForgetPageController::class, 'candidate_forget_password'])->name('candidate_forget_password');
Route::post('forget-password/candidate/submit', [ForgetPageController::class, 'candidate_forget_password_submit'])->name('candidate_forget_password_submit');
Route::get('reset-password/candidate/{token}/{email}', [ForgetPageController::class, 'candidate_reset_password'])->name('candidate_reset_password');
Route::post('reset-password/candidate/submit', [ForgetPageController::class, 'candidate_reset_password_submit'])->name('candidate_reset_password_submit');

// Candidate Milldleware Routes
Route::middleware(['candidate:candidate'])->group(function() {
    Route::get('/candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate_dashboard');
});
// Admin Group routes
Route::middleware(['admin:admin'])->group(function () {

    //Blog Page Routes
    Route::get('/admin/blog-page', [BlogPageController::class, 'index'])->name('admin_blog_page');
    Route::post('/admin/blog-page/update', [BlogPageController::class, 'update'])->name('admin_blog_page_update');

    //Faq Page Routes
    Route::get('/admin/faq-page', [FaqPageController::class, 'index'])->name('admin_faq_page');
    Route::post('/admin/faq-page/update', [FaqPageController::class, 'update'])->name('admin_faq_page_update');

    //Terms Page Routes
    Route::get('/admin/term-page', [TermController::class, 'index'])->name('admin_term_page');
    Route::post('/admin/term-page/update', [TermController::class, 'update'])->name('admin_term_page_update');

    //Privacy Page Routes
    Route::get('/admin/privacy-page', [PrivacyPolicyController::class, 'index'])->name('admin_privacy_policy');
    Route::post('/admin/privacy-page/update', [PrivacyPolicyController::class, 'update'])->name('admin_privacy_policy_update');

    //Contact Page Routes
    Route::get('/admin/contact-page', [ContactPageController::class, 'index'])->name('admin_contact_page');
    Route::post('/admin/contact-page/update', [ContactPageController::class, 'update'])->name('admin_contact_page_update');

    // Pricing Page Routes
    Route::get('/admin/pricing-page', [AdminPricingPageController::class, 'index'])->name('admin_pricing_page');
    Route::post('/admin/pricing-page/update', [AdminPricingPageController::class, 'update'])->name('admin_pricing_page_update');

    // Other Page routes
    Route::get('/admin/other-page', [OtherPageController::class, 'index'])->name('admin_other_page');
    Route::post('/admin/other-page/update', [OtherPageController::class, 'update'])->name('admin_other_page_update');


    // Admin Dashboard Route and middleware
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/admin/edit-profile', [ProfileController::class, 'index'])->name('admin_profile');
    Route::post('/admin/profile-submit', [ProfileController::class, 'profileSubmit'])->name('admin_profile_submit');
    Route::get('/admin/home-page', [HomePageSettingController::class, 'index'])->name('home_page_setting');
    Route::post('/admin/home-page/update', [HomePageSettingController::class, 'update'])->name('home_page_update');

    // job category routes
    Route::get('/admin/job-category', [JobCategoryController::class, 'index'])->name('admin_job_category');
    Route::get('/admin/job-category/create', [JobCategoryController::class, 'create'])->name('admin_job_category_create');
    Route::post('/admin/job-category/store', [JobCategoryController::class, 'store'])->name('admin_job_category_store');
    Route::get('/admin/job-category/edit/{id}', [JobCategoryController::class, 'edit'])->name('admin_job_category_edit');
    Route::post('/admin/job-category/update/{id}', [JobCategoryController::class, 'update'])->name('admin_job_category_update');
    Route::get('/admin/job-category/delete/{id}', [JobCategoryController::class, 'delete'])->name('admin_job_category_delete');

    // Admin job location
    Route::get('/admin/job-location/view', [AdminJobLocation::class, 'index'])->name('admin_job_location');
    Route::get('/admin/job-location/create', [AdminJobLocation::class, 'create'])->name('admin_job_location_create');
    Route::post('/admin/job-location/store', [AdminJobLocation::class, 'store'])->name('admin_job_location_store');
    Route::get('/admin/job-location/edit/{id}', [AdminJobLocation::class, 'edit'])->name('admin_job_location_edit');
    Route::post('/admin/job-location/update/{id}', [AdminJobLocation::class, 'update'])->name('admin_job_location_update');
    Route::get('/admin/job-location/delete/{id}', [AdminJobLocation::class, 'delete'])->name('admin_job_location_delete');

    // Admin Job Type route
    Route::get('/admin/job-type/view', [AdminJobType::class, 'index'])->name('admin_job_type');
    Route::get('/admin/job-type/create', [AdminJobType::class, 'create'])->name('admin_job_type_create');
    Route::post('/admin/job-type/store', [AdminJobType::class, 'store'])->name('admin_job_type_store');
    Route::get('/admin/job-type/edit/{id}', [AdminJobType::class, 'edit'])->name('admin_job_type_edit');
    Route::post('/admin/job-type/update/{id}', [AdminJobType::class, 'update'])->name('admin_job_type_update');
    Route::get('/admin/job-type/delete/{id}', [AdminJobType::class, 'delete'])->name('admin_job_type_delete');

    // Admin Job Expriences Route
    Route::get('/admin/job-experience/view', [AdminJobExperience::class, 'index'])->name('admin_job_experience');
    Route::get('/admin/job-experience/create', [AdminJobExperience::class, 'create'])->name('admin_job_experience_create');
    Route::post('/admin/job-experience/store', [AdminJobExperience::class, 'store'])->name('admin_job_experience_store');
    Route::get('/admin/job-experience/edit/{id}', [AdminJobExperience::class, 'edit'])->name('admin_job_experience_edit');
    Route::post('/admin/job-experience/update/{id}', [AdminJobExperience::class, 'update'])->name('admin_job_experience_update');
    Route::get('/admin/job-experience/delete/{id}', [AdminJobExperience::class, 'delete'])->name('admin_job_experience_delete');

    // Admin job gender routes
    Route::get('/admin/job-gender/view', [AdminJobGender::class, 'index'])->name('admin_job_gender');
    Route::get('/admin/job-gender/create', [AdminJobGender::class, 'create'])->name('admin_job_gender_create');
    Route::post('/admin/job-gender/store', [AdminJobGender::class, 'store'])->name('admin_job_gender_store');
    Route::get('/admin/job-gender/edit/{id}', [AdminJobGender::class, 'edit'])->name('admin_job_gender_edit');
    Route::post('/admin/job-gender/update/{id}', [AdminJobGender::class, 'update'])->name('admin_job_gender_update');
    Route::get('/admin/job-gender/delete/{id}', [AdminJobGender::class, 'delete'])->name('admin_job_gender_delete');

    // Admin Job Salary Routes
    Route::get('/admin/job-salary-range/view', [AdminJobSalaryRange::class, 'index'])->name('admin_job_salary_range');
    Route::get('/admin/job-salary-range/create', [AdminJobSalaryRange::class, 'create'])->name('admin_job_salary_range_create');
    Route::post('/admin/job-salary-range/store', [AdminJobSalaryRange::class, 'store'])->name('admin_job_salary_range_store');
    Route::get('/admin/job-salary-range/edit/{id}', [AdminJobSalaryRange::class, 'edit'])->name('admin_job_salary_range_edit');
    Route::post('/admin/job-salary-range/update/{id}', [AdminJobSalaryRange::class, 'update'])->name('admin_job_salary_range_update');
    Route::get('/admin/job-salary-range/delete/{id}', [AdminJobSalaryRange::class, 'delete'])->name('admin_job_salary_range_delete');

    // Admin Compnay location Section Routes
    Route::get('/admin/company-location/view', [AdminCompanyLocationController::class, 'index'])->name('admin_company_location');
    Route::get('/admin/company-location/create', [AdminCompanyLocationController::class, 'create'])->name('admin_company_location_create');
    Route::post('/admin/company-location/store', [AdminCompanyLocationController::class, 'store'])->name('admin_company_location_store');
    Route::get('/admin/company-location/edit/{id}', [AdminCompanyLocationController::class, 'edit'])->name('admin_company_location_edit');
    Route::post('/admin/company-location/update/{id}', [AdminCompanyLocationController::class, 'update'])->name('admin_company_location_update');
    Route::get('/admin/company-location/delete/{id}', [AdminCompanyLocationController::class, 'delete'])->name('admin_company_location_delete');

    // Admin Compnay industry Section Routes
    Route::get('/admin/company-industry/view', [AdminCompanyIndustryController::class, 'index'])->name('admin_company_industry');
    Route::get('/admin/company-industry/create', [AdminCompanyIndustryController::class, 'create'])->name('admin_company_industry_create');
    Route::post('/admin/company-industry/store', [AdminCompanyIndustryController::class, 'store'])->name('admin_company_industry_store');
    Route::get('/admin/company-industry/edit/{id}', [AdminCompanyIndustryController::class, 'edit'])->name('admin_company_industry_edit');
    Route::post('/admin/company-industry/update/{id}', [AdminCompanyIndustryController::class, 'update'])->name('admin_company_industry_update');
    Route::get('/admin/company-industry/delete/{id}', [AdminCompanyIndustryController::class, 'delete'])->name('admin_company_industry_delete');

    // Admin Compnay size Section Routes
    Route::get('/admin/company-size/view', [AdminCompanySizeController::class, 'index'])->name('admin_company_size');
    Route::get('/admin/company-size/create', [AdminCompanySizeController::class, 'create'])->name('admin_company_size_create');
    Route::post('/admin/company-size/store', [AdminCompanySizeController::class, 'store'])->name('admin_company_size_store');
    Route::get('/admin/company-size/edit/{id}', [AdminCompanySizeController::class, 'edit'])->name('admin_company_size_edit');
    Route::post('/admin/company-size/update/{id}', [AdminCompanySizeController::class, 'update'])->name('admin_company_size_update');
    Route::get('/admin/company-size/delete/{id}', [AdminCompanySizeController::class, 'delete'])->name('admin_company_size_delete');

    // Why Choose Section routes
    Route::get('/admin/why-choose', [WhyChooseController::class, 'index'])->name('admin_why_choose');
    Route::get('/admin/why-choose/create', [WhyChooseController::class, 'create'])->name('admin_why_choose_create');
    Route::post('/admin/why-choose/store', [WhyChooseController::class, 'store'])->name('admin_why_choose_store');
    Route::get('/admin/why-choose/edit/{id}', [WhyChooseController::class, 'edit'])->name('admin_why_choose_edit');
    Route::post('/admin/why-choose/update/{id}', [WhyChooseController::class, 'update'])->name('admin_why_choose_update');
    Route::get('/admin/why-choose/delete/{id}', [WhyChooseController::class, 'delete'])->name('admin_why_choose_delete');

    // Tesimonial Section Routes
    Route::get('/admin/testimonial', [TestimonialController::class, 'index'])->name('admin_testimonial');
    Route::get('/admin/testimonial/create', [TestimonialController::class, 'create'])->name('admin_testimonial_create');
    Route::post('/admin/testimonial/store', [TestimonialController::class, 'store'])->name('admin_testimonial_store');
    Route::get('/admin/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('admin_testimonial_edit');
    Route::post('/admin/testimonial/update/{id}', [TestimonialController::class, 'update'])->name('admin_testimonial_update');
    Route::get('/admin/testimonial/delete/{id}', [TestimonialController::class, 'delete'])->name('admin_testimonial_delete');

    // Blog Section Routes
    Route::get('/admin/blog-post', [BlogPostController::class, 'index'])->name('admin_blog_post');
    Route::get('/admin/blog-post/create', [BlogPostController::class, 'create'])->name('admin_blog_post_create');
    Route::post('/admin/blog-post/store', [BlogPostController::class, 'store'])->name('admin_blog_post_store');
    Route::get('/admin/blog-post/edit/{id}', [BlogPostController::class, 'edit'])->name('admin_blog_post_edit');
    Route::post('/admin/blog-post/update/{id}', [BlogPostController::class, 'update'])->name('admin_blog_post_update');
    Route::get('/admin/blog-post/delete/{id}', [BlogPostController::class, 'delete'])->name('admin_blog_post_delete');

    // Pricing service routes
    Route::get('/admin/package/view', [AdminPackageController::class, 'index'])->name('admin_package');
    Route::get('/admin/package/create', [AdminPackageController::class, 'create'])->name('admin_package_create');
    Route::post('/admin/package/store', [AdminPackageController::class, 'store'])->name('admin_package_store');
    Route::get('/admin/package/edit/{id}', [AdminPackageController::class, 'edit'])->name('admin_package_edit');
    Route::post('/admin/package/update/{id}', [AdminPackageController::class, 'update'])->name('admin_package_update');
    Route::get('/admin/package/delete/{id}', [AdminPackageController::class, 'delete'])->name('admin_package_delete');

    // Faq routes
    Route::get('/admin/faq/view', [FaqController::class, 'index'])->name('admin_faq');
    Route::get('/admin/faq/create', [FaqController::class, 'create'])->name('admin_faq_create');
    Route::post('/admin/faq/store', [FaqController::class, 'store'])->name('admin_faq_store');
    Route::get('/admin/faq/edit/{id}', [FaqController::class, 'edit'])->name('admin_faq_edit');
    Route::post('/admin/faq/update/{id}', [FaqController::class, 'update'])->name('admin_faq_update');
    Route::get('/admin/faq/delete/{id}', [FaqController::class, 'delete'])->name('admin_faq_delete');
});

// Admin Login Routes
Route::get('/admin/login', [LoginController::class, 'login'])->name('admin_login');
Route::get('/admin/forget-password', [LoginController::class, 'forgetPassword'])->name('admin_foget_password');
Route::post('/admin/forget-password', [LoginController::class, 'forgetPasswordSubmit'])->name('admin_foget_password_submit');

Route::post('/admin/login-submit', [LoginController::class, 'loginSubmit'])->name('admin_login_submit');

Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin_logout');

Route::get('/admin/reset-password/{token}/{email}', [LoginController::class, 'resetPassword'])->name('reset_password');

Route::post('/admin/reset-password-submit', [LoginController::class, 'resetPasswordSubmit'])->name('admin_reset_password_submit');
