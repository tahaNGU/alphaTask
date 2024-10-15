<?php

namespace App\Repositories;

use App\Models\kyc;
use App\Repositories\Contracts\kycRepositoryInterface;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class KycRepository implements kycRepositoryInterface
{
    protected $model;
    protected $cacheKey = 'kyc';
    public function __construct(kyc $kyc)
    {
        $this->model = $kyc;
    }

    public function getByNationalCode(kyc $kyc)
    {
        return Cache::get($kyc['id']);
    }

    public function store(array $data)
    {
        $kyc=$this->model->create($data);
        $kyc->addMedia($data['pic'])->toMediaCollection('image');
        $kyc['pic']=route('kyc.pic',['kyc'=>$kyc['id']]);
        Cache::forever(key:$kyc['id'], value: $kyc->toArray());
        return $kyc;
    }
    public function downloadPic(kyc $kyc){
        return $kyc;
    }

}
