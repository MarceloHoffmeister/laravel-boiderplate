<?php

namespace App\Support\Database;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * Model class for repo.
     *
     * @var string
     */
    protected $modelClass;

    /**
     * @return Builder|\Illuminate\Database\Query\Builder
     * @throws BindingResolutionException
     */
    public function newQuery()
    {
        return app()->make($this->modelClass)->newQuery();
    }

    /**
     * @param mixed|null $query
     * @param int $take
     * @param bool $paginate
     * @return LengthAwarePaginator
     * @throws BindingResolutionException
     */
    public function doQuery($query = null, int $take = 20, bool $paginate = true): LengthAwarePaginator
    {
        if (! $query) {
            $query = $this->newQuery();
        }

        if ($paginate) {
            return $query->paginate($take);
        }

        if ($take) {
            return $query->take($take)->get();
        }

        return $query->get();
    }

    /**
     * Responsal por buscar todos os registros.
     *
     * @param int $take
     * @param bool $paginate
     * @return LengthAwarePaginator
     * @throws BindingResolutionException
     */
    public function getAll(int $take = 20, bool $paginate = false): LengthAwarePaginator
    {
        return $this->doQuery(null, $take, $paginate);
    }

    /**
     * @param int $id
     * @param bool $fail
     * @return Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     * @throws BindingResolutionException
     */
    public function findByID(int $id, bool $fail = true)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }

        return $this->newQuery()->find($id);
    }

    /**
     * Localizar elemento pela chave primária com id definido como padrão.
     *
     * @param int $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function findOne(int $id)
    {
        $pk_name = app()->make($this->modelClass)->getKeyName();

        return $this->newQuery()
            ->where($pk_name, $id)
            ->get()
            ->first();
    }

    /**
     * Criar um objeto Model com as informações fornecidas.
     *
     * @param array $data
     * @return Model
     * @throws BindingResolutionException
     */
    public function factory(array $data = []): Model
    {
        $model = $this->newQuery()->getModel()->newInstance();

        $this->fillModel($model, $data);

        return $model;
    }

    /**
     * Preencha um registro (desejável vazio) com os dados fornecidos.
     *
     * @param Model $model
     * @param array $data
     * @return void
     */
    public function fillModel(Model $model, array $data = []): void
    {
        $model->fill($data);
    }

    /**
     * Salvar um objeto Model.
     *
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model
    {
        $model->save();

        return $model;
    }

    /**
     * deletar um objeto Model.
     *
     * @param Model $model
     * @return bool|null
     * @throws Exception
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }

    /**
     * Responsavel por criar um objeto Model com as informações fornecidas.
     *
     * @param array $data
     * @return Model
     * @throws BindingResolutionException
     */
    public function create(array $data): Model
    {
        $model = $this->factory($data);

        return $this->save($model);
    }

    /**
     * Responsavel por atualizar um objeto Model com as informações fornecidas.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data = []): Model
    {
        $this->fillModel($model, $data);

        return $this->save($model);
    }

    /**
     * Responsavel por exluir um objeto Model com as informações fornecidas.
     *
     * @param Model $model
     * @return bool|Model|null
     * @throws Exception
     */
    public function destroy(Model $model)
    {
        $model = $this->delete($model);

        return $model;
    }
}
