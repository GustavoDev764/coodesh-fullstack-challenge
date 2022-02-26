<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SpaceFlightNewsTest extends TestCase
{
    private static function  getMyUrl($url=''){
        return url('/coodesh-challenge-fullstack/api/public'.$url);
    }

    private static function getNewSpaceFlightNews(){     
        
        return [
            'featured'    => false,
            'sku'         => '14055',
            'title'       => 'U.S. and Europe say space cooperation with Russia not affected yet by Ukraine crisis',
            'url'         => 'https://spacenews.com//wp-content//uploads//2022//02//maxar-russiantroops.jpg',
            'imageUrl'    => 'https:\/\/spacenews.com\/wp-content\/uploads\/2022\/02\/maxar-russiantroops.jpg',
            'newsSite'    => 'SpaceNews',
            'summary'     => 'American and European officials said Feb. 23 that space cooperation with Russia remains unaffected even as that country continues to threaten a full-scale invasion of Ukraine.',
            'publishedAt' => '2022-02-23T22:39:37.000Z',
        ];
    }

    
    public function test_create_space_flight_news()
    {
        $dataForm = $this::getNewSpaceFlightNews();

        $this->json('POST', 'api/articles', $dataForm, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id'
                ],
            ]);
    }
    
    public function test_update_space_flight_news()
    {
        $dataForm = $this::getNewSpaceFlightNews();

        $response = Http::post($this::getMyUrl('/api/articles'), $dataForm);
        $data = $response->json(); 
        $article = $data['data'];

        $article['title'] = 'Update-'.$article['title'];

        $this->json('PUT', 'api/articles/'.$article['id'], $article, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id'
                ],
            ]);
    }
    
    public function test_delete_space_flight_news()
    {
        $dataForm = $this::getNewSpaceFlightNews();

        $response = Http::post($this::getMyUrl('/api/articles'), $dataForm);
        $data = $response->json(); 
        $article = $data['data'];        

        $this->json('DELETE', 'api/articles/'.$article['id'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
            ]);
    }
}
