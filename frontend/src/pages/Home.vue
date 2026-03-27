<template>
    <div>
        <Navbar />


        <div class="container">

            <h2>Artikel Terbaru</h2>

            <div class="top-bar">

                <input v-model="search" @input="handleSearch" placeholder="Cari artikel..." class="search-input" />

            </div>

            <div v-if="loading" class="loading">
                Loading...
            </div>

            <div v-if="!loading && articles.length === 0">
                Artikel tidak ditemukan
            </div>

            <div class="grid">
                <div v-for="item in articles" :key="item.id" class="card">

                    <img v-if="item.image" :src="'http://localhost:8000/storage/' + item.image" class="thumb" />

                    <h3>
                        <router-link :to="'/article/' + item.slug">
                            {{ item.title }}
                        </router-link>
                    </h3>

                    <p>{{ item.content.substring(0, 100) }}...</p>

                </div>

            </div>

            <div class="pagination">

                <button @click="prev" :disabled="page === 1">
                    Prev
                </button>

                <span>Page {{ page }}</span>

                <button @click="next">
                    Next
                </button>

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
            articles: [],
            search: '',
            page: 1,
            loading: false,   // loading
            timer: null       // debounce
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        async load() {
            this.loading = true   // 🔥 mulai loading

            try {
                const res = await api.get('/articles', {
                    params: {
                        search: this.search,
                        page: this.page
                    }
                })

                this.articles = res.data.data.data

            } catch (err) {
                console.log(err)
            }

            this.loading = false  // 🔥 selesai loading
        },

        handleSearch() {

            clearTimeout(this.timer) // 🔥 hapus timer lama

            this.timer = setTimeout(() => {
                this.page = 1
                this.load()
            }, 500) // ⏱ delay 500ms
        },

        next() {
            this.page++
            this.load()
        },

        prev() {
            if (this.page > 1) {
                this.page--
                this.load()
            }
        }

    }
}



</script>

<style scoped>
body {
    background: #f9fafb;
}

.container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
}

.card {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
}

.thumb {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.menu a:hover {
    opacity: 0.7;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}


.card {
    border: 1px solid #ddd;
    border-radius: 12px;
    overflow: hidden;
    transition: 0.3s;
    background: white;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}


.thumb {
    width: 100%;
    height: 180px;
    object-fit: cover;
}


.card h3 {
    font-size: 16px;
    padding: 10px;
}

.card p {
    font-size: 14px;
    padding: 0 10px 10px;
    color: #555;
}

.top-bar {
    margin-bottom: 20px;
}

.search-input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.pagination button {
    padding: 8px 12px;
    border: none;
    background: #2563eb;
    color: white;
    border-radius: 6px;
}

.pagination button:disabled {
    background: #ccc;
}

.loading {
    text-align: center;
    padding: 20px;
    font-weight: bold;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% {
        opacity: 0.5
    }

    50% {
        opacity: 1
    }

    100% {
        opacity: 0.5
    }
}
</style>