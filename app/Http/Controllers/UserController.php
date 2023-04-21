<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(RoleRepository $roleRepository): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'users' => $this->userRepository->all(),
                'roles' => $roleRepository->activeRoles()
            ];
            return view('backend.users.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $this->userRepository->store($request->all());
            return back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function edit($id,RoleRepository $roleRepository): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data       = [
                'edit'  => $this->userRepository->find($id),
                'users' => $this->userRepository->all(),
                'roles' => $roleRepository->activeRoles()
            ];
            return view('backend.users.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update(UserRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->userRepository->update($id, $request->all());
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->userRepository->destroy($id);
            return back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
