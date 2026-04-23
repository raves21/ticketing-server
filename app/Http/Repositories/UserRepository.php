<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(
        private User $user
    ) {
        parent::__construct($user);
    }
}
