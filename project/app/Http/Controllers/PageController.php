<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkWithPage;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if (Gate::allows('manage-pages')) {
            $pages = Page::defaultOrder()->withDepth()->get();
        } else {
            $pages = Auth::user()->pages->all();
        }

        return view('admin.pages.index')->with(array('pages' => $pages));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view( 'admin.pages.create' );
        return view('admin.pages.create')->with(array('model' => new Page(), 'orderPages' => Page::defaultOrder()->withDepth()->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkWithPage $request)
    {
        // $request->validate( array(
        //     'title'   => 'required',
        //     'url'     => 'required',
        //     'content' => 'required'
        // ) );

        $page = Page::create(array(
            'title'   => trim($request->input('title')),
            'url'     => trim($request->input('url')),
            'content' => trim($request->input('content')),
            'user_id' => Auth::user()->id
        ));

        // $page = Auth::user()->pages->save(new Page( array(
        //      'title'   => trim( $request->input( 'title' ) ),
        //      'url'     => trim( $request->input( 'url' ) ),
        //      'content' => trim( $request->input( 'content' ) )
        //  ) ) );

        if (isset($page)) {
            $this->updatePageOrder($page, $request);

            return redirect()->route('pages.index')->with('status', 'The page has been created.');
        } else {
            return back()->withErrors(array('error', 'Unos stranice nije uspio!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //return view( 'admin.pages.edit' )->with( array( 'page' => $page ) );
        return view('admin.pages.edit')->with(array('model' => $page, 'orderPages' => Page::defaultOrder()->withDepth()->get()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(WorkWithPage $request, Page $page)
    {
        if($response = $this->updatePageOrder($page, $request)){
            return $response;
        }

        $page->title = $request->title;
        $page->url = $request->url;
        $page->content = $request->content;

        $page->save();

        return redirect()->route('pages.index')->with('status', 'The page was updated.');
    }

    public function delete(Page $page)
    {
        // html forma za opciju Da/NE
        return view('admin.pages.delete')->with(array('page' => $page));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index')->with('status', 'The page was deleted.');
    }

    protected function updatePageOrder(Page $page, Request $request)
    {
        if ($request->has('order', 'orderPage')) {
            if ($page->id == $request->orderPage) {
                return redirect()->route('pages.edit', ['page' => $page->id])->withInput()->withErrors(['error', 'Cannot order page against itself.']);
            }

            $page->updateOrder($request->order, $request->orderPage);
        }
    }
}
