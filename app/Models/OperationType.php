<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OperationType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationType findByCode($code)
 */
class OperationType extends Model
{
    const OPERATION_TYPE_WIN = 'win';
    const OPERATION_TYPE_CONVERTATION = 'convertation';
    const OPERATION_TYPE_WITHDRAW = 'withdraw';
    const OPERATION_TYPE_CHARGE = 'charge';

//    public function scopeFindByCode($query, string $code): self
//    {
//        return $query->where('code', '=', $code)->first();
//    }
}