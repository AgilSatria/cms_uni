<template>
    <div class="card">

        <h3 class="mb-3">
            {{ isEdit ? 'Edit Artikel' : 'Tambah Artikel' }}
        </h3>

        <input v-model="title" class="form-input" placeholder="Judul Artikel">

        <textarea v-model="content" class="form-input" placeholder="Isi Artikel"></textarea>

        <button @click="simpan" class="btn-save">
            {{ isEdit ? 'Update' : 'Simpan' }}
        </button>

    </div>
</template>

<script>
import api from '@/services/Api'

export default {
    data() {
        return {
            title: '',
            content: '',
            isEdit: false,
            id: null
        }
    },

    mounted() {
        this.checkEdit()
    },

    methods: {
        checkEdit() {
            if (this.$route.params.id) {
                this.isEdit = true
                this.id = this.$route.params.id
                this.loadData()
            }
        },


        // Load data artikel berdasarkan id
        async loadData() {
            try {
                const res = await api.get('/articles/id/' + this.id)
                const data = res.data.data

                this.title = data.title
                this.content = data.content

            } catch (err) {
                console.log(err)
            }
        },




        // Simpan data, jika isEdit true maka update, jika false maka create
        async simpan() {
            try {

                if (this.isEdit) {
                    // 🔥 UPDATE
                    await api.put('/articles/' + this.id, {
                        title: this.title,
                        content: this.content
                    })

                    alert('Berhasil update')

                } else {
                    // 🔥 CREATE
                    await api.post('/articles', {
                        title: this.title,
                        content: this.content
                    })

                    alert('Berhasil tambah')
                }

                this.$router.push('/admin/articles')

            } catch (err) {
                console.log(err)
                alert('Gagal')
            }
        }
    }
}
</script>

<style scoped>
.card {
    background: white;
    padding: 20px;
    border-radius: 12px;
}

.form-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.btn-save {
    background: #2563eb;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
}
</style>