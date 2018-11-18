<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ExchangeRate
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $sender_account_type_id
 * @property int $receiver_account_type_id
 * @property float $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate whereReceiverAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate whereSenderAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeRate whereUpdatedAt($value)
 */
class ExchangeRate extends Model
{
    //
}
