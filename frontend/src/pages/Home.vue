<template>
    <div>
        <h2>List Artikel</h2>

        <div v-for="item in articles" :key="item.id">
            <router-link :to="'/article/' + item.slug">
                {{ item.title }}
            </router-link>

            <p>{{ item.content }}</p>

            <router-link :to="'/article/' + item.slug">
                Baca Detail
            </router-link>

        </div>

    </div>
</template>

<script>
import api from '@/services/Api'

export default {
    data() {
        return { articles: [] }
    },
    mounted() {
        api.get('/articles').then(res => {
            this.articles = res.data.data.data
        })
    }
}


</script>