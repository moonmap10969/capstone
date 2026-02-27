<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingItem extends Model
{
    protected $fillable = [
    'section_id',
    'component_id',
    'item_name',
    'max_score',
    'date_administered'
];

    public function component()
    {
        return $this->belongsTo(GradingComponent::class, 'component_id');
    }
}