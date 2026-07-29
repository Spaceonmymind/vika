<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\AppointmentToDoctorWidget\Http\Middleware\CheckMaxDataValid;
use Modules\Chat\Http\Controllers\AdminChatController;
use Modules\Chat\Http\Controllers\AdminIntentController;
use Modules\Chat\Http\Controllers\AdminIntentStatisticController;
use Modules\Chat\Http\Controllers\AdminVikaTypeController;
use Modules\Chat\Http\Controllers\AdminWidgetController;
use Modules\Chat\Http\Controllers\AdminWidgetsStatisticController;
use Modules\Chat\Http\Controllers\ChatController;
use Modules\Chat\Http\Controllers\MaxController;
use Modules\Chat\Http\Controllers\TelegramBotController;
use Modules\Chat\Http\Middleware\CheckSubscriptionNotificationToken;
use Modules\Chat\Http\Middleware\InsertUserIdIntoRequest;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('chat')
    ->group(function () {
        Route::controller(ChatController::class)->group(function () {

            Route::middleware([InsertUserIdIntoRequest::class])
                ->group(function () {
                    Route::get('get_history', 'getChatMessages');
                    Route::get('get_widgets', 'getWidgetsList');
                    Route::post('send_message', 'handleIncomingMessage');
                    Route::get('update_widgets_table', 'updateAndGetWidgetsList');
                    Route::get('get_chat_hints', 'getChatHints');
                });

            Route::prefix('widget/{widget:code_name}')->group(function () {
                Route::any('get_by_code', 'getWidgetInfoByCode')->missing(function (Request $request) {
                    throw new ModelNotFoundException('Виджет с кодом ' . $request->route('widget') . ' не найден');
                });
            });

            Route::post('safe_widget_hit', 'createWidgetUsageRecord');
            Route::any('get_vika_type_by_resource', 'getVikaTypeByResourceUrl');
        });

    });


/*===============================================*
*              Роуты админки                     *
*================================================*/
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin/chat')->group(function () {

        Route::middleware('permission:administrate_chat|administrate_ai')->group(function () {

            Route::prefix('intents')->group(function () {

                Route::any('list', [AdminIntentController::class, 'getIntents']);
            });

        });
        Route::middleware('permission:administrate_ai')->group(function () {

            Route::prefix('intents')->group(function () {
                Route::post('create', [AdminIntentController::class, 'createIntent']);
                Route::prefix('{chatIntent}')->whereNumber(['intent'])->group(function () {
                    Route::any('get', [AdminIntentController::class, 'getIntent']);
                    Route::post('update', [AdminIntentController::class, 'updateIntent']);
                    Route::post('delete', [AdminIntentController::class, 'deleteIntent']);
                    Route::any('get_recommendations', [AdminIntentController::class, 'getRecommendedTestRequests']);
                    Route::post('test_requests/create', [AdminIntentController::class, 'addTestRequest']);
                    Route::any('test_requests/can_create', [AdminIntentController::class, 'canAddTestRequest']);
                });

                Route::post('/test_requests/{testRequest}/delete', [AdminIntentController::class, 'deleteTestRequest'])
                    ->whereNumber(['testRequest']);

                Route::any('get_plot', [AdminIntentController::class, 'getPlot']);
                Route::any('test', [AdminIntentController::class, 'testMessage']);
                Route::any('test_llm', [AdminIntentController::class, 'testLLMPrompt']);

                Route::any('get_handlers', [AdminIntentController::class, 'getIntentHandlers']);

            });

        });

        Route::middleware('permission:administrate_chat|administrate_ai|administrate_vika_types|get_intents_statistic')->group(function () {

            Route::prefix('vika_types')->group(function () {
                Route::any('list', [AdminVikaTypeController::class, 'getVikaTypes']);
            });

        });

        Route::middleware('permission:administrate_chat|administrate_vika_types|administrate_widgets|get_intents_statistic')->group(function () {

            Route::prefix('widgets')->group(function () {
                Route::any('list', [AdminWidgetController::class, 'getWidgets']);
            });

        });

        Route::middleware('permission:administrate_widgets')->group(function () {

            Route::prefix('widgets')->group(function () {
                Route::post('create', [AdminWidgetController::class, 'createWidget']);

                Route::prefix('{chatWidget}')->whereNumber(['widget'])->group(function () {

                    Route::any('get', [AdminWidgetController::class, 'getWidget']);
                    Route::post('update', [AdminWidgetController::class, 'updateWidget']);
                    Route::post('delete', [AdminWidgetController::class, 'deleteWidget']);

                });
            });

        });

        Route::middleware('permission:administrate_vika_types|administrate_widgets')->group(function () {

            Route::prefix('widgets')->group(function () {

                Route::any('get_types', [AdminWidgetController::class, 'getWidgetTypes']);
                Route::any('get_icons', [AdminWidgetController::class, 'getIcons']);

                Route::prefix('attaching')->group(function () {
                    Route::post('create', [AdminWidgetController::class, 'addWidgetToVikaType']);
                    Route::prefix('{attachedToVikaTypeWidget}')->whereNumber(['attachedWidget'])->group(function () {
                        Route::post('update', [AdminWidgetController::class, 'updateAttachedToVikaTypeWidget']);
                        Route::post('delete', [AdminWidgetController::class, 'deleteAttachedToVikaTypeWidget']);
                    });
                });

                Route::prefix('categories')->group(function () {
                    Route::prefix('{chatWidgetCategory}')->whereNumber(['chatWidgetCategory'])->group(function () {
                        Route::post('update', [AdminWidgetController::class, 'updateWidgetCategory']);
                        Route::post('delete', [AdminWidgetController::class, 'deleteWidgetCategory']);
                    });
                });


            });

            Route::prefix('vika_types')->group(function () {

                Route::prefix('{vikaType}')->whereNumber(['vikaType'])->group(function () {
                    Route::any('get_menu', [AdminVikaTypeController::class, 'getVikaTypeWidgetMenu']);
                    Route::post('add_widget_category', [AdminWidgetController::class, 'addWidgetCategoryToVikaType']);
                    Route::any('get_widget_categories', [AdminWidgetController::class, 'getVikaTypeWidgetCategories']);
                });

            });
        });

        Route::middleware('permission:administrate_vika_types')->group(function () {

            Route::prefix('vika_types')->group(function () {
                Route::post('create', [AdminVikaTypeController::class, 'createVikaType']);

                Route::prefix('{vikaType}')->whereNumber(['vikaType'])->group(function () {

                    Route::any('get', [AdminVikaTypeController::class, 'getVikaType']);
                    Route::post('update', [AdminVikaTypeController::class, 'updateVikaType']);
                    Route::post('delete', [AdminVikaTypeController::class, 'deleteVikaType']);

                });
            });

        });

        Route::middleware('permission:administrate_chat')->group(function () {

            Route::prefix('button_types')->group(function () {
                Route::any('list', [AdminChatController::class, 'getAnswerButtonTypes']);
            });

            Route::prefix('answers')->group(function () {
                Route::any('list', [AdminChatController::class, 'getAnswers']);
                Route::post('create', [AdminChatController::class, 'createAnswer']);

                Route::prefix('{answer}')->whereNumber(['answer'])->group(function () {
                    Route::any('get', [AdminChatController::class, 'getAnswer']);
                    Route::post('update', [AdminChatController::class, 'updateAnswer']);
                    Route::post('delete', [AdminChatController::class, 'deleteAnswer']);
                });
            });
        });

        Route::middleware('permission:administrate_widgets_statistic')->group(function () {

            Route::prefix('widgets/statistic')->group(function () {
                Route::any('summary', [AdminWidgetsStatisticController::class, 'getWidgetsStatisticByPeriod']);
                Route::any('export_summary', [AdminWidgetsStatisticController::class, 'exportWidgetsStatisticByPeriod']);
                Route::get('{widget}', [AdminWidgetsStatisticController::class, 'getWidgetStatisticByPeriodAndId'])
                    ->whereNumber(['widget']);
            });

        });

        Route::middleware('permission:get_intents_statistic')->group(function () {

            Route::prefix('intents/statistic')->group(function () {
                Route::any('get_top', [AdminIntentStatisticController::class, 'getTopIntents']);
                Route::any('export_top', [AdminIntentStatisticController::class, 'exportTopIntents']);
                Route::any('get_history', [AdminIntentStatisticController::class, 'getIntentsHistoryRecords']);
                Route::any('export_history', [AdminIntentStatisticController::class, 'exportIntentsHistoryRecords']);
                Route::any('get_intent_statistic', [AdminIntentStatisticController::class, 'getIntentStatisticByDays']);
            });

        });
    });
});

//smee -u https://smee.io/j4r03DrLwvEVkcM --target http://vi.local/api/telegram/webhook
Route::post('/telegram/webhook', [TelegramBotController::class, 'webhook']);

//smee -u https://smee.io/s1A4XllmxEiLGgb --target http://vi.local/api/max/webhook
Route::prefix('max')->group(function () {
    Route::get('{urlId}/get_widget', [MaxController::class, 'getWidgetFromMax']);
    Route::post('webhook', [MaxController::class, 'webhook']);

    Route::middleware([CheckSubscriptionNotificationToken::class])->group(function () {
        Route::post('send_notification', [MaxController::class, 'sendAppointmentNotificationToMax']);
    });

    Route::get('get_subscription_event_types', [MaxController::class, 'getSubscriptionEventTypes']);
    Route::get('get_subscription_weather_school_class_ranges', [MaxController::class, 'getSubscriptionSchoolClassRanges']);

    Route::middleware([CheckMaxDataValid::class])->group(function () {
        Route::post('get_subscriptions', [MaxController::class, 'getUserSubscriptions']);
        Route::post('subscribe', [MaxController::class, 'createSubscription']);
        Route::post('unsubscribe', [MaxController::class, 'deleteSubscription']);
    });

});
