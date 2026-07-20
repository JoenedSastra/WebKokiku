<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Models\DrinkItem;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $orders = Order::with('items')->latestFirst()->get();

        // Dibutuhkan untuk form "Tambah Order" (pilih menu makanan/minuman aktif)
        $menuItems  = MenuItem::active()->ordered()->get();
        $drinkItems = DrinkItem::active()->ordered()->get();

        $logoPath = Setting::get('logo_path');
        $logoUrl  = $logoPath && Storage::disk('public')->exists($logoPath)
            ? Storage::disk('public')->url($logoPath)
            : null;
        $faviconUrl = $logoUrl;

        return view('admin.orders', compact('orders', 'menuItems', 'drinkItems', 'logoUrl', 'faviconUrl'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'customer_name'       => ['required', 'string', 'max:255'],
            'table_number'        => ['nullable', 'string', 'max:50'],
            'phone'                => ['nullable', 'string', 'max:50'],
            'notes'                => ['nullable', 'string', 'max:1000'],
            'items'                => ['required', 'array', 'min:1'],
            'items.*.type'         => ['required', 'in:menu,drink'],
            'items.*.id'           => ['required', 'integer'],
            'items.*.qty'          => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $order = DB::transaction(function () use ($validated) {
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'table_number'  => $validated['table_number'] ?? null,
                'phone'         => $validated['phone'] ?? null,
                'notes'         => $validated['notes'] ?? null,
                'status'        => 'menunggu',
                'total'         => 0,
            ]);

            $total = 0;

            foreach ($validated['items'] as $line) {
                $model = $line['type'] === 'menu'
                    ? MenuItem::find($line['id'])
                    : DrinkItem::find($line['id']);

                if (! $model) {
                    continue; // item mungkin sudah dihapus, lewati baris ini
                }

                $price    = (int) preg_replace('/[^0-9]/', '', (string) $model->price);
                $qty      = (int) $line['qty'];
                $subtotal = $price * $qty;
                $total   += $subtotal;

                OrderItem::create([
                    'order_id'  => $order->id,
                    'item_type' => $line['type'],
                    'item_id'   => $model->id,
                    'item_name' => $model->name,
                    'price'     => $price,
                    'qty'       => $qty,
                ]);
            }

            $order->update(['total' => $total]);

            return $order;
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat.',
                'order'   => $order->load('items'),
            ]);
        }

        return redirect()->back()->with('success', 'Order berhasil dibuat.');
    }

    public function updateStatus(Request $request, $id)
    {
        $this->authorizeAdmin();

        $order = Order::find($id);
        if (! $order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,diproses,selesai,dibatalkan'],
        ]);

        $order->update(['status' => $validated['status']]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Status order diperbarui.']);
        }

        return redirect()->back()->with('success', 'Status order diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorizeAdmin();

        $order = Order::find($id);
        if (! $order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan.'], 404);
        }

        $order->delete(); // order_items ikut terhapus otomatis (cascadeOnDelete di migration)

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Order berhasil dihapus.']);
        }

        return redirect()->back()->with('success', 'Order berhasil dihapus.');
    }

    protected function authorizeAdmin()
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }
}