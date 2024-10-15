<?php
namespace App\Services;

use App\Http\Resources\kycResource;
use App\Models\kyc;
use App\Repositories\Contracts\kycRepositoryInterface;
use App\Services\Contract\KycServiceInterface;
use Symfony\Component\HttpFoundation\Response;
class KycService implements KycServiceInterface
{
    protected $kycRepository;

    public function __construct(kycRepositoryInterface $kycRepository)
    {
        $this->kycRepository = $kycRepository;
    }

    public function storeKyc($data)
    {
        $kyc=$this->kycRepository->store($data);
        return response()->json([
            'msg'=>'created successfully',
            'data'=>$kyc
        ],Response::HTTP_CREATED);

    }

    public function downloadPic(kyc $kyc){
        return $this->kycRepository->downloadPic($kyc);
    }

    public function showKyc(string $national_code){
        return response()->json([
            'msg'=>'kyc sample model',
            'data'=>$this->kycRepository->getByNationalCode($national_code)
        ],Response::HTTP_ACCEPTED);
    }

}
