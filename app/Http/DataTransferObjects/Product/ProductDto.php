<?php

namespace App\Http\DataTransferObjects\Product;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class ProductDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('required|string|max:120')]
    public string $name,

    #[Rule('nullable|string|max:36')]
    public ?string $reference_code,

    #[Rule('nullable|string|max:36')]
    public ?string $ean_code,

    #[Rule('nullable|numeric|min:0')]
    public ?float $cost_price,

    #[Rule('nullable|numeric|min:0')]
    public ?float $sale_price,

    #[Rule('nullable|numeric|min:0')]
    public ?float $minimum_quantity,

    #[Rule('nullable|numeric|min:0')]
    public ?float $current_quantity,

    #[Rule('nullable|string')]
    public ?string $note,

    #[Rule('nullable|boolean')]
    public ?bool $is_discontinued,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,
  ) {
  }

  /**
   * Utilizado para formatar os dados caso seja necessário
   *
   * @return array
   */
  public function toResource(): array
  {
    return parent::toArray();
  }
}
