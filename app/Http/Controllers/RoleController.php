<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'roles' => $this->roleRepository->all()
            ];
            return view('backend.roles.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function store(RoleRequest $request)
    {
        try {
            $this->roleRepository->store($request->all());
            return back()->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function edit(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'edit' => $this->roleRepository->find($id),
                'roles' => $this->roleRepository->all()
            ];
            return view('backend.roles.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update(RoleRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->roleRepository->update($id, $request->all());
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->roleRepository->destroy($id);
            return back()->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
