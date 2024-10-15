<?php

namespace App\Repositories\Contracts;

use App\Models\kyc;

interface kycRepositoryInterface
{
    public function getAll();

    public function getByNationalCode(kyc $kyc);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}
