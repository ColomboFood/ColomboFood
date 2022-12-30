<?php

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('check', function () {
    $ctr_ok = 0;
    $ctr_ko = 0;
    $files = collect(Storage::disk(config('media-library.disk_name'))->allFiles('data/import/immagini'));
    $files = $files->map( fn($f) => Str::of($f)->explode('/') )->map( fn($f) => $f[count($f)-1] )
                    ->map( fn($f) => Str::of($f)->replace('.jpg','') );
    foreach($files as $file)
    {
        $product = Product::where('sku', $file)->first();
        if(!$product) {
            dump($file);
            $ctr_ko++;
        }
        else $ctr_ok++;
    }

    dump($ctr_ok.'/'.$ctr_ko);
})->purpose('Display an inspiring quote');
