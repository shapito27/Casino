<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OperationType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OperationType whereUpdatedAt($value)
 */
class OperationType extends Model
{
    //
}
