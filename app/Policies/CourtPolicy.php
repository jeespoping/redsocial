<?php

namespace App\Policies;

use App\User;
use App\Court;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourtPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ( $user->hasRole('Admin') )
        {
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any courts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the court.
     *
     * @param  \App\User  $user
     * @param  \App\Court  $court
     * @return mixed
     */
    public function view(User $user, Court $court)
    {
        return $user->id === $court->user_id || $user->hasPermissionTo('View courts');
    }

    /**
     * Determine whether the user can create courts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Court') || $user->hasPermissionTo('Create Courts');
    }

    /**
     * Determine whether the user can update the court.
     *
     * @param  \App\User  $user
     * @param  \App\Court  $court
     * @return mixed
     */
    public function update(User $user, Court $court)
    {
        return $user->id === $court->user_id || $user->hasPermissionTo('Update courts');
    }

    /**
     * Determine whether the user can delete the court.
     *
     * @param  \App\User  $user
     * @param  \App\Court  $court
     * @return mixed
     */
    public function delete(User $user, Court $court)
    {
        return $user->id === $court->user_id || $user->hasPermissionTo('Delete courts');
    }

    /**
     * Determine whether the user can restore the court.
     *
     * @param  \App\User  $user
     * @param  \App\Court  $court
     * @return mixed
     */
    public function restore(User $user, Court $court)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the court.
     *
     * @param  \App\User  $user
     * @param  \App\Court  $court
     * @return mixed
     */
    public function forceDelete(User $user, Court $court)
    {
        //
    }
}
