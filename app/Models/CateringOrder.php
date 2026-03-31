<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CateringOrder extends Model
{
    protected $table = 'catering_orders';

    protected $fillable = [
        'user_id',
        'order_code',
        'nama_acara',
        'nama_pelanggan',
        'code_pelanggan',
        'alamat',
        'no_hp',
        'qty',
        'harga_per_porsi',
        'total_harga',
        'catatan',
        'status',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'qty' => 'integer',
        'harga_per_porsi' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'bukti_pembayaran' => 'array',
    ];

    /**
     * Get the user (pelanggan) associated with this catering order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            // Generate order code if not exists
            if (!$model->order_code) {
                $model->order_code = 'CAT-' . now()->format('Ymd') . '-' . strtoupper(str()->random(6));
            }

            // Fill customer data from user if user_id is set
            if ($model->user_id) {
                $user = User::find($model->user_id);
                if ($user) {
                    $model->nama_pelanggan = $user->name;
                    $model->no_hp = $model->no_hp ?? $user->no_hp;
                    $model->alamat = $model->alamat ?? $user->alamat;
                }
            }

            // Calculate total harga
            if ($model->qty >= 50) {
                $model->total_harga = $model->qty * $model->harga_per_porsi;
            } else {
                // Minimum 50 porsi
                $model->total_harga = 50 * $model->harga_per_porsi;
            }
        });

        static::updating(function ($model) {
            // Handle bukti_pembayaran file deletion
            if ($model->isDirty('bukti_pembayaran')) {
                $oldFiles = (array) $model->getOriginal('bukti_pembayaran');
                $newFiles = (array) $model->bukti_pembayaran;
                $deletedFiles = array_diff($oldFiles, $newFiles);
                foreach ($deletedFiles as $file) {
                    Storage::disk('public')->delete($file);
                }
            }

            // Fill customer data from user if user_id changed
            if ($model->isDirty('user_id') && $model->user_id) {
                $user = User::find($model->user_id);
                if ($user) {
                    $model->nama_pelanggan = $user->name;
                    $model->no_hp = $model->no_hp ?? $user->no_hp;
                    $model->alamat = $model->alamat ?? $user->alamat;
                }
            }

            // Recalculate total harga if qty or harga_per_porsi changes
            if ($model->isDirty(['qty', 'harga_per_porsi'])) {
                $qty = $model->qty;
                $hargaPerPorsi = $model->harga_per_porsi ?? 25000;

                if ($qty >= 50) {
                    $model->total_harga = $qty * $hargaPerPorsi;
                } else {
                    // Minimum 50 porsi
                    $model->total_harga = 50 * $hargaPerPorsi;
                }
            }
        });

        // Delete all files when catering order is deleted
        static::deleting(function ($model) {
            foreach ((array) $model->bukti_pembayaran as $file) {
                Storage::disk('public')->delete($file);
            }
        });
    }
}
