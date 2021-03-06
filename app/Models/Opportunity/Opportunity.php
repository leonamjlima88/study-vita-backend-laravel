<?php

namespace App\Models\Opportunity;

use App\Http\DataTransferObjects\Opportunity\OpportunityDto;
use App\Models\Customer\Customer;
use App\Models\Opportunity\Enum\OpportunityApprovalEnum;
use App\Models\Opportunity\Enum\OpportunityStatusEnum;
use App\Models\Seller\Seller;
use App\Models\Opportunity\OpportunityProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Opportunity extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'opportunity';
    protected $dates = [];
    protected $dataClass = OpportunityDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'status' => OpportunityStatusEnum::class,
        'approval' => OpportunityApprovalEnum::class,
    ];

    protected $fillable = [
        'customer_id',
        'seller_id',
        'status',
        'approval',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);        
    }    

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function opportunityProduct()
    {
        return $this->hasMany(OpportunityProduct::class);
    }
}
