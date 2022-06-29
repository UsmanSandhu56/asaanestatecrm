<div class="users-page home-page-set">
    <div class="content-overlay">
    </div>
    <div class="header-navbar-shadow">
    </div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @role('owner')
            @include('backend.partials.owner-dashboard')
            @elserole('agent')
            @include('backend.partials.agent-dashboard')
            @endrole
        </div>
    </div>
</div>
