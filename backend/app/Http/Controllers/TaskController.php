<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\TaskRequest;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        $userId = auth()->id();
        $tasks = $this->taskService->getUserTasks($userId);

        return response()->json($tasks);
    }

    public function show(int $id): JsonResponse
    {
        $userId = auth()->id();
        $task = $this->taskService->getUserTask($id, $userId);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $userId = auth()->id();
        $validated = $request->validated();

        $task = $this->taskService->createTask($validated, $userId);
        
        // Broadcast event for real-time notification
        event(new TaskCreated($task));

        return response()->json($task, 201);
    }

    public function update(TaskRequest $request, int $id): JsonResponse
    {
        $userId = auth()->id();
        $validated = $request->validated();

        $task = $this->taskService->updateTask($id, $validated, $userId);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function destroy(int $id): JsonResponse
    {
        $userId = auth()->id();
        $deleted = $this->taskService->deleteTask($id, $userId);

        if (!$deleted) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['message' => 'Task deleted successfully']);
    }
}