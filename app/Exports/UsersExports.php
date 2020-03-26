<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExports  implements FromCollection,WithHeadings
{


    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Email',
        ];
    }
    public function collection()
    {
         $users = DB::table('Users')->select('id','name', 'email')->get();
         return $users;
        
    }



/*
    public function view(): View

    {
        
        return view('reporteChart.excel',[
            'users' => User::get()
            
        ]);
    }*/
}