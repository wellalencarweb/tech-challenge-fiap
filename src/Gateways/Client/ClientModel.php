<?php

namespace Src\Gateways\Client;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use  HasFactory;

    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'cpf'
    ];

    protected static function newFactoryTimes(int $count): ClientFactory
    {
        return ClientFactory::times($count);
    }
}
