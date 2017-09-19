<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements TableInterface
{
    use TransformableTrait;

    protected $table = "categories";

    protected $fillable = ['category'];

    public function getTableHeaders()
    {
        //retorna o header da tabela
        return ['#','Categoria'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        //valor de acordo com o header
        switch ($header){
            case '#':
                return $this->id;
                break;
            case 'Categoria':
                return $this->category;
                break;
        }
    }

}
