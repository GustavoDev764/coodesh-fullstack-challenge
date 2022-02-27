<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\{SpaceFlightNews,Events,Launches};
use Carbon\Carbon;

class GetAllSpaceFlightNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    private $url;

    protected $signature = 'get:allSpaceFlightNews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buscar todas as noticias novas ou atualizar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->url = 'https://api.spaceflightnewsapi.net/v3/articles';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Buscar todas as noticias novas ou atualizar');
        $request = Http::get($this->url.'/count');
        $total = (int) $request->json();
        $perPage = 1000;
        
        $total_request = ceil($total / $perPage);
        
        $pageCurrent = 1;
        $itemStart = 1;
        while ($pageCurrent <= $total_request) {
            
            
            
            if($pageCurrent !== 1){
                //pagina de inicio
                $itemStart =  $perPage * $pageCurrent - $perPage;
            }
            

            $this->info('===================================================');
            $this->info('itemStart: '.$itemStart.'');
            $this->info('pageCurrent: '.$pageCurrent.'/'.$total_request);
            

            $request = Http::get($this->url.'?_limit='.$perPage.'&_start='.$itemStart);
            $data = $request->json();
            
            $this->info('total data request: '.count($data).'');
            $this->info('===================================================');

            $dataInsert = [];
            $sku = [];

            for ($i=0; $i < count($data); $i++) { 
                $exits = SpaceFlightNews::where('sku','=',$data[$i]['id'])->first();

                $item = (array) $data[$i];
                unset($item['id']);
                unset($item['launches']);
                unset($item['events']);
                unset($item['updatedAt']);
                $item['sku'] = $data[$i]['id']; 

                if($exits){                               
                    $exits->fill($item)->save();
                }else{
                    $sku[] = $item['sku'];
                    $now = Carbon::now();
                    $item['created_at'] = $now;
                    $item['updated_at'] = $now;

                    $dataInsert[] = $item;
                }            
            } 
            
            Log::info('=========== SpaceFlightNews Inserindo '.$perPage.' rows ===========');
            SpaceFlightNews::insert($dataInsert);

            $pageCurrent++;
        }       
        
        
        $this->info('===================================================');
        $this->info('   data entered successfully   ');
        $this->info('===================================================');
    }
}
