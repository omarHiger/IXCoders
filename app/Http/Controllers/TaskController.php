<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Events\TaskStatusUpdated;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $tasks = TaskResource::collection(Task::filter($request->all())->paginate($request['perPage'] ?? 5));
            return $this->success('Get tasks successfully', $tasks);
        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? TaskStatus::Pending;
            $task = Task::create($data);
            return $this->success('create task successfully', new TaskResource($task));

        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $task = Task::find($id);
            if (!$task)
                return $this->notFound('Task not found');

            return $this->success('Get Task successfully', new TaskResource($task));
        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $task = Task::find($id);
            if (!$task)
                return $this->notFound('Task not found');

            //this line for authorize that only owner can update task
            Gate::authorize('update', $task);

            $data = $request->validated();
            $task->update($data);
            return $this->success('Update Task successfully', new TaskResource($task));
        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function changeStatus(string $id, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $task = Task::find($id);
            if (!$task)
                return $this->notFound('Task not found');
            $task->update([
                'status' => $request['status']
            ]);
            event(new TaskStatusUpdated($task));
            return $this->success('task status updated successfully', new TaskResource($task));

        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $task = Task::find($id);
            if (!$task)
                return $this->notFound('Task not found');

            //this line for authorize that only owner can delete task
            Gate::authorize('delete', $task);

            $task->delete();
            return $this->success('Delete task successfully');
        } catch (\throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }
}
