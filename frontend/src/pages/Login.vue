<template>
  <div class="container mt-5" style="max-width:400px">
    <h3 class="mb-3">Login Admin</h3>

    <input v-model="email" class="form-control mb-2" placeholder="Email">
    <input v-model="password" type="password" class="form-control mb-3" placeholder="Password">

    <button @click="login" class="btn btn-primary w-100" :disabled="loading">
      {{ loading ? 'Loading...' : 'Login' }}
    </button>

    <p v-if="error" class="text-danger mt-2">{{ error }}</p>
  </div>
</template>

<script>
import api from '@/services/Api'

export default {
  data(){
    return{
      email:'',
      password:'',
      loading:false,
      error:null
    }
  },
  methods:{
    async login(){
      this.loading = true
      this.error = null

      try{
        const res = await api.post('/login',{
          email:this.email,
          password:this.password
        })

        localStorage.setItem('token', res.data.data.token)

        this.$router.push('/admin/dashboard')
      }catch(e){
        this.error = 'Email atau password salah'
      }finally{
        this.loading = false
      }
    }
  }
}
</script>