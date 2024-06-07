<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Course\StoreRequest;
use App\Http\Requests\Manager\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * CourseController of Pages ...
 */
class CourseController extends Controller
{
    private $course;

    public function __construct(
        Course $course,
    ) {
        $this->course = $course;
    }

    public function list(Request $request)
    {
        $courses = $this->course
            ->query()
            ->findStrBy('name', $request)
            ->findStrBy('code', $request)
            ->paginate(PAGE_SIZE_DEFAULT);

        if ($request->ajax()) {
            return response()->json([
                'courses' => $courses
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.list', [
                'courses' => $courses
            ]);
        }
    }

    public function detail(Request $request)
    {
        $course = $this->course
            ->query()
            ->find($request->course_id);

        if ($request->ajax()) {
            return response()->json([
                'course' => $course
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.detail', [
                'course' => $course
            ]);
        }
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.course.create');
        }
    }

    public function edit(Request $request)
    {
        $course = $this->course
            ->query()
            ->find($request->course_id);

        if ($request->ajax()) {
            return response()->json(
                ['course' => $course],
                Response::HTTP_ACCEPTED
            );
        } else {
            return view('manager.page.course.edit', [
                'course' => $course
            ]);
        }
    }

    public function store(StoreRequest $request)
    {
        $path = $this->course->getTable();
        $contents = $request->file('image');

        $path = Storage::disk('public')->put(
            $path,
            $contents
        );

        $course = $this->course
            ->query()
            ->create([
                'code' => $request->code,
                'name' => $request->name,
                'price' => $request->price,
                'status' => $request->status,
                'image' => $path,
                'release_datetime' => $request->release_datetime,
                'description' => $request->description,
            ]);

        if ($request->ajax()) {
            return response()->json([
                'course' => $course
            ], Response::HTTP_ACCEPTED);
        }
    }

    public function update(UpdateRequest $request)
    {
        $path = $this->course->getTable();
        $contents = $request->file('image');

        $course = $this->course
            ->query()
            ->find($request->course_id);

        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put(
                $path,
                $contents
            );

            $course->image = $imagePath;
        }

        $course->code = $request->code;
        $course->name = $request->name;
        $course->price = $request->price;
        $course->status = $request->status;
        $course->image = $request->image;
        $course->release_datetime = $request->release_datetime;
        $course->description = $request->description;

        if ($request->ajax()) {
            return response()->json([
                'course' => $course
            ], Response::HTTP_ACCEPTED);
        }
    }

    public function delete(Request $request)
    {
        $courseId = $request->course_id;

        $course = $this->course
            ->query()
            ->find($courseId);

        if (empty($user) && $request->ajax()) {
            return response()->json([
                'message' => 'NOT FOUND 404'
            ], Response::HTTP_NOT_FOUND);
        }

        $course->delete();

        if ($request->ajax()) {
            return response()->json([
                'course' => $course
            ], Response::HTTP_ACCEPTED);
        }
    }
}
