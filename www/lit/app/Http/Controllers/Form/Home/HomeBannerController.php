<?php

namespace Lit\Http\Controllers\Form\Home;

use Ignite\Crud\Controllers\FormController;
use Illuminate\Contracts\Auth\Access\Authorizable;

class HomeBannerController extends FormController
{
    /**
     * Authorize request for authenticated lit-user and permission operation.
     * Operations: read, update
     *
     * @param Authorizable $user
     * @param string $operation
     * @return boolean
     */
    public function authorize(Authorizable $user, string $operation): bool
    {
        return true;
    }
}
