<?php

namespace CodeFlix\Repositories;

use Jrean\UserVerification\Facades\UserVerification;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Repositories\UserRepository;
use CodeFlix\Models\User;
use CodeFlix\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{



    public function create(array $attributes)
    {
        $user = new User();
        $attributes['role'] = User::ROLE_ADMIN;
        $attributes['password'] = $user->generatedPassword();
        $model = parent::create($attributes); //guarda o modelo criado
        UserVerification::generate($model); //vai criar um token e guardar no verification_token
        UserVerification::send($model,'Sua Conta foi Criada');
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
