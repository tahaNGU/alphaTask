<?php

namespace App\Repositories\Contracts;

use App\Models\kyc;

interface kycRepositoryInterface
{
    public function getByNationalCode(string $national_code);

    public function store(array $data);

    public function downloadPic(kyc $kyc);
}
