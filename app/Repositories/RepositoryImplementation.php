<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class RepositoryImplementation implements Repository
{
    /**
     * Gets model for operation.
     *
     * @return mixed
     */
    public abstract function getModel();

    public function getQuery()
    {
        return $this->getModel()->query();
    }

    /**
     * Get all data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->getModel()->get();
    }

    /**
     * Search data by specify criteria.
     *
     * @param $searchKeyword
     * @param string $field
     * @return mixed
     */
    public function search($searchKeyword, $field = '')
    {
        $search = "%{$searchKeyword}%";
        return $this->getModel()
            ->where($field, 'like', $search)
            ->paginate($this->perPage());
    }

    /**
     * All or search query
     * @param null $searchQuery
     * @param string $field
     * @return mixed
     */
    public function allOrSearch($searchQuery = null, $field = '')
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery, $field);
    }

    /**
     * Get count of row being shown perpage.
     *
     * @return int
     */
    public function perPage()
    {
        return 20;
    }

    public function searchesPerPage()
    {
        return 100;
    }

    /**
     * Get all data with pagination
     * @return mixed
     */
    public function getWithPagination()
    {
        return $this->getModel()->latest()->paginate($this->perPage());
    }

    /**
     * Find data by given an identifier.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * Find data by specified column name and value.
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     *
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->first();
    }

    /**
     * Find data by specified column name and value.
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     *
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getBy($key, $value, $operator = '=', $paginate = true)
    {
        if ($paginate) {
            return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
        } else {
            return $this->getModel()->where($key, $operator, $value)->get();
        }
    }

    /**
     * Create a new data.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    /**
     * Updates the row with the provided data and id
     *
     * @param array $data
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, $id)
    {
        $entity = $this->find($id);
        $entity->update($data);
        return $entity;
    }

    /**
     * Updates the table based on the field value condition.
     *
     * @param $field
     * @param $value
     * @param $updateData
     * @return mixed
     */
    public function updateBy($field, $value, $updateData)
    {
        DB::beginTransaction();
        try {
            $result = $this->getModel()->where($field, $value)->update($updateData);
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollback();

            Log::error('RepoImp updateBy ' . $exception->getMessage() . ' Trace : ' . $exception->getTraceAsString());

            return false;
        }
    }

    /**
     * Deletes a row with the provided id.
     *
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $object = $this->find($id);
        if (!is_null($object)) {
            $object->delete();
            return true;
        }
        return false;
    }

    public function findBySingle($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->first();
    }

    public function getCount()
    {
        return $this->getModel()->count();
    }

    public function filterBy($query, $columnName, $value)
    {
        return $query->where($columnName, $value);
    }

    public function filterLikeBy($query, $columnName, $keyword)
    {
        return $query->where($columnName, 'LIKE', '%' . $keyword . '%');
    }

    public function filterQuery($query, $data){

        return $query;
    }
}
