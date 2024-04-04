<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\User\StoreRequest;
use App\Http\Requests\Manager\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserController of Pages ...
 */
class UserController extends Controller
{
    private $user;

    public function __construct(
        User $user,
    ) {
        $this->user = $user;
    }

    public function renderListPage(Request $request)
    {
        $users = $this->user
            ->queryEloquentBuilder()
            ->findStrBy('full_name', $request)
            ->findStrBy('phone_number', $request)
            ->findBy('status', $request)
            ->paginate(PAGE_SIZE_DEFAULT);

        $defaultStatues = User::DEFAULT_STATUES;

        return view('manager.page.user.list-page', [
            'users' => $users,
            'defaultStatues' => $defaultStatues,
        ]);
    }

    public function renderDetailPage(Request $request)
    {
        $userId = $request->user_id;

        // $responseClient = Http::get('https://www.youtube.com/27c95ca9-7b15-4796-8291-8a205962f5b9');

        $user = $this->user
            ->queryEloquentBuilder()
            ->find($userId);

        $defaultStatues = User::DEFAULT_STATUES;

        return view('manager.page.user.detail-page', [
            'user' => $user,
            'defaultStatues' => $defaultStatues
        ]);
    }

    public function renderCreatePage(Request $request)
    {
        $defaultStatues = User::DEFAULT_STATUES;

        return view('manager.page.user.create-page', [
            'defaultStatues' => $defaultStatues
        ]);
    }

    public function renderEditPage(Request $request)
    {
        $userId = $request->user_id;

        $user = $this->user
            ->queryEloquentBuilder()
            ->find($userId);

        $defaultStatues = User::DEFAULT_STATUES;

        return view('manager.page.user.edit-page', [
            'user' => $user,
            'defaultStatues' => $defaultStatues
        ]);
    }

    public function store(StoreRequest $request)
    {
        $imageUpload = $request->file('avatar_path');

        $attributes = $request->only([
            'full_name',
            'email',
            'password',
            'id_login',
            'status',
            'address',
            'phone_number',
            'description',
        ]);

        $avatarPath = Storage::disk('public')->put(
            'avatar',
            $imageUpload
        );

        $attributes['avatar_path'] = $avatarPath;

        $user = $this->user
            ->queryEloquentBuilder()
            ->create($attributes);

        return response()->json([
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateRequest $request)
    {
        $userId = $request->user_id;
        $imageUpload = $request->file('avatar_path');

        $attributes = $request->only([
            'full_name',
            'email',
            'id_login',
            'status',
            'address',
            'phone_number',
            'description',
        ]);

        if ($password = $request->password) {
            $attributes['password'] = $password;
        }

        if ($request->hasFile('avatar_path')) {
            $avatarPath = Storage::disk('public')->put(
                'avatar',
                $imageUpload
            );
            $attributes['avatar_path'] = $avatarPath;
        }

        $user = $this->user
            ->queryEloquentBuilder()
            ->find($userId)
            ->update($attributes);

        return response()->json([
            'user' => $user
        ], Response::HTTP_ACCEPTED);
    }


    /**
     * Method delete
     *
     * @param \Illuminate\Http\Request $request [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $userId = $request->user_id;

        $user = $this->user
            ->queryEloquentBuilder()
            ->find($userId);

        if (empty($user)) {
            return response()->json([
                'message' => 'NOT FOUND 404'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json([
            'user' => $user
        ], Response::HTTP_ACCEPTED);
    }
}
