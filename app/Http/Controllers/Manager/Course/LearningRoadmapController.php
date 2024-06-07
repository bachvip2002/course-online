<?php

namespace App\Http\Controllers\Manager\Course;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * LearningRoadmapController of Pages ...
 */
class LearningRoadmapController extends Controller
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

    public function index(Request $request)
    {
        $courseId = $request->course_id;

        $course = $this->course
            ->query()
            ->findOrFail($courseId);

        $chapters = $this->chapter
            ->query()
            ->with([
                'lessons' => function ($query) {
                    $query->orderBy('order');
                }
            ])
            ->orderBy('order')
            ->where('course_id', '=', $course->id)
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'chapters' => $chapters,
                'course' => $course
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.learning-roadmap.index', [
                'chapters' => $chapters,
                'course' => $course
            ]);
        }
    }
}
