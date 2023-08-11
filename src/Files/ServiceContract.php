<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceContract
{
    public function getAll(): Collection;
    public function get(int $id): Model|null;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool|null;
    public function delete(int $id): bool|int;
    public function deleteMany(array $ids): bool|int;
    public function restore(int $id): bool|int;
    public function restoreMany(array $ids): bool|int;
}
