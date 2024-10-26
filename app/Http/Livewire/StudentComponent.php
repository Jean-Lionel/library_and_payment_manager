<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Eleve;
use App\Models\Classe;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentComponent extends Component
{
    public $students;
    public function mount()
    {
        $this->students = Eleve::all();
    }
    public function render()
    {
        return view('livewire.student-component');
    }

    public function generatePdf()
    {
        $data = [
            'students' => $this->students
        ];
        $pdf = Pdf::loadView('pdf.liste2', $data);
        return response()->streamDownload( function() use($pdf){
            echo $pdf->stream();
        }, 'students.pdf');
    }
}
