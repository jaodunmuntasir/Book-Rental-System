<?php

namespace App\Policies;

use App\Models\Books;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class BooksPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;  // Grant all permissions to admin
        }
    }
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Books $books): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Books $books): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Books $books): bool
    {
        return in_array($user->role, ['admin', 'librarian']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Books $books): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Books $books): bool
    {
        return $user->role === 'admin';
    }
}
