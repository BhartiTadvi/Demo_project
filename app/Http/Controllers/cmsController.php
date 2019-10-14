<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\cm;
use Illuminate\Http\Request;

class cmsController extends Controller
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
            $cms = cm::where('customer_details_with_address', 'LIKE', "%$keyword%")
                ->orWhere('Ordered products', 'LIKE', "%$keyword%")
                ->orWhere('pagecontent', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $cms = cm::latest()->paginate($perPage);
        }

        return view('cms.index', compact('cms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cms.create');
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
        
        cm::create($requestData);

        return redirect('cms')->with('flash_message', 'cm added!');
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
        $cm = cm::findOrFail($id);

        return view('cms.show', compact('cm'));
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
        $cm = cm::findOrFail($id);

        return view('cms.edit', compact('cm'));
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
        
        $cm = cm::findOrFail($id);
        $cm->update($requestData);

        return redirect('cms')->with('flash_message', 'cm updated!');
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
        cm::destroy($id);

        return redirect('cms')->with('flash_message', 'cm deleted!');
    }
}
