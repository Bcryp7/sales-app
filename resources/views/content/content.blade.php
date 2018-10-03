@extends('layout.master')

@section('content')

    <template v-if="menu == 0">

        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        Desktop
                    </a>
                </li>
            </ol>
            <div class="container-fluid">
                <h1>Dashboard</h1>
            </div>

        </main>

    </template>

    <template v-if="menu == 1">

        <categories></categories>

    </template>

    <template v-if="menu == 2">

        <articles></articles>

    </template>

@endsection