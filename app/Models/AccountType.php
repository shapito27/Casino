<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AccountType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountType whereUpdatedAt($value)
 */
class AccountType extends Model
{
    //
}
