@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Exclusão de Usuário: </h3>


                <?php  $ico = Icon::create('turn');?>
                {!! Button::warning($ico.' Voltar')->asLinkTo(route('admin.users.index'))!!}
                <?php  $iconedit = Icon::create('pencil');?>
                {!! Button::primary($iconedit.' Editar')->asLinkTo(route('admin.users.edit',['user' => $user->id ]))!!}
                    <?php  $icodel = Icon::create('destroy');?>

                {!! Button::danger($icodel.' Excluir')->asLinkTo(route('admin.users.destroy',['user' => $user->id ]))
                        ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("formdelete").submit();'])
                 !!}

            <?php $formdelete = FormBuilder::plain([
                        'id' => 'formdelete',
                        'route'=> ['admin.users.destroy','user'=>$user->id],
                        'method' => 'DELETE',
                        'style' => 'display:none'
                ]) ?>


            {!! form($formdelete) !!}
            <br><br>


                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">#</th>
                            <td>{{$user->id}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Nome</th>
                            <td>{{$user->name}}</td>
                        </tr>

                        <tr>
                            <th scope="row">E-Mail</th>
                            <td>{{$user->email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

    </div>
@endsection
