<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Folder;
//舞追加2022/02/13
use App\Models\Task;
//舞追加2022/02/16
use App\Http\Requests\CreateTask;
//2.19追加
use App\Http\Requests\EditTask;
//2.22追加
use Illuminate\Support\Facades\Auth;
// ★ Authクラスをインポートする 2.23追加⭐︎

class TaskController extends Controller
{
    //
    public function index(int $id)
    {
    // すべてのフォルダを取得する
    // $folders = Folder::all();
    // ★ ユーザーのフォルダを取得する  2.24追加
    $folders = Auth::user()->folders()->get();

    // 選ばれたフォルダを取得する
    $current_folder = Folder::find($id);

    // 選ばれたフォルダに紐づくタスクを取得する
    // $tasks = Task::where('folder_id', $current_folder->id)->get();
    //リレーション機能を使った書き換え
    $tasks = $current_folder->tasks()->get(); // ★

    return view('tasks/index', [
        'folders' => $folders,
        'current_folder_id' => $current_folder->id,
        'tasks' => $tasks,
    ]);
    }


    /**
    * GET /folders/{id}/tasks/create
    */
    public function showCreateForm(int $id)
    {
        return view('tasks/create',
            [
                'folder_id' => $id
            ]);
    }

    //２・１９追加
    public function create(int $id, CreateTask $request)
    {
    $current_folder = Folder::find($id);

    $task = new Task();
    $task->title = $request->title;
    $task->due_date = $request->due_date;

    $current_folder->tasks()->save($task);

    return redirect()->route('tasks.index', [
        'id' => $current_folder->id,
    ]);
    }

    /**
    * GET /folders/{id}/tasks/{task_id}/edit
    */
    public function showEditForm(int $id, int $task_id)
    {
    $task = Task::find($task_id);

    return view('tasks/edit', [
        'task' => $task,
    ]);
    }

    //2.22追加
    public function edit(int $id, int $task_id, EditTask $request)
    {
    // 1
    $task = Task::find($task_id);

    // 2
    $task->title = $request->title;
    $task->status = $request->status;
    $task->due_date = $request->due_date;
    $task->save();

    // 3
    return redirect()->route('tasks.index', [
        'id' => $task->folder_id,
    ]);
    }



}
