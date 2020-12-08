<?php

namespace App\Policies;

use App\User;
use App\Championship;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChampionshipPolicy
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
     * Determine whether the user can view any championships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the championship.
     *
     * @param  \App\User  $user
     * @param  \App\Championship  $championship
     * @return mixed
     */
    public function view(User $user, Championship $championship)
    {
        return $user->id === $championship->user_id || $user->hasPermissionTo('View championships');
    }

    /**
     * Determine whether the user can create championships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Court') || $user->hasPermissionTo('Create championships');
    }

    /**
     * Determine whether the user can update the championship.
     *
     * @param  \App\User  $user
     * @param  \App\Championship  $championship
     * @return mixed
     */
    public function update(User $user, Championship $championship)
    {
        return $user->id === $championship->user_id || $user->hasPermissionTo('Update championships');
    }

    /**
     * Determine whether the user can delete the championship.
     *
     * @param  \App\User  $user
     * @param  \App\Championship  $championship
     * @return mixed
     */
    public function delete(User $user, Championship $championship)
    {
        return $user->id === $championship->user_id || $user->hasPermissionTo('Delete championships');
    }

    /**
     * Determine whether the user can restore the championship.
     *
     * @param  \App\User  $user
     * @param  \App\Championship  $championship
     * @return mixed
     */
    public function restore(User $user, Championship $championship)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the championship.
     *
     * @param  \App\User  $user
     * @param  \App\Championship  $championship
     * @return mixed
     */
    public function forceDelete(User $user, Championship $championship)
    {
        //
    }
}
