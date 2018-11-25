<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subject
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereUpdatedAt($value)
 * @property int $available
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereAvailable($value)
 */
class Subject extends Model
{
    //
}
