<template>
  <div class="layout">

    <Sidebar />

    <div class="main">
      <Navbar />

      <div class="content">
        <router-view />
      </div>
    </div>

  </div>
</template>

<script>
import Sidebar from '@/components/admin/sidebar.vue'
import Navbar from '@/components/admin/Navbar.vue'

export default {
  components:{ Sidebar, Navbar }
}
</script>

<style>
.layout{
  display:flex;
  min-height:100vh; /* 🔥 penting */
}

.main{
  flex:1;
  display:flex;
  flex-direction:column;
}

.content{
  padding:20px;
}
</style>