{{-- resources/views/admin/pending_users.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">قائمة المستخدمين في انتظار التفعيل</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($users->isEmpty())
        <p>لا يوجد مستخدمون في انتظار التفعيل.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">الاسم الكامل</th>
                    <th class="py-2 px-4 border-b">البريد الإلكتروني</th>
                    <th class="py-2 px-4 border-b">الهاتف</th>
                    <th class="py-2 px-4 border-b">العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->fullname }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->telephone }}</td>
                    <td class="py-2 px-4 border-b space-x-2">
                        <form action="{{ route('admin.approveUser', $user->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">قبول</button>
                        </form>
                        <form action="{{ route('admin.rejectUser', $user->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">رفض</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
