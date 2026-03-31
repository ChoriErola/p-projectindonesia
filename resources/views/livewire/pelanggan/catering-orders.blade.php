<div>
    <div style="margin-top: 80px; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; margin: 20px;">
        <div class="container-lg">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 style="color: white; margin: 0; font-weight: 600;">Pesanan Catering Anda</h4>
                    <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0 0; font-size: 0.9rem;">Kelola pesanan catering Anda</p>
                </div>
                <a href="{{ route('pelanggan.catering-pesanan.create') }}" class="btn" style="background-color: #ff9800; color: white; border: none; padding: 10px 25px; font-weight: 600; border-radius: 5px; text-decoration: none; transition: all 0.3s;">
                    <i class="bi bi-plus-circle" style="margin-right: 8px;"></i>Pesanan Baru
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show container-lg" role="alert" style="margin-top: 20px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-lg" style="margin-top: 30px; margin-bottom: 50px;">
        @forelse ($cateringOrders as $order)
            <div class="card mb-4" style="box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 10px; border: none;">
                <div class="card-body p-4">
                    {{-- HEADER --}}
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 style="color: #a8729a; margin: 0; font-weight: 600;">{{ $order->nama_acara }}</h5>
                            <p style="color: #999; font-size: 0.9rem; margin: 5px 0 0 0;">Kode: <strong>{{ $order->order_code }}</strong></p>
                        </div>
                        <span class="badge" style="background-color: {{ match($order->status) {
                            'pending' => '#6c757d',
                            'confirmed' => '#0dcaf0',
                            'completed' => '#198754',
                            'cancelled' => '#dc3545',
                            default => '#6c757d'
                        } }}; padding: 8px 12px; font-size: 0.9rem;">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    {{-- DETAIL --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p style="color: #666; margin-bottom: 8px;"><strong>Jumlah Porsi:</strong> {{ $order->qty }} porsi</p>
                            <p style="color: #666; margin-bottom: 8px;"><strong>Harga/Porsi:</strong> Rp {{ number_format($order->harga_per_porsi, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p style="color: #666; margin-bottom: 8px;"><strong>Total Harga:</strong> <span style="color: #a8729a; font-weight: 600; font-size: 1.1rem;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></p>
                            <p style="color: #666; margin-bottom: 0;"><strong>Alamat:</strong> {{ substr($order->alamat, 0, 50) }}...</p>
                        </div>
                    </div>

                    {{-- BUTTON DETAIL --}}
                    <button type="button" class="btn btn-sm" style="background-color: #a8729a; color: white; border: none; padding: 8px 16px; font-weight: 600; border-radius: 5px; cursor: pointer;" 
                            onclick="toggleDetail({{ $order->id }})">
                        <i class="bi bi-eye" style="margin-right: 5px;"></i> Lihat Detail
                    </button>

                    {{-- COLLAPSE DETAIL --}}
                    <div id="detail-{{ $order->id }}" style="display: none; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd;">
                        {{-- DETAIL ALAMAT & CATATAN --}}
                        <div class="mb-4">
                            <p style="color: #666; margin-bottom: 8px;"><strong>Alamat Lengkap:</strong></p>
                            <p style="color: #666; background: #f8f9fa; padding: 12px; border-radius: 5px; margin: 0;">{{ $order->alamat }}</p>
                        </div>

                        @if($order->catatan)
                            <div class="mb-4">
                                <p style="color: #666; margin-bottom: 8px;"><strong>Catatan:</strong></p>
                                <p style="color: #666; background: #f8f9fa; padding: 12px; border-radius: 5px; margin: 0;">{{ $order->catatan }}</p>
                            </div>
                        @endif

                        {{-- BUKTI PEMBAYARAN --}}
                        @if($order->status === 'confirmed')
                            <div class="mt-4 pt-4" style="border-top: 1px solid #ddd;">
                                <p style="color: #333; margin-bottom: 12px; font-weight: 600;"><i class="bi bi-receipt"></i> Upload Bukti Pembayaran</p>

                                @if(isset($selectedOrder) && $selectedOrder->id === $order->id)
                                    <form wire:submit.prevent="uploadBukti">
                                        <div class="mb-3">
                                            <input type="file" 
                                                   wire:model="bukti_pembayaran" 
                                                   multiple 
                                                   accept="image/*" 
                                                   class="form-control" 
                                                   style="border: 2px dashed #a8729a; padding: 20px; text-align: center;">
                                            @error('bukti_pembayaran.*') 
                                                <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> 
                                            @enderror
                                            <small style="color: #999; display: block; margin-top: 8px;">Format: JPG, PNG, WEBP. Maksimal 2MB per file</small>
                                        </div>

                                        @if(count($bukti_pembayaran ?? []) > 0)
                                            <div class="mb-3">
                                                <p style="color: #666; font-size: 0.9rem; margin-bottom: 8px;">Preview:</p>
                                                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px;">
                                                    @foreach($bukti_pembayaran as $file)
                                                        <div style="position: relative; border-radius: 8px; overflow: hidden; border: 2px solid #ddd;">
                                                            <img src="{{ $file->temporaryUrl() }}" 
                                                                 style="width: 100%; height: 100px; object-fit: cover;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-sm" style="background-color: #198754; color: white; border: none; padding: 8px 16px; font-weight: 600; border-radius: 5px;">
                                                <i class="bi bi-check-circle"></i> Kirim Bukti
                                            </button>
                                            <button type="button" class="btn btn-sm" style="background-color: #6c757d; color: white; border: none; padding: 8px 16px; font-weight: 600; border-radius: 5px;" 
                                                    onclick="toggleUploadForm({{ $order->id }})">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm" style="background-color: #a8729a; color: white; border: none; padding: 8px 16px; font-weight: 600; border-radius: 5px; cursor: pointer;"
                                            wire:click="selectOrder({{ $order->id }})" 
                                            onclick="toggleUploadForm({{ $order->id }})">
                                        <i class="bi bi-upload"></i> Upload Bukti Pembayaran
                                    </button>
                                @endif
                            </div>

                            {{-- TAMPIL BUKTI PEMBAYARAN YANG SUDAH DIUPLOAD --}}
                            @if(count($order->bukti_pembayaran ?? []) > 0)
                                <div class="mt-4 pt-4" style="border-top: 1px solid #ddd;">
                                    <p style="color: #333; margin-bottom: 12px; font-weight: 600;"><i class="bi bi-image"></i> Bukti Pembayaran Terkini</p>
                                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px;">
                                        @foreach($order->bukti_pembayaran as $bukti)
                                            <div style="position: relative; border-radius: 8px; overflow: hidden; border: 2px solid #ddd; cursor: pointer;"
                                                 onclick="showImage('{{ asset('storage/' . $bukti) }}')">
                                                <img src="{{ asset('storage/' . $bukti) }}" 
                                                     alt="Bukti Pembayaran" 
                                                     style="width: 100%; height: 120px; object-fit: cover;">
                                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.3s;"
                                                     onmouseover="this.style.opacity='1'"
                                                     onmouseout="this.style.opacity='0'">
                                                    <i class="bi bi-zoom-in" style="color: white; font-size: 20px;"></i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="mt-4">
                            <button type="button" class="btn btn-sm" style="background-color: #6c757d; color: white; border: none; padding: 8px 16px; font-weight: 600; border-radius: 5px; cursor: pointer;" 
                                    onclick="toggleDetail({{ $order->id }})">
                                <i class="bi bi-chevron-up"></i> Sembunyikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 60px 20px;">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 20px; display: block;"></i>
                <h5 style="color: #999; margin-bottom: 10px;">Belum ada pesanan catering</h5>
                <p style="color: #bbb; margin-bottom: 20px;">Buat pesanan catering baru untuk memulai</p>
                <a href="{{ route('pelanggan.catering-pesanan.create') }}" class="btn" style="background-color: #a8729a; color: white; border: none; padding: 10px 25px; font-weight: 600; border-radius: 5px; text-decoration: none;">
                    <i class="bi bi-plus-circle" style="margin-right: 8px;"></i>Buat Pesanan Sekarang
                </a>
            </div>
        @endforelse
    </div>

    {{-- IMAGE MODAL --}}
    <div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center;">
        <div style="position: relative; max-width: 90%; max-height: 90%; border-radius: 10px; overflow: hidden;">
            <img id="modalImage" src="" alt="Bukti Pembayaran" style="width: 100%; height: auto; border-radius: 10px;">
            <button onclick="closeImageModal()" style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                ×
            </button>
        </div>
    </div>

    <script>
        function toggleDetail(orderId) {
            const detail = document.getElementById('detail-' + orderId);
            detail.style.display = detail.style.display === 'none' ? 'block' : 'none';
        }

        function toggleUploadForm(orderId) {
            const form = document.getElementById('form-' + orderId);
            if(form) {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        }

        function showImage(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'flex';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
    </script>
</div>
