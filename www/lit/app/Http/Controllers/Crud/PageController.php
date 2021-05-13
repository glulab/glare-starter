<?php

namespace Lit\Http\Controllers\Crud;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Ignite\Crud\Controllers\CrudController;

class PageController extends CrudController
{
    /**
     * Authorize request for authenticated lit-user and permission operation.
     * Operations: create, read, update, delete
     *
     * @param Authorizable $user
     * @param string $operation
     * @param integer $id
     * @return boolean
     */
    public function authorize(Authorizable $user, string $operation, $id = null): bool
    {
        // return $user->can("{$operation} pages");
        return true;
    }

    /**
     * Fill model on store.
     *
     * @param  mixed $model
     * @return void
     */
    public function fillOnStore($model)
    {
        $model->type = $this->getTypeBasedOnPrefix();
    }

    /**
     * Default attributes depend on route prefix
     *
     * @return array
     */
    public function getTypeBasedOnPrefix($defaultType = 'page')
    {
        if (strpos($this->config->routePrefix(), '-') === false) {
            return $defaultType;
        }

        $pageType = explode('-', $this->config->routePrefix())[0] ?? $defaultType;

        if ($pageType === 'default') {
            $pageType = $defaultType;
        }

        return $pageType;
    }
}
