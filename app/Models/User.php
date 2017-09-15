<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use CodeFlix\Notifications\meuResetDeSenha;

class User extends Authenticatable implements TableInterface
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    const ROLE_ADMIN = 1;
    const ROLE_CLIENT = 2;


    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new meuResetDeSenha($token));
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        //retorna o header da tabela
        return ['#','Nome','E-Mail'];
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
            case 'nome':
                return $this->name;
                break;
            case 'E-Mail':
                return $this->email;
                break;
        }
    }
}
