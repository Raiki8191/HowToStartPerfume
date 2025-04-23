<nav class="bg-white border-b border-gray-100">
    <!-- ナビゲーション左側 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- ロゴ -->
                <div class="shrink-0 flex items-center bg-white">
                    <a href="/">
                        <x-application-logo class="block h-16 w-auto filter grayscale contrast-100" />
                    </a>
                </div>


            </div>

            <!-- ナビゲーション右側 -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- 未ログイン時の表示 -->
                @guest
                <div class="flex space-x-4 p-2 bg-gray-50 rounded-md shadow-sm border border-gray-200">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 border border-indigo-500 text-indigo-600 text-sm font-semibold rounded hover:bg-indigo-500 hover:text-white transition duration-200">
                        ログイン
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 border border-green-500 text-green-600 text-sm font-semibold rounded hover:bg-green-500 hover:text-white transition duration-200">
                        新規登録
                    </a>
                </div>
                @endguest



                <!-- ログイン済みのユーザー -->
                @auth
                <div class="flex items-center space-x-4">
                    <!-- 通知アイコン -->
                    <div class="relative">
                        <a href="{{ route('notifications.index') }}"
                            class="text-gray-500 hover:text-indigo-600 transition relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 
                         6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 
                         6.165 6 8.388 6 11v3.159c0 .538-.214 
                         1.055-.595 1.436L4 17h5m6 0v1a3 
                         3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>

                            <!-- 通知件数バッジ（任意）-->
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                            @endif
                        </a>
                    </div>

                    <!-- ユーザー名とドロップダウン -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 
                                111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 
                                010-1.414z" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    プロフィール
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        ログアウト
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                @endauth

            </div>
        </div>
    </div>
</nav>