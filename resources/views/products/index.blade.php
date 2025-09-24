@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Daftar Products</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

<div id="app">
    <div class="controls mb-3 d-flex align-items-center gap-2">
    <input
        class="form-control w-auto"
        v-model="q"
        placeholder="Cari produk..."
        @input="filterLocal"
    >
    <button class="btn btn-secondary" @click="reload">Cari</button>
    </div>

    <div v-if="loading">Memuat produk...</div>
    <div v-else>
      <div v-if="filtered.length === 0">Tidak ada produk.</div>

      <div class="product-list row">
        <div class="col-md-4 mb-3" v-for="product in filtered" :key="product.id">
          <div class="card p-3 h-100">
            <h5>@{{ product.name }}</h5>
            <p class="text-muted mb-2">Rp @{{ formatCurrency(product.price) }}</p>

            <div class="d-flex justify-content-between mt-auto">
              <button class="btn btn-sm btn-info" @click="viewProduct(product)">Lihat</button>
              <a :href="'/products/' + product.id + '/edit'" class="btn btn-sm btn-warning">Edit</a>
              <button class="btn btn-sm btn-danger" @click="deleteProduct(product.id)">Hapus</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Vue 3 via CDN -->
<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<!-- Axios via CDN -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
const { createApp } = Vue;

createApp({
  data() {
    return {
      products: [],
      filtered: [],
      q: '',
      loading: false,
    }
  },
  methods: {
    fetchProducts() {
      this.loading = true;
      axios.get("{{ route('products.json') }}")
        .then(res => {
          this.products = res.data.data || [];
          this.filtered = this.products;
        })
        .catch(err => {
          console.error(err);
          alert('Gagal memuat produk.');
        })
        .finally(() => {
          this.loading = false;
        });
    },
    formatCurrency(value) {
      return Number(value).toLocaleString('id-ID', { maximumFractionDigits: 0 });
    },
    viewProduct(product) {
      alert(product.name + "\\nHarga: Rp " + this.formatCurrency(product.price));
    },
    reload() {
      this.fetchProducts();
    },
    filterLocal() {
      const q = this.q.trim().toLowerCase();
      if (!q) {
        this.filtered = this.products;
        return;
      }
      this.filtered = this.products.filter(p =>
        (p.name && p.name.toLowerCase().includes(q)) ||
        (p.description && p.description.toLowerCase().includes(q))
      );
    },
    deleteProduct(id) {
      if (!confirm('Yakin ingin menghapus produk ini?')) return;

      axios.delete('/products/' + id, {
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(() => {
        this.products = this.products.filter(p => p.id !== id);
        this.filterLocal();
      })
      .catch(err => {
        console.error(err);
        alert('Gagal menghapus produk.');
      });
    }
  },
  mounted() {
    this.fetchProducts();
  }
}).mount('#app');
</script>
@endsection
