<x-admin-nav>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control text-gray-900" placeholder="Name" value="{{ $user->name }}" >
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control text-gray-900" placeholder="Email" value="{{ $user->email }}" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Usertype</label>
                                    <input type="text" name="usertype" class="form-control text-gray-900" placeholder="Usertype" value="{{ $user->usertype }}" >
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Status</label>
                                    <input type="text" name="status" class="form-control text-gray-900" placeholder="Status" value="{{ $user->status }}" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-grid">
                                    <button class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-nav>