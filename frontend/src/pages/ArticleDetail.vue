<template>
  <div>

    <Navbar />

    <div class="container">

      <div v-if="article">

        <!-- 🔥 HERO IMAGE -->
        <img v-if="article.image" :src="'http://localhost:8000/storage/' + article.image" class="hero-img" />

        <!-- 🔥 TITLE -->
        <h1 class="title">
          {{ article.title }}
        </h1>

        <!-- 🔥 META -->
        <p class="meta">
          Diposting oleh Admin
        </p>

        <!-- 🔥 CONTENT -->
        <div class="content" v-html="formatContent">
        </div>

      </div>

      <!-- 🔥 LOADING -->
      <div v-else class="loading">
        Loading...
      </div>

    </div>

  </div>
</template>

<script>
import api from '@/services/Api'
import Navbar from '@/components/Navbar.vue'

export default {

  components: { Navbar },

  data() {
    return {
      article: null
    }
  },

  mounted() {
    this.load()
  },

  methods: {
    async load() {
      const slug = this.$route.params.slug

      const res = await api.get('/articles/' + slug)

      this.article = res.data.data
    }
  },

  computed: {
    formatContent() {
      return this.article.content.replace(/\n/g, '<br>')
    }
  }


}
</script>


<style scoped>
.container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.hero-img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  border-radius: 12px;
  margin-bottom: 20px;
}

.title {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 10px;
}

.meta {
  color: #777;
  font-size: 14px;
  margin-bottom: 20px;
}

.content {
  line-height: 1.8;
  font-size: 16px;
  color: #333;
}

.loading {
  text-align: center;
  padding: 50px;
}

.content img {
  max-width: 100%;
  border-radius: 10px;
  margin: 10px 0;
}
</style>
