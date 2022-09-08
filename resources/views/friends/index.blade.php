<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friends') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-6 gap-6">
            <div class="col-span-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold">Friends</h2>
                            <div class="space-y-3">
                                @forelse ($friends as $friend)
                                    <div class="flex items-center justify-between">
                                        <div>{{ $friend->name }}</div>
                                        <div class="space-x-2">
                                            <form action="{{ route('friends.destroy', $friend) }}" class="inline" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-indigo-600">Unfriend</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <span>You have no friends.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold">Friend requests</h2>
                            <div class="space-y-3">
                                @forelse ($friendsFrom as $friendFrom)
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('profile', $friendFrom) }}">{{ $friendFrom->name }}</a>
                                        <div class="space-x-2">
                                            <form action="{{ route('friends.update', $friendFrom) }}" class="inline" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-indigo-600">Accept</button>
                                            </form>
                                            <form action="{{ route('friends.destroy', $friendFrom) }}"class="inline" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-indigo-600">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <span>You have no friend request.</span>
                                @endforelse
                            </div>
                        </div>
                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold">Pending friend requests</h2>
                            <div class="space-y-3">
                                @forelse ($friendsTo as $friendTo)
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('profile', $friendTo) }}">{{ $friendTo->name }}</a>
                                        <div class="space-x-2">
                                            <form action="{{ route('friends.destroy', $friendTo) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-indigo-600">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <span>You have no pending friend request yet.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
