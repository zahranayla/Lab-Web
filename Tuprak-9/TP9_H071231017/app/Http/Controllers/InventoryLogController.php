<?php
namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class inventoryLogController extends Controller
{
    public function index()
    {
        $inventoryLogs = InventoryLog::with('product')->get();
        return view('inventory_logs.index', compact('inventoryLogs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory_logs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|string|in:restock,sold',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'sold' && $request->quantity > $product->stock) {
            return redirect()->route('inventory_logs.index')->with('error', 'Jumlah sold melebihi stok yang tersedia.');
        }
        InventoryLog::create($request->all());
        return redirect()->route('inventory_logs.index')->with('success', 'Log inventaris berhasil ditambahkan');
        // // Update stok produk sesuai dengan jenis perubahan (restock/sold)
        // if ($request->type === 'restock') {
        //     $product->increment('stock', $request->quantity);
        // } elseif ($request->type === 'sold') {
        //     $product->decrement('stock', $request->quantity);
        // }
        
        InventoryLog::create($request->all());
        return redirect()->route('inventory_logs.index')->with('success', 'Log inventaris berhasil ditambahkan');
    }

    public function destroy(InventoryLog $inventoryLog)
    {
        $inventoryLog->delete();
        return redirect()->route('inventory_logs.index')->with('success', 'Log inventaris berhasil dihapus');
    }
}