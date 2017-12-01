<?php

namespace App\Repositories;

/**
 * Base Repository
 */
trait BaseRepository
{
    /**
     * Store new Record
     *
     * @param   $input
     * @return model
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * Save the input
     *
     * @param   $model
     * @param   $input
     * @return model
     */
    public function save($model, $input)
    {
        $model->fill($input);
        $model->save();

        return $model;
    }
}
