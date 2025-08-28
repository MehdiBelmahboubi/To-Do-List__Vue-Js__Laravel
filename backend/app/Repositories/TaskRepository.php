<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(int $userId): Collection
    {
        return Task::where('user_id', $userId)->get();
    }

    public function find(int $id, int $userId): ?Task
    {
        return Task::where('user_id', $userId)->find($id);
    }

    public function create(array $data, int $userId): Task
    {
        $data['user_id'] = $userId;
        return Task::create($data);
    }

    public function update(int $id, array $data, int $userId): bool
    {
        $task = $this->find($id, $userId);
        
        if (!$task) {
            return false;
        }
        
        return $task->update($data);
    }

    public function delete(int $id, int $userId): bool
    {
        $task = $this->find($id, $userId);
        
        if (!$task) {
            return false;
        }
        
        return $task->delete();
    }
}