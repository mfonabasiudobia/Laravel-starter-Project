<section :class="toggleSidebar ? '' : 'sidebar-wrapper'" x-on:click="toggleSidebar = !toggleSidebar" x-cloak>
    <div x-on:click="event.stopPropagation()" class="sidebar bg-light "
        :class="toggleSidebar ? 'w-0 md:w-[250px]' : 'w-[270px] md:w-0'">
        {{-- <div class="flex justify-center py-3">
            <a href="{{route('admin.dashboard')}}">
                <img src="{{asset(cache('setting')->logo)}}" class="w-[100px] h-auto " />
            </a>
        </div> --}}
        <ul>
            <li class="{{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="las la-video"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="{{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="las la-users"></i>
                    <span>Members</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.logout')}}" class="logout">
                    <i class="las la-power-off logout"></i>
                    <span>Log out</span>
                </a>
            </li> 
        </ul>
    </div>
</section>