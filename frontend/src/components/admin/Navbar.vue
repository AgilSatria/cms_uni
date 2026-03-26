<template>
  <div class="navbar">
    <h5>Dashboard</h5>

    <button @click="logout" class="btn-logout">
      Logout
    </button>
  </div>
</template>

<script>
export default {
  methods:{
    logout(){
      localStorage.removeItem('token')
      this.$router.push('/login')
    }
  }
}
</script>

<style scoped>
.navbar{
  background:white;
  padding:15px 25px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  border-bottom:1px solid #eee;
}

.btn-logout{
  background:#ef4444;
  color:white;
  border:none;
  padding:8px 12px;
  border-radius:6px;
}
</style>