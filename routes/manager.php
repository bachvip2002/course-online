<?php

use App\Http\Controllers\Manager\Course\LearningRoadmapController;
use App\Http\Controllers\Manager\CourseController;
use App\Http\Controllers\Manager\Course\LearningRoadmap\ChapterController;
use App\Http\Controllers\Manager\Course\LearningRoadmap\LessonController;
use App\Http\Controllers\Manager\AuthenticationController;
use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\ResourceManagementController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Middleware\ManagerAuthenticate;
use Illuminate\Support\Facades\Route;

//user begin
Route::get('manager/authentication/sign-in-page', [AuthenticationController::class, 'renderSignInPage'])
    ->name('manager.authentication.sign-in-page');

Route::post('manager/authentication/login', [AuthenticationController::class, 'login'])
    ->name('manager.authentication.login');

Route::get('manager/authentication/logout', [AuthenticationController::class, 'logout'])
    ->name('manager.authentication.logout');

Route::prefix('manager')
    ->name('manager.')
    ->middleware([ManagerAuthenticate::class])
    ->group(
        function () {
            Route::get('dashboard/index', [DashboardController::class, 'index'])
                ->name('dashboard.index');

            Route::get('user/list-page', [UserController::class, 'renderListPage'])
                ->name('user.list-page');

            Route::get('user/create-page', [UserController::class, 'renderCreatePage'])
                ->name('user.create-page');

            Route::get('user/edit-page', [UserController::class, 'renderEditPage'])
                ->name('user.edit-page');

            Route::get('user/detail-page', [UserController::class, 'renderDetailPage'])
                ->name('user.detail-page');

            Route::post('user/store', [UserController::class, 'store'])
                ->name('user.store');

            Route::put('user/update', [UserController::class, 'update'])
                ->name('user.update');

            Route::delete('user/delete', [UserController::class, 'delete'])
                ->name('user.delete');

            Route::get('resource-management/list-page', [ResourceManagementController::class, 'renderListPage'])
                ->name('resource-management.list-page');

            Route::get('resource-management/create-page', [ResourceManagementController::class, 'renderCreatePage'])
                ->name('resource-management.create-page');

            Route::post('resource-management/store', [ResourceManagementController::class, 'store'])
                ->name('resource-management.store');

            Route::get('course/list-page', [CourseController::class, 'renderListPage'])
                ->name('course.list-page');

            Route::get('course/create-page', [CourseController::class, 'renderCreatePage'])
                ->name('course.create-page');

            Route::get('course/edit-page', [CourseController::class, 'renderEditPage'])
                ->name('course.edit-page');

            Route::get('course/detail-page', [CourseController::class, 'renderDetailPage'])
                ->name('course.detail-page');

            Route::post('course/store', [CourseController::class, 'store'])
                ->name('course.store');

            Route::put('course/update', [CourseController::class, 'update'])
                ->name('course.update');

            Route::delete('course/delete', [CourseController::class, 'delete'])
                ->name('course.delete');

            Route::get('course/learning-roadmap/index-page', [LearningRoadmapController::class, 'renderIndexPage'])
                ->name('course.learning-roadmap.index-page');

            Route::get('course/learning-roadmap/chapter/create-page', [ChapterController::class, 'renderCreatePage'])
                ->name('course.learning-roadmap.chapter.create-page');

            Route::get('course/learning-roadmap/chapter/edit-page', [ChapterController::class, 'renderEditPage'])
                ->name('course.learning-roadmap.chapter.edit-page');

            Route::get('course/learning-roadmap/chapter/detail-page', [ChapterController::class, 'renderDetailPage'])
                ->name('course.learning-roadmap.chapter.index-page');

            Route::get('course/learning-roadmap/chapter/record-order-page', [ChapterController::class, 'renderRecordOrderPage'])
                ->name('course.learning-roadmap.chapter.record-order-page');

            Route::post('course/learning-roadmap/chapter/store', [ChapterController::class, 'store'])
                ->name('course.learning-roadmap.chapter.store');

            Route::put('course/learning-roadmap/chapter/update', [ChapterController::class, 'update'])
                ->name('course.learning-roadmap.chapter.update');

            Route::delete('course/learning-roadmap/chapter/delete', [ChapterController::class, 'delete'])
                ->name('course.learning-roadmap.chapter.delete');

            Route::put('course/learning-roadmap/chapter/sort-record', [ChapterController::class, 'sortRecord'])
                ->name('course.learning-roadmap.chapter.sort-record');

            Route::get('course/learning-roadmap/lesson/create-page', [LessonController::class, 'renderCreatePage'])
                ->name('course.learning-roadmap.lesson.create-page');

            Route::get('course/learning-roadmap/lesson/edit-page', [LessonController::class, 'renderEditPage'])
                ->name('course.learning-roadmap.lesson.edit-page');

            Route::get('course/learning-roadmap/lesson/detail-page', [LessonController::class, 'renderDetailPage'])
                ->name('course.learning-roadmap.lesson.detail-page');

            Route::get('course/learning-roadmap/lesson/record-order-page', [LessonController::class, 'renderRecordOrderPage'])
                ->name('course.learning-roadmap.lesson.record-order-page');

            Route::get('course/learning-roadmap/lesson/video-create-page', [LessonController::class, 'renderVideoCreatePage'])
                ->name('course.learning-roadmap.lesson.video-create-page');

            Route::put('course/learning-roadmap/lesson/upload-video', [LessonController::class, 'uploadVideo'])
                ->name('course.learning-roadmap.lesson.upload-video');
        }
    );
