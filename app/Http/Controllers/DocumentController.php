<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        $documents = DocumentType::all();
        return view('document', compact('documents'));
    }
}
