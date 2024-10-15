<?php

namespace Tests\Feature;

use App\Models\kyc;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class KycTest extends TestCase
{
    use RefreshDatabase;
    private $prefixRoute="kyc";
    public function test_create(): void
    {
        $response = $this->post(route($this->prefixRoute.".store"),[
            'national_code'=>rand(1000000000,9000000000),
            'pic'=>uploadedFile::fake()->image('photo.jpg'),
            'birthday'=>'1389/01/02'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_validation_natinal_code(){
        $kyc=self::__kyc();
        $response = $this->post(route($this->prefixRoute.".store"),[
            'national_code'=>$kyc['national_code'],
            'pic'=>uploadedFile::fake()->image('photo.jpg'),
            'birthday'=>'1389/01/02'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertUnprocessable();
    }
    public function test_validation_biethday(){
        $response = $this->post(route($this->prefixRoute.".store"),[
            'national_code'=>rand(1000000000,9000000000),
            'pic'=>uploadedFile::fake()->image('photo.jpg'),
            'birthday'=>'1389-01-02'
        ]);
        $response->assertStatus(status: Response::HTTP_UNPROCESSABLE_ENTITY)->assertUnprocessable();
    }
    public function test_get_kyc(){
        $kyc=self::__kyc();
        $response=$this->get(route($this->prefixRoute.".show",['kyc'=>$kyc->national_code]));
        $response->assertStatus(Response::HTTP_ACCEPTED);
    }
    public function test_ip_address(){
        $kyc=self::__kyc();
        $response=$this->withServerVariables(['REMOTE_ADDR' => '0.0.0.0'])
        ->get(route($this->prefixRoute.".show",['kyc'=>$kyc->national_code]));
        $response->assertForbidden();
    }
    private function __kyc(): object
    {
        return kyc::factory()->create();
    }
}
