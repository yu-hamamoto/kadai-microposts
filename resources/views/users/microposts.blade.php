@if(count($favorites)>0)
    <ul class="list-unstyled">
        @foreach($favorites as $user)
            <li class="media">
                {{--ユーザのメールアドレスをもとにGravatarを取得して表示--}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($user->email,['size'=>50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        {{--お気に入りボタン--}}
                        @include('micropost_favorite.favorite_button',['micropost'=>$micropost])
                    </div>
                </div>
            </li>
        @endforeach  
    </ul> 
    {{--ページネーションのリンク--}}
    {{ $favorites->links() }}
@endif    