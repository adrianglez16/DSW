<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunityLinkForm;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)
    {
        // dd($channel);
        // channels ordenados por title de manera ascendente
        $channels = Channel::orderBy('title', 'asc')->get();

        // si hay un 'channel', es decir si hay un slug en la url
        if ($channel) {
            //El método latest ordena por última fecha de creación, no de actualización. Por eso le hemos pasado el argumento updated_at.
            $links = $channel->communitylinks()->where('approved', true)->latest('updated_at')->paginate(25);

            return view('community/index', compact('links', 'channels'));
        } else {
            $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);

            return view('community/index', compact('links', 'channels'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityLinkForm $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required|active_url',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $usu = Auth::users()->isTrusted();

        $request->merge(['user_id' => Auth::id(), 'approved' => $usu]);

        $link = new CommunityLink();
        $link->user_id = Auth::id();

        // si existe el link, muestra mensaje de info
        if ($link->hasAlreadyBeenSubmitted($request->link)) {

            return back()->with('info', 'You added new items, follow next step!');
        } else {
            // sino existe lo 'crea'
            CommunityLink::create($request->all());

            if ($usu) {
                // si el usuario está trusted realmente lo crea
                return back()->with('success', 'Link created successfully!');
            } else {
                // sino está trusted no lo crea
                return back()->with('error', "You have no permission for this page!");
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
