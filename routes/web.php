<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'forbid-banned-user',], function () {      //раскоменть и бан начнет работать
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['restrictedToDayLight']], function () {

//***************************** Панель администратора ****************************************
            Route::group(['middleware' => 'can:admin-acces'], function () {
                Route::get('/admin', 'AdminController@log_view')->name('admin'); // Главная админка логи
                Route::get('/to_lower_tag', 'OpoController@to_lower_tag')->name('to_lower_tag'); // Перевести теги в нижний регистр

                Route::get('/check_journal_full', 'AdminController@check_journal_full'); // проверка заполненности журналов
                Route::get('/admin/config_safety', 'AdminController@config_edit')->name('config_safety'); // Редактирование конфигурации безопасности
                Route::post('/admin/update_config_safety', 'AdminController@config_update')->name('update_config_safety'); // Сохранение конфигурации безопасности
                Route::get('pdf_logs', 'AdminController@pdf_logs')->name('pdf_logs')->middleware('password.confirm'); // скачать журнал логов
                Route::get('clear_logs', 'AdminController@clear_logs')->name('clear_logs')->middleware('password.confirm'); // очистить журнал логов
                Route::get('admin/ban/{id}', 'AdminController@ban1_user');  //Блокировка пользователя
                Route::get('admin/unban/{id}', 'AdminController@unban_user');  //Разблокировка пользователя
                Route::get('/admin/perm', 'AdminController@perm_view'); //Отображение привелегий
                Route::resource('roles', RoleController::class);    //Работа с ролями
                Route::resource('users', UserController::class);    //Работа с пользователями
            });
            //********************* Смена пароля ****************************************
            Route::get('/change-password', 'ChangePasswordController@index')->name('changepwd');
            Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
            //********************* SUMCHECKER ******************************************
            Route::get('/sumcontroller/get_tree', 'SumCheckerController@get_tree');
            Route::get('/sumcontroller/test', 'SumCheckerController@test');
            Route::get('/sumcontroller/test2', 'SumCheckerController@test_view');
            Route::get('/sumcontroller/get_choiced', 'SumCheckerController@get_choiced');
            Route::post('/sumcontroller/set_paths', 'SumCheckerController@set_paths');
            Route::get('/sumcontroller/cmd', 'SumCheckerController@sumchecker_cmd');
            Route::get('/sumcontroller/get_all_logs', 'SumCheckerController@get_all_logs');
//******************************* Технологический блок ******************************************
            //********************* Главная ***********************************************
            Route::get('/', ['as' => 'gazprom', 'uses' => 'MenuController@view_menu']);
            //********************* Страница ОПО ******************************************
            Route::get('/opo', 'OpoController@view_opo');
            Route::get('/get_status_tb', 'OpoController@get_status_tb');
            Route::get('/get_status_line_kc', 'OpoController@get_status_line_kc');
            Route::get('/get_status_kc', 'OpoController@get_status_kc');
            Route::get('/get_status_do', 'OpoController@get_status_do');
            Route::get('/get_status_tb_kc', 'OpoController@get_status_tb_kc');
            Route::get('/get_status_kran_kc', 'OpoController@get_status_kran_kc');
            Route::get('/get_p_t_kc', 'OpoController@get_p_t_kc');
            Route::get('/get_km', 'OpoController@get_km');
            Route::get('/dataModalWindowMKU/{id_tb}', 'OpoController@dataModalWindowMKU');
            Route::get('/ks', 'OpoController@view_ks');
//            Route::get('/dataModalWindowKC/{id_tb}', 'OpoController@dataModalWindowKC');


//******************************* Документарный блок ******************************************
            //********************* ЖАС ***********************************************
            Route::group(['middleware' => 'can:events-view'], function () {
                Route::get('/jas_full', "JasController@showJas"); // страница Журнала событий полная
                Route::get('/jas_in_top_table', "JasController@jas_in_top_table"); // в маленький журнал данные
                Route::get('/check_new_JAS', "JasController@check_new_JAS"); // проверка новых сообщений
                Route::get('/jas_commit/{id}', "JasController@jas_commit"); // квитировать событие
                Route::get('/jas_new_record', "JasController@jas_new_record"); // создание нового события
                Route::get('/get_tb_for_jas/{type_tb}/{id_obj}', "JasController@get_tb_for_jas"); // создание нового события
                Route::get('/save_comment/{id_record}/{text}', "JasController@save_comment"); // изменение комментария
                Route::post('/save_new_jas', 'JasController@save_new_jas');  //сохранение
            });
            //********************* Справочники ******************************************
            Route::get('/docs/directory_do', 'DirectoryController@show_directory_do');  //Справочник ДО
            Route::get('/docs/directory_do/create', 'DirectoryController@create_do');  //Создание ДО
            Route::post('/docs/directory_do/save', 'DirectoryController@save_do');  //сохранение
            Route::get('/docs/directory_opo', 'DirectoryController@show_directory_opo');  //Справочник ОПО
            Route::get('/docs/directory_opo/create', 'DirectoryController@create_opo');  //Создание ОПО
            Route::post('/docs/directory_opo/save', 'DirectoryController@save_opo');  //сохранение
            Route::get('/docs/directory_opo/edit/{id_opo}', 'DirectoryController@edit_opo');  //обновление
            Route::post('/docs/directory_opo/update/{id_opo}', 'DirectoryController@update_opo');  //сохранение изменений

            Route::get('/docs/directory_obj', 'DirectoryController@show_directory_obj');  //Справочник элементов ОПО
            Route::get('/docs/directory_obj/create', 'DirectoryController@create_obj');  //Создание ОПО
            Route::get('/get_do/{id_do}', 'DirectoryController@get_do');  //получить ОПО по ДО
            Route::post('/docs/directory_obj/save', 'DirectoryController@save_obj');  //сохранение
            Route::get('/docs/directory_obj/edit/{id_obj}', 'DirectoryController@edit_obj');  //обновление
            Route::post('/docs/directory_obj/update/{id_obj}', 'DirectoryController@update_obj');  //сохранение изменений

            Route::get('/docs/directory_tb', 'DirectoryController@show_directory_tb');  //Справочник ТБ элементов ОПО
            Route::get('/docs/directory_tb/edit/{id_tb}', 'DirectoryController@edit_directory_tb');  //изменение ТБ элементов ОПО
            Route::post('/docs/directory_tb/update/{type_tb}/{id_tb}', 'DirectoryController@update_tb');  //обновление
            Route::get('/docs/directory_tb/create', 'DirectoryController@create_tb');  //создание
            Route::get('/get_obj/{id_opo}', 'DirectoryController@get_obj');  //получить элементы ОПО
            Route::get('/get_typetb/{id_obj}', 'DirectoryController@get_typetb');  //получить типы ТБ
            Route::get('/get_tb/{type_tb}', 'DirectoryController@get_tb');  //получение строк для создания
            Route::post('/docs/directory_tb/save/{type_tb}', 'DirectoryController@save_tb');  //сохранение

            //********************* Отчеты ***********************************************
            Route::get('/docs', 'ReportController@index');  //главная страница

            Route::get('/docs/result_apk', 'ReportController@result_apk');  //Результаты АПК, корпоративного контроля и государственного надзора
            Route::get('/docs/get_result_apk/{year}', 'ReportController@get_result_apk');  //данные
            Route::get('/docs/result_apk/create', 'ReportController@create_result_apk');  //создание
            Route::post('/docs/result_apk/save', 'ReportController@save_result_apk');  //сохранение
            Route::get('/docs/result_apk/remove/{id}', 'ReportController@remove_result_apk');  //удаление
            Route::get('/docs/result_apk/edit/{id}', 'ReportController@edit_result_apk');  //обновление
            Route::post('/docs/result_apk/update/{id}', 'ReportController@update_result_apk');  //сохранение изменений

            Route::get('/docs/kipd_internal_checks', 'ReportController@kipd_internal_checks');  //План корректирующих действий ПБ по внутренним проверкам
            Route::get('/docs/get_kipd_internal_checks/{year}', 'ReportController@get_kipd_internal_checks');  //данные
            Route::get('/docs/kipd_internal_checks/remove/{id}', 'ReportController@remove_kipd_internal_checks');  //удаление
            Route::get('/docs/kipd_internal_checks/checked/{id}', 'ReportController@checked_kipd_internal_checks');  //не учитывать в обсчете
            Route::get('/docs/kipd_internal_checks/create', 'ReportController@create_kipd_internal_checks');  //создание
            Route::post('/docs/kipd_internal_checks/save', 'ReportController@save_kipd_internal_checks');  //сохранение
            Route::get('/docs/kipd_internal_checks/edit/{id}', 'ReportController@edit_kipd_internal_checks');  //обновление
            Route::post('/docs/kipd_internal_checks/update/{id}', 'ReportController@update_kipd_internal_checks');  //сохранение изменений

            Route::get('/docs/perfomance_plan_KiPD', 'ReportController@perfomance_plan_KiPD');  //Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::get('/docs/get_perfomance_plan_KiPD/{year}', 'ReportController@get_perfomance_plan_KiPD');  //данные
            Route::get('/docs/perfomance_plan_KiPD/create', 'ReportController@create_perfomance_plan_KiPD');  //создание
            Route::post('/docs/perfomance_plan_KiPD/save', 'ReportController@save_perfomance_plan_KiPD');  //сохранение
            Route::get('/docs/perfomance_plan_KiPD/remove/{id}', 'ReportController@remove_perfomance_plan_KiPD');  //удаление
            Route::get('/docs/perfomance_plan_KiPD/edit/{id}', 'ReportController@edit_perfomance_plan_KiPD');  //обновление
            Route::post('/docs/perfomance_plan_KiPD/update/{id}', 'ReportController@update_perfomance_plan_KiPD');  //сохранение изменений

            Route::get('/docs/actual_declarations', 'ReportController@actual_declarations');  //Реестр актуальных деклараций ПБ
            Route::get('/docs/actual_declarations/create', 'ReportController@create_actual_declarations');  //создание
            Route::post('/docs/actual_declarations/save', 'ReportController@save_actual_declarations');  //сохранение
            Route::get('/docs/actual_declarations/remove/{id}', 'ReportController@remove_actual_declarations');  //удаление
            Route::get('/docs/actual_declarations/edit/{id}', 'ReportController@edit_actual_declarations');  //обновление
            Route::post('/docs/actual_declarations/update/{id}', 'ReportController@update_actual_declarations');  //сохранение изменений
            Route::get('/docs/actual_declarations/get_params/{year}', 'ReportController@get_actual_declarations');  //за год

            Route::get('/docs/sved_avar', 'ReportController@sved_avar');  //Сведения об аварийности на опасных производственных объектах ДО
            Route::get('/docs/get_sved_avar/{year}', 'ReportController@get_sved_avar');  //данные
            Route::get('/docs/sved_avar/create', 'ReportController@create_sved_avar');  //создание
            Route::post('/docs/sved_avar/save', 'ReportController@save_sved_avar');  //сохранение
            Route::get('/docs/sved_avar/remove/{id}', 'ReportController@remove_sved_avar');  //удаление
            Route::get('/docs/sved_avar/edit/{id}', 'ReportController@edit_sved_avar');  //обновление
            Route::post('/docs/sved_avar/update/{id}', 'ReportController@update_sved_avar');  //сохранение изменений

            Route::get('/docs/plan_industrial_safety', 'ReportController@plan_industrial_safety');  //Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/docs/get_plan_industrial_safety/{year}', 'ReportController@get_plan_industrial_safety');  //Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/docs/plan_industrial_safety/create', 'ReportController@create_plan_industrial_safety');  //создание
            Route::post('/docs/plan_industrial_safety/save', 'ReportController@save_plan_industrial_safety');  //сохранение
            Route::get('/docs/plan_industrial_safety/remove/{id}', 'ReportController@remove_plan_industrial_safety');  //удаление
            Route::get('/docs/plan_industrial_safety/edit/{id}', 'ReportController@edit_plan_industrial_safety');  //обновление
            Route::post('/docs/plan_industrial_safety/update/{id}', 'ReportController@update_plan_industrial_safety');  //сохранение изменений
            Route::get('/docs/plan_industrial_safety/get_params/{year}', 'ReportController@get_plan_industrial_safety');  //обновление

            Route::get('/docs/goals_trans_yugorsk', 'ReportController@goals_trans_yugorsk');  //Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности
            Route::get('/docs/goals_trans_yugorsk/create', 'ReportController@create_goals_trans_yugorsk');  //создание
            Route::post('/docs/goals_trans_yugorsk/save', 'ReportController@save_goals_trans_yugorsk');  //сохранение
            Route::get('/docs/goals_trans_yugorsk/remove/{id}', 'ReportController@remove_goals_trans_yugorsk');  //удаление
            Route::get('/docs/goals_trans_yugorsk/edit/{id}', 'ReportController@edit_goals_trans_yugorsk');  //обновление
            Route::post('/docs/goals_trans_yugorsk/update/{id}', 'ReportController@update_goals_trans_yugorsk');  //сохранение изменений
            Route::get('/docs/goals_trans_yugorsk/get_params/{year}', 'ReportController@get_goals_trans_yugorsk');  //выборка за выбранный год

            Route::get('/docs/emergency_drills', 'ReportController@emergency_drills');  //Сведения о противоаварийных тренировках, проведенных на опасных производственных объектах
            Route::get('/docs/emergency_drills/create', 'ReportController@create_emergency_drills');  //создание
            Route::post('/docs/emergency_drills/save', 'ReportController@save_emergency_drills');  //сохранение
            Route::get('/docs/emergency_drills/remove/{id}', 'ReportController@remove_emergency_drills');  //удаление
            Route::get('/docs/emergency_drills/edit/{id}', 'ReportController@edit_emergency_drills');  //обновление
            Route::post('/docs/emergency_drills/update/{id}', 'ReportController@update_emergency_drills');  //сохранение изменений
            Route::get('/docs/emergency_drills/get_params/{year}', 'ReportController@get_emergency_drills');  //выборка за выбранный год

            Route::get('/docs/open_kr_dtoip', 'ReportController@open_kr_dtoip');  //Сведения о выполнении графика КР и ДТОиР ОПО
            Route::post('/docs/save_kr_dtoip/{year}', 'ReportController@save_kr_dtoip');  //сохранение
            Route::get('/docs/get_kr_dtoip/{year}', 'ReportController@get_kr_dtoip');  //сохранение
            Route::get('/uncheck_kr_dtoip/{num_pp}/{year}', 'ReportController@uncheck_kr_dtoip');  //убрать из обсчета

            Route::get('/docs/report_events', 'ReportController@show_report_events');  // Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за _____________20_____ года
            Route::get('/docs/report_events/get_params/{year}', 'ReportController@get_report_events_year');  // выборка за год
            Route::get('/docs/report_events/create', 'ReportController@create_report_events');  // страница создания записи
            Route::post('/docs/report_events/save', 'ReportController@save_report_events');  //сохранение
            Route::get('/docs/report_events/remove/{id}', 'ReportController@remove_report_events');  //удаление
            Route::get('/docs/report_events/edit/{id}', 'ReportController@edit_report_events');  //обновление
            Route::post('/docs/report_events/update/{id}', 'ReportController@update_report_events');  //сохранение изменений

            Route::get('/docs/events', 'ReportController@show_events');  // Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за _____________20_____ года
            Route::get('/docs/events/get_params/{year}', 'ReportController@get_events');  // выборка за год
            Route::get('/docs/events/create', 'ReportController@create_events');  // страница создания записи
            Route::post('/docs/events/save', 'ReportController@save_events');  //сохранение
            Route::get('/docs/events/remove/{id}', 'ReportController@remove_events');  //удаление
            Route::get('/docs/events/edit/{id}', 'ReportController@edit_events');  //обновление
            Route::post('/docs/events/update/{id}', 'ReportController@update_events');  //сохранение изменений

            Route::get('/docs/pat_themes', 'ReportController@show_pat_themes');  //перечень тем ПАТ
            Route::get('/docs/pat_themes/create', 'ReportController@create_pat_themes');  //создание ПАТ
            Route::post('/docs/pat_themes/save', 'ReportController@save_pat_themes');  //сохранить новую тему ПАТ
            Route::get('/docs/pat_themes/edit/{id}', 'ReportController@edit_pat_themes');  //редактирование темы ПАТ
            Route::post('/docs/pat_themes/update/{id}', 'ReportController@update_pat_themes');  //сохранение измененной темы ПАТ

            Route::get('/docs/plan_of_industrial_safety', 'ReportController@show_plan_of_industrial_safety');  // План работ в области промышленной безопасности
            Route::get('/docs/plan_of_industrial_safety/get_params/{year}', 'ReportController@get_plan_of_industrial_safety');  // выборка за год
            Route::get('/docs/plan_of_industrial_safety/create', 'ReportController@create_plan_of_industrial_safety');  // страница создания записи
            Route::post('/docs/plan_of_industrial_safety/save', 'ReportController@save_plan_of_industrial_safety');  //сохранение
            Route::get('/docs/plan_of_industrial_safety/remove/{id}', 'ReportController@remove_plan_of_industrial_safety');  //удаление
            Route::get('/docs/plan_of_industrial_safety/edit/{id}', 'ReportController@edit_plan_of_industrial_safety');  //обновление
            Route::post('/docs/plan_of_industrial_safety/update/{id}', 'ReportController@update_plan_of_industrial_safety');  //сохранение изменений


            Route::get('/docs/conclusions_industrial_safety', 'ReportController@show_conclusions_industrial_safety');  // План работ в области промышленной безопасности
            Route::get('/docs/conclusions_industrial_safety/get_params/{year}', 'ReportController@get_conclusions_industrial_safety');  // выборка за год
            Route::get('/docs/conclusions_industrial_safety/create', 'ReportController@create_conclusions_industrial_safety');  // страница создания записи
            Route::post('/docs/conclusions_industrial_safety/save', 'ReportController@save_conclusions_industrial_safety');  //сохранение
            Route::get('/docs/conclusions_industrial_safety/remove/{id}', 'ReportController@remove_conclusions_industrial_safety');  //удаление
            Route::get('/docs/conclusions_industrial_safety/edit/{id}', 'ReportController@edit_conclusions_industrial_safety');  //обновление
            Route::post('/docs/conclusions_industrial_safety/update/{id}', 'ReportController@update_conclusions_industrial_safety');  //сохранение изменений

            Route::get('/docs/fulfillment_certification', 'ReportController@show_fulfillment_certification');  // План работ в области промышленной безопасности
            Route::get('/docs/fulfillment_certification/get_params/{year}', 'ReportController@get_fulfillment_certification');  // выборка за год
            Route::get('/docs/fulfillment_certification/create', 'ReportController@create_fulfillment_certification');  // страница создания записи
            Route::post('/docs/fulfillment_certification/save', 'ReportController@save_fulfillment_certification');  //сохранение
            Route::get('/docs/fulfillment_certification/remove/{id}', 'ReportController@remove_fulfillment_certification');  //удаление
            Route::get('/docs/fulfillment_certification/edit/{id}', 'ReportController@edit_fulfillment_certification');  //обновление
            Route::post('/docs/fulfillment_certification/update/{id}', 'ReportController@update_fulfillment_certification');  //сохранение изменений

            Route::get('/docs/pat_schedule', 'ReportController@show_pat_schedule');  // План работ в области промышленной безопасности
            Route::get('/docs/pat_schedule/get_params/{year}', 'ReportController@get_pat_schedule');  // выборка за год
            Route::get('/docs/pat_schedule/create', 'ReportController@create_pat_schedule');  // страница создания записи
            Route::post('/docs/pat_schedule/save', 'ReportController@save_pat_schedule');  //сохранение
            Route::get('/docs/pat_schedule/remove/{id}', 'ReportController@remove_pat_schedule');  //удаление
            Route::get('/docs/pat_schedule/edit/{id}', 'ReportController@edit_pat_schedule');  //обновление
            Route::post('/docs/pat_schedule/update/{id}', 'ReportController@update_pat_schedule');  //сохранение изменений

///////////************** Расчеты в крон **************************************/////////////////////////
            Route::get('/update_kipd_internal_checks', 'MathController@update_kipd_internal_checks'); //Обновление План корректирующих действий ПБ по внутренним проверкам
            Route::get('/update_perfomance_plan_KiPD', 'MathController@update_perfomance_plan_KiPD'); //Обновление Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::get('/update_plan_industrial_safety', 'MathController@update_plan_industrial_safety'); //Обновление Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/update_goals_trans_yugorsk', 'MathController@update_goals_trans_yugorsk'); //Обновление Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности

            Route::get('/create_record_indicator', 'MathController@create_record_indicator'); //Создание записи в таблицу с результатами
            Route::get('/get_indicator/{year}', 'MathController@get_indicator'); //получение данных с таблицы с результатами

///////////************** Отчеты PDF **************************************/////////////////////////
            Route::get('/pdf_actual_declarations/{year}', 'PdfReportController@pdf_actual_declarations');     // скачать реестр актуальных деклараций
            Route::get('/pdf_emergency_drills/{year}', 'PdfReportController@pdf_emergency_drills');     // скачать сведения о противоаварийных тренировках, проведенных на опасных производственных объектах в 20__ году
            Route::get('/pdf_goals_trans_yugorsk/{year}', 'PdfReportController@pdf_goals_trans_yugorsk');     // скачать Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности на 20__ год
            Route::get('/pdf_perfomance_plan_KiPD/{year}', 'PdfReportController@pdf_perfomance_plan_KiPD');     // скачать Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::get('/pdf_plan_industrial_safety/{year}', 'PdfReportController@pdf_plan_industrial_safety');     // скачать Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/pdf_kipd_internal_checks/{year}', 'PdfReportController@pdf_kipd_internal_checks');     // скачать План корректирующих действий ПБ по внутренним проверкам за
            Route::get('/pdf_result_apk/{year}/{type}', 'PdfReportController@pdf_result_apk');     // скачать Результаты АПК, корпоративного контроля и государственного надзора
            Route::get('/pdf_sved_avar/{year}', 'PdfReportController@pdf_sved_avar');     // скачать Сведения об аварийности на опасных производственных объектах дочернего общества за
            Route::get('/pdf_report_events/{year}', 'PdfReportController@pdf_report_events');     // скачать Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
            Route::get('/pdf_events/{year}', 'PdfReportController@pdf_events');     // скачать Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
            Route::get('/pdf_kr_dtoip/{year}', 'PdfReportController@pdf_kr_dtoip');  //скачать КР ДТОиР ОПО
            Route::get('/pdf_plan_of_industrial_safety/{year}', 'PdfReportController@pdf_plan_of_industrial_safety');     // скачать план работ в области ПБ
            Route::get('/pdf_pat_schedule/{year}', 'PdfReportController@pdf_pat_schedule');     // скачать График комплексных противоаварийных тренировок

///////////************** Отчеты Excel **************************************/////////////////////////
            Route::get('/excel_conclusions_industrial_safety/{year}', 'ExcelReportController@excel_conclusions_industrial_safety');
            Route::get('/excel_events/{year}', 'ExcelReportController@excel_events');
            Route::get('/excel_fulfillment_certification/{year}', 'ExcelReportController@excel_fulfillment_certification');
            Route::get('/excel_pat_schedule/{year}', 'ExcelReportController@excel_pat_schedule');
            Route::get('/excel_plan_of_industrial_safety/{year}', 'ExcelReportController@excel_plan_of_industrial_safety');
            Route::get('/excel_actual_declarations/{year}', 'ExcelReportController@excel_actual_declarations');
            Route::get('/excel_emergency_drills/{year}', 'ExcelReportController@excel_emergency_drills');     // скачать сведения о противоаварийных тренировках, проведенных на опасных производственных объектах в 20__ году
            Route::get('/excel_report_events/{year}', 'ExcelReportController@excel_report_events');     // скачать Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
            Route::get('/excel_goals_trans_yugorsk/{year}', 'ExcelReportController@excel_goals_trans_yugorsk');     // скачать Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности на 20__ год
            Route::get('/excel_kipd_internal_checks/{year}', 'ExcelReportController@excel_kipd_internal_checks');     // скачать План корректирующих действий ПБ по внутренним проверкам за
            Route::get('/excel_kr_dtoip/{year}', 'ExcelReportController@excel_kr_dtoip');  //скачать КР ДТОиР ОПО
            Route::get('/excel_perfomance_plan_KiPD/{year}', 'ExcelReportController@excel_perfomance_plan_KiPD');     // скачать Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::get('/excel_plan_industrial_safety/{year}', 'ExcelReportController@excel_plan_industrial_safety');     // скачать Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/excel_result_apk/{year}', 'ExcelReportController@excel_result_apk');     // скачать Результаты АПК, корпоративного контроля и государственного надзора
            Route::get('/excel_sved_avar/{year}', 'ExcelReportController@excel_sved_avar');     // скачать Сведения об аварийности на опасных производственных объектах дочернего общества за


///////////************** Нормативно-справочная информация **************************************/////////////////////////
            Route::get('/docs/abbrev', 'ReferenceInformationController@show_abbrev');  //таблица сокращений
            Route::get('/docs/abbrev/create', 'ReferenceInformationController@create_abbrev');  //создание сокращений
            Route::post('/docs/abbrev/save', 'ReferenceInformationController@save_abbrev');  //сохранить новое сокращение

            Route::get('/docs/incidents', 'ReferenceInformationController@show_incidents');  //таблица аварий, инцидентов и предпоссылок к ним
            Route::get('/docs/incidents/get_params/', 'ReferenceInformationController@get_incidents');  //данные для отображения
            Route::get('/docs/incidents/create', 'ReferenceInformationController@create_incidents');  //создание вида аварий/инцидентов/предпосылок
            Route::post('/docs/incidents/save', 'ReferenceInformationController@save_incidents');  //сохранить новый вид аварии/инцидента/предпосылки

            Route::get('/docs/implications', 'ReferenceInformationController@show_implications');  //таблица последствий техногенных событий
            Route::get('/docs/danger_signs', 'ReferenceInformationController@show_danger_signs');  // Cправочник признаков опасности опасных производственных объектов
            Route::get('/docs/danger_classes', 'ReferenceInformationController@show_danger_classes');  // Cправочник классов опасности опасных производственных объектов
            Route::get('/docs/type_of_hazards', 'ReferenceInformationController@show_type_of_hazards');  // Cправочник видов опасных веществ

            Route::get('/docs/norm_document', ['as' => 'show_files', 'uses' => 'UploadFilesController@show_files']);  //таблица со всеми pdf
            Route::get('/docs/norm_document_open/{id}', ['as' => 'open_files', 'uses' => 'UploadFilesController@open_files']);  //открыть файл
            Route::get('/docs/norm_document_delete/{id}', ['as' => 'delete_file', 'uses' => 'UploadFilesController@delete_file']);  //открыть файл
            Route::post('/docs/upload', ['as' => 'upload_file', 'uses' => 'UploadFilesController@save_file']); //загрузить файл


        });
    });
});
//*******************************************
Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});








