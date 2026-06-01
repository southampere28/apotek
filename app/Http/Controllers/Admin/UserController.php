<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apoteker;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function supplierCreate(): View
    {
        return view('admin.supplier-create', [
            'title' => 'Tambah Supplier',
            'role' => 'admin',
            'description' => 'Tambahkan data supplier baru dengan kode otomatis dari helper.',
            'kodeSupplier' => generate_kode_supplier(),
        ]);
    }

    public function supplierStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_supplier' => ['required', 'string', 'max:255', 'unique:supplier,kode_supplier'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'kota' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', 'Supplier baru berhasil ditambahkan.');
    }

    public function apotekerCreate(): View
    {
        return view('admin.apoteker-create', [
            'title' => 'Tambah Apoteker',
            'role' => 'admin',
            'description' => 'Tambahkan apoteker baru beserta akun login yang terhubung.',
            'kodeApoteker' => generate_kode_apoteker(),
        ]);
    }

    public function apotekerStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_apoteker' => ['required', 'string', 'max:255', 'unique:apoteker,kode_apoteker'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'alamat' => ['required', 'string'],
            'kota' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'apoteker',
            ]);

            Apoteker::create([
                'kode_apoteker' => $validated['kode_apoteker'],
                'user_id' => $user->id,
                'nama' => $validated['name'],
                'alamat' => $validated['alamat'],
                'kota' => $validated['kota'],
                'telepon' => $validated['telepon'],
            ]);
        });

        return redirect()
            ->route('admin.apoteker.index')
            ->with('success', 'Apoteker baru berhasil ditambahkan.');
    }

    public function pelangganCreate(): View
    {
        return view('admin.pelanggan-create', [
            'title' => 'Tambah Pelanggan',
            'role' => 'admin',
            'description' => 'Tambahkan pelanggan baru beserta akun login yang terhubung.',
            'kodePelanggan' => generate_kode_pelanggan(),
        ]);
    }

    public function pelangganStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_pelanggan' => ['required', 'string', 'max:255', 'unique:pelanggan,kode_pelanggan'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'alamat' => ['required', 'string'],
            'kota' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'pelanggan',
            ]);

            Pelanggan::create([
                'kode_pelanggan' => $validated['kode_pelanggan'],
                'user_id' => $user->id,
                'nama' => $validated['name'],
                'alamat' => $validated['alamat'],
                'kota' => $validated['kota'],
                'telepon' => $validated['telepon'],
            ]);
        });

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan baru berhasil ditambahkan.');
    }

    public function pelangganIndex(): View
    {
        $pelangganList = Pelanggan::with('user')
            ->orderBy('nama')
            ->get();

        return view('admin.pelanggan', [
            'title' => 'Manajemen Pelanggan',
            'role' => 'admin',
            'description' => 'Kelola data pelanggan, status akun, dan riwayat transaksi.',
            'pelangganList' => $pelangganList,
            'totalPelanggan' => $pelangganList->count(),
            'pelangganDenganAkun' => $pelangganList->whereNotNull('user_id')->count(),
            'pelangganBaruBulanIni' => $pelangganList->where('created_at', '>=', now()->startOfMonth())->count(),
        ]);
    }

    public function supplierIndex(): View
    {
        $supplierList = Supplier::withCount(['obat', 'pembelian'])
            ->orderBy('nama')
            ->get();

        return view('admin.supplier', [
            'title' => 'Manajemen Supplier',
            'role' => 'admin',
            'description' => 'Kelola data supplier, kontak, dan relasi pembelian obat.',
            'supplierList' => $supplierList,
            'totalSupplier' => $supplierList->count(),
            'supplierDenganObat' => $supplierList->where('obat_count', '>', 0)->count(),
            'totalObatTerkait' => $supplierList->sum('obat_count'),
            'totalPembelianTerkait' => $supplierList->sum('pembelian_count'),
        ]);
    }

    public function apotekerIndex(): View
    {
        $apotekerList = Apoteker::with('user')
            ->orderBy('nama')
            ->get();

        return view('admin.apoteker', [
            'title' => 'Manajemen Apoteker',
            'role' => 'admin',
            'description' => 'Kelola data apoteker, akun login, dan data kontak.',
            'apotekerList' => $apotekerList,
            'totalApoteker' => $apotekerList->count(),
            'apotekerDenganAkun' => $apotekerList->whereNotNull('user_id')->count(),
            'apotekerBaruBulanIni' => $apotekerList->where('created_at', '>=', now()->startOfMonth())->count(),
        ]);
    }
}