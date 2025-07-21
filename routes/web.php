<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\ReviewController;
// ----------------------
// 🔐 Auth Routes
// ----------------------
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------
// 🌐 Public / Frontend Routes
// ----------------------
Route::get('/', [FrontendController::class, 'index'])->name('user.dashboard');
Route::get('/plans', [FrontendController::class, 'plans']);
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq.page');
Route::get('/plan', [FrontendController::class, 'plan'])->name('plan.show');
Route::get('/about', [FrontendController::class, 'about'])->name('plans.about');

// Static Pages
Route::get('/about-company', [PageController::class, 'aboutCompany'])->name('about.company');
Route::get('/Privacy-Policy', [PageController::class, 'showPrivacyPolicy'])->name('privacy.policy');
Route::get('/refund-return', [PageController::class, 'refundreturn'])->name('refund.return');
Route::get('/terms-conditions', [PageController::class, 'showTermsConditions'])->name('terms.conditions');

// ----------------------
// 🛒 Public Shop Section
// ----------------------
Route::get('/shop', [PlanController::class, 'index'])->name('plans.index');
Route::get('/plan/{slug}', [PlanController::class, 'show'])->name('plan.show');
Route::get('/free-trial', [PlanController::class, 'freeTrial'])->name('free.trial');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::get('/blogs', [BlogController::class, 'blogview'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'blogsdetail'])->name('blog.show');
// ----------------------
// 🛠️ Admin Routes
// ----------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminPlanController::class, 'dashboard'])->name('dashboard');
    Route::resource('plans', AdminPlanController::class);
    Route::resource('categories', AdminCategoryController ::class);
    Route::resource('pages', PageController::class);
    Route::resource('contact', ContactInfoController::class);
    Route::resource('blogs', BlogController::class);
});
