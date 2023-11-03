<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\OnboardController;
use App\Http\Controllers\TenantApiController;
use App\Http\Livewire\ProfileComponent;
use App\Models\Survey;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', function () {
            return view('auth/login');
        })->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/', function () {
        return redirect('/dashboard');
    })->name('tenant-login');

    Route::middleware(['auth:sanctum', 'verified', 'auth.onboard'])->group(function () {

        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('main');
            Route::get('/mood', [DashboardController::class, 'index'])->name('mood');
            Route::get('/surveys', [DashboardController::class, 'index'])->name('survey');
        });

        Route::name('employee.')->prefix('employee')->group(function () {
            Route::get('/', ProfileComponent::class)->name('list');
        });

        Route::name('community.')->prefix('community')->group(function () {
            Route::name('groups.')->prefix('groups')->group(function () {
                Route::get('/', [MemberController::class, 'indexTiles'])->name('list');
                Route::get('/{id}', ProfileComponent::class)->name('view');
                Route::get('/{id}/delete', [MemberController::class, 'deleteGroup'])->name('delete');
            });

            Route::name('departments.')->prefix('departments')->group(function () {
                Route::get('/', [MemberController::class, 'indexTiles'])->name('list');
                Route::get('/{id}', ProfileComponent::class)->name('view');
                Route::get('/{id}/delete', [MemberController::class, 'deleteDepartment'])->name('delete');

                Route::get('/{id}/profile', function () {
                    return view('pages/community/profile');
                })->name('profile');
            });

            Route::get('/feed', function () {
                return view('pages/community/feed');
            })->name('feed');

            Route::get('/events', function () {
                return view('pages/community/meetups');
            })->name('events');
        });

        Route::name('billing.')->prefix('billing')->group(function () {
            Route::get('/cards', function () {
                return view('pages/finance/credit-cards');
            })->name('credit-cards');
            Route::get('/transactions', [TransactionController::class, 'index01'])->name('transactions');
            Route::get('/transaction-details', [TransactionController::class, 'index02'])->name('transaction-details');
        });

        Route::name('survey.')->prefix('survey')->group(function () {
            // Route::get('/', [CampaignController::class, 'index'])->name('list');

            Route::get('/drafts', [CampaignController::class, 'drafts'])->name('drafts');
            Route::get('/ongoing', [CampaignController::class, 'ongoing'])->name('ongoing');
            Route::get('/past', [CampaignController::class, 'past'])->name('past');

            Route::get('/create', [CampaignController::class, 'create'])->name('create');
            Route::get('/edit/{survey}', function (Survey $survey) {
                return view('pages/campaign/create')->with(['survey' => $survey]);
            })->name('edit');
            Route::get('/{id}', [CampaignController::class, 'view'])->name('view');
            Route::post('/{id}', [CampaignController::class, 'store'])->name('process');
            // Route::get('/{id}/1', [CampaignController::class, 'answer1']);
            // Route::get('/{id}/2', [CampaignController::class, 'answer2']);
            // Route::get('/{id}/3', [CampaignController::class, 'answer3']);
            // Route::get('/{id}/4', [CampaignController::class, 'answer4']);
            // Route::get('/{id}/completed', [CampaignController::class, 'completed']);
        });

        Route::name('template.')->prefix('frameworks')->group(function () {
            Route::get('/', [CampaignController::class, 'viewTemplates'])->name('list');
            Route::get('/use/{id}', [CampaignController::class, 'useTemplate'])->name('use');
        });

        // Route for the getting the data feed
        Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
        Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');
        Route::get('/ecommerce/customers', [CustomerController::class, 'index'])->name('customers');
        Route::get('/ecommerce/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/ecommerce/invoices', [InvoiceController::class, 'index'])->name('invoices');
        Route::get('/ecommerce/shop', function () {
            return view('pages/ecommerce/shop');
        })->name('shop');
        Route::get('/ecommerce/shop-2', function () {
            return view('pages/ecommerce/shop-2');
        })->name('shop-2');
        Route::get('/ecommerce/product', function () {
            return view('pages/ecommerce/product');
        })->name('product');
        Route::get('/ecommerce/cart', function () {
            return view('pages/ecommerce/cart');
        })->name('cart');
        Route::get('/ecommerce/cart-2', function () {
            return view('pages/ecommerce/cart-2');
        })->name('cart-2');
        Route::get('/ecommerce/cart-3', function () {
            return view('pages/ecommerce/cart-3');
        })->name('cart-3');
        Route::get('/ecommerce/pay', function () {
            return view('pages/ecommerce/pay');
        })->name('pay');

        Route::get('/community/users-tabs', [MemberController::class, 'indexTabs'])->name('users-tabs');
        Route::get('/community/users-tiles', [MemberController::class, 'indexTiles'])->name('users-tiles');

        Route::get('/community/forum', function () {
            return view('pages/community/forum');
        })->name('forum');
        Route::get('/community/forum-post', function () {
            return view('pages/community/forum-post');
        })->name('forum-post');

        Route::get('/community/meetups-post', function () {
            return view('pages/community/meetups-post');
        })->name('meetups-post');

        Route::get('/job/job-listing', [JobController::class, 'index'])->name('job-listing');
        Route::get('/job/job-post', function () {
            return view('pages/job/job-post');
        })->name('job-post');
        Route::get('/job/company-profile', function () {
            return view('pages/job/company-profile');
        })->name('company-profile');
        Route::get('/messages', function () {
            return view('pages/messages');
        })->name('messages');
        Route::get('/tasks/kanban', function () {
            return view('pages/tasks/tasks-kanban');
        })->name('tasks-kanban');
        Route::get('/tasks/list', function () {
            return view('pages/tasks/tasks-list');
        })->name('tasks-list');
        Route::get('/inbox', function () {
            return view('pages/inbox');
        })->name('inbox');
        Route::get('/calendar', function () {
            return view('pages/calendar');
        })->name('calendar');
        Route::get('/settings/account', function () {
            return view('pages/settings/account');
        })->name('account');
        Route::get('/settings/notifications', function () {
            return view('pages/settings/notifications');
        })->name('notifications');
        Route::get('/settings/apps', function () {
            return view('pages/settings/apps');
        })->name('apps');
        Route::get('/settings/plans', function (Request $request) {
            $basicPaylink = $request->user()->newSubscription('basic', $monthly = 52314)
                ->returnTo(route('plans'))
                ->create();
            $proPaylink = $request->user()->newSubscription('pro', $monthly = 52319)
                ->returnTo(route('plans'))
                ->create();
            $enterprisePaylink = $request->user()->newSubscription('enterprise', $monthly = 52320)
                ->returnTo(route('plans'))
                ->create();

            return view(
                'pages/settings/plans',
                [
                    'basicPaylink' => $basicPaylink,
                    'proPaylink' => $proPaylink,
                    'enterprisePaylink' => $enterprisePaylink,
                ],
            );
        })->name('plans');
        Route::get('/settings/billing', function () {
            return view('pages/settings/billing');
        })->name('billing');
        Route::get('/settings/feedback', function () {
            return view('pages/settings/feedback');
        })->name('feedback');
        Route::get('/utility/changelog', function () {
            return view('pages/utility/changelog');
        })->name('changelog');
        Route::get('/utility/roadmap', function () {
            return view('pages/utility/roadmap');
        })->name('roadmap');
        Route::get('/utility/faqs', function () {
            return view('pages/utility/faqs');
        })->name('faqs');
        Route::get('/utility/empty-state', function () {
            return view('pages/utility/empty-state');
        })->name('empty-state');
        Route::get('/utility/404', function () {
            return view('pages/utility/404');
        })->name('404');
        Route::get('/utility/knowledge-base', function () {
            return view('pages/utility/knowledge-base');
        })->name('knowledge-base');

        Route::withoutMiddleware(['auth.onboard'])->group(function () {
            Route::get('/finish-onboard', [OnboardController::class, 'finishOnboard'])->name('finish-onboard');
            Route::get('/onboarding-01', function () {
                return view('pages/onboarding-01');
            })->name('onboarding-01');
            Route::get('/onboarding-02', function () {
                return view('pages/onboarding-02');
            })->name('onboarding-02');
            Route::get('/onboarding-03', function () {
                return view('pages/onboarding-03');
            })->name('onboarding-03');
            Route::get('/onboarding-04', function () {
                return view('pages/onboarding-04');
            })->name('onboarding-04');
        });



        Route::get('/component/button', function () {
            return view('pages/component/button-page');
        })->name('button-page');
        Route::get('/component/form', function () {
            return view('pages/component/form-page');
        })->name('form-page');
        Route::get('/component/dropdown', function () {
            return view('pages/component/dropdown-page');
        })->name('dropdown-page');
        Route::get('/component/alert', function () {
            return view('pages/component/alert-page');
        })->name('alert-page');
        Route::get('/component/modal', function () {
            return view('pages/component/modal-page');
        })->name('modal-page');
        Route::get('/component/pagination', function () {
            return view('pages/component/pagination-page');
        })->name('pagination-page');
        Route::get('/component/tabs', function () {
            return view('pages/component/tabs-page');
        })->name('tabs-page');
        Route::get('/component/breadcrumb', function () {
            return view('pages/component/breadcrumb-page');
        })->name('breadcrumb-page');
        Route::get('/component/badge', function () {
            return view('pages/component/badge-page');
        })->name('badge-page');
        Route::get('/component/avatar', function () {
            return view('pages/component/avatar-page');
        })->name('avatar-page');
        Route::get('/component/tooltip', function () {
            return view('pages/component/tooltip-page');
        })->name('tooltip-page');
        Route::get('/component/accordion', function () {
            return view('pages/component/accordion-page');
        })->name('accordion-page');
        Route::get('/component/icons', function () {
            return view('pages/component/icons-page');
        })->name('icons-page');
        Route::fallback(function () {
            return view('pages/utility/404');
        });
    });
});

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {
    Route::post('/login', [TenantApiController::class, 'login']);
    Route::get('/tenant', function (Request $request) {
        return tenant();
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('community', [TenantApiController::class, 'communityList']);
        Route::get('survey/available', [TenantApiController::class, 'availableSurveys']);
        Route::get('survey/completed', [TenantApiController::class, 'completedSurveys']);
        Route::get('survey/{id}', [TenantApiController::class, 'getSurvey']);
        Route::post('survey/{id}', [TenantApiController::class, 'submitSurvey']);
        Route::post('validate-answer', [TenantApiController::class, 'validateAnswer']);

        Route::post('mood/submit', [MoodController::class, 'store']);
        Route::get('mood/timeline', [MoodController::class, 'timeline']);
        Route::get('mood/analytics/weekly', [MoodController::class, 'personalAnalyticsWeekly']);
        Route::get('mood/analytics/monthly', [MoodController::class, 'personalAnalyticsMonthly']);

        Route::post('change-password', [TenantApiController::class, 'changePassword']);
        Route::post('update-profile', [TenantApiController::class, 'updateProfile']);
    });
});
