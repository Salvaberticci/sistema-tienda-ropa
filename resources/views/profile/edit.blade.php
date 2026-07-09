<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="page-heading">Mi Perfil</h2>
            <p class="text-sm text-beige-500 mt-0.5">Administra tu información personal</p>
        </div>
    </x-slot>

    <div class="content-area max-w-3xl">
        <div class="space-y-6">
            <div class="card p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
