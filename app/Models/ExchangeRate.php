<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ExchangeRate
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $sender_account_type_id
 * @property int $receiver_account_type_id
 * @property float $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereReceiverAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereSenderAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExchangeRate whereUpdatedAt($value)
 */
class ExchangeRate extends Model
{
    //
}
