<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SenhaForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('senha', 'password',[
                'label' => 'Digite a Senha',
                'rules' => 'required|max:255'
            ])
            ->add('repita', 'password',[
                'label' => 'Repita a Senha',
                'rules' => "required|max:255,$id "  //tabela/campo/id que funciona para create e para update
            ]);
    }
}
