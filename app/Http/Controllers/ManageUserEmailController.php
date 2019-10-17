<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manage_user_email;
use Illuminate\Http\Request;
use App\EmailTemplate;

class ManageUserEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $manage_user_email = EmailTemplate::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address1', 'LIKE', "%$keyword%")
                ->orWhere('address2', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $manage_user_email = EmailTemplate::paginate($perPage);
        }
        return view('manage_user_email.index', compact('manage_user_email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('manage_user_email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        EmailTemplate::create($requestData);
        return redirect()->route('manage_user_email.index')->with('flash_message', 'Email template added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $manage_user_email = EmailTemplate::findOrFail($id);
        return view('manage_user_email.show', compact('manage_user_email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $manage_user_email = EmailTemplate::findOrFail($id);
        return view('manage_user_email.edit', compact('manage_user_email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
      $manage_user_email = EmailTemplate::findOrFail($id);
        $manage_user_email->name = $request->name;
        $manage_user_email->mailsubject = $request->mailsubject;
        $manage_user_email->templatecontent = $request->template_content;
        $manage_user_email->template_key = $request->template_key;
        $manage_user_email->save();
        return redirect()->route('manage_user_email.index')->with('flash_message', 'Email updated successfully!');
    }
    
}
