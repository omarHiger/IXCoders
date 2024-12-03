<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $tasks = TaskResource::collection(Task::all());
            return $this->success('Get tasks successfully', $tasks);
        } catch (Exception $th) {
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
            $task = Task::create($data);
            return $this->success('create task successfully', new TaskResource($task));

        } catch (Exception $th) {
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
        } catch (Exception $th) {
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

            $data = $request->validated();
            $task->update($data);
            return $this->success('Update Task successfully', new TaskResource($task));
        } catch (Exception $th) {
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
            $task->delete();
            return $this->success('Delete task successfully');
        } catch (Exception $th) {
            return $this->serverError($th->getMessage());
        }
    }
}
