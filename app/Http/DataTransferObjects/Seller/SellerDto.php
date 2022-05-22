<?php

namespace App\Http\DataTransferObjects\Seller;

use Illuminate\Validation\Rule as ValidationRule;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class SellerDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('required|string|max:80')]
    public string $name,

    public string $ein,

    #[Rule('nullable|string')]
    public ?string $note,

    #[Rule('nullable|string|max:10')]
    public ?string $zipcode,

    #[Rule('nullable|string|max:100')]
    public ?string $address,

    #[Rule('nullable|string')]
    public ?string $address_number,

    #[Rule('nullable|string|max:100')]
    public ?string $complement,

    #[Rule('nullable|string|max:100')]
    public ?string $district,

    #[Rule('nullable|string|max:100')]
    public ?string $reference_point,

    #[Rule('nullable|string|max:100')]
    public ?string $city,    

    #[Rule('nullable|string|max:30')]
    public ?string $phone,

    #[Rule('nullable|string|email|max:100')]
    public ?string $email,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    request()->merge([
      'ein' => onlyNumbers(request('ein', '')),
    ]);
  }  

  public static function rules(): array
  {
    static::prepareForValidation();
    return [
      'ein' => [
        'required',
        'string',
        'numeric',
        ValidationRule::unique('seller', 'ein')->ignore(getRouteParameter(request()->route())),
        fn ($att, $value, $fail) => static::rulesEin($att, $value, $fail),
      ],
    ];
  }

  // Validar CPF/CNPJ
  public static function rulesEin($att, $value, $fail)
  {
    if ($value && (!cpfOrCnpjIsValid($value))) {
      $fail(trans('request_validation_lang.field_is_not_valid', ['value' => $value]));
    }
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
