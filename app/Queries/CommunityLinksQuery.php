<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel = null)
    {
        //El método latest ordena por última fecha de creación, no de actualización. Por eso le hemos pasado el argumento updated_at.
        $consulta = $channel->communitylinks()->where('approved', true)->latest('updated_at')->paginate(25);

        return $consulta;
    }


    public function getAll()
    {
        $consulta = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);

        return $consulta;
    }

    public function getMostPopular()
    {
        $consulta = CommunityLink::where('approved', true)->withCount('users')->orderBy('users_count', 'desc')->paginate(25);
       
        return $consulta;
    }

    public function getMostPopularAndChannel(Channel $channel)
    {
        $consulta = $channel->communitylinks()->where('approved', true)->withCount('users')->orderBy('users_count', 'desc')->paginate(25);
        return $consulta;
    }

}
