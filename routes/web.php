<?php

use Illuminate\Http\Request;
use App\Task;

Route::get('/', function () {                           //read
    $tasks = Task::orderBy('created_at','asc')->get();
    return view('tasks.index',[
        'tasks' => $tasks,
    ]);
});

Route::post('/task', function (Request $request) {      //create
    $validator = Validator::make($request->all(),[
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

Route::delete('/task/{task}', function (Task $task) {   //delete
    $task->delete();
    return redirect('/');
});

Route::patch('/task/{task}', function(Task $task){      //update
    $task->done = 1;
    $task->update();
    return redirect('/');
});

Route::patch('/task/undo/{task}', function(Task $task){      //update
    $task->done = 0;
    $task->update();
    return redirect('/');
});