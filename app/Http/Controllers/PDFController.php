<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Company;

class PDFController extends Controller
{
    public function generate_pdf_quote(Request $request)
    {
        $user = auth()->user();
        $page_name = 'pdf_quote';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $user = auth()->user();
        $data['company'] = Company::find($request->company_id);
        $data['qoute'] = $request->all();
        $pdf = Pdf::loadView('pdf.templates.qoute.first', $data);

        $fileTitle = $request->file_title ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->file_title) : 'quote';
        $fileName = $fileTitle . '.pdf';
        return $pdf->download($fileName);
    }
}
