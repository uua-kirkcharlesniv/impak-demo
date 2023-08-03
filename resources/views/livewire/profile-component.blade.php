<div>
    <div class="relative flex" x-data="{ profileSidebarOpen: false }">
        <!-- Profile sidebar -->
        <x-community.profile-sidebar :users="$users" :selectedId="$selectedId" :host="$host" />

        <!-- Profile body -->
        <x-community.profile-body :user="$this->user" :host="$host" />
    </div>
</div>
