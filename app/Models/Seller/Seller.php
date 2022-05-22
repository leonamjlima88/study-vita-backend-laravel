<?php

namespace App\Models\Seller;

use App\Http\DataTransferObjects\Seller\SellerDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Seller extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'seller';
    protected $dates = [];
    protected $dataClass = SellerDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [        
    ];

    protected $fillable = [
        'name',
        'ein',
        'note',
        'zipcode',
        'address',
        'address_number',
        'complement',
        'district',
        'city',
        'reference_point',
        'phone',
        'email',
      ];

    protected static function boot()
    {
        parent::boot();
        
        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model->ein = onlyNumbers($model->ein ?? ''));

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model->ein = formatCpfCnpj($model->ein ?? ''));
    }    
}
