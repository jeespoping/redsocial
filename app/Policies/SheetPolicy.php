<?php

namespace App\Policies;

use App\User;
use App\Sheet;
use app\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class SheetPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any sheets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the sheet.
     *
     * @param  \App\User  $user
     * @param  \App\Sheet  $sheet
     * @return mixed
     */
    public function view(User $user, Sheet $sheet)
    {
        //
    }

    /**
     * Determine whether the user can create sheets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the sheet.
     *
     * @param  \App\User  $user
     * @param  \App\Sheet  $sheet
     * @return mixed
     */
    public function update(User $user, Sheet $sheet)
    {
        //
    }

    /**
     * Determine whether the user can delete the sheet.
     *
     * @param  \App\User  $user
     * @param  \App\Sheet  $sheet
     * @param  \App\Team  $Team
     * @return mixed
     */
    public function delete(User $user, Sheet $sheet, Team $team)
    {
        return $user->id === $sheet->user_id || $user->id === $team->user_id;
    }

    /**
     * Determine whether the user can restore the sheet.
     *
     * @param  \App\User  $user
     * @param  \App\Sheet  $sheet
     * @return mixed
     */
    public function restore(User $user, Sheet $sheet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sheet.
     *
     * @param  \App\User  $user
     * @param  \App\Sheet  $sheet
     * @return mixed
     */
    public function forceDelete(User $user, Sheet $sheet)
    {
        //
    }
}
