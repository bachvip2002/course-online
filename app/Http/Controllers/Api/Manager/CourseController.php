<?php

namespace App\Http\Controllers\Api\Manager;

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

    public function renderListPage(Request $request)
    {
        $courses = $this->course
            ->query()
            ->findStrBy('name', $request)
            ->findStrBy('code', $request)
            ->paginate(PAGE_SIZE_DEFAULT);

        return view('manager.page.course.list-page', [
            'courses' => $courses
        ]);
    }

    public function renderDetailPage(Request $request)
    {
        $courseId = $request->course_id;

        $course = $this->course
            ->query()
            ->find($courseId);

        return view('manager.page.course.detail-page', [
            'course' => $course
        ]);
    }

    public function renderCreatePage()
    {
        return view('manager.page.course.create-page');
    }

    public function renderEditPage(Request $request)
    {
        $courseId = $request->course_id;

        $course = $this->course
            ->query()
            ->find($courseId);

        return view('manager.page.course.edit-page', [
            'course' => $course
        ]);
    }

    public function renderTable(Request $request)
    {
        $courses = $this->course
            ->query()
            ->findStrBy('name', $request)
            ->findStrBy('code', $request)
            ->paginate(PAGE_SIZE_DEFAULT);

        $table = view('manager.page.course.component.table', [
            'courses' => $courses
        ])->render();

        $paginate = view('manager.layout.paginate.basic-ajax', [
            'paginator' => $courses
        ])->render();

        return response()->json([
            'table' => $table,
            'paginate' => $paginate,
        ], Response::HTTP_ACCEPTED);
    }

    public function store(StoreRequest $request)
    {
        $imageUpload = $request->file('image_path');

        $attributes  = $request->only([
            'code',
            'name',
            'price',
            'status',
            'image_path',
            'release_datetime',
            'description',
        ]);

        $imagePath = Storage::disk('public')->put(
            'course',
            $imageUpload
        );

        $attributes['image_path'] = $imagePath;

        $course = $this->course
            ->query()
            ->create($attributes);

        return response()->json([
            'user' => $course
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateRequest $request)
    {
        $courseId = $request->course_id;
        $imageUpload = $request->file('image_path');

        $attributes = $request->only([
            'code',
            'name',
            'price',
            'status',
            'image_path',
            'release_datetime',
            'description',
        ]);

        if ($request->hasFile('image_path')) {
            $avatarPath = Storage::disk('public')->put(
                'course',
                $imageUpload
            );
            $attributes['image_path'] = $avatarPath;
        }

        $course = $this->course
            ->query()
            ->find($courseId)
            ->update($attributes);

        return response()->json([
            'course' => $course
        ], Response::HTTP_ACCEPTED);
    }

    public function delete(Request $request)
    {
        $courseId = $request->course_id;

        $course = $this->course
            ->query()
            ->find($courseId);

        if (empty($user)) {
            return response()->json([
                'message' => 'NOT FOUND 404'
            ], Response::HTTP_NOT_FOUND);
        }

        $course->delete();

        return response()->json([
            'course' => $course
        ], Response::HTTP_ACCEPTED);
    }
}
