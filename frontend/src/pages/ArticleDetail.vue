<template>
  <div class="container">

    <h2>{{ article.title }}</h2>

    <p>{{ article.content }}</p>

  </div>
</template>

<script>
import api from '@/services/Api'

export default {
  data() {
    return {
      article: {}
    }
  },
  mounted() {
    this.load()
  },
  methods: {
    load() {
      const slug = this.$route.params.slug

      api.get('/articles/' + slug)
        .then(res => {
          this.article = res.data.data
        })
    }
  }
}
</script>