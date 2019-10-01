<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\manage_user_email;
use Illuminate\Http\Request;
use App\EmailTemplate;

class manage_user_emailController extends Controller
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
            $manage_user_email = EmailTemplate::latest()->paginate($perPage);
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

        // dd($requestData);
        
        EmailTemplate::create($requestData);

        return redirect('manage_user_email')->with('flash_message', 'manage_user_email added!');
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
        
        $requestData = $request->all();
        
        $manage_user_email = EmailTemplate::findOrFail($id);
        $manage_user_email->update($requestData);

        return redirect('manage_user_email')->with('flash_message', 'manage_user_email updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        manage_user_email::destroy($id);

        return redirect('manage_user_email')->with('flash_message', 'manage_user_email deleted!');
    }
}
