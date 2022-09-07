<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (auth()->user()->hasPendingFriendRequestTo($user))
                        <span>Waiting for {{ $user->name }} to accept your friend request.</span>

                        <form action="{{ route('friend.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-indigo-600">Cancel</button>
                        </form>
                    @elseif (auth()->user()->hasPendingFriendRequestFrom($user))
                        <span>{{ $user->name }} has requested to add you as a friend.</span>

                        <form action="{{ route('friend.update', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-indigo-600">Accept</button>
                        </form>

                        <form action="{{ route('friend.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-indigo-600">Reject</button>
                        </form>
                    @else
                        <form action="{{ route('friend.store', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-indigo-600">Add as friend</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
