<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->role === 'admin' || $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->role === 'admin' || $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public function backoffice(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function CompletedKYC(User $authUser)
    {
        // Verificar si el usuario tiene un KYC aprobado.
        return $authUser->kycEntry && $authUser->kycEntry->status === 'verified';
    }

    /**
     * Determina si un usuario puede vincularse con otras cuentas.
     */
    public function LinkAccounts(User $authUser)
    {
        // Verificar si el usuario tiene menos de 5 cuentas vinculadas.
        return $authUser->linkedAccounts()->count() < 5;
    }

    public function ranked(User $authUser)
    {
        // Verificar si el usuario tiene un rank.
        return $authUser->rank;
    }
}
