<?php

use Illuminate\Support\Facades\Route;

use App\Constants\WebRouteName;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ChatController;






Route::get('/', function () {
    //return view('welcome');

    return redirect()->route(WebRouteName::WEB_ROUTE_LOGIN_INDEX);
});


//Login Routes

Route::get('login', [LoginController::class, 'loginIndex'])->name(WebRouteName::WEB_ROUTE_LOGIN_INDEX);
Route::post('login', [LoginController::class, 'login'])->name(WebRouteName::WEB_ROUTE_LOGIN);


//Dashboard Routes
Route::get('dashboard', [DashboardController::class, 'index'])->name(WebRouteName::WEB_ROUTE_DASHBOARD);

//User Route,
Route::get('user', [UserController::class, 'userIndex'])->name(WebRouteName::WEB_ROUTE_USER_INDEX);
Route::get('user/create', [UserController::class, 'create'])->name(WebRouteName::WEB_ROUTE_USER_CREATE);
Route::post('user/create', [UserController::class, 'store'])->name(WebRouteName::WEB_ROUTE_USER_STORE);
Route::post('user/update', [UserController::class, 'update'])->name(WebRouteName::WEB_ROUTE_USER_UPDATE);
Route::post('user/delete', [UserController::class, 'delete'])->name(WebRouteName::WEB_ROUTE_USER_DELETE);


//Company Routes
Route::get('company', [CompanyController::class, 'companyIndex'])->name(WebRouteName::WEB_ROUTE_COMPANY_INDEX);
Route::get('company/create', [CompanyController::class, 'create'])->name(WebRouteName::WEB_ROUTE_COMPANY_CREATE);
Route::post('company/create', [CompanyController::class, 'store'])->name(WebRouteName::WEB_ROUTE_COMPANY_STORE);
Route::post('company/update', [CompanyController::class, 'update'])->name(WebRouteName::WEB_ROUTE_COMPANY_UPDATE);
Route::post('company/delete', [CompanyController::class, 'delete'])->name(WebRouteName::WEB_ROUTE_COMPANY_DELETE);

//Register Routes
Route::get('register', [RegisterController::class, 'registerIndex'])->name(WebRouteName::WEB_ROUTE_REGISTER_INDEX);
Route::post('register', [RegisterController::class, 'register'])->name(WebRouteName::WEB_ROUTE_REGISTER);

//Project Routes
Route::get('project', [ProjectController::class, 'projectIndex'])->name(WebRouteName::WEB_ROUTE_PROJECT_INDEX);
Route::get('project/create', [ProjectController::class, 'create'])->name(WebRouteName::WEB_ROUTE_PROJECT_CREATE);
Route::post('project/create', [ProjectController::class, 'store'])->name(WebRouteName::WEB_ROUTE_PROJECT_STORE);
Route::post('project/update', [ProjectController::class, 'update'])->name(WebRouteName::WEB_ROUTE_PROJECT_UPDATE);
Route::post('project/delete', [ProjectController::class, 'delete'])->name(WebRouteName::WEB_ROUTE_PROJECT_DELETE);

//Ticket Routes
Route::get('ticket', [TicketController::class, 'ticketIndex'])->name(WebRouteName::WEB_ROUTE_TICKET_INDEX);
Route::get('ticket/create', [TicketController::class, 'create'])->name(WebRouteName::WEB_ROUTE_TICKET_CREATE);
Route::post('ticket/create', [TicketController::class, 'store'])->name(WebRouteName::WEB_ROUTE_TICKET_STORE);
Route::post('ticket', [TicketController::class, 'update'])->name(WebRouteName::WEB_ROUTE_TICKET_UPDATE);
Route::post('ticket/update-progress', [TicketController::class, 'updateProgress'])->name(WebRouteName::WEB_ROUTE_TICKET_UPDATE_PROGRESS);

//Message Routes
Route::post('ticket/create-message', [ChatController::class, 'storeMessage'])->name(WebRouteName::WEB_ROUTE_TICKET_STORE_MESSAGE);
Route::get('ticket/messages/{id}', [ChatController::class, 'getMessages'])->name(WebRouteName::WEB_ROUTE_TICKET_GET_MESSAGE); // Fetch messages

//Assign Staff Routes
