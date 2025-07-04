<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-lg" aria-label="Sidebar">
    <div class="h-full px-4 py-6 overflow-y-auto bg-[#232329] dark:bg-[#232329] flex flex-col justify-between">
        <div>
            <!-- Branding -->
            <div class="flex flex-col items-center mb-8 select-none">
                <img src="https://images.glints.com/unsafe/glints-dashboard.oss-ap-southeast-1.aliyuncs.com/company-logo/e5854fb24f56d1112295bc32db67ebbe.png"
                    alt="Logo"
                    class="w-30 h-20 rounded-full shadow-lg mb-2 bg-white object-contain border-2 border-[#38d4ae]">
            </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded-lg transition group hover:scale-[1.03] hover:shadow-md hover:bg-[#38d4ae]/90 hover:text-[#18181b] {{ request()->routeIs('admin.dashboard') ? 'bg-[#38d4ae] text-[#18181b] shadow' : 'text-[#f3f4f6]' }}">
                        <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-[#18181b] transition" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.projects.index') }}" class="flex items-center p-2 rounded-lg transition group hover:scale-[1.03] hover:shadow-md hover:bg-[#38d4ae]/90 hover:text-[#18181b] {{ request()->routeIs('admin.projects.*') ? 'bg-[#38d4ae] text-[#18181b] shadow' : 'text-[#f3f4f6]' }}">
                        <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-[#18181b] transition" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span>Projects</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tasks.index') }}" class="flex items-center p-2 rounded-lg transition group hover:scale-[1.03] hover:shadow-md hover:bg-[#38d4ae]/90 hover:text-[#18181b] {{ request()->routeIs('admin.tasks.*') ? 'bg-[#38d4ae] text-[#18181b] shadow' : 'text-[#f3f4f6]' }}">
                        <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-[#18181b] transition" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span>Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 rounded-lg transition group hover:scale-[1.03] hover:shadow-md hover:bg-[#38d4ae]/90 hover:text-[#18181b] {{ request()->routeIs('admin.users.*') ? 'bg-[#38d4ae] text-[#18181b] shadow' : 'text-[#f3f4f6]' }}">
                        <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-[#18181b] transition" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
            <div class="my-6 border-t border-[#38383f]"></div>
        </div>
        <div class="mb-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full p-2 text-red-500 rounded-lg hover:bg-[#e5484d] hover:text-[#18181b] transition group hover:scale-[1.03] hover:shadow-md">
                    <svg class="w-5 h-5 mr-2 text-red-500 group-hover:text-[#18181b] transition" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4.75A.75.75 0 013.75 4h12.5a.75.75 0 010 1.5H3.75A.75.75 0 013 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM3 10a.75.75 0 01.75-.75h12.5a.75.75 0 010 1.5H3.75A.75.75 0 013 10z" clip-rule="evenodd"/></svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
