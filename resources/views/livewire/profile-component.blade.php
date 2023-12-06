<div>
    <div class="relative flex" x-data="{ profileSidebarOpen: false, inviteModalOpen: false }">
        <!-- Profile sidebar -->
        <x-community.profile-sidebar :users="$users" :selectedId="$selectedId" :host="$host" />

        <!-- Profile body -->
        <x-community.profile-body :user="$this->user" :host="$host" />

        <livewire:invite-employee :showButton="false" />
    </div>
</div>
