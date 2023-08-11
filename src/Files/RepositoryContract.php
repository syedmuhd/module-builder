<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Contract for all model repositories.
 */

interface RepositoryContract
{
    public function create(array $data): Model;
    public function get(int $id): Model|null;
    public function update(int $id, array $data): bool|null;
    public function delete(int $id): bool|int;
    public function deleteMany(array $ids): bool|int;
    public function restore(int $id): bool|int;
    public function restoreMany(array $ids): bool|int;
}
