<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Operation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $value
 * @property int $status_id
 * @property int $type_id
 * @property int $sender_account_id
 * @property int $receiver_account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereReceiverAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereSenderAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereValue($value)
 * @property string $status
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Operation whereType($value)
 */
class Operation extends Model
{
    //
}
