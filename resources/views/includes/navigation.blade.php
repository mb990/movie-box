<div class="movie-nav">
    <a title="Trending" href="{{route('homepage.trending')}}" class="nav-tab {{ Request::is('/') ? 'active-nav' : ''}}">Trending</a>
    <a title="Top Rated" href="{{route('homepage.top')}}" class="nav-tab {{ Request::is('top') ? 'active-nav' : ''}}">Top Rated</a>
    <a title="New Arrivals" href="{{route('homepage.new')}}" class="nav-tab {{ Request::is('new') ? 'active-nav' : ''}}">New Arrivals</a>
    <!-- SEARCH BUTTON -->
    <form action="{{route('search')}}" class="nav-tab-search">
        @csrf
        <input type="text" class="search-input" placeholder="Search movie.." name="search">
        <button type="submit" class='button-recommended'><i class="fa fa-search"></i></button>
    </form>
    <!-- END SEARCH BUTTON -->
    <div class="nav-grid">
        <button class="btn-nav active-nav js-grid" onclick="gridView()">
            <svg class="bi bi-grid" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 012.5 1h3A1.5 1.5 0 017 2.5v3A1.5 1.5 0 015.5 7h-3A1.5 1.5 0 011 5.5v-3zM2.5 2a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 1h3A1.5 1.5 0 0115 2.5v3A1.5 1.5 0 0113.5 7h-3A1.5 1.5 0 019 5.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zM1 10.5A1.5 1.5 0 012.5 9h3A1.5 1.5 0 017 10.5v3A1.5 1.5 0 015.5 15h-3A1.5 1.5 0 011 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 9h3a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-1.5 1.5h-3A1.5 1.5 0 019 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3z" clip-rule="evenodd"/>
            </svg>
        </button>
        <button class="btn-nav js-list" onclick="listView()">
            <i class="material-icons">&#xe164;</i>
        </button>
    </div>
</div>