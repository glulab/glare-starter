<?php

namespace Lit\Http\Controllers\Form\Settings;

use Illuminate\Http\Request;
use Ignite\Crud\Api\ApiRequest;
use Ignite\Crud\Controllers\FormController;
use Illuminate\Contracts\Auth\Access\Authorizable;

class SiteController extends FormController
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

    public function api(Request $request)
    {
        $r = $request->all();
        if (!empty($r['payload']['map_iframe_src'])) {
            $r['payload']['map_iframe_src'] = $this->resolveEmbedCode($r['payload']['map_iframe_src']);
            $request->replace($r);
        }
        return parent::api($request);
    }

    public function resolveEmbedCode($input)
    {
        if (strpos($input, 'src=') === false) {
            return $input;
        }

        preg_match("/\<iframe.+src\=(?:\"|\')(.+?)(?:\"|\')(?:.+?)\>/", $input, $matches);
        $output =  $matches[1];

        return $output;
    }
}
