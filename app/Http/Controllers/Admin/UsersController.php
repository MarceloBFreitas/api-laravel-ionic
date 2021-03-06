<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Models\User;
use CodeFlix\Repositories\UserRepository;

use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Forms\UserForm;
use CodeFlix\Forms\SenhaForm;
use Kris\LaravelFormBuilder\FormBuilder;


class UsersController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $users = $this->repository->paginate();
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

            $this->repository->create($data);
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
        return view('admin.users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class, [
            'method' => 'PUT',
            'url' => route('admin.users.update',['user' => $user->id]),
            'model' => $user
        ]);

        return view('admin.users.edit',['form'=>$form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class,[
            'data' => ['id' => $user->id]
        ]);
        if( ! $form->isValid() ){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }else{
            $data = array_except($form->getFieldValues(),'password','role'); //tiro do formulario os campos que nao quero
            $user->fill($data); //esse metodo popula os campos do fillable do model, é do eloquent
            $user->save();
            $request->session()->flash('message','Usuário Alterado com Sucesso');

            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Request $request)
    {
        $user->delete();

        $request->session()->flash('message','Usuário Removido com Sucesso');
        return redirect()->route('admin.users.index');
    }

    public function criaSenha(FormBuilder $formBuilder){
        $form = $formBuilder->create(SenhaForm::class, [
            'method' => 'POST',
            'url' => url('admin/alterar/alteraSenha')
        ]);

        return view('admin.users.novasenha',['form'=>$form]);
    }

    public function alteraSenha(Request $request)
    {
        $data = $request->all();
        if($data['senha']==$data['repita']){
            $user = \Auth::user();
            $user->password = bcrypt($data['senha']);
            $user->save();
            $request->session()->flash('message','Senha Alterada com Sucesso');
            return redirect()->route('admin.users.index');
        }else{
            $request->session()->flash('alertar','Senhas digitadas não conferem');
            return redirect()->back();
        }
    }
}
