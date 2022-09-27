<nav x-data="{ open: false }" class="bg-orange ">
    <!-- Primary Navigation Menu -->
    <div class="">
        <div class="flex justify-center h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex px-20">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('My Activities') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:flex px-20">
                    <x-nav-link :href="route('manage-activities')" :active="request()->routeIs('manage-activities')">
                        {{ __('Manage Activities') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:flex px-20">
                    <x-nav-link :href="route('new-activity')" :active="request()->routeIs('new-activity')">
                        {{ __('New Activity') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:flex px-20">
                    <x-nav-link :href="route('manage-account')" :active="request()->routeIs('manage-account')">
                        {{ __('Manage Accout') }}
                    </x-nav-link>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="hidden space-x-8 sm:-my-px sm:flex px-20">
                    @csrf
                    <x-nav-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>


</nav>
