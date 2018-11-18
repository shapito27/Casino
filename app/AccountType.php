<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AccountType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountType whereUpdatedAt($value)
 */
class AccountType extends Model
{
    //
}
