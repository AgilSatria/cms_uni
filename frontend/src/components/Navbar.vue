<template>
    <nav class="navbar">

        <div class="logo">CMS</div>

        <div class="menu">
            <router-link to="/">Home</router-link>
            <router-link to="/">Artikel</router-link>
            <router-link to="/login">Login</router-link>
        </div>

    </nav>
</template>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #111827;
    color: white;
}

.logo {
    font-weight: bold;
    font-size: 18px;
}

.menu a {
    margin-left: 15px;
    color: white;
    text-decoration: none;
}

.menu a.router-link-exact-active {
    font-weight: bold;
    border-bottom: 2px solid white;
}
</style>