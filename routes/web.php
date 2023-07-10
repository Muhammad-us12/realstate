<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\WebsiteController;
use App\Http\Controllers\website\BlogController;
use App\Http\Controllers\website\BlogsController;
use App\Http\Controllers\website\OfferController;
use App\Http\Controllers\website\VideoController;

use App\Http\Controllers\location\LocationsController;
use App\Http\Controllers\location\SocietyController;
use App\Http\Controllers\location\BlockController;
use App\Http\Controllers\location\FilesController;
use App\Http\Controllers\location\LocalPropertyController;
use App\Http\Controllers\members\AgentController;
use App\Http\Controllers\members\CustomerController;
use App\Http\Controllers\members\BuyerController;
use App\Http\Controllers\Accounts\AccountsController;
use App\Http\Controllers\Accounts\PaymentsController;
use App\Http\Controllers\Accounts\ReceivedController;
use App\Http\Controllers\Accounts\ExpenseController;

use App\Http\Controllers\Clients\ClientController;
use App\Http\Controllers\Clients\FollowUpCatController;

use App\Http\Controllers\Auth\RegisteredUserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Website Routes
Route::get('/', [WebsiteController::class,'index']);
Route::get('/about-us', [WebsiteController::class,'about_us']);
Route::get('/contact-us', [WebsiteController::class,'contact_us']);
Route::post('/contact-us', [WebsiteController::class,'contact_us_sub']);
Route::get('/contact-us-messages-list', [WebsiteController::class,'contact_us_messages_list']);
Route::get('/delete-query/{id}', [WebsiteController::class,'delete_query']);




Route::get('/blog-list', [WebsiteController::class,'blog_list']);
Route::get('/category-blogs/{id}', [WebsiteController::class,'category_blogs']);
Route::get('/blog-details/{id}', [WebsiteController::class,'blog_details']);

Route::get('/offer-list', [WebsiteController::class,'offers_list']);
Route::get('/video-list', [WebsiteController::class,'videos_list']);
Route::get('/category-offers/{id}', [WebsiteController::class,'category_offers']);
Route::get('/offers-details/{id}', [WebsiteController::class,'offers_details']);
Route::get('/video-details/{id}', [WebsiteController::class,'video_details']);
Route::get('/category-videos/{id}', [WebsiteController::class,'category_videos']);


Route::post('/search-property', [WebsiteController::class,'search_property']);
Route::get('/property-detail/{id}', [WebsiteController::class,'property_detail']);
Route::get('/society-details/{id}', [WebsiteController::class,'society_detail']);

Route::get('/all-societies-display', [WebsiteController::class,'all_societies_display']);
Route::get('/all-team-members', [WebsiteController::class,'all_team_members']);


Route::post('/fetch_socities_wi_location', [FilesController::class,'fetch_socities_wi_location']);


Route::middleware(['auth:web'])->group(function () {

// Website Blogs

Route::get('/blogs-list', [BlogsController::class,'index']);
Route::get('/blogs-add', [BlogsController::class,'create']);
Route::get('/blogs-update/{id}', [BlogsController::class,'edit']);
Route::post('/blogs-update/{id}', [BlogsController::class,'update']);
Route::post('/blogs-submit', [BlogsController::class,'store']);
Route::get('/blogs-categories', [BlogsController::class,'blogs_categories']);
Route::get('/category-data/{id}', [BlogsController::class,'getCategories']);
Route::post('/blog-cat-submit', [BlogsController::class,'storeCategory']);
Route::post('/blog-cat-update', [BlogsController::class,'updateCategory']);
Route::post('/update_blog_status', [BlogsController::class,'update_blog_status']);

// Website Offers
Route::get('/offers-list', [OfferController::class,'index']);
Route::get('/offers-add', [OfferController::class,'create']);
Route::get('/offers-update/{id}', [OfferController::class,'edit']);
Route::post('/offers-update/{id}', [OfferController::class,'update']);
Route::get('/offers-categories', [OfferController::class,'offers_categories']);
Route::post('/offers-cat-submit', [OfferController::class,'storeCategory']);
Route::post('/offers-cat-update', [OfferController::class,'updateCategory']);
Route::post('/offer-submit', [OfferController::class,'store']);
Route::post('/update_offer_status', [OfferController::class,'update_offer_status']);

// Website Offers
Route::get('/videos-list', [VideoController::class,'index']);
Route::get('/videos-add', [VideoController::class,'create']);
Route::get('/videos-update/{id}', [VideoController::class,'edit']);
Route::post('/videos-update/{id}', [VideoController::class,'update']);
Route::get('/videos-categories', [VideoController::class,'videos_categories']);
Route::post('/videos-cat-submit', [VideoController::class,'storeCategory']);
Route::post('/video-submit', [VideoController::class,'store']);
Route::post('/video-cat-update', [VideoController::class,'updateCategory']);
Route::post('/update_video_status', [VideoController::class,'update_video_status']);







// Locations 
Route::get('/locations-list', [LocationsController::class,'index']);
Route::get('/add-location', [LocationsController::class,'create']);
Route::post('/location-submit', [LocationsController::class,'store']);
Route::get('/location-update/{id}', [LocationsController::class,'edit']);
Route::post('/location-update/{id}', [LocationsController::class,'update']);

// Society
Route::get('/add-society', [SocietyController::class,'create']);
Route::get('/societies-list', [SocietyController::class,'index']);
Route::post('/society-submit', [SocietyController::class,'store']);
Route::get('/society-update/{id}', [SocietyController::class,'edit']);
Route::post('/society-update/{id}', [SocietyController::class,'update']);

// Blocks
Route::get('/block-list', [BlockController::class,'index']);
Route::post('/block-submit', [BlockController::class,'store']);

// Files
Route::get('/add-files', [FilesController::class,'create']);
Route::get('/files-list', [FilesController::class,'index']);
Route::post('/files-submit', [FilesController::class,'store']);
Route::post('/files-sale', [FilesController::class,'files_sale']);
Route::post('/fetch_file_wi_id', [FilesController::class,'fetch_file_wi_id']);
Route::post('/add_marala_type', [FilesController::class,'add_marala_type']);
Route::post('/fetch_marala_type', [FilesController::class,'fetch_marala_type']);
Route::post('/fetch_blocks_wi_scotites', [FilesController::class,'fetch_blocks_wi_scotites']);
Route::post('/post_file_purchase', [FilesController::class,'post_file_purchase']);
Route::post('/post_file_sale', [FilesController::class,'post_file_sale']);
Route::post('/update_file_purchase', [FilesController::class,'update_file_purchase']);
Route::post('/update_file_sale', [FilesController::class,'update_file_sale']);
Route::get('/file-print/{id}', [FilesController::class,'file_print']);


// Local Property
Route::get('/add-property', [LocalPropertyController::class,'create']);
Route::get('/property-list', [LocalPropertyController::class,'index']);
Route::post('/property-submit', [LocalPropertyController::class,'store']);
Route::post('/fetch_proporty_wi_id', [LocalPropertyController::class,'fetch_proporty_wi_id']);
Route::post('/property-sale', [LocalPropertyController::class,'property_sale']);
Route::post('/post-property-sale', [LocalPropertyController::class,'post_property_sale']);
Route::get('/property_update/{id}', [LocalPropertyController::class,'edit']);
Route::post('/property_update', [LocalPropertyController::class,'update']);
Route::get('/localproperty-print/{id}', [LocalPropertyController::class,'localproperty_print']);


Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('/users-list', [RegisteredUserController::class,'users_lists']);
Route::get('/user-update/{id}', [RegisteredUserController::class,'user_update']);
Route::post('/user-update/{id}', [RegisteredUserController::class,'update']);



// Agents
Route::get('/add-agent', [AgentController::class,'create']);
Route::get('/agents-list', [AgentController::class,'index']);
Route::get('/agents-profile/{id}', [AgentController::class,'show']);
Route::post('/agent-submit', [AgentController::class,'store']);
Route::get('/agent-update/{id}', [AgentController::class,'edit']);
Route::post('/agent-update/{id}', [AgentController::class,'update']);
Route::get('/fetch_agent_list', [AgentController::class,'fetch_agent_list']);
Route::get('/fetch_agent_bal/{id}', [AgentController::class,'fetch_agent_bal']);
Route::get('/agent-ledeger/{id}', [AgentController::class,'AgentLedeger']);
Route::post('/update_agent_status', [AgentController::class,'update_agent_status']);




// Customers
Route::get('/add-customer', [CustomerController::class,'create']);
Route::get('/customers-list', [CustomerController::class,'index']);
Route::get('/customer-profile/{id}', [CustomerController::class,'show']);
Route::post('/customer-submit', [CustomerController::class,'store']);
Route::get('/customer-update/{id}', [CustomerController::class,'edit']);
Route::post('/customer-update/{id}', [CustomerController::class,'update']);
Route::get('/fetch_customer_list', [CustomerController::class,'fetch_customer_list']);
Route::get('/fetch_customer_bal/{id}', [CustomerController::class,'fetch_customer_bal']);
Route::get('/customer-ledeger/{id}', [CustomerController::class,'customerLedeger']);



// Buyer
Route::get('/add-buyer', [BuyerController::class,'create']);
Route::get('/buyers-list', [BuyerController::class,'index']);
Route::get('/buyer-profile/{id}', [BuyerController::class,'show']);
Route::post('/buyer-submit', [BuyerController::class,'store']);
Route::get('/buyer-update/{id}', [BuyerController::class,'edit']);
Route::post('/buyer-update/{id}', [BuyerController::class,'update']);


// Cash Accounts
Route::get('/cash-deposit', [AccountsController::class,'cashDeposit']);
Route::post('/cash-deposit', [AccountsController::class,'cashDepositSub']);
Route::get('/cash_deposit_print/{id}', [AccountsController::class,'cash_deposit_print']);
Route::get('/accounts-list', [AccountsController::class,'index']);
Route::post('/account-submit', [AccountsController::class,'store']);
Route::get('/accounts-ledeger/{id}', [AccountsController::class,'accountLedeger']);
Route::get('/fetch_cash_acc_bal/{id}', [AccountsController::class,'fetch_cash_acc_bal']);
Route::get('/fetch_account_list', [AccountsController::class,'fetch_account_list']);
Route::get('/payable_receivable', [AccountsController::class,'payable_receivable']);
Route::get('/profit-report', [AccountsController::class,'profit_report']);
Route::get('/date-wise-profit-report', [AccountsController::class,'date_wise_profit_report']);
Route::post('/date-wise-profit-report', [AccountsController::class,'date_wise_profit_report_sub']);

// Payments 
Route::get('/payments-list', [PaymentsController::class,'index']);
Route::get('/payments-add', [PaymentsController::class,'create']);
Route::post('/payments-sub', [PaymentsController::class,'store']);
Route::get('/payment-list-print/{id}', [PaymentsController::class,'payment_list_print']);



// Received Payments 
Route::get('/received-list', [ReceivedController::class,'index']);
Route::get('/received-add', [ReceivedController::class,'create']);
Route::post('/received-sub', [ReceivedController::class,'store']);
Route::get('/receive-list-print/{id}', [ReceivedController::class,'payment_list_print']);



// Expense 
Route::get('/add-expense', [ExpenseController::class,'create']);
Route::get('/expense-list', [ExpenseController::class,'index']);
Route::post('/expense-sub', [ExpenseController::class,'store']);
Route::get('/expense-categories', [ExpenseController::class,'expense_categories']);
Route::post('/expense-cat-submit', [ExpenseController::class,'storeCategory']);
Route::get('/expense-sub-categories', [ExpenseController::class,'expense_sub_categories']);
Route::post('/expense-sub-cat-submit', [ExpenseController::class,'expense_sub_cat_submit']);
Route::post('/fetch_sub_category', [ExpenseController::class,'fetch_sub_category']);
Route::get('/expense_print/{id}', [ExpenseController::class,'expense_print']);
Route::post('/expense-cat-update', [ExpenseController::class,'update']);
Route::post('/expense-sub-cat-update', [ExpenseController::class,'sub_cat_update']);



// Reports

// Expense Reports

Route::get('/day-book', [ExpenseController::class,'day_book']);
Route::post('/day-book', [ExpenseController::class,'day_book_sub']);
Route::get('/expense-reports', [ExpenseController::class,'expense_reports']);
Route::post('/category-wise-expense', [ExpenseController::class,'category_wise_expense']);
Route::post('/sub-category-wise-expense', [ExpenseController::class,'sub_category_wise_expense']);
Route::get('/print-all-expense', [ExpenseController::class,'print_all_expense']);
Route::post('/date-wise-expense', [ExpenseController::class,'date_wise_expense']);
Route::post('/cash-account-wise-expense', [ExpenseController::class,'cash_account_wise_expense']);



// Payments Report
Route::get('/payments-report', [PaymentsController::class,'payments_reports']);
Route::post('/date-wise-payment', [PaymentsController::class,'date_wise_payment']);
Route::post('/date-wise-recveive-payments', [ReceivedController::class,'date_wise_recveive_payments']);

// Ledger

Route::get('/reports-list', [AccountsController::class,'reports_list']);
Route::get('/ledger-reports', [AccountsController::class,'ledger_reports']);
Route::post('/print-cash-account-ledeger', [AccountsController::class,'print_cash_account_ledeger']);
Route::post('/date-wise-cash-account-ledeger', [AccountsController::class,'date_wise_cash_account_ledeger']);
Route::post('/print-agent-account-ledeger', [AccountsController::class,'print_agent_account_ledeger']);
Route::post('/date-wise-agent-account-ledeger', [AccountsController::class,'date_wise_agent_account_ledeger']);

// Files Report
Route::get('/files-reports', [FilesController::class,'files_reports']);
Route::post('/status-wise-files', [FilesController::class,'status_wise_files']);
Route::post('/marala-wise-files', [FilesController::class,'marala_wise_files']);
Route::post('/purchase-status-wise-files', [FilesController::class,'purchase_status_wise_files']);
Route::post('/sale-status-wise-files', [FilesController::class,'sale_status_wise_files']);

Route::post('/location-wise-files', [FilesController::class,'location_wise_files']);
Route::post('/societies-wise-files', [FilesController::class,'societies_wise_files']);
Route::post('/societies-block-wise-files', [FilesController::class,'societies_block_wise_files']);

// LocalProperty Report
Route::get('/local-porperty-reports', [LocalPropertyController::class,'local_porperty_reports']);
Route::post('/status-wise-property', [LocalPropertyController::class,'status_wise_property']);
Route::post('/location-wise-property', [LocalPropertyController::class,'location_wise_property']);
Route::post('/societies-wise-property', [LocalPropertyController::class,'societies_wise_property']);
Route::post('/marala-wise-property', [LocalPropertyController::class,'marala_wise_property']);


Route::get('add_client_admin',[ClientController::class,'add_client_admin']);
Route::post('client_registration_admin',[ClientController::class,'store_admin']);
Route::get('all_clients_list',[ClientController::class,'all_clients_list']);
Route::get('unassign_clients_list',[ClientController::class,'unassign_clients_list']);
Route::get('assign_clients_to_agents',[ClientController::class,'assign_clients_to_agents']);


Route::get('clients_follow_up_list_admin/{id}',[ClientController::class,'clients_follow_up_list_admin']);
Route::post('udpate_cleint_status_admin',[ClientController::class,'udpate_cleint_status']);

Route::get('follow_up_categories',[FollowUpCatController::class,'follow_up_categories']);
Route::post('follow_up_cat_submit',[FollowUpCatController::class,'follow_up_cat_submit']);
Route::post('follow_up_cat_update',[FollowUpCatController::class,'follow_up_cat_update']);

Route::get('follow_up_sub_categories',[FollowUpCatController::class,'follow_up_sub_categories']);
Route::post('follow_up_sub_cat_submit',[FollowUpCatController::class,'follow_up_sub_cat_submit']);
Route::post('follow_up_sub_cat_update',[FollowUpCatController::class,'follow_up_sub_cat_update']);





});



Route::get('/dashboard',[AccountsController::class,'dashboard'])
->middleware('auth:web')->name('dashboard');

Route::get('/agent-login', [AgentController::class,'agent_login']);


Route::get('/agent_dashboard',[AgentController::class,'dashboard'])
->middleware('auth:agent')->name('agent_dashboard');

Route::middleware('auth:agent')->group(function(){
    
    Route::get('daily_dairy',[ClientController::class,'daily_dairy']);
    Route::get('client_follow_up/{id}/{client_id}',[ClientController::class,'client_follow_up']);
    Route::post('client_follow_up_sub',[ClientController::class,'client_follow_up_sub']);

    Route::get('clients_list',[ClientController::class,'clients_list']);
    Route::post('udpate_cleint_status',[ClientController::class,'udpate_cleint_status']);
    
    Route::get('clients_follow_up_list/{id}',[ClientController::class,'clients_follow_up_list']);
    Route::get('client_registration',[ClientController::class,'create']);
    Route::post('client_registration',[ClientController::class,'store']);

    
});


require __DIR__.'/auth.php';
