@extends('layouts.app')

@section('content')
<h4>Edit Produk</h4>

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
            @{{ loading ? 'Menyimpan...' : 'Update Produk' }}
        </button>
    </form>

    <div v-if="success" class="alert alert-success mt-3">
        Produk berhasil diperbarui!
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
                name: @json($product->name),
                price: @json($product->price)
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
                await axios.put("{{ route('products.update', ['product_id' => $id]) }}", this.form, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                this.success = true;

                // Redirect ke index
                // Delay 2 detik sebelum redirect
                setTimeout(() => {
                    window.location.href = "{{ route('products.index') }}";
                }, 2000);
            } catch (error) {
                console.error(error.response?.data || error);
                alert("Terjadi kesalahan saat memperbarui produk!");
            } finally {
                this.loading = false;
            }
        }
    }
}).mount('#app');
</script>
@endsection
