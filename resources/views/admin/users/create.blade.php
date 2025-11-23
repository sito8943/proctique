<x-app-layout title="Create a new user">
    <x-form method="POST" action="/admin/users" contentClass="flex flex-col gap-6 md:gap-10 w-full md:w-2/3">
        <x-text-input required name="name" id="name" label="Name" :value="old('name', '')" placeholder="Jane Doe" />

        <x-text-input required name="email" id="email" label="Email" :value="old('email', '')" placeholder="jane@example.com" />

        <x-text-input required name="password" id="password" label="Password" :value="old('password', '')" />

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_admin" value="1" @checked(old('is_admin', false))>
            <span>Admin</span>
        </label>
    </x-form>
</x-app-layout>

