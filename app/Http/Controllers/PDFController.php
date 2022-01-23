<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF()
    {

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('pdf.myPDF', $data);
        //stream
        //render
        return $pdf->stream('itsolutionstuff.pdf');
    }

}