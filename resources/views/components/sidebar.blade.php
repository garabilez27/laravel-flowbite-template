<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
            @foreach ($user->menus as $mn => $menu)
                @if ($menu['branched'])
                <li>
                    <button type="button" class="{{ $mn == $s_menu ? 'active' : '' }} flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="{{ $mn }}" data-collapse-toggle="{{ $mn }}">
                        <i class="fa {{ $menu['icon'] }} text-xl"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $menu['detail'] }}</span>
                        <i class="fa fa-angle-down text-xl"></i>
                    </button>
                    <ul id="{{ $mn }}" class="{{ $mn == $s_menu ? '' : 'hidden' }} py-2 space-y-2">
                        @foreach ($menu['subs'] as $sb => $sub)
                            <li>
                                <a href="{{ route($sub['reference']) }}" class=" {{ $sb == $s_submenu ? 'active' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $sub['detail'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li>
                    <a href="{{ route($menu['reference']) }}" class="{{ $mn == $s_menu ? 'active' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa fa-gauge text-xl"></i>
                        <span class="ms-3">{{ $menu['detail'] }}</span>
                    </a>
                </li>
                @endif
            @endforeach
       </ul>
    </div>
 </aside>
