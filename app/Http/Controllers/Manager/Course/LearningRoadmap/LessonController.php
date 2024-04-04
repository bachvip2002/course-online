<?php

namespace App\Http\Controllers\Manager\Course\LearningRoadmap;

use App\Exceptions\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Course\LearningRoadmap\Lesson\UploadVideoRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * LessonController of Pages ...
 */
class LessonController extends Controller
{
    private $course;
    private $chapter;
    private $lesson;

    public function __construct(
        Course $course,
        Chapter $chapter,
        Lesson $lesson
    ) {
        $this->course = $course;
        $this->chapter = $chapter;
        $this->lesson = $lesson;
    }

    public function renderDetailPage(Request $request)
    {
        return view('manager.page.course.learning-roadmap.lesson.detail-page');
    }

    public function renderCreatePage(Request $request)
    {
        $courseId = $request->query('course_id');
        $chapterId = $request->query('chapter_id');

        $course = $this->course
            ->queryEloquentBuilder()
            ->findOrFail($courseId);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->findOrFail($chapterId);

        $chapter->load('lessons');

        return view('manager.page.course.learning-roadmap.lesson.create-page', [
            'course' => $course,
            'chapter' => $chapter,
        ]);
    }

    public function renderVideoCreatePage(Request $request)
    {
        $lessonId = $request->query('lesson_id');
        $courseId = $request->query('course_id');
        $chapterId = $request->query('chapter_id');

        $lesson = $this->lesson
            ->queryEloquentBuilder()
            ->find($lessonId);

        return view('manager.page.course.learning-roadmap.lesson.video-create-page', [
            'lesson' => $lesson,
        ]);
    }

    public function renderEditPage(Request $request)
    {
        return view('manager.page.course.learning-roadmap.lesson.edit-page');
    }

    public function renderRecordOrderPage(Request $request)
    {
        $courseId = $request->query('course_id');
        $chapterId = $request->query('chapter_id');

        $course = $this->course
            ->queryEloquentBuilder()
            ->findOrFail($courseId);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->findOrFail($chapterId);

        $lessons = $this->lesson
            ->queryEloquentBuilder()
            ->where('chapter_id', $chapter->id)
            ->get();

        return view('manager.page.course.learning-roadmap.lesson.record-order-page', [
            'course' => $course,
            'chapter' => $chapter,
            'lessons' => $lessons,
        ]);
    }

    public function store()
    {
    }

    public function uploadVideo(UploadVideoRequest $request)
    {
        $videoContent = $request->file('video_path');
        $imageContent = $request->file('avatar_path');
        $lessonId = $request->query('lesson_id');

        $lesson = $this->lesson
            ->queryEloquentBuilder()
            ->find($lessonId);

        try {
            $videoPath = Storage::disk('public')->put('lesson/video', $videoContent);
            $avatarPath = Storage::disk('public')->put('lesson/image', $imageContent);

            $lesson->update([
                'avatar_path' => $avatarPath,
                'video_path' => $videoPath,
            ]);
        } catch (Exception $exception) {

            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/upload-file.log'),
            ])->info(
                $exception->getMessage(),
                // $exception->getTrace()
            );

            throw new JsonResponse([
                'message' => $exception->getMessage()
            ], (int)$exception->getCode());
        }

        return response()->json([
            'lesson' => $lesson,
        ], Response::HTTP_CREATED);
    }
}
