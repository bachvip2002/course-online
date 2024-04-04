<?php

namespace App\Http\Controllers\Manager\Course\LearningRoadmap;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Course\LearningRoadmap\Chapter\StoreRequest;
use App\Http\Requests\Manager\Course\LearningRoadmap\Chapter\UpdateRequest;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ChapterController of Pages ...
 */
class ChapterController extends Controller
{
    private $course;
    private $chapter;

    public function __construct(
        Course $course,
        Chapter $chapter
    ) {
        $this->course = $course;
        $this->chapter = $chapter;
    }

    public function renderCreatePage(Request $request)
    {
        $courseId = $request->query('course_id');

        $course = $this->course
            ->queryEloquentBuilder()
            ->findOrFail($courseId);

        return view('manager.page.course.learning-roadmap.chapter.create-page', [
            'course' => $course,
        ]);
    }

    public function renderEditPage(Request $request)
    {
        $courseId = $request->query('course_id');
        $chapterId = $request->query('chapter_id');

        $course = $this->course
            ->queryEloquentBuilder()
            ->findOrFail($courseId);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->findOrFail($chapterId);

        return view('manager.page.course.learning-roadmap.chapter.edit-page', [
            'course' => $course,
            'chapter' => $chapter,
        ]);
    }

    public function renderRecordOrderPage(Request $request)
    {
        $courseId = $request->query('course_id');

        $course = $this->course
            ->queryEloquentBuilder()
            ->findOrFail($courseId);

        $chapters = $this->chapter
            ->queryEloquentBuilder()
            ->orderBy('order')
            ->where('course_id', '=', $course->id)
            ->get();

        return view('manager.page.course.learning-roadmap.chapter.record-order-page', [
            'course' => $course,
            'chapters' => $chapters,
        ]);
    }

    public function renderDetailPage(Request $request)
    {
        $courseId = $request->query('course_id');
        $chapterId = $request->query('chapter_id');

        $course = $this->course
            ->queryEloquentBuilder()
            ->findOrFail($courseId);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->findOrFail($chapterId);

        return view('manager.page.course.learning-roadmap.chapter.detail-page', [
            'course' => $course,
            'chapter' => $chapter,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $courseId = $request->input('course_id');

        $orderMax = $this->chapter
            ->queryEloquentBuilder()
            ->where('course_id', $courseId)
            ->max('order');

        $request->merge(['order' => ($orderMax + 1)]);

        $attributes = $request->only([
            'course_id',
            'name',
            'order',
            'description'
        ]);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->create($attributes);

        return response()->json([
            'chapter' => $chapter
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateRequest $request)
    {
        $chapterId = $request->input('chapter_id');

        $attributes = $request->only([
            'name',
            'description',
        ]);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->find($chapterId);

        if (empty($chapter)) {
            return response()->json(
                ['message' => 'NOT FOUND 404'],
                Response::HTTP_NOT_FOUND
            );
        }

        $chapter->update($attributes);

        return response()->json([
            'chapter' => $chapter
        ], Response::HTTP_ACCEPTED);
    }

    public function delete(Request $request)
    {
        $chapterId = $request->chapter_id;

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->find($chapterId);

        if (empty($chapter)) {
            return response()->json([
                'message' => 'NOT FOUND 404'
            ], Response::HTTP_NOT_FOUND);
        }

        $chapter->delete();

        return response()->json([
            'chapter' => $chapter
        ], Response::HTTP_ACCEPTED);
    }

    public function sortRecord(Request $request)
    {
        dd($request);

        $chapterId = $request->input('chapter_id');

        $attributes = $request->only([
            'name',
            'description',
        ]);

        $chapter = $this->chapter
            ->queryEloquentBuilder()
            ->find($chapterId);

        if (empty($chapter)) {
            return response()->json(
                ['message' => 'NOT FOUND 404'],
                Response::HTTP_NOT_FOUND
            );
        }

        $chapter->update($attributes);

        return response()->json([
            'success'
        ], Response::HTTP_ACCEPTED);
    }
}
