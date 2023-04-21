<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    public function all()
    {
        return Role::latest()->paginate();
    }

    public function activeRoles()
    {
        return Role::where('status',1)->latest()->get();
    }

    public function store($data)
    {
        return Role::create($data);
    }

    public function find($id)
    {
        return Role::find($id);
    }

    public function update($id,$data)
    {
        $role = $this->find($id);

        return $role->update($data);
    }

    public function destroy($id): int
    {
        return Role::destroy($id);
    }
}
