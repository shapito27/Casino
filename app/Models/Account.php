<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Account
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $type_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\app\Account whereUserId($value)
 * @property-read \app\Models\User $user
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account whereType($value)
 */
class Account extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
