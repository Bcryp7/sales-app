@extends('layout.master')

@section('content')

    <template v-if="menu == 0">

        <h1>Content of Menu 0</h1>

    </template>

    <template v-if="menu == 1">

        <categories></categories>

    </template>

    <template v-if="menu == 2">

        <articles></articles>

    </template>

    <template v-if="menu == 3">

        <h1>Contenido del menu 3</h1>

    </template>

    <template v-if="menu == 4">

        <h1>Contenido del menu 4</h1>

    </template>

    <template v-if="menu == 5">

        <h1>Contenido del menu 5</h1>

    </template>

    <template v-if="menu == 6">

        <h1>Contenido del menu 6</h1>

    </template>

    <template v-if="menu == 7">

        <h1>Contenido del menu 7</h1>

    </template>

    <template v-if="menu == 8">

        <h1>Contenido del menu 8</h1>

    </template>

    <template v-if="menu == 9">

        <h1>Contenido del menu 9</h1>

    </template>

    <template v-if="menu == 10">

        <h1>Contenido del menu 10</h1>

    </template>

    <template v-if="menu == 11">

        <h1>Contenido del menu 11</h1>

    </template>

    <template v-if="menu == 12">

        <h1>Contenido del menu 12</h1>

    </template>

@endsection