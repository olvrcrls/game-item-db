<?php

namespace App\Base;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $resource;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = $this->getModel();
        $this->resource = $this->getResource();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract public function getModel(): Model;

    abstract public function getResource(): string;

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $model = $this->model->create($data);
        return new $this->resource([$model]);
    }

    /**
     * @param int|Model $id
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int|Model $id, array $data)
    {
        $model = $id instanceof Model ? $id : $this->model->findOrFail($id);
        $model->update($data);

        $model->fresh();
        return new $this->resource([$model]);
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            $model = $this->model->findOrFail($id);
            $model->delete();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model|bool
     * @throws \Exception
     */
    public function find(string $id)
    {
        $model = $this->model->where($this->model->getRouteKeyName(), $id)->first();

        return $model ? (new $this->resource([$model])) : false;
    }

    /**
     * @param array<string> $columns
     * @return JsonResource
     */
    public function all(...$columns): JsonResource
    {
        if (empty($columns)) {
            $columns = ['*'];
        }

        $data = $this->model->all($columns);
        return new $this->resource($data);
    }
}