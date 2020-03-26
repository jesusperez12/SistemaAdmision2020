<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Cedula',
            'Email',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
             
              // $event->sheet->setBackground('#000000');
            },
          
        ];
      
    }
    public function view(): View
    {
        return view('reporteChart.prueba',[
            'users' => User::get()
            
        ]);
    }

 /*  public function collection()
    {
        $users = DB::table('users')->select('name','Apellidos','cedula', 'email')->get();
        return $users;
    }*/
}
