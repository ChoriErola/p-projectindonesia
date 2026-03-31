<div>
    <div style="margin-top: 80px; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; margin: 20px;">
        <div class="container-lg">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 style="color: white; margin: 0; font-weight: 600;">Buat Pesanan Catering Baru</h4>
                    <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0 0; font-size: 0.9rem;">Isi formulir di bawah untuk membuat pesanan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-lg" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="card" style="box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 10px; border: none;">
            <div class="card-body p-5">
                <form wire:submit.prevent="save">
                    {{-- NAMA ACARA --}}
                    <div class="mb-4">
                        <label for="nama_acara" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nama Acara <span style="color: #dc3545;">*</span></label>
                        <input type="text" 
                               id="nama_acara" 
                               wire:model="nama_acara" 
                               class="form-control" 
                               style="border: 1px solid #ddd; padding: 10px 12px; border-radius: 5px; font-size: 0.95rem;"
                               placeholder="Contoh: Pernikahan, Hari Jadi, Ulang Tahun">
                        @error('nama_acara') <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                    </div>

                    {{-- QTY & HARGA --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="qty" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Jumlah Porsi <span style="color: #dc3545;">*</span></label>
                            <input type="number" 
                                   id="qty" 
                                   wire:model.live="qty" 
                                   class="form-control" 
                                   style="border: 1px solid #ddd; padding: 10px 12px; border-radius: 5px; font-size: 0.95rem;"
                                   min="50" 
                                   max="2000"
                                   placeholder="Minimum 50 porsi">
                            @error('qty') <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="harga_per_porsi" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Harga per Porsi (Rp) <span style="color: #dc3545;">*</span></label>
                            <input type="number" 
                                   id="harga_per_porsi" 
                                   wire:model.live="harga_per_porsi" 
                                   class="form-control" 
                                   style="border: 1px solid #ddd; padding: 10px 12px; border-radius: 5px; font-size: 0.95rem;"
                                   min="25000"
                                   placeholder="Contoh: 25000">
                            @error('harga_per_porsi') <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- TOTAL HARGA --}}
                    <div class="mb-4">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Total Harga (Otomatis)</label>
                        <div style="background: #f8f9fa; padding: 12px; border-radius: 5px; border: 1px solid #ddd;">
                            <p style="color: #a8729a; font-size: 1.2rem; font-weight: 600; margin: 0;">Rp {{ number_format($total_harga, 0, ',', '.') }}</p>
                            <small style="color: #999;">Minimum 50 porsi @ {{ number_format($harga_per_porsi, 0, ',', '.') }}/porsi</small>
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="mb-4">
                        <label for="alamat" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Alamat Acara <span style="color: #dc3545;">*</span></label>
                        <textarea id="alamat" 
                                  wire:model="alamat" 
                                  class="form-control" 
                                  style="border: 1px solid #ddd; padding: 10px 12px; border-radius: 5px; font-size: 0.95rem; font-family: inherit;"
                                  rows="3"
                                  placeholder="Alamat lengkap tempat acara"></textarea>
                        @error('alamat') <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                    </div>

                    {{-- NO HP --}}
                    <div class="mb-4">
                        <label for="no_hp" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">No. HP <span style="color: #dc3545;">*</span></label>
                        <input type="tel" 
                               id="no_hp" 
                               wire:model="no_hp" 
                               class="form-control" 
                               style="border: 1px solid #ddd; padding: 10px 12px; border-radius: 5px; font-size: 0.95rem;"
                               placeholder="Contoh: 08123456789"
                               maxlength="15">
                        @error('no_hp') <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                    </div>

                    {{-- CATATAN --}}
                    <div class="mb-4">
                        <label for="catatan" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Catatan (Opsional)</label>
                        <textarea id="catatan" 
                                  wire:model="catatan" 
                                  class="form-control" 
                                  style="border: 1px solid #ddd; padding: 10px 12px; border-radius: 5px; font-size: 0.95rem; font-family: inherit;"
                                  rows="3"
                                  placeholder="Catatan khusus atau permintaan istimewa"></textarea>
                    </div>

                    {{-- BUKTI PEMBAYARAN (OPSIONAL) --}}
                    <div class="mb-4">
                        <label for="bukti_pembayaran" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Bukti Pembayaran (Opsional)</label>
                        <input type="file" 
                               id="bukti_pembayaran" 
                               wire:model="bukti_pembayaran" 
                               multiple 
                               accept="image/*" 
                               class="form-control" 
                               style="border: 2px dashed #a8729a; padding: 20px; text-align: center; cursor: pointer;">
                        @error('bukti_pembayaran.*') <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span> @enderror
                        <small style="color: #999; display: block; margin-top: 8px;">Format: JPG, PNG, WEBP. Maksimal 2MB per file. Bisa upload beberapa file</small>
                    </div>

                    {{-- PREVIEW BUKTI --}}
                    @if(count($bukti_pembayaran ?? []) > 0)
                        <div class="mb-4">
                            <p style="color: #666; font-weight: 600; margin-bottom: 12px;">Preview Bukti Pembayaran:</p>
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 12px;">
                                @foreach($bukti_pembayaran as $file)
                                    <div style="position: relative; border-radius: 8px; overflow: hidden; border: 2px solid #ddd;">
                                        <img src="{{ $file->temporaryUrl() }}" 
                                             alt="Preview" 
                                             style="width: 100%; height: 100px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- BUTTONS --}}
                    <div class="d-flex gap-2" style="margin-top: 30px;">
                        <button type="submit" class="btn" style="background-color: #a8729a; color: white; border: none; padding: 12px 30px; font-weight: 600; border-radius: 5px; cursor: pointer; flex: 1;">
                            <i class="bi bi-check-circle"></i> Buat Pesanan
                        </button>
                        <a href="{{ route('pelanggan.catering-pesanan') }}" class="btn" style="background-color: #6c757d; color: white; border: none; padding: 12px 30px; font-weight: 600; border-radius: 5px; text-decoration: none; flex: 1; text-align: center;">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
