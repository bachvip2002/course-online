<?php

namespace App\Http\Controllers\Manager\Course\LearningRoadmap;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Course\LearningRoadmap\Lesson\UploadVideoRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
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

    public function detail(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.lesson.detail');
        }
    }

    public function create(Request $request)
    {
        $courseId = $request->query('course_id');
        $chapterId = $request->query('chapter_id');

        $course = $this->course
            ->query()
            ->findOrFail($courseId);

        $chapter = $this->chapter
            ->query()
            ->findOrFail($chapterId);

        $chapter->load('lessons');

        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'chapter' => $chapter,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.lesson.create', [
                'course' => $course,
                'chapter' => $chapter,
            ]);
        }
    }

    public function videoCreate(Request $request)
    {
        $lesson = $this->lesson
            ->query()
            ->find($request->query('lesson_id'));

        if ($request->ajax()) {
            return response()->json([
                'lesson' => $lesson,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.lesson.video-create', [
                'lesson' => $lesson,
            ]);
        }
    }

    public function edit(Request $request)
    {

        if ($request->ajax()) {
            return response()->json([], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.lesson.edit');
        }
    }

    public function recordOrder(Request $request)
    {
        $course = $this->course
            ->query()
            ->findOrFail($request->query('course_id'));

        $chapter = $this->chapter
            ->query()
            ->findOrFail($request->query('chapter_id'));

        $lessons = $this->lesson
            ->query()
            ->where('chapter_id', $chapter->id)
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'chapter' => $chapter,
                'lessons' => $lessons,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.lesson.record-order', [
                'course' => $course,
                'chapter' => $chapter,
                'lessons' => $lessons,
            ]);
        }
    }

    public function store(Request $request)
    {
    }

    public function uploadVideo(UploadVideoRequest $request)
    {
        $lesson = $this->lesson
            ->query()
            ->find($request->query('lesson_id'));

        try {
            $videoPath = Storage::disk('public')->put(
                $this->lesson->getTable() . '/video',
                $request->file('video_path')
            );

            $avatarPath = Storage::disk('public')->put(
                $this->lesson->getTable() . '/image',
                $request->file('avatar_path')
            );

            $lesson->avatar_path = $avatarPath;
            $lesson->video_path = $videoPath;
        } catch (Exception $exception) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => $exception->getMessage()
                ], (int)$exception->getCode());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'lesson' => $lesson,
            ], Response::HTTP_CREATED);
        }
    }
}
