<?php

namespace App\Livewire\Pelanggan;

use App\Models\CateringOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CateringOrders extends Component
{
    use WithFileUploads;

    public $cateringOrders;
    public $selectedOrder;
    public $bukti_pembayaran = [];

    public function mount()
    {
        $this->loadCateringOrders();
    }

    public function loadCateringOrders()
    {
        $this->cateringOrders = CateringOrder::where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    public function selectOrder($orderId)
    {
        $this->selectedOrder = CateringOrder::where('user_id', Auth::id())
            ->findOrFail($orderId);
    }

    public function uploadBukti()
    {
        $this->validate([
            'bukti_pembayaran.*' => 'image|max:2048',
        ]);

        $files = [];
        foreach ($this->bukti_pembayaran as $file) {
            $files[] = $file->store('bukti-pembayaran-catering', 'public');
        }

        // Merge dengan file yang sudah ada
        $existingFiles = (array) $this->selectedOrder->bukti_pembayaran ?? [];
        $allFiles = array_merge($existingFiles, $files);

        $this->selectedOrder->update([
            'bukti_pembayaran' => $allFiles,
            'status' => 'confirmed',
        ]);

        $this->reset('bukti_pembayaran');
        $this->loadCateringOrders();
        $this->selectedOrder = null;

        session()->flash('success', 'Bukti pembayaran berhasil dikirim.');
    }

    public function deletePaymentProof($fileName)
    {
        $files = (array) $this->selectedOrder->bukti_pembayaran ?? [];
        $files = array_filter($files, fn($file) => $file !== $fileName);

        // Delete file from storage
        Storage::disk('public')->delete($fileName);

        $this->selectedOrder->update([
            'bukti_pembayaran' => array_values($files),
        ]);

        $this->loadCateringOrders();
        $this->selectOrder($this->selectedOrder->id);

        session()->flash('success', 'Bukti pembayaran berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.pelanggan.catering-orders');
    }
}
