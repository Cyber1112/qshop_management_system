<?php

namespace App\Contracts;

interface CreateOrUpdateBusinessCategories{

    public function execute(array $categories_id): void;

}
