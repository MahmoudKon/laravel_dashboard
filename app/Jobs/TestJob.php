<?php

namespace App\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $controller;
    protected $sleep;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $controller, $sleep = 9)
    {
        $this->message = $message;
        $this->controller = $controller;
        $this->sleep  = $sleep;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep($this->sleep);
        $response = "This Message From Job \n\t ' $this->message '\n Sleep = $this->sleep \n Controller Message: ".$this->controller->testReturn()."\n";
        echo $response;
        return response()->json($response, 200); ;
    }
}
