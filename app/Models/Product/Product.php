<?php

namespace App\Models\Product;

use App\Http\DataTransferObjects\Product\ProductDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Product extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'product';
    protected $dates = [];
    protected $dataClass = ProductDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'cost_price' => 'float',
        'sale_price' => 'float',
        'minimum_quantity' => 'float',
        'current_quantity' => 'float',        
        'is_discontinued' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'reference_code',
        'ean_code',
        'cost_price',
        'sale_price',
        'minimum_quantity',
        'current_quantity',
        'note',
        'is_discontinued',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }    
}
