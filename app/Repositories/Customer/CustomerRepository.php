<?php

namespace App\Repositories\Customer;

use App\Models\Customer\Customer;
use App\Repositories\BaseRepository;

class CustomerRepository extends BaseRepository
{
  public function __construct(Customer $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Customer);
  }
}