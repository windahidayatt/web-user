<!-- ASIDE -->
<aside>
    <div class="top">
        <div class="logo">
            <img src="{{ url('assets/images/logo-users.png') }}" alt="logo">
        </div>
    </div>

    <div class="sidebar">
        @can('isAdmin')
            <a href="/user" class="{{ $page_name == 'User' ? 'active' : ''}}">
                <span class="material-icons-sharp">person</span>
                <h3>Manage User</h3>
            </a>
        @endcan

        <a href="/team" class="{{ $page_name == 'Team' ? 'active' : ''}}">
            <span class="material-icons-sharp">diversity_2</span>
            <h3>Team</h3>
        </a>
        
        <form id="form-logout" action="/logout" method="POST">
            @csrf
            <a href="#" class="logout-btn" onclick="document.getElementById('form-logout').submit()">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </form>

    </div>
</aside>
<!-- END ASIDE -->

<script type="text/javascript">
    $(document).ready(function(){
      //jquery for toggle sub menus
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });
    });
</script>
 