<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faqs;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
     $faqs = Faqs::get();
     // dd($faqs);
     return view('faqs.index',compact('faqs'));
    }
    public function create()
    {
     return view('faqs.create');
    }

    public function store(Request $request)
    {
    	 $request->validate([
        'questionno'=>'required|unique:faqs,question_no',
            'question'=>'required|unique:faqs,question',
            'answer'=>'required',
            'status'=>'required',
            ]);
    	 $faqs = new Faqs();
    	 $faqs->question_no = $request->questionno;
    	 $faqs->question = $request->question;
    	 $faqs->answer = $request->answer;
    	 $faqs->status = $request->status;
    	 $faqs->save();
    	 return redirect()->route('faqs')->with('success','FAQs created successfully');
    }
    public function edit($id)
    {
    	$faqs =Faqs::findOrFail($id);
     return view('faqs.edit',compact('faqs'));
    }
    public function show($id)
    {
         $faqs = Faqs::findOrFail($id);
        return view('faqs.show', compact('faqs'));
    }
     public function update(Request $request,$id)
    {

    	 $request->validate([
            'questionno'=>'required|unique:faqs,question_no,'.$id,
            'question'=>'required|unique:faqs,question,'.$id,
            'answer'=>'required',
            'status'=>'required',
            ]);
            
    	 $faqs = Faqs::findOrFail($id);
    	 $faqs->question_no = $request->questionno;
    	 $faqs->question = $request->question;
    	 $faqs->answer = $request->answer;
    	 $faqs->status = $request->status;
    	 $faqs->save();
    	 return redirect()->route('faqs')->with('success','FAQs updated successfully');
    }

    public function destroy($id)
    {
         Faqs::destroy($id);
        return redirect()->route('faqs')->with('success', 'FAQs deleted successfully');
    }

}
