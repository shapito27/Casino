<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Operation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $value
 * @property int $status_id
 * @property int $type_id
 * @property int $sender_account_id
 * @property int $receiver_account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereReceiverAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereSenderAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereValue($value)
 */
class Operation extends Model
{
    //
}
