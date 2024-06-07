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

    public function create(Request $request)
    {
        $course = $this->course
            ->query()
            ->findOrFail($request->query('course_id'));

        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.chapter.create', [
                'course' => $course,
            ]);
        }
    }

    public function edit(Request $request)
    {
        $course = $this->course
            ->query()
            ->findOrFail($request->query('course_id'));

        $chapter = $this->chapter
            ->query()
            ->findOrFail($request->query('chapter_id'));

        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'chapter' => $chapter,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.chapter.edit', [
                'course' => $course,
                'chapter' => $chapter,
            ]);
        }
    }

    public function recordOrder(Request $request)
    {
        $course = $this->course
            ->query()
            ->findOrFail($request->query('course_id'));


        $chapters = $this->chapter
            ->query()
            ->orderBy('order')
            ->where('course_id', '=', $course->id)
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'chapters' => $chapters,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.chapter.record-order', [
                'course' => $course,
                'chapters' => $chapters,
            ]);
        }
    }

    public function detail(Request $request)
    {
        $course = $this->course
            ->query()
            ->findOrFail($request->query('course_id'));

        $chapter = $this->chapter
            ->query()
            ->findOrFail($request->query('chapter_id'));

        if ($request->ajax()) {
            return response()->json([
                'course' => $course,
                'chapter' => $chapter,
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.chapter.detail', [
                'course' => $course,
                'chapter' => $chapter,
            ]);
        }
    }

    public function store(StoreRequest $request)
    {
        $orderMax = $this->chapter
            ->query()
            ->where('course_id', $request->course_id)
            ->max('order');

        $chapter = $this->chapter
            ->query()
            ->create([
                'course_id' => $request->course_id,
                'name' => $request->name,
                'order' => $request->order,
                'description' => $request->description,
                'order' => ($orderMax + 1)
            ]);

        if ($request->ajax()) {
            return response()->json([
                'chapter' => $chapter
            ], Response::HTTP_CREATED);
        }
    }

    public function update(UpdateRequest $request)
    {
        $chapter = $this->chapter
            ->query()
            ->find($request->chapter_id);

        if (empty($chapter)) {
            if ($request->ajax()) {
                return response()->json(
                    ['message' => 'NOT FOUND 404'],
                    Response::HTTP_NOT_FOUND
                );
            }
        }

        $chapter->name = $request->name;
        $chapter->description = $request->description;
        $chapter->save();

        if ($request->ajax()) {
            return response()->json([
                'chapter' => $chapter
            ], Response::HTTP_ACCEPTED);
        }
    }

    public function delete(Request $request)
    {
        $chapter = $this->chapter
            ->query()
            ->find($request->chapter_id);

        if (empty($chapter)) {
            if ($request->ajax()) {
                return response()->json(
                    ['message' => 'NOT FOUND 404'],
                    Response::HTTP_NOT_FOUND
                );
            }
        }

        $chapter->delete();

        if ($request->ajax()) {
            return response()->json([
                'chapter' => $chapter
            ], Response::HTTP_ACCEPTED);
        }
    }

    public function sortRecord(Request $request)
    {
        $chapter = $this->chapter
            ->query()
            ->find($request->input('chapter_id'));

        if (empty($chapter)) {
            if ($request->ajax()) {
                return response()->json(
                    ['message' => 'NOT FOUND 404'],
                    Response::HTTP_NOT_FOUND
                );
            }
        }

        $chapter->name = $request->name;
        $chapter->description = $request->description;
        $chapter->save();

        if ($request->ajax()) {
            return response()->json([
                'chapter' => $chapter
            ], Response::HTTP_ACCEPTED);
        }
    }
}
