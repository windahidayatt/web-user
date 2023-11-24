<!-- ASIDE -->
<aside>
    <div class="top">
        <div class="logo">
            <img src="{{ url('assets/images/logo-users.png') }}" alt="logo">
        </div>
    </div>

    <div class="sidebar">

        <a href="/user" class="{{ $page_name == 'User' ? 'active' : ''}}">
            <span class="material-icons-sharp">person</span>
            <h3>Manage User</h3>
        </a>

        {{-- <div class="item">
            <a class="sub-btn {{ $page_name == 'User' ? 'active' : ''}}">
                <span class="material-icons-sharp">groups</span>
                <h3>User</h3>
                <span class="material-icons-sharp dropdown">chevron_right</span>
            </a>
            <div class="sub-menu {{ $page_name == 'user' ? 'active' : ''}}">
                <a href="/student/detail/{{ $student->id }}" class="sub-item {{ $sub_page_name == 'Biodata' ? 'active' : ''}}">Biodata</a>
                <a href="/usm-history/detail/{{ $student->id }}" class="sub-item {{ $sub_page_name == 'Riwayat USM' ? 'active' : ''}}">Riwayat USM</a>
                <a href="/student-cv" class="sub-item {{ $sub_page_name == 'CV' ? 'active' : ''}}">CV</a>
                <a href="/student-doc/{{ $student->id }}" class="sub-item {{ $sub_page_name == 'File Pendukung' ? 'active' : ''}}">File Pendukung</a>
            </div>
        </div> --}}
        

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
 