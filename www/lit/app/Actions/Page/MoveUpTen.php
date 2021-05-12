<?php

namespace Lit\Actions\Page;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Ignite\Support\AttributeBag;

class MoveUpTen
{
    /**
     * Run the action.
     *
     * @param  Collection  $models
     * @return JsonResponse
     */
    public function run(Collection $models, AttributeBag $attributes, Request $request)
    {
        $id = $request->only('ids')['ids'][0] ?? null;
        $p = \App\Models\Page::find($id);
        $p->position = $p->position - 10;
        $r = $p->save();
        if ($r) {
            return response()->success('Pozycja zmieniona.');
        } else {
            return response()->danger('Błąd!');
        }
    }
}
