<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\User;

use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;

class UserController extends Controller{
    
    public function home(){
        return 'home register';
    }
    
    public function store(Request $request){
        
        $user = new User();
        $user->name = 'Usuario 2';
        $user->email = 'usuario2@gmail.com';
        $user->password = '12345678';
        $user->save();
        
        $fdqn = sprintf('%s.%s', 'usuario2', env('APP_DOMAIN'));

        $website = new Website();
        $website->uuid = Str::random(10);
        app(WebsiteRepository::class)->create($website);
        
        $hostname = new Hostname();
        $hostname->fqdn = $fdqn;
        $hostname = app(HostnameRepository::class)->create($hostname);
        app(HostnameRepository::class)->attach($hostname, $website);
        
        
        echo 'terminado';
    }
}
