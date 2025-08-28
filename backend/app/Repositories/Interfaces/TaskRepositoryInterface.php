<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function all(int $userId): Collection;
    public function find(int $id, int $userId): ?Task;
    public function create(array $data, int $userId): Task;
    public function update(int $id, array $data, int $UserId): bool;
    public function delete(int $id, int $userId): bool;
}