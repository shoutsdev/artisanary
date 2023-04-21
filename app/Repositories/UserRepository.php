<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::where('id','!=',auth()->id())->latest()->paginate();
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($id,$data)
    {
        $user = $this->find($id);

        return $user->update($data);
    }

    public function destroy($id): int
    {
        return User::destroy($id);
    }
}
