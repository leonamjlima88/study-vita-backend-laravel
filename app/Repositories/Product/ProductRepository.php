<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
  public function __construct(Product $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Product);
  }
}
