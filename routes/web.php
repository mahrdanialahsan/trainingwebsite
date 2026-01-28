<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ConsultingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\WaiverController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\BioController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ConsultingSectionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::get('/email/verify', [AuthController::class, 'showVerificationNotice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Password Reset Routes
Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'resetPassword'])->name('password.update');

// User Dashboard Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/dashboard/account', [DashboardController::class, 'updateAccount'])->name('dashboard.account.update');
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
Route::get('/trainings/{slug}', [TrainingController::class, 'show'])->name('trainings.show');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/consulting', [ConsultingController::class, 'index'])->name('consulting');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Booking Routes
Route::get('/book/{slug}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/waiver', [BookingController::class, 'showWaiver'])->name('bookings.waiver');
Route::post('/bookings/{booking}/accept-waiver', [BookingController::class, 'acceptWaiver'])->name('bookings.accept-waiver');
Route::get('/bookings/{booking}/payment', [BookingController::class, 'showPayment'])->name('bookings.payment');
Route::post('/bookings/{booking}/payment', [BookingController::class, 'processPayment'])->name('bookings.process-payment');
Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('bookings.confirmation');

// Webhooks
Route::post('/webhooks/stripe', [\App\Http\Controllers\WebhookController::class, 'stripe'])->name('webhooks.stripe');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Courses Management
    Route::resource('courses', AdminCourseController::class);
    
    // Bookings Management
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    
    // Waivers Management
    Route::resource('waivers', WaiverController::class);
    
    // Pages Management
    Route::resource('pages', PageController::class);
    
    // Documents Management
    Route::resource('documents', DocumentController::class);
    
    // Bios Management
    Route::get('/bios', [BioController::class, 'index'])->name('bios.index');
    Route::get('/bios/{bio}/edit', [BioController::class, 'edit'])->name('bios.edit');
    Route::put('/bios/{bio}', [BioController::class, 'update'])->name('bios.update');
    
    // Settings Management
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // About Page Management
    Route::resource('about', AdminAboutController::class);
    
    // FAQs Management
    Route::resource('faqs', AdminFaqController::class);
    
    // Consulting Sections Management
    Route::resource('consulting-sections', ConsultingSectionController::class);
    
    // Trainings Management
    Route::resource('trainings', AdminTrainingController::class);
    Route::post('trainings/{training}/facilities', [AdminTrainingController::class, 'storeFacility'])->name('trainings.facilities.store');
    Route::put('trainings/{training}/facilities/{facility}', [AdminTrainingController::class, 'updateFacility'])->name('trainings.facilities.update');
    Route::delete('trainings/{training}/facilities/{facility}', [AdminTrainingController::class, 'destroyFacility'])->name('trainings.facilities.destroy');
    Route::post('trainings/{training}/amenities', [AdminTrainingController::class, 'storeAmenity'])->name('trainings.amenities.store');
    Route::put('trainings/{training}/amenities/{amenity}', [AdminTrainingController::class, 'updateAmenity'])->name('trainings.amenities.update');
    Route::delete('trainings/{training}/amenities/{amenity}', [AdminTrainingController::class, 'destroyAmenity'])->name('trainings.amenities.destroy');
    
    // Users Management
    Route::resource('users', UserController::class);
    Route::put('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    Route::put('users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
    
    // Admins Management (Super Admin only)
    Route::middleware('super_admin')->group(function () {
        Route::resource('admins', AdminController::class);
    });
    
    // Password change for current admin (all admins can access)
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::put('change-password', [AdminController::class, 'updatePassword'])->name('update-password');
});
