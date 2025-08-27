<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>

    <Head title="Welcome" />

    <v-app>
        <v-main>
            <v-container class="fill-height d-flex flex-column justify-center align-center text-center">

                <!-- Simple Welcome Card -->
                <v-card class="pa-6" max-width="400" elevation="10">
                    <v-card-title class="text-h5 font-weight-bold justify-center">
                        Welcome User
                    </v-card-title>
                    <v-card-text>
                        <p class="mb-4">Simple Blog Posts</p>

                        <!-- Auth Buttons -->
                        <div>
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                            <v-btn color="primary" class="mx-2">Dashboard</v-btn>
                            </Link>

                            <template v-else>
                                <Link v-if="canLogin" :href="route('login')">
                                <v-btn color="primary" class="mx-2">Login</v-btn>
                                </Link>

                                <Link v-if="canRegister" :href="route('register')">
                                <v-btn color="secondary" class="mx-2">Register</v-btn>
                                </Link>
                            </template>
                        </div>
                    </v-card-text>
                </v-card>

            </v-container>
        </v-main>
    </v-app>
</template>
