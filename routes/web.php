<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Poll;

Route::group(['prefix' => 'api', 'middleware' => 'allowOrigin'], function () {

    Route::get('/polls/{page}', function ($page) {
        return Response::json(['status' => 200, 'polls' => Poll::skip(($page - 1) * 5)
            ->take(5)
            ->get(['id', 'question'])->toArray()
        ]);
    });

    Route::get('/poll/{id}', function ($id) {
        $poll = Poll::find($id);
        //out going format: {"status":200,"poll":{"id":"1","question":"What is your preferred framework for 2014 ?","options":["Laravel","PhalconPHP","CakePHP"]}}
        return Response::json(['status' => 200, 'poll' => $poll->toArray()]);
    });

    Route::post('/poll/{id}/option', function ($id) {
        $option = request('option');
        $poll = Poll::find($id);
        $options = implode(',', $poll->options);
        $rules = [
            'option' => 'in:' . $options,
        ];
        $valid = Validator::make(compact('option'), $rules);
        if ($valid->passes()) {
            $poll->stats()->where('option', '=', $option)->increment('vote_count');
            return Response::json(['status' => 200, 'mesg' => 'saved successfully!']);
        } else
            return Response::json(['status' => 400, 'mesg' => 'option not allowed!'], 400);

    });

    Route::get('/stats/{id}', function ($id) {
        $poll = Poll::find($id);
        $stats = $poll->stats()
            ->select(['option', 'vote_count as stats'])
            ->get()->toArray();
        return Response::json(['status' => 200, 'stats' => $stats]);
    });
});