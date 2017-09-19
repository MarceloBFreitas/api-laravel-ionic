<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\CategoryForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\Category;
use CodeFlix\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;


class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categorias = $this->repository->paginate();
        return view('admin.category.index',['categorias'=>$categorias]);
    }

    public function show($id)
    {
        return view('admin.category.show', ['category'=>$this->repository->find($id)]);
    }

    public function edit($id,FormBuilder $formBuilder)
    {
        $category = $this->repository->find($id);
        $form = $formBuilder->create(CategoryForm::class, [
            'method' => 'PUT',
            'url' => route('admin.categorias.update',['categoria' => $category->id]),
            'model' => $category
        ]);

        return view('admin.category.edit',['form'=>$form]);
    }

    public function update(Request $request, $id,FormBuilder $formBuilder)
    {
        $category = $this->repository->find($id);
        $form = $formBuilder->create(CategoryForm::class,[
            'data' => ['id' => $category->id]
        ]);
        if( ! $form->isValid() ){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }else{
            $category->fill($request->all()); //esse metodo popula os campos do fillable do model, é do eloquent
            $category->save();
            $request->session()->flash('message','Categoria Alterada com Sucesso');

            return redirect()->route('admin.categorias.index');
        }
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CategoryForm::class, [
            'method' => 'POST',
            'url' => route('admin.categorias.store')
        ]);

        return view('admin.category.create',['form'=>$form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder,Request $request)
    {
        $form = $formBuilder->create(CategoryForm::class);
        if( ! $form->isValid() ){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }else{
            $category = new Category();
            $data = $form->getFieldValues(); //retorna
            Category::create($data);
            $request->session()->flash('message','Categoria criada com Sucesso');
            return redirect()->route('admin.categorias.index');
        }
    }

    public function destroy($id,Request $request)
    {
        $this->repository->find($id)->delete();
        $request->session()->flash('message','Categoria Removida com Sucesso');
        return redirect()->route('admin.categorias.index');
    }


}
