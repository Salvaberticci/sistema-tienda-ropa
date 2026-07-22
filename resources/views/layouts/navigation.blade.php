<nav x-data="{ open: false }" class="bg-white border-b border-beige-200/60 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <span class="font-display text-xl font-bold text-gradient">Hechizos</span>
                    @if (auth()->user()->role === 'admin')
                        <span class="hidden sm:inline text-xs text-beige-400 font-medium px-2 py-0.5 bg-beige-100 rounded-lg">Admin</span>
                    @endif
                </a>

                @if (auth()->user()->role === 'admin')
                    <div class="hidden lg:flex items-center gap-1">
                        <x-nav-link :href="route('admin.productos.index')" :active="request()->routeIs('admin.productos.*')">
                            Productos
                        </x-nav-link>
                        <x-nav-link :href="route('admin.inventario.index')" :active="request()->routeIs('admin.inventario.*')">
                            Inventario
                        </x-nav-link>
                        <x-nav-link :href="route('admin.clientes.index')" :active="request()->routeIs('admin.clientes.*')">
                            Clientes
                        </x-nav-link>
                        <x-nav-link :href="route('admin.ventas.index')" :active="request()->routeIs('admin.ventas.*')">
                            Ventas
                        </x-nav-link>
                        <x-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')">
                            Categorías
                        </x-nav-link>
                        <x-nav-link :href="route('admin.cierres.index')" :active="request()->routeIs('admin.cierres.*')">
                            Cierres
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex sm:items-center sm:ms-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium text-beige-600 bg-beige-50 hover:bg-beige-100 hover:text-beige-700 border border-beige-200/60 transition-all duration-200">
                                <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-beige-400 to-beige-600 text-white text-xs font-bold flex items-center justify-center">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </span>
                                <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-beige-100">
                                <p class="text-sm font-medium text-beige-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-beige-500 mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <x-dropdown-link :href="route('pedidos.index')">
                                    Mis pedidos
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    Perfil
                                </x-dropdown-link>
                            </div>
                            <div class="border-t border-beige-100 py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        Cerrar sesión
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <button @click="open = ! open" class="lg:hidden inline-flex items-center justify-center p-2 rounded-xl text-beige-500 hover:text-beige-700 hover:bg-beige-100 transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-beige-200/60 bg-white">
        @if (auth()->user()->role === 'admin')
            <div class="px-4 py-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.productos.index')" :active="request()->routeIs('admin.productos.*')">
                    Productos
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.inventario.index')" :active="request()->routeIs('admin.inventario.*')">
                    Inventario
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.clientes.index')" :active="request()->routeIs('admin.clientes.*')">
                    Clientes
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.ventas.index')" :active="request()->routeIs('admin.ventas.*')">
                    Ventas
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.categorias.index')" :active="request()->routeIs('admin.categorias.*')">
                    Categorías
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.cierres.index')" :active="request()->routeIs('admin.cierres.*')">
                    Cierres
                </x-responsive-nav-link>
            </div>
        @endif

        <div class="border-t border-beige-100 px-4 py-3">
            <div class="flex items-center gap-3 mb-3">
                <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-beige-400 to-beige-600 text-white text-sm font-bold flex items-center justify-center">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </span>
                <div>
                    <p class="text-sm font-medium text-beige-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-beige-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('pedidos.index')">
                    Mis pedidos
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
