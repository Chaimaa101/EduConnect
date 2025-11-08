<?php

namespace App\Policies;

use App\Models\Cour;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CourPolicy
{
        public function create(User $user): Response
        {
                return $user->role !== 'student'
                        ? Response::allow()
                        : Response::deny('You are not allowed to create courses.');
        }

        public function enrol(User $user, Cour $cour): Response
        {
                if ($user->role !== 'student') {
                        return Response::deny('Only students can enroll.');
                }

                if ($cour->students()->where('users.id', $user->id)->exists()) {
                        return Response::deny('You are already enrolled in this course.');
                }

                if ($cour->teacher_id === $user->id) {
                        return Response::deny('You cannot enroll in your own course.');
                }
                return Response::allow();
        }
}
