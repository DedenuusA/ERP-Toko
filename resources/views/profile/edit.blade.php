@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8">

        <!-- HEADER -->

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-800">

                Profile Settings

            </h1>

            <p class="text-gray-500 mt-2">

                Kelola akun dan keamanan profile Anda

            </p>

        </div>

        <!-- PROFILE INFO -->

        <div class="bg-white rounded-2xl shadow-sm border p-6 mb-6">

            <div class="mb-6">

                <h2 class="text-xl font-semibold text-slate-800">

                    Informasi Profile

                </h2>

                <p class="text-gray-500 text-sm mt-1">

                    Update nama dan email akun Anda

                </p>

            </div>

            @include('profile.partials.update-profile-information-form')

        </div>

        <!-- PASSWORD -->

        <div class="bg-white rounded-2xl shadow-sm border p-6 mb-6">

            <div class="mb-6">

                <h2 class="text-xl font-semibold text-slate-800">

                    Ubah Password

                </h2>

                <p class="text-gray-500 text-sm mt-1">

                    Gunakan password yang aman dan kuat

                </p>

            </div>

            @include('profile.partials.update-password-form')

        </div>

        <!-- DELETE ACCOUNT -->

        <div class="bg-white rounded-2xl shadow-sm border border-red-200 p-6">

            <div class="mb-6">

                <h2 class="text-xl font-semibold text-red-600">

                    Hapus Account

                </h2>

                <p class="text-gray-500 text-sm mt-1">

                    Account yang dihapus tidak dapat dikembalikan

                </p>

            </div>

            @include('profile.partials.delete-user-form')

        </div>

    </div>
@endsection
