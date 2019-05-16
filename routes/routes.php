<?php


Route::get(config('explainer.docs_uri'), function () {

    return view('explainer::app')->with([
        'data' => @file_get_contents(config('explainer.json_path'))
    ]);

})->name('explainer.docs')->explain(config('explainer.explain_self') ? Lemon\Explainer\Explains\SelfExplain::class : NULL);


Route::get(config('explainer.json_uri'), function () {

    return response()->json(json_decode(@file_get_contents(config('explainer.json_path'))));

})->name('explainer.json');
