<?php

namespace App\Base;

use Exception;

abstract class BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = $this->getModel();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract public function getModel();

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int   $id
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);

        return $model->fresh();
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
    public function find(int $id)
    {
        $model = $this->model->find($id);

        return $model ?? false;
    }
}