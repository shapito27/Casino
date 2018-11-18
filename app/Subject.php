<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subject
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subject whereUpdatedAt($value)
 */
class Subject extends Model
{
    //
}
