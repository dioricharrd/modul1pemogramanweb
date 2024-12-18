<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container">
                <!-- Link ke Home -->
                <router-link :to="{ name: 'home' }" class="navbar-brand">HOME</router-link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Items -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Link ke Villas -->
                        <li class="nav-item me-2">
                            <router-link :to="{ name: 'villas.index' }" class="nav-link active" aria-current="page">VILLAS</router-link>
                        </li>
                        <!-- Button ke Reservation -->
                        <li class="nav-item">
                            <router-link :to="{ name: 'reservations.index' }" class="btn btn-primary">RESERVATIONS</router-link>
                        </li>
                    </ul>
                    <!-- Login Button -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" role="search">
                        <a href="#" target="_blank" class="btn btn-success">LOGIN</a>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Render router view -->
        <router-view></router-view>
    </div>
    </template>
    