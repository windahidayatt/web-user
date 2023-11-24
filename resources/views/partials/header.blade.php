<nav id="nav-header" class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="left">
        <h1>
            @isset ($back_link)
                <span>
                    <a class="a-img-icon" href="{{ $back_link }}">
                        <img class="avatar avatar-sm rounded-circle td-btn" alt="Icon Pencil" src="{{ url('assets/images/icon/icon-back-grey.svg') }}">
                    </a>
                </span> 
            @endisset
            {{ $sub_page_name != '' ? $sub_page_name : $page_name }}
        </h1>
    </div>

    <div class=" ml-auto">
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <button id="close-btn" style="display: none">
                    <span class="material-icons-sharp">close</span>
                </button>
                <div class="profile">
                    {{-- Commented cause fitur not available yet --}}
                    {{-- <span class="material-icons-sharp active">notifications</span> --}}
                    {{-- <div class="info">
                        <p style="margin-bottom: 0.25rem;"><b>{{ Auth::user()->name }}</b></p>
                        <small class="text-muted">{{ Auth::user()->role->name }} ISO Jepang</small>
                    </div>
                    <div class="profile-photo">
                        @if(Auth::user()->profile_pict == null)
                            <img src="{{ url('assets/images/profile-1.jpg') }}" alt="">
                        @else
                            @can('isPeserta')
                                <img src="{{ url('/show-file/profile_pict/') . '/' . Auth::user()->id . '/' . Auth::user()->profile_pict }}" alt="" style="height: 100%">
                            @endcan

                            @can('canAccessBackoffice')
                                <img src="{{ url('/backoffice/show-file/profile_pict/') . '/' . Auth::user()->id . '/' . Auth::user()->profile_pict }}" alt="" style="height: 100%">
                            @endcan
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</nav>