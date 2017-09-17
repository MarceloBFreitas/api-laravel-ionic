@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Usuário: </h3>
            {!! Button::danger('Voltar')->asLinkTo(route('admin.users.index'))!!}
            <?php  $icon = Icon::create('pencil');?>
           {!! form($form
           ->add('Salve','submit',['attr' => ['class' => 'btn btn-primary btn-block'],
           'label' => $icon. " Editar"])) !!}


        </div>
    </div>
@endsection
