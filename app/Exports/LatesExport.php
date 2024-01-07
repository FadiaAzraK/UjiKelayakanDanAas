<?php

namespace App\Exports;

use App\Models\Late;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class LatesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   

        if(Auth::user()->role == 'admin'){
            $late = late::with('student')->get()->map(function ($late) {
                return collect([
                    'student_nis' => $late->student->nis,
                    'student_name' => $late->student->name,
                    'rombel_name' => $late->student->rombel->rombel,
                    'rayon_name' => $late->student->rayon->rayon,
                    'total' => $late->student->late->count(),
                ]);
            });

            $late->prepend([
                'NIS',
                'Nama',
                'Rombel',
                'Rayon',
                'Total',
            ]);        
    
            return $late;

        }
        
        else {
            $students = student::where('rayon_id', function ($query) {
                $query->select('id')
                    ->from('rayons')
                    ->where('user_id', Auth::user()->id);
            })->with('late')->get()->map(function ($students) {
                return collect([
                    'student_nis' => $students->nis,
                    'student_name' => $students->name,
                    'rombel_name' => $students->rombel->rombel,
                    'rayon_name' => $students->rayon->rayon,
                    'total' => $students->late->count(),
                ]);
            });

            $students->prepend([
                'NIS',
                'Nama',
                'Rombel',
                'Rayon',
                'Total',
            ]);

            return $students;
        }
    }
}


