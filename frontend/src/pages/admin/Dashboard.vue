<template>
    <div>

        <h3 class="mb-4">Dashboard</h3>

        <div class="grid">

            <div class="card">
                <h4>{{ data.total_articles || 0 }}</h4>
                <p>Total Artikel</p>
            </div>

            <div class="card">
                <h4>{{ data.total_users || 0 }}</h4>
                <p>Total User</p>
            </div>

        </div>

    </div>
</template>

<script>
import api from '@/services/Api'

export default {
    data() {
        return {
            data: {}
        }
    },
    mounted() {
        api.get('/dashboard').then(res => {
            this.data = res.data.data
        })
    }
}
</script>

<style scoped>
.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}
</style>