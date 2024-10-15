<?php
namespace App\Services\Contract;

use App\Models\kyc;

interface KycServiceInterface
{
    public function storeKyc(array $data);
   
    public function showKyc(string $national_code);

    public function downloadPic(kyc $kyc);
}
