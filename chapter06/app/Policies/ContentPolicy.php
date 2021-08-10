<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;
use stdClass;

use function intval;

class ContentPolicy
{
    use HandlesAuthorization;

    // 리스트 6.5.2.12 PHP 빌트인 클래스를 이용한 정책 클래스 구현 예
    public function edit(
        Authenticatable $authenticatable,
        stdClass $class
    ): bool {
        // ①
        if (property_exists($class, 'id')) {
            return intval($authenticatable->getAuthIdentifier()) === intval($class->id);
        }
        return false;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Content $content
     * @return mixed
     */
    public function view(User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Content $content
     * @return mixed
     */
    public function update(User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Content $content
     * @return mixed
     */
    public function delete(User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Content $content
     * @return mixed
     */
    public function restore(User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Content $content
     * @return mixed
     */
    public function forceDelete(User $user, Content $content)
    {
        //
    }
}
