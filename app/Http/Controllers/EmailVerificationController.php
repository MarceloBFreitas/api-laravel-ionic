<?php

namespace CodeFlix\Http\Controllers;

use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use Jrean\UserVerification\Traits\VerifiesUsers;

class EmailVerificationController extends Controller
{
    use VerifiesUsers; //adicionar essa trait

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    //sobrescrever dois métodos
    public function redirectAfterVerification()
    {
        $this->loginUser();
        return url('/admin/dashboard');
    }

    protected function loginUser()
    {
        $email = \Request::get('email');
        $user = $this->repository->findByField('email',$email)->first();
        \Auth::login($user);
    }
}
