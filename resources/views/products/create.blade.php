@extends('layouts.app')

@section('content')
<h4>Tambahkan Produk</h4>

<div id="app">
    <form @submit.prevent="submitForm">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" v-model="form.name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" v-model="form.price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="loading">
            @{{ loading ? 'Menyimpan...' : 'Buat Produk' }}
        </button>
    </form>

    <div v-if="success" class="alert alert-success mt-3">
        Produk berhasil dibuat!
    </div>
</div>

{{-- CDN Vue dan Axios --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            form: {
                name: "",
                price: ""
            },
            loading: false,
            success: false
        }
    },
    methods: {
        async submitForm() {
            this.loading = true;
            this.success = false;

            try {
                await axios.post("{{ route('products.store') }}", this.form, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                this.form.name = "";
                this.form.price = "";
                this.success = true;
            } catch (error) {
                console.error(error.response?.data || error);
                alert("Terjadi kesalahan saat menyimpan produk!");
            } finally {
                this.loading = false;
            }
        }
    }
}).mount('#app');
</script>
@endsection
