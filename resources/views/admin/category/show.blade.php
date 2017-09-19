@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Exclusão de Categorias: </h3>


                <?php  $ico = Icon::create('turn');?>
                {!! Button::warning($ico.' Voltar')->asLinkTo(route('admin.categorias.index'))!!}
                <?php  $iconedit = Icon::create('pencil');?>
                {!! Button::primary($iconedit.' Editar')->asLinkTo(route('admin.categorias.edit',['id' => $category->id ]))!!}
                    <?php  $icodel = Icon::create('destroy');?>

                {!! Button::danger($icodel.' Excluir')->asLinkTo(route('admin.categorias.destroy',['category' => $category->id ]))
                        ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("formdelete").submit();'])
                 !!}

            <?php $formdelete = FormBuilder::plain([
                        'id' => 'formdelete',
                        'route'=> ['admin.categorias.destroy','id'=>$category->id],
                        'method' => 'DELETE',
                        'style' => 'display:none'
                ]) ?>


            {!! form($formdelete) !!}
            <br><br>


                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">#</th>
                            <td>{{$category->id}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Nome</th>
                            <td>{{$category->category}}</td>
                        </tr>


                    </tbody>
                </table>
            </div>

    </div>
@endsection
