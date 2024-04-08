<?php

namespace App\Http\Controllers\Manager\Course;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

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

    public function renderIndexPage(Request $request)
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

        return view('manager.page.course.learning-roadmap.page', [
            'chapters' => $chapters,
            'course' => $course
        ]);
    }
}
