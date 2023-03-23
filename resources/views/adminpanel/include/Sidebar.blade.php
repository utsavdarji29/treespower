 <div class="admin-dashboard-menu-part">
    <ul>
        <li>
            <a href="{{ route('adminpanel.dashboard') }}" class="active">
                <img src="{{ asset('managerpanel/images/dashboard-icn.png') }}">
                <span>DASHBOARD</span>
            </a>
        </li>
        <li>
            <a href="{{ route('adminpanel.user.manage') }}">
                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                <span>Manage Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('adminpanel.manager.manage') }}">
                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                <span>Manage Manager</span>
            </a>
        </li>
        <li>
            <a href="{{ route('adminpanel.category.manage') }}">
                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                <span>Manage Category</span>
            </a>
        </li>
        <li>
            <a href="{{ route('adminpanel.job.manage') }}">
                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                <span>Manage Job</span>
            </a>
        </li>
    </ul>
</div>
<div class="admin-dashboard-messages-icn">
    <ul>
        <li>
            <a href="{{ route('adminpanel.logout') }}">
                <img src="{{ asset('managerpanel/images/Users-icn.png') }}">
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>