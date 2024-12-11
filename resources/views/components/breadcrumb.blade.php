<nav class="flex mb-5" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            <i class="fa fa-home"></i>
            &nbsp;Home
            </a>
        </li>
        @if (empty($s_submenu))
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fa fa-angle-right text-gray-400"></i>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                        {{ $user->menus[$s_menu]['detail'] }}
                    </span>
                </div>
            </li>
        @else
            <li>
                <div class="flex items-center">
                    <i class="fa fa-angle-right text-gray-400"></i>
                    <a href="{{ route($user->menus[$s_menu]['reference']) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                        {{ $user->menus[$s_menu]['detail'] }}
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fa fa-angle-right text-gray-400"></i>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                        {{ $user->menus[$s_menu]['subs'][$s_submenu]['detail'] }}
                    </span>
                </div>
            </li>
        @endif
    </ol>
</nav>

<h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
    @if (empty($s_submenu))
        {{ $user->menus[$s_menu]['detail'] }}
    @else
        {{ $user->menus[$s_menu]['subs'][$s_submenu]['detail'] }}
    @endif
</h1>
