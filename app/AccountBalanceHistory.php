<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AccountBalanceHistory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $account_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AccountBalanceHistory whereValue($value)
 */
class AccountBalanceHistory extends Model
{
    //
}
