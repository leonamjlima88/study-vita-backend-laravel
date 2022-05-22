<?php

namespace App\Repositories\Seller;

use App\Models\Seller\Seller;
use App\Repositories\BaseRepository;

class SellerRepository extends BaseRepository
{
  public function __construct(Seller $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Seller);
  }
}