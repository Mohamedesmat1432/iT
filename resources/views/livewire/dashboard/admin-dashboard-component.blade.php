<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="mt-2">
        <h1 class=" text-2xl font-medium text-gray-900">
            {{ __('Admin Dashboard') }}
        </h1>
    </div>
    <div class="mt-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-indigo-500 rounded p-5 text-white">
                <div class="flex text-2xl justify-between">
                    <x-icon class="w-12 h-12 text-center" name="user" />
                    <div class="text-center">
                        <div> {{ __('Users') }}</div>
                        <div>{{ $users }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-red-500 rounded p-5 text-white">
                <div class="flex text-2xl justify-between">
                    <x-icon class="w-12 h-12 text-center" name="rectangle-stack" />
                    <div class="text-center">
                        <div> {{ __('Departments') }}</div>
                        <div>{{ $departments }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-700 rounded p-5 text-white">
                <div class="flex text-2xl justify-between">
                    <x-icon class="w-12 h-12 text-center" name="server-stack" />
                    <div class="text-center">
                        <div> {{ __('Switchs') }}</div>
                        <div>{{ $switchs }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-500 rounded p-5 text-white">
                <div class="flex text-2xl justify-between">
                    <x-icon class="w-12 h-12 text-center" name="server" />
                    <div class="text-center">
                        <div> {{ __('Patchs') }}</div>
                        <div>{{ $patchs }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-500 rounded p-5 text-white">
                <div class="flex text-2xl justify-between">
                    <x-icon class="w-12 h-12 text-center" name="home-modern" />
                    <div class="text-center">
                        <div> {{ __('Companies') }}</div>
                        <div>{{ $companies }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-green-500 rounded p-5 text-white">
                <div class="flex text-2xl justify-between">
                    <x-icon class="w-12 h-12 text-center" name="clipboard-document-check" />
                    <div class="text-center">
                        <div> {{ __('Licenses') }}</div>
                        <div>{{ $licenses }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
