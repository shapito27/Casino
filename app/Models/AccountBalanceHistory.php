<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountBalanceHistory
 *
 * @package App\Models
 * @property int $id
 * @property int $account_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountBalanceHistory whereValue($value)
 * @mixin \Eloquent
 */
class AccountBalanceHistory extends Model
{
    //
}
