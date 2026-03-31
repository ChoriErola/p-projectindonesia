<?php

namespace App\Livewire\Pelanggan;

use App\Models\CateringOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CateringOrdersCreate extends Component
{
    use WithFileUploads;

    public $nama_acara;
    public $qty = 50;
    public $harga_per_porsi = 25000;
    public $total_harga = 0;
    public $alamat;
    public $no_hp;
    public $catatan;
    public $bukti_pembayaran = [];

    public function mount()
    {
        // Pre-fill dari user data
        $user = Auth::user();
        $this->alamat = $user->alamat ?? '';
        $this->no_hp = $user->no_hp ?? '';
    }

    public function updatedQty()
    {
        $this->calculateTotal();
    }

    public function updatedHargaPerPorsi()
    {
        $this->calculateTotal();
    }

    protected function calculateTotal()
    {
        // Minimum 50 porsi
        $effectiveQty = max(50, $this->qty ?? 50);
        $this->total_harga = $effectiveQty * ($this->harga_per_porsi ?? 25000);
    }

    public function save()
    {
        $this->validate([
            'nama_acara' => 'required|string|max:50',
            'qty' => 'required|numeric|min:50|max:2000',
            'harga_per_porsi' => 'required|numeric|min:25000',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'catatan' => 'nullable|string',
            'bukti_pembayaran.*' => 'image|max:2048',
        ]);

        $files = [];
        foreach ($this->bukti_pembayaran as $file) {
            $files[] = $file->store('bukti-pembayaran-catering', 'public');
        }

        // Generate unique order code
        $orderCode = 'CAT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        while (CateringOrder::where('order_code', $orderCode)->exists()) {
            $orderCode = 'CAT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        }

        // Minimum 50 porsi
        $effectiveQty = max(50, $this->qty);
        $totalHarga = $effectiveQty * $this->harga_per_porsi;

        CateringOrder::create([
            'user_id' => Auth::id(),
            'order_code' => $orderCode,
            'nama_acara' => $this->nama_acara,
            'nama_pelanggan' => Auth::user()->name,
            'code_pelanggan' => Auth::id(),
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'qty' => $this->qty,
            'harga_per_porsi' => $this->harga_per_porsi,
            'total_harga' => $totalHarga,
            'catatan' => $this->catatan,
            'status' => 'pending',
            'bukti_pembayaran' => $files ?: null,
        ]);

        session()->flash('success', 'Pesanan catering berhasil dibuat');
        return redirect()->route('pelanggan.catering-pesanan');
    }

    public function render()
    {
        return view('livewire.pelanggan.catering-orders-create');
    }
}
