<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\SettingsCollection;
use App\Http\Resources\V2\BusinessSettingCollection;
use App\Models\AppSettings;
use App\Models\BusinessSetting;
use App\Models\Currency;
use App;

class SettingsController extends Controller
{
    public function index()
    {

        $settings = BusinessSetting::pluck('value','type')->toArray();
        $currency = Currency::findOrFail( $settings['system_default_currency']);

         $response = [
             'name' => $settings['website_name'],
             'logo' => $settings['header_logo'],
             'meta_title' => $settings['meta_title'],
             'meta_description' =>  $settings['meta_description'],
             'site_motto' => $settings['site_motto'],
             'site_icon' => $settings['site_icon'],
             'facebook' =>  $settings['facebook_link'],
             'twitter' => $settings['twitter_link'],
             'instagram' => $settings['instagram_link'],
             'youtube' => $settings['youtube_link'],
             'currency' => [
                 'name' => $currency->name,
                 'symbol' => $currency->symbol,
                 'exchange_rate' => $currency->exchange_rate,
                 'code' => $currency->code,
             ],
         ];
           
         return response()->json($response);
    }


    
}


