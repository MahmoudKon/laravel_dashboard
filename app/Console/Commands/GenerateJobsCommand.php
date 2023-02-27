<?php

namespace App\Console\Commands;

use App\Jobs\SendDataEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class GenerateJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(public array $data = [])
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->data['file_name'] = $this->createFile();
        $this->data['from'] = now()->subDay()->format('Y-m-d');
        $this->data['to'] = today()->format('Y-m-d');
        
        $query = User::select('id')->whereDate('created_at', '>=', $this->data['from'])->whereDate('created_at', '<=', $this->data['to']);
        $this->data['end']   = $query->min('id');
        $this->data['start'] = $query->max('id');

        dispatch(new SendDataEmail($this->data));
        return 0;

    }

    protected function createFile()
    {
        $file_name = time().'.xlsx';
        Storage::disk('public')->append($file_name, 'Hello');
        return $file_name;
    }
}
