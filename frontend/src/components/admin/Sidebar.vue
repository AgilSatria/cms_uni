<template>
  <div class="sidebar">
    <h4 class="logo">⚡ CMS</h4>

    <router-link to="/admin/dashboard" class="menu">
      📊 Dashboard
    </router-link>

    <router-link to="/admin/articles" class="menu">
      📝 Artikel
    </router-link>
  </div>
</template>

<style scoped>
.sidebar{
 width:240px;
  height:100vh; /* 🔥 ini bikin full tinggi */
  background:#111827;
  color:white;
  padding:20px;
}

.logo{
  margin-bottom:30px;
}

.menu{
  display:block;
  padding:12px;
  margin-bottom:8px;
  border-radius:8px;
  color:#cbd5e1;
  text-decoration:none;
}

.menu:hover{
  background:#1f2937;
}

.menu.router-link-exact-active{
  background:#2563eb;
  color:white;
}
</style>