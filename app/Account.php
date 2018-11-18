<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Account
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $type_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUserId($value)
 */
class Account extends Model
{
    //
}
