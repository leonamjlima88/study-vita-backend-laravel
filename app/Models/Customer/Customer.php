<?php

namespace App\Models\Customer;

use App\Http\DataTransferObjects\Customer\CustomerDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Customer extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'customer';
    protected $dates = [];
    protected $dataClass = CustomerDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'is_icms_taxpayer' => 'boolean',
    ];

    protected $fillable = [
        'business_name',
        'alias_name',
        'ein',
        'state_registration',
        'is_icms_taxpayer',
        'municipal_registration',
        'note',
        'internet_page',
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
