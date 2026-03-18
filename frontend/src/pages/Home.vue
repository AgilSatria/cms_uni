<template>
<div>
<h2>List Artikel</h2>

<div v-for="item in articles" :key="item.id">
<h4>{{ item.title }}</h4>
<p>{{ item.content }}</p>
</div>

</div>
</template>

<script>
import api from '@/services/Api'

export default{
data(){
return{ articles:[] }
},
mounted(){
api.get('/articles').then(res=>{
this.articles = res.data.data.data
})
}
}
</script>