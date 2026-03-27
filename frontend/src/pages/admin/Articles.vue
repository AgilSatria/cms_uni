<template>
  <div>



    <div class="header">
      <h3>Artikel</h3>

      <div class="d-flex gap-2">
        <input v-model="search" @input="load" placeholder="Cari artikel..." class="search-input">

        <router-link to="/admin/articles/create" class="btn-add">
          + Tambah
        </router-link>
      </div>
    </div>

    <div class="card">
      <table class="table">
        <thead>
          <tr>
            <th>Judul</th>
            <th>Image</th>
            <th width="200">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="item in articles" :key="item.id">
            <router-link :to="'/article/' + item.slug">
              {{ item.title }}
            </router-link>

            <td>
              <img v-if="item.image" :src="'http://localhost:8000/storage/' + item.image" width="80">
            </td>

            <td>
              <router-link :to="'/admin/articles/edit/' + item.id" class="btn-edit">Edit</router-link>

              <button @click="hapus(item.id)" class="btn-delete">
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="pagination">
        <button @click="prev" :disabled="page === 1">Prev</button>
        <span>Page {{ page }}</span>
        <button @click="next">Next</button>
      </div>
    </div>

  </div>
</template>

<script>
import api from '@/services/Api'


export default {
  // 🔥 data untuk menyimpan list artikel, kata kunci pencarian, dan halaman saat ini
  data() { return { articles: [], search: '', page: 1 } },
  mounted() { this.load() },
  methods: {
    load() {
      api.get('/articles', {
        params: {
          search: this.search,
          page: this.page
        }
      }).then(res => {
        this.articles = res.data.data.data
      })
    },

    // 🔥 fungsi untuk halaman selanjutnya
    next() {
      this.page++
      this.load()
    },
    // 🔥 fungsi untuk halaman sebelumnya
    prev() {
      if (this.page > 1) {
        this.page--
        this.load()
      }
    },


    // 🔥 fungsi hapus artikel
    async hapus(id) {
      if (confirm('Yakin mau hapus artikel ini?')) {
        try {
          await api.delete('/articles/' + id)

          alert('Berhasil dihapus')

          this.load() // 🔥 reload data

        } catch (err) {
          console.log(err)
          alert('Gagal hapus')
        }
      }
    }
  }


}
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
}

.btn-add {
  background: #2563eb;
  color: white;
  padding: 8px 12px;
  border-radius: 6px;
  text-decoration: none;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.table {
  width: 100%;
}

.btn-edit {
  background: #f59e0b;
  padding: 5px 10px;
  margin-right: 5px;
  border-radius: 5px;
  color: white;
}

.btn-delete {
  background: #ef4444;
  padding: 5px 10px;
  border-radius: 5px;
  color: white;
}

.search-input {
  padding: 8px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

.pagination {
  margin-top: 20px;
  display: flex;
  gap: 10px;
  align-items: center;
}
</style>