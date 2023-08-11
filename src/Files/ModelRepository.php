<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * Base repository class for all model repositories.
 * Provides basic CRUD functionality.
 * This class should be extended by all model repositories.
 * 
 */

abstract class ModelRepository implements RepositoryContract
{

    protected Model $model;

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function get(int $id): Model|null
    {
        return $this->model->find($id);
    }

    public function firstBy(string $column, string $value): Model|null
    {
        return $this->model->where($column, $value)->first();
    }

    public function findBy(string $column, string $value): Collection|null
    {
        return $this->model->where($column, $value)->get();
    }

    public function update(int $id, array $data): bool|null
    {
        return $this->model->find($id)?->update($data);
    }

    public function delete(int $id): bool|int
    {
        return $this->model->destroy($id);
    }

    public function deleteMany(array $ids): bool|int
    {
        return $this->model->destroy($ids);
    }

    public function restore(int $id): bool|int
    {
        return $this->model->withTrashed()->restore($id);
    }

    public function restoreMany(array $ids): bool|int
    {
        return $this->model->withTrashed()->restore($ids);
    }
}
