<?php namespace DancerDeck\Core;

/**
 * Based on laravel.io's code.
 * @see https://github.com/LaravelIO/laravel.io/blob/master/app/Lio/Core/EloquentRepository.php
 */

use Illuminate\Database\Eloquent\Model;
use DancerDeck\Core\Exceptions\EntityNotFoundException;

abstract class EloquentRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function setNewModel($attributes = [])
    {
        $model = $this->getNew($attributes);
        $this->setModel($model);

        return $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id, $with = null)
    {
        if ($with) {
            return $this->model->with($with)->find($id);
        }

        return $this->model->find($id);
    }

    public function requireById($id)
    {
        $model = $this->getById($id);

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    /**
     * @return Model
     */
    public function getNew($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    public function save($data)
    {
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }

    public function update($data)
    {
        $this->model->fill($data);

        return $this->model->save();
    }

    public function delete($model)
    {
        return $model->delete();
    }

    protected function storeEloquentModel($model)
    {
        $this->setModel($model);

        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    protected function storeArray($data)
    {
        $model = $this->getNew($data);

        return $this->storeEloquentModel($model);
    }

}
