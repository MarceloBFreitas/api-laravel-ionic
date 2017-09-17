<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Models\User;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Forms\UserForm;
use Kris\LaravelFormBuilder\FormBuilder;


class UsersController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.users.store')
        ]);

        return view('admin.users.create',['form'=>$form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder,Request $request)
    {
        $form = $formBuilder->create(UserForm::class);
        if( ! $form->isValid() ){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }else{
            $user = new User();

            $data = $form->getFieldValues(); //retorna
            $data['role'] = User::ROLE_ADMIN;
            $data['password'] = $user->generatedPassword();
            User::create($data);

            $request->session()->flash('message','usuário criado com Sucesso');

            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //route model binding

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
