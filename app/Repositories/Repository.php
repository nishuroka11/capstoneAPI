<?php

namespace App\Repositories;

interface Repository
{
    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public function getModel();

    /**
     * Gets the query of model for operation
     *
     * @return mixed
     */
    public function getQuery();

    /**
     * Gets count of row being shown perpage.
     *
     * @return int
     */
    public function perPage();

    /**
     * Gets all data with pagination
     * @return mixed
     */
    public function getWithPagination();

    public function getBy($key, $value, $operator = '=', $paginate = true);

    /**
     * Gets all data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Search data by specify criteria.
     *
     * @param mixed $searchQuery
     *
     * @return mixed
     */
    public function search($searchQuery);

    /**
     * All or search query
     * @param null $searchQuery
     * @return mixed
     */
    public function allOrSearch($searchQuery = null);

    /**
     * Find data by given an identifier.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Find data by specified column name and value.
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy($key, $value, $operator = '=');

    /**
     * Create a new data.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update old data
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * Delete a specified data by given data id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id);

    public function getCount();

    public function filterQuery($query, $data);

    public function filterBy($query, $columnName, $value);

    public function filterLikeBy($query, $columnName, $keyword);
}
