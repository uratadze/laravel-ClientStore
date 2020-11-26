<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $fillable = [
        'person', 'product', 'quantity', 'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPerson()
    {
        return $this->belongsTo(Person::class, 'person', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }

    /**
     * current user filter
     * 
     * @return query
     */
    public function scopeByUser($query)
    {
        return $query ->whereHas('getPerson',function($query)
        {
            $query->where('client', Auth::id());
        });
    }

    /**
     * date filter
     * 
     * @return query
     */
    public function scopeSearchByDate($query, $from, $till)
    {
        return $query->where('created_at', '>=', $from)->where('created_at', '<=', date('Y-m-d',strtotime($till) + 86400));
    }

    /**
     * Get status name.
     * 
     * @return string
     */
    public function getStatus()
    {
        if($this->status == 0)
        {
            return __('მიღებულია');
        }
        elseif($this->status == 1)
        {
            return __('გზაშია');
        }
        else
        {
            return __('დასრულებულია');
        }
    }
}
