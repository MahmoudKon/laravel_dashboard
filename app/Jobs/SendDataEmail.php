<?php

namespace App\Jobs;

use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class SendDataEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $tries = -1;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public array $data = [])
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            echo "Start = {$this->data['start']}   |  end = {$this->data['end']} \n";
            $rows = User::select('id', 'email')->whereBetween('id', [$this->data['end'], $this->data['start']])->limit(5)->orderBy('id', 'DESC')->get();

            if ($this->data['start'] == $this->data['end']) {
                echo " Send Email Now";
                return ;
            }

            $content = Storage::disk('public')->get($this->data['file_name']);

            foreach ($rows as $row) {
                $content .= $row->email . "\n";
                Storage::disk('public')->put($this->data['file_name'], $content);
            }

            $this->data['start'] = $rows[count($rows) - 1]->id;
            echo "Start = {$this->data['start']}   |  end = {$this->data['end']} \n";
            dispatch(new SendDataEmail($this->data));
        } catch (Exception $e) {
            echo "Start = {$this->data['start']}   |  end = {$this->data['end']} \n";
        }
    }
}
