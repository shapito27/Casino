<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrizeInterval
 *
 * @property int $id
 * @property string $name
 * @property string $prize_type
 * @property int $from
 * @property int $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval wherePrizeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $modified_by
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrizeInterval whereModifiedBy($value)
 */
class PrizeInterval extends Model
{
    //
}
