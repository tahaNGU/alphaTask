<?php

namespace App\Repositories\Contracts;

use App\Models\kyc;

interface kycRepositoryInterface
{
    public function getByNationalCode(kyc $kyc);

    public function store(array $data);

    public function downloadPic(kyc $kyc);
}
