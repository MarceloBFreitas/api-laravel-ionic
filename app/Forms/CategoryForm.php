<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('category', 'text',[
                'label' => 'Nome',
                "rules' => 'required|max:255|unique:categories,category,$id"
            ]);
    }
}

