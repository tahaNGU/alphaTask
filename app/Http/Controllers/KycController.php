<?php

namespace App\Http\Controllers;

use App\Http\Requests\KycRequest;
use App\Models\kyc;
use App\Services\Contract\KycServiceInterface;

class KycController extends Controller
{
   public function __construct(protected KycServiceInterface $kycService)
    {
        $this->kycService = $kycService;
    }

    public function store(KycRequest $request)
    {
        return $this->kycService->storeKyc($request->validated());
    }

    public function show(kyc $kyc){
        return $this->kycService->showKyc($kyc);
    }
}
