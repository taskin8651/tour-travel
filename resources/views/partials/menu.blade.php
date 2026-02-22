<aside
    class="w-64 bg-slate-900 text-slate-100 min-h-screen hidden lg:flex flex-col
           transition-all duration-300 ease-in-out">

    {{-- BRAND --}}
    <div class="px-6 py-4 text-xl font-semibold border-b border-slate-700 tracking-wide">
        Travel Admin
    </div>

    {{-- NAV --}}
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm overflow-y-auto">

        {{-- DASHBOARD --}}
        <a href="{{ route('admin.home') }}"
           class="group flex items-center gap-3 px-3 py-2 rounded transition
           {{ request()->routeIs('admin.home')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            <i class="fas fa-tachometer-alt text-slate-400 group-hover:text-white"></i>
            Dashboard
        </a>

        {{-- ================= TRAVEL MANAGEMENT ================= --}}
        <div x-data="{ open:
            {{ request()->is('admin/categories*')
            || request()->is('admin/sub-categories*')
            || request()->is('admin/listings*') ? 'true' : 'false' }}
        }">

            <button @click="open = !open"
                class="group w-full flex items-center justify-between px-3 py-2 rounded
                       hover:bg-slate-800 transition">

                <span class="flex items-center gap-3">
                    <i class="fas fa-plane text-slate-400 group-hover:text-white"></i>
                    Travel Management
                </span>

                <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">

                <a href="{{ route('admin.categories.index') }}"
                   class="block px-3 py-2 rounded transition
                   {{ request()->is('admin/categories*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    Categories
                </a>

                <a href="{{ route('admin.sub-categories.index') }}"
                   class="block px-3 py-2 rounded transition
                   {{ request()->is('admin/sub-categories*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    Sub Categories
                </a>

                <a href="{{ route('admin.listings.index') }}"
                   class="block px-3 py-2 rounded transition
                   {{ request()->is('admin/listings*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    Listings
                </a>

            </div>
        </div>

        {{-- ================= ENQUIRIES ================= --}}
        <a href="{{ route('admin.enquiries.index') }}"
           class="group flex items-center gap-3 px-3 py-2 rounded transition
           {{ request()->is('admin/enquiries*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            <i class="fas fa-envelope text-slate-400 group-hover:text-white"></i>
            Enquiries
        </a>

       {{-- ================= CONTENT MANAGEMENT ================= --}}
<div x-data="{ open:
    {{ request()->is('admin/hero-sections*')
    || request()->is('admin/galleries*')
    || request()->is('admin/testimonials*')
    || request()->is('admin/blogs*')
    || request()->is('admin/blog-categories*')
    || request()->is('admin/brands*') ? 'true' : 'false' }}
}">

    <button @click="open = !open"
        class="group w-full flex items-center justify-between px-3 py-2 rounded
               hover:bg-slate-800 transition">

        <span class="flex items-center gap-3">
            <i class="fas fa-layer-group text-slate-400 group-hover:text-white"></i>
            Content Management
        </span>

        <i class="fas fa-chevron-down text-xs transition-transform duration-300"
           :class="open ? 'rotate-180' : ''"></i>
    </button>

    <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">

        {{-- Hero --}}
        <a href="{{ route('admin.hero-sections.index') }}"
           class="block px-3 py-2 rounded transition
           {{ request()->is('admin/hero-sections*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            Hero Section
        </a>

        {{-- Gallery --}}
        <a href="{{ route('admin.galleries.index') }}"
           class="block px-3 py-2 rounded transition
           {{ request()->is('admin/galleries*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            Gallery
        </a>

        {{-- Testimonials --}}
        <a href="{{ route('admin.testimonials.index') }}"
           class="block px-3 py-2 rounded transition
           {{ request()->is('admin/testimonials*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            Testimonials
        </a>

        {{-- Blog Categories --}}
        <a href="{{ route('admin.blog-categories.index') }}"
           class="block px-3 py-2 rounded transition
           {{ request()->is('admin/blog-categories*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            Blog Categories
        </a>

        {{-- Blogs --}}
        <a href="{{ route('admin.blogs.index') }}"
           class="block px-3 py-2 rounded transition
           {{ request()->is('admin/blogs*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            Blogs
        </a>

        {{-- Brands (NEW) --}}
        <a href="{{ route('admin.brands.index') }}"
           class="block px-3 py-2 rounded transition
           {{ request()->is('admin/brands*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            Brands
        </a>

    </div>
</div>

        {{-- ================= WEBSITE SETTINGS ================= --}}
        <a href="{{ route('admin.settings.index') }}"
           class="group flex items-center gap-3 px-3 py-2 rounded transition
           {{ request()->is('admin/settings*')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            <i class="fas fa-cog text-slate-400 group-hover:text-white"></i>
            Website Settings
        </a>

        {{-- ================= USER MANAGEMENT ================= --}}
        @can('user_management_access')
        <div x-data="{ open:
            {{ request()->is('admin/permissions*')
            || request()->is('admin/roles*')
            || request()->is('admin/users*') ? 'true' : 'false' }}
        }">

            <button @click="open = !open"
                class="group w-full flex items-center justify-between px-3 py-2 rounded
                       hover:bg-slate-800 transition">

                <span class="flex items-center gap-3">
                    <i class="fas fa-users text-slate-400 group-hover:text-white"></i>
                    User Management
                </span>

                <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">

                @can('permission_access')
                <a href="{{ route('admin.permissions.index') }}"
                   class="block px-3 py-2 rounded transition
                   {{ request()->is('admin/permissions*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    Permissions
                </a>
                @endcan

                @can('role_access')
                <a href="{{ route('admin.roles.index') }}"
                   class="block px-3 py-2 rounded transition
                   {{ request()->is('admin/roles*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    Roles
                </a>
                @endcan

                @can('user_access')
                <a href="{{ route('admin.users.index') }}"
                   class="block px-3 py-2 rounded transition
                   {{ request()->is('admin/users*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    Users
                </a>
                @endcan

            </div>
        </div>
        @endcan

    </nav>

    {{-- LOGOUT --}}
    <div class="border-t border-slate-700 p-3">
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
           class="group flex items-center gap-3 px-3 py-2 rounded transition
                  hover:bg-red-600 hover:text-white">
            <i class="fas fa-sign-out-alt group-hover:translate-x-1 transition"></i>
            Logout
        </a>
    </div>

</aside>