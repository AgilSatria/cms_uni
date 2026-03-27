<template>
    <div class="card">

        <h3 class="mb-3">
            {{ isEdit ? 'Edit Artikel' : 'Tambah Artikel' }}
        </h3>

        <input type="file" @change="handleFile">

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
            image: null,
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

        handleFile(e) {
            this.image = e.target.files[0]
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




        //        
        async simpan() {
            const formData = new FormData()

            formData.append('title', this.title)
            formData.append('content', this.content)

            if (this.image) {
                formData.append('image', this.image)
            }

            if (this.isEdit) {
                await api.post('/articles/' + this.id + '?_method=PUT', formData)
            } else {
                await api.post('/articles', formData)
            }

            this.$router.push('/admin/articles')
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

.preview-img {
    margin-top: 10px;
    width: 140px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}
</style>