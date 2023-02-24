<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use App\Models\CommunityLinkUser;
use Illuminate\Support\Facades\Auth;

class CommunityLinkUserController extends Controller
{

    public function store(CommunityLink $link, CommunityLinkUser $linkUser)
    {
        $linkUser->toggle($link);
        return back();
    }

   

}
