<template>
    <div class="nav_bar_vue">
        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'profile' }">Профиль</router-link>
        </li>

        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'brief' }">Резюме</router-link>
        </li>
    </div>
</template>

<script>
    export default {}
</script>