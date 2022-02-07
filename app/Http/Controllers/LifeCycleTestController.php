<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller{
    public function showServiceProviderTest(){
        $encrypt = app()->make('encrypter');
        $password = $encrypt->encrypt('password');
        $sample = app()->make('serviceProviderTest');
        dd($sample,$password,$encrypt->decrypt($password));
    }

    public function showServiceContainerTest(){
        app()->bind('lifeCyleTest',function(){
            return 'ライフサイクルテスト';
        });
        $test = app()->make('lifeCyleTest');

    // $message = new Message();
    // $sample = new Sample($message);
    // $sample->run();

        app()->bind('sample',Sample::class);
        app()->make('sample');
        dd($test,app());
    }
}


    class Sample{
        public $message;
        public function __construct(Message $message){
            $this->message = $message;
        }
        public function run(){
            $this->message->send();
        }
    }

    class Message{
        public function send(){
            echo('メッセージ表示');
        }
    }

