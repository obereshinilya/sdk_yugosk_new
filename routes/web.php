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
            Route::get('/new_jas_main', 'OpoController@new_jas_main');
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
                Route::get('/get_jas/{start}/{end}', "JasController@get_jas_date"); // жас за определенный период
                Route::get('/get_tb/{name}', "JasController@get_tb"); // редирект со страницы жаса

            });
            //********************* Справочники ******************************************
            Route::get('/docs/directory_do', 'DirectoryController@show_directory_do');  //Справочник ДО
            Route::get('/docs/directory_do/create', 'DirectoryController@create_do');  //Создание ДО
            Route::post('/docs/directory_do/save', 'DirectoryController@save_do');  //сохранение
            Route::get('/docs/directory_do/edit/{id_do}', 'DirectoryController@edit_do');  //обновление
            Route::post('/docs/directory_do/update/{id_do}', 'DirectoryController@update_do');  //сохранение изменений
            Route::get('/docs/directory_do/show/{id_do}', 'DirectoryController@show_do');  //просмотр
            Route::post('/docs/get_do_data', 'DirectoryController@get_do_data')->name('get_do_data');  //Справочник ДО


            Route::get('/docs/directory_opo', 'DirectoryController@show_directory_opo');  //Справочник ОПО
            Route::get('/docs/directory_opo/create', 'DirectoryController@create_opo');  //Создание ОПО
            Route::post('/docs/directory_opo/save', 'DirectoryController@save_opo');  //сохранение
            Route::get('/docs/directory_opo/edit/{id_opo}', 'DirectoryController@edit_opo');  //обновление
            Route::post('/docs/directory_opo/update/{id_opo}', 'DirectoryController@update_opo');  //сохранение изменений
            Route::get('/docs/directory_opo/show/{id_opo}', 'DirectoryController@show_opo');  //обновление
            Route::post('/docs/get_opo_data', 'DirectoryController@get_opo_data')->name('get_opo_data');  //Справочник ОПО

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

            Route::get('/docs/opo', 'OPOintelligenceController@opo');  //Сведения, характеризующие ОПО
            Route::get('/docs/edit_intelligence_opo/{id_add_info_opo}', 'OPOintelligenceController@edit_intelligence');  //Изменение сведений, характеризующих ОПО
            Route::get('/docs/create_intelligence_opo', 'OPOintelligenceController@create_intelligence');  //Добавление сведений, характеризующих ОПО
            Route::post('/docs/intelligence_opo/save', 'OPOintelligenceController@save_add_composition_opo');  //сохранение
            Route::post('/docs/intelligence_opo/save_part', 'OPOintelligenceController@save_part_opo');  //сохранение
            Route::get('/docs/intelligence_opo/get_part/{id_opo}', 'OPOintelligenceController@get_part_opo');  //сохранение
            Route::get('/docs/intelligence_opo/delete_part/{id}', 'OPOintelligenceController@delete_part_opo');  //сохранение
            Route::get('/docs/intelligence_opo/delete_all/{id}', 'OPOintelligenceController@delete_all');  //сохранение
            Route::post('/docs/intelligence_opo/update/{id_add_info_opo}', 'OPOintelligenceController@update_intelligence_opo');  //сохранение изменений
            Route::get('/docs/show_intelligence_opo/{id_add_info_opo}', 'OPOintelligenceController@show_intelligence_opo');  //просмотр

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
            Route::post('/docs/get_kipd_internal_checks', 'ReportController@get_kipd_internal_checks');  //данные
            Route::get('/docs/kipd_internal_checks/remove/{id}', 'ReportController@remove_kipd_internal_checks');  //удаление
            Route::get('/docs/kipd_internal_checks/checked/{id}', 'ReportController@checked_kipd_internal_checks');  //не учитывать в обсчете
            Route::get('/docs/kipd_internal_checks/create', 'ReportController@create_kipd_internal_checks');  //создание
            Route::post('/docs/kipd_internal_checks/save', 'ReportController@save_kipd_internal_checks');  //сохранение
            Route::get('/docs/kipd_internal_checks/edit/{id}', 'ReportController@edit_kipd_internal_checks');  //обновление
            Route::post('/docs/kipd_internal_checks/update/{id}', 'ReportController@update_kipd_internal_checks');  //сохранение изменений

            Route::get('/docs/perfomance_plan_KiPD', 'ReportController@perfomance_plan_KiPD');  //Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::post('/docs/get_perfomance_plan_KiPD', 'ReportController@get_perfomance_plan_KiPD');  //данные
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
            Route::post('/docs/actual_declarations/get_params', 'ReportController@get_actual_declarations');  //за год

            Route::get('/docs/sved_avar', 'ReportController@sved_avar');  //Сведения об аварийности на опасных производственных объектах ДО
            Route::get('/docs/get_sved_avar/{year}/{year_end}', 'ReportController@get_sved_avar');  //данные
            Route::get('/docs/sved_avar/create', 'ReportController@create_sved_avar');  //создание
            Route::post('/docs/sved_avar/save', 'ReportController@save_sved_avar');  //сохранение
            Route::get('/docs/sved_avar/remove/{id}', 'ReportController@remove_sved_avar');  //удаление
            Route::get('/docs/sved_avar/edit/{id}', 'ReportController@edit_sved_avar');  //обновление
            Route::post('/docs/sved_avar/update/{id}', 'ReportController@update_sved_avar');  //сохранение изменений

            Route::get('/docs/plan_industrial_safety', 'ReportController@plan_industrial_safety');  //Сведения о выполнении плана работ в области промышленной безопасности
            Route::post('/docs/get_plan_industrial_safety', 'ReportController@get_plan_industrial_safety');  //Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/docs/plan_industrial_safety/create', 'ReportController@create_plan_industrial_safety');  //создание
            Route::post('/docs/plan_industrial_safety/save', 'ReportController@save_plan_industrial_safety');  //сохранение
            Route::get('/docs/plan_industrial_safety/remove/{id}', 'ReportController@remove_plan_industrial_safety');  //удаление
            Route::get('/docs/plan_industrial_safety/edit/{id}', 'ReportController@edit_plan_industrial_safety');  //обновление
            Route::post('/docs/plan_industrial_safety/update/{id}', 'ReportController@update_plan_industrial_safety');  //сохранение изменений
//            Route::get('/docs/plan_industrial_safety/get_params/{year}', 'ReportController@get_plan_industrial_safety');  //обновление

            Route::get('/docs/goals_trans_yugorsk', 'ReportController@goals_trans_yugorsk');  //Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности
            Route::get('/docs/goals_trans_yugorsk/create', 'ReportController@create_goals_trans_yugorsk');  //создание
            Route::post('/docs/goals_trans_yugorsk/save', 'ReportController@save_goals_trans_yugorsk');  //сохранение
            Route::get('/docs/goals_trans_yugorsk/remove/{id}', 'ReportController@remove_goals_trans_yugorsk');  //удаление
            Route::get('/docs/goals_trans_yugorsk/edit/{id}', 'ReportController@edit_goals_trans_yugorsk');  //обновление
            Route::post('/docs/goals_trans_yugorsk/update/{id}', 'ReportController@update_goals_trans_yugorsk');  //сохранение изменений
            Route::post('/docs/goals_trans_yugorsk/get_params', 'ReportController@get_goals_trans_yugorsk');  //выборка за выбранный год

            Route::get('/docs/emergency_drills', 'ReportController@emergency_drills');  //Сведения о противоаварийных тренировках, проведенных на опасных производственных объектах
            Route::get('/docs/emergency_drills/create', 'ReportController@create_emergency_drills');  //создание
            Route::post('/docs/emergency_drills/save', 'ReportController@save_emergency_drills');  //сохранение
            Route::get('/docs/emergency_drills/remove/{id}', 'ReportController@remove_emergency_drills');  //удаление
            Route::get('/docs/emergency_drills/edit/{id}', 'ReportController@edit_emergency_drills');  //обновление
            Route::post('/docs/emergency_drills/update/{id}', 'ReportController@update_emergency_drills');  //сохранение изменений
            Route::post('/docs/emergency_drills/get_params', 'ReportController@get_emergency_drills');  //выборка за выбранный год

            Route::get('/docs/open_kr_dtoip/{id_do}', 'ReportController@open_kr_dtoip');  //Сведения о выполнении графика КР и ДТОиР ОПО
            Route::post('/docs/save_kr_dtoip/{year}/{id_do}', 'ReportController@save_kr_dtoip');  //сохранение
            Route::get('/docs/get_kr_dtoip/{year}/{id_do}', 'ReportController@get_kr_dtoip');  //сохранение
            Route::get('/uncheck_kr_dtoip/{num_pp}/{year}/{id_do}', 'ReportController@uncheck_kr_dtoip');  //убрать из обсчета

            Route::get('/docs/report_events', 'ReportController@show_report_events');  // Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за _____________20_____ года
            Route::post('/docs/report_events/get_params', 'ReportController@get_report_events_year');  // выборка за год
            Route::get('/docs/report_events/create', 'ReportController@create_report_events');  // страница создания записи
            Route::post('/docs/report_events/save', 'ReportController@save_report_events');  //сохранение
            Route::get('/docs/report_events/remove/{id}', 'ReportController@remove_report_events');  //удаление
            Route::get('/docs/report_events/edit/{id}', 'ReportController@edit_report_events');  //обновление
            Route::post('/docs/report_events/update/{id}', 'ReportController@update_report_events');  //сохранение изменений

            Route::get('/docs/events', 'ReportController@show_events');  // Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за _____________20_____ года
            Route::post('/docs/events/get_params', 'ReportController@get_events');  // выборка за год
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

            Route::get('/docs/plan_of_industrial_safety/{id_do}', 'ReportController@show_plan_of_industrial_safety');  // План работ в области промышленной безопасности
            Route::get('/docs/plan_of_industrial_safety/get_params/{year}/{id_do}', 'ReportController@get_plan_of_industrial_safety');  // выборка за год
            Route::get('/docs/plan_of_industrial_safety/create/{id_do}', 'ReportController@create_plan_of_industrial_safety');  // страница создания записи
            Route::post('/docs/plan_of_industrial_safety/save/{id_do}', 'ReportController@save_plan_of_industrial_safety');  //сохранение
            Route::get('/docs/plan_of_industrial_safety/remove/{id}', 'ReportController@remove_plan_of_industrial_safety');  //удаление
            Route::get('/docs/plan_of_industrial_safety/edit/{id}/{id_do}', 'ReportController@edit_plan_of_industrial_safety');  //обновление
            Route::post('/docs/plan_of_industrial_safety/update/{id}', 'ReportController@update_plan_of_industrial_safety');  //сохранение изменений

            Route::get('/docs/conclusions_industrial_safety_main', 'ConclusionsController@show_conclusions_industrial_safety_main');  // План работ в области промышленной безопасности

            Route::post('/get_group/{table}/{column}', 'GroupController@get_group'); //получить группу для fieldset

            Route::post('/docs/conclusions_industrial_safety', 'ConclusionsController@show_conclusions_industrial_safety')->name('open_conclusions_industrial_safety');  // План работ в области промышленной безопасности
            Route::get('/docs/conclusions_industrial_safety/create', 'ConclusionsController@create_conclusions_industrial_safety');  // страница создания записи
            Route::post('/docs/conclusions_industrial_safety/save', 'ConclusionsController@save_conclusions_industrial_safety');  //сохранение
            Route::get('/docs/conclusions_industrial_safety/remove/{id}', 'ConclusionsController@remove_conclusions_industrial_safety');  //удаление
            Route::get('/docs/conclusions_industrial_safety/edit/{id}', 'ConclusionsController@edit_conclusions_industrial_safety');  //обновление
            Route::post('/docs/conclusions_industrial_safety/update/{id}', 'ConclusionsController@update_conclusions_industrial_safety');  //сохранение изменений

            Route::get('/docs/fulfillment_certification', 'ReportController@show_fulfillment_certification');  // План работ в области промышленной безопасности
            Route::post('/docs/fulfillment_certification/get_params', 'ReportController@get_fulfillment_certification');  // выборка за год
            Route::get('/docs/fulfillment_certification/create', 'ReportController@create_fulfillment_certification');  // страница создания записи
            Route::post('/docs/fulfillment_certification/save', 'ReportController@save_fulfillment_certification');  //сохранение
            Route::get('/docs/fulfillment_certification/remove/{id}', 'ReportController@remove_fulfillment_certification');  //удаление
            Route::get('/docs/fulfillment_certification/edit/{id}', 'ReportController@edit_fulfillment_certification');  //обновление
            Route::post('/docs/fulfillment_certification/update/{id}', 'ReportController@update_fulfillment_certification');  //сохранение изменений

            Route::get('/docs/pat_schedule', 'ReportController@show_pat_schedule');  // План работ в области промышленной безопасности
            Route::post('/docs/pat_schedule/get_params', 'ReportController@get_pat_schedule');  // выборка за год
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
            Route::get('/get_indicator/{year}/{id}', 'MathController@get_indicator'); //получение данных с таблицы с результатами (дата и выбор ДО)

///////////************** Отчеты PDF **************************************/////////////////////////
            Route::post('/pdf_actual_declarations', 'PdfReportController@pdf_actual_declarations')->name('pdf_actual');     // скачать реестр актуальных деклараций
            Route::post('/pdf_emergency_drills', 'PdfReportController@pdf_emergency_drills')->name('pdf_emergency');     // скачать сведения о противоаварийных тренировках, проведенных на опасных производственных объектах в 20__ году
            Route::post('/pdf_goals_trans_yugorsk', 'PdfReportController@pdf_goals_trans_yugorsk')->name('pdf_goals');     // скачать Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности на 20__ год
            Route::post('/pdf_perfomance_plan_KiPD/', 'PdfReportController@pdf_perfomance_plan_KiPD')->name('pdf_perfomance_plan_kipd');     // скачать Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::post('/pdf_plan_industrial_safety/', 'PdfReportController@pdf_plan_industrial_safety')->name('pdf_plan_industrial');     // скачать Сведения о выполнении плана работ в области промышленной безопасности
            Route::post('/pdf_kipd_internal_checks', 'PdfReportController@pdf_kipd_internal_checks')->name('pdf_kipd_internal');     // скачать План корректирующих действий ПБ по внутренним проверкам за
            Route::get('/pdf_result_apk/{year}/{type}', 'PdfReportController@pdf_result_apk');     // скачать Результаты АПК, корпоративного контроля и государственного надзора
            Route::get('/pdf_sved_avar/{start}/{finish}', 'PdfReportController@pdf_sved_avar');     // скачать Сведения об аварийности на опасных производственных объектах дочернего общества за
            Route::post('/pdf_report_events', 'PdfReportController@pdf_report_events')->name('pdf_report_events');     // скачать Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
            Route::post('/pdf_events', 'PdfReportController@pdf_events')->name('pdf_events');     // скачать Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
            Route::get('/pdf_kr_dtoip/{year}/{id_do}', 'PdfReportController@pdf_kr_dtoip');  //скачать КР ДТОиР ОПО
            Route::get('/pdf_plan_of_industrial_safety/{year}/{id_do}', 'PdfReportController@pdf_plan_of_industrial_safety');     // скачать план работ в области ПБ
            Route::post('/pdf_pat_schedule', 'PdfReportController@pdf_pat_schedule')->name('pdf_pat_schedule');     // скачать График комплексных противоаварийных тренировок
            Route::get('/pdf_jas/{start}/{end}', 'PdfReportController@pdf_jas');     // скачать ЖАС за выбранный период

///////////************** Отчеты Excel **************************************/////////////////////////
            Route::get('/excel_conclusions_industrial_safety_main', 'ExcelReportController@excel_conclusions_industrial_safety_main');
            Route::post('/excel_conclusions_industrial_safety', 'ExcelReportController@excel_conclusions_industrial_safety')->name('excel_conclusions');
            Route::post('/excel_events', 'ExcelReportController@excel_events')->name('excel_events');
            Route::post('/excel_fulfillment_certification', 'ExcelReportController@excel_fulfillment_certification')->name('excel_fulfillment');
            Route::post('/excel_pat_schedule', 'ExcelReportController@excel_pat_schedule')->name('excel_pat_schedule');
            Route::get('/excel_plan_of_industrial_safety/{year}/{id_do}', 'ExcelReportController@excel_plan_of_industrial_safety');
            Route::post('/excel_actual_declarations', 'ExcelReportController@excel_actual_declarations')->name('excel_actual');
            Route::post('/excel_emergency_drills', 'ExcelReportController@excel_emergency_drills')->name('excel_emergency');     // скачать сведения о противоаварийных тренировках, проведенных на опасных производственных объектах в 20__ году
            Route::post('/excel_report_events', 'ExcelReportController@excel_report_events')->name('excel_report_events');     // скачать Отчет наименование филиала/дочернего общества о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»
            Route::post('/excel_goals_trans_yugorsk', 'ExcelReportController@excel_goals_trans_yugorsk')->name('excel_goals');     // скачать Цели ООО «Газпром трансгаз Югорск» в области производственной безопасности на 20__ год
            Route::post('/excel_kipd_internal_checks', 'ExcelReportController@excel_kipd_internal_checks')->name('excel_kipd_internal');     // скачать План корректирующих действий ПБ по внутренним проверкам за
            Route::get('/excel_kr_dtoip/{year}/{id_do}', 'ExcelReportController@excel_kr_dtoip');  //скачать КР ДТОиР ОПО
            Route::post('/excel_perfomance_plan_KiPD', 'ExcelReportController@excel_perfomance_plan_KiPD')->name('excel_perfomance_plan_kipd');     // скачать Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром»
            Route::post('/excel_plan_industrial_safety', 'ExcelReportController@excel_plan_industrial_safety')->name('excel_plan_industrial');     // скачать Сведения о выполнении плана работ в области промышленной безопасности
            Route::get('/excel_result_apk/{year}', 'ExcelReportController@excel_result_apk');     // скачать Результаты АПК, корпоративного контроля и государственного надзора
            Route::get('/excel_sved_avar/{start}/{finish}', 'ExcelReportController@excel_sved_avar');     // скачать Сведения об аварийности на опасных производственных объектах дочернего общества за
            Route::get('/excel_jas/{start}/{end}', 'ExcelReportController@excel_jas');     // скачать Жас за определенный период


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

            Route::get('/docs/status_gtu', ['as' => 'show_excel', 'uses' => 'UploadFilesController@show_excel']);  //таблица со всеми pdf
            Route::post('/docs/upload_excel', ['as' => 'upload_excel', 'uses' => 'UploadFilesController@save_excel']); //загрузить файл
            Route::get('/docs/excel_delete/{id}', ['as' => 'excel_delete', 'uses' => 'UploadFilesController@excel_delete']);  //открыть файл
            Route::get('/docs/excel_download/{id}', ['as' => 'excel_download', 'uses' => 'UploadFilesController@excel_download']);  //открыть файл
            Route::get('/docs/example_excel', ['as' => 'excel_example', 'uses' => 'UploadFilesController@excel_example']);  //открыть файл

        });
    });
});
//*******************************************
Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});








