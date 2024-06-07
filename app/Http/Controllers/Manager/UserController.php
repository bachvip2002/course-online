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

    public function list(Request $request)
    {
        $users = $this->user
            ->query()
            ->findStrBy('full_name', $request)
            ->findStrBy('phone_number', $request)
            ->findBy('status', $request)
            ->paginate(PAGE_SIZE_DEFAULT);

        if ($request->ajax()) {
            return response()->json([
                'users' => $users,
                'userStatuses' => $this->user->getAllStatus(),
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.user.list', [
                'users' => $users,
                'userStatuses' => $this->user->getAllStatus(),
            ]);
        }
    }

    public function detail(Request $request)
    {
        $user = $this->user
            ->query()
            ->find($request->user_id);

        if ($request->ajax()) {
            return response()->json([
                'user' => $user,
                'userStatuses' => $this->user->getAllStatus(),
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.user.detail', [
                'user' => $user,
                'userStatuses' => $this->user->getAllStatus(),
            ]);
        }
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'userStatuses' => $this->user->getAllStatus(),
            ], Response::HTTP_ACCEPTED);
        } else {
            return view('manager.page.user.create', [
                'userStatuses' => $this->user->getAllStatus(),
            ]);
        }
    }

    public function edit(Request $request)
    {
        $userId = $request->user_id;

        $user = $this->user
            ->query()
            ->find($userId);

        if ($request->ajax()) {
            return response()->json([
                'user' => $user
            ], Response::HTTP_CREATED);
        } else {
            return view('manager.page.user.edit', [
                'user' => $user,
                'userStatuses' => $this->user->getAllStatus(),
            ]);
        }
    }

    public function store(StoreRequest $request)
    {
        $contents = $request->file('avatar');
        $path = $this->user->getTable();

        $avatar = Storage::disk('public')->put(
            $path,
            $contents
        );

        $user = $this->user
            ->query()
            ->create([
                'full_name' => $request->full_name,
                'email'  => $request->email,
                'password'  => $request->password,
                'id_login'  => $request->id_login,
                'status'  => $request->status,
                'address'  => $request->address,
                'phone_number'  => $request->description,
                'description'  => $request->description,
                'avatar'  =>  $avatar,
            ]);

        if ($request->ajax()) {
            return response()->json([
                'user' => $user
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * update
     *
     * @param  \App\Http\Requests\Manager\User\UpdateRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $user = $this->user
            ->query()
            ->find($request->user_id);

        if ($password = $request->password) {
            $user->password = $password;
        }

        if ($request->hasFile('avatar')) {
            $contents = $request->file('avatar');
            $path = $user->getTable();

            $avatar = Storage::disk('public')->put(
                $path,
                $contents
            );

            $user->avatar = $avatar;
        }

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id_login = $request->id_login;
        $user->status = $request->status;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->description = $request->description;
        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'user' => $user
            ], Response::HTTP_ACCEPTED);
        }
    }


    /**
     * Method delete
     *
     * @param \Illuminate\Http\Request $request 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $userId = $request->user_id;

        $user = $this->user
            ->query()
            ->find($userId);

        if (empty($user)) {
            return response()->json([
                'message' => 'NOT FOUND 404'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        if ($request->ajax()) {
            return response()->json([
                'user' => $user
            ], Response::HTTP_ACCEPTED);
        }
    }
}
