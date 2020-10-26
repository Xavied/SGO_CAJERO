<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteExport implements FromView
{
    private $data;
    private $keys;

    public function __construct($data, $keys)
    {
        $this->data = json_decode($data, true);
        $this->keys = json_decode($keys, true);
    }

    public function view(): View
    {
        return view('excel', [
            'data' => $this->data, 'keys' => $this->keys
        ]);
    }    
}
