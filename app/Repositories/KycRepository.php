<?php

namespace App\Repositories;

use App\Models\kyc;
use App\Repositories\Contracts\kycRepositoryInterface;
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

    public function getAll()
    {
        return $this->model->all();
    }

    public function getByNationalCode(kyc $kyc)
    {
        return Cache::get($kyc['id']);
    }

    public function store(array $data)
    {
        $kyc=$this->model->create($data);
        $kyc->addMedia($data['pic'])->toMediaCollection('image');
        $kyc['pic']=$kyc->getMedia('image')->first()?->getUrl();
        Cache::forever(key:$kyc['id'], value: $kyc->toArray());
        return $kyc;
    }

    public function update($id, array $data)
    {
        $kyc = $this->model->find($id);
        if ($kyc) {
            $kyc->update($data);
            return $kyc;
        }
        return null;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
