<?php


namespace App\Domains\Person\Services;


use App\Domains\Person\Database\Repositories\UserRepository;

class UserService
{
    protected $repo;

    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index($data = [])
    {
        return $this->repo->getAll();
    }

    public function store($data)
    {
        return $this->repo->save($data);
    }
}
