<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SenhaForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('senha', 'email',[
                'label' => 'Digite a Senha',
                'rules' => 'required|max:255'
            ])
            ->add('repita', 'email',[
                'label' => 'Repita a Senha',
                'rules' => "required|max:255"  //tabela/campo/id que funciona para create e para update
            ]);
    }
}
